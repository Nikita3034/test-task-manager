<?php

namespace App\Traits;

trait PaginationTrait
{
    protected $limit = 3;

    /**
     * Get pagination for list page
     *
     * @param [type] $count_posts
     * @param [type] $form_id
     * @return void
     */
    protected function getPagination($count_posts, $form_id)
    {
        if ($count_posts > $this->limit) {

            $p = !empty($_GET['page']) ? (int) $_GET['page'] : 0;

            $pages_count = ceil($count_posts / $this->limit);

            if ($pages_count > 0) {

                $pages = range(0, $pages_count - 1);
    
                if ($pages_count > 8) {
    
                    if ($p > 5 && $p < ($pages_count - 5)) {
                        $pages = array_merge(range($p - 4, $p + 4));
                    } else if ($p >= ($pages_count - 5)) {
                        $pages = array_merge(range($pages_count - 8, $pages_count));
                    } else {
                        $pages = array_merge(range(0, 8));
                    }
                }

                require_once VIEWS_PATH .'/pagination.tpl.php';
            }
        }
    }
}