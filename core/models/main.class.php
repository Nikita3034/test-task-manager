<?php

class Main {

    private $class = null;
    private $model = null;
    protected static $view = null;

    protected static $url = null;
    private $path = null;
    
    private $db = null;

    CONST admin_role = 1;

    public function __construct() {

        $this->class = 'main';
    }

    public function load() {

        self::$url = parse_url($_SERVER['REQUEST_URI'])['path'];

        $this->breakUrl();

        $this->initClass();

        if ($this->isAjax())
            $this->actionAjax();
        else
            $this->print();
    }

    private function breakUrl() {

        $url = explode('/', self::$url);

        if (!empty($url[1]))
            $this->class = $url[1];
    }

    private function initClass( $class = false ) {

        if ($class)
            $this->class = $class;

        self::$view = $this->class;
     
        $this->path = MODEL_PATH .'/'. $this->class .'.class.php';

        if (file_exists($this->path)) {

            require_once $this->path;

            $this->model = new $this->class;
        }
    }

    private function print() {

        $this->getHeader();

        $this->getBody();

        $this->getFooter();
    }

    private function getHeader() {

        require_once VIEWS_PATH .'/header.tpl.php';
    }

    private function getBody() {

        $this->path = VIEWS_PATH .'/'. $this->class .'/'. self::$view .'.tpl.php';

        if (!file_exists($this->path))
            $this->getPage404();

        require_once $this->path;
    }

    private function getFooter() {

        require_once VIEWS_PATH .'/footer.tpl.php';
    }

    private function getPage404() {

        require_once VIEWS_PATH .'/page404.tpl.php';
        
        exit;
    }

    private function dbConnect() {

        require_once CORE_PATH.'/db.params.php';
        require_once CORE_PATH.'/db.class.php';

        $db_params = [
            'user' => DB_USER,
            'pass' => DB_PASS,
            'db' => DB_NAME,
        ];

        $this->db = new SafeMySQL($db_params);
    }

    protected function getDB() {

        $this->dbConnect();

        return $this->db;
    }

    protected function isAjax() {

        if( !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' )
            return true;

        return false;
    }

    private function actionAjax() {

        $url = explode('/', self::$url);

        if (empty($url[2]))
            return false;

        if (!method_exists($this->model, $url[2]))
            return false;

        $result = $this->model->{$url[2]}();

        $this->resultAjax($result);
    }

    protected function resultAjax( $result ) {

        echo json_encode($result);

        die();
    }

    protected function getPagination( $count_posts, $current_count, $form_id ) {

        if ($count_posts > $current_count) {

            $p = !empty($_GET['page']) ? (int) $_GET['page'] : 0;

            $pages_count = ceil($count_posts / $current_count);

            if ($pages_count > 0) {

                $pages = range(0, $pages_count - 1);
    
                if ($pages_count > 8) {
    
                    if( $p > 5 && $p < ($pages_count - 5) )
                        $pages = array_merge(range($p - 4, $p + 4));
                    else if( $p >= ($pages_count - 5) )
                        $pages = array_merge(range($pages_count - 8, $pages_count));
                    else
                        $pages = array_merge(range(0, 8));
                }

                require_once VIEWS_PATH .'/pagination.tpl.php';
            }
        }
    }

    protected function cleanString( $string ) {

        // удаление пробелов из начала и конца строки
        $string = trim($string);

        // удаления экранированных символов
        $string = stripslashes($string);

        // удаления тегов
        $string = strip_tags($string);

        // преобразование специальных символов в HTML
        $string = htmlspecialchars($string);
        
        return $string;
    }

    protected function isAdmin() {

        if (isset($_COOKIE['user_id']) and isset($_COOKIE['user_hash'])) {

            $db = $this->getDB();

            $sql = "SELECT * FROM ?n WHERE `ID` = ?i AND `hash` = ?s AND `role` = ?i";

            $result = $db->getOne($sql, 'users', $_COOKIE['user_id'], $_COOKIE['user_hash'], self::admin_role);

            if (empty($result))
                return false;

        } else
            return false;

        return true;
    }

    protected function isAuth() {

        $db = $this->getDB();

        $sql = "SELECT * FROM ?n WHERE `ID` = ?i AND `hash` = ?s";

        $result = $db->getOne($sql, 'users', $_COOKIE['user_id'], $_COOKIE['user_hash']);

        if (isset($_COOKIE['user_id']) and isset($_COOKIE['user_hash'])) {

            $db = $this->getDB();

            $sql = "SELECT * FROM ?n WHERE `ID` = ?i AND `hash` = ?s";

            $result = $db->getOne($sql, 'users', $_COOKIE['user_id'], $_COOKIE['user_hash']);

            if (empty($result))
                return false;

        } else
            return false;

        return true;
    }
}