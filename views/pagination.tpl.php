<div class="col-md-12">
    <ul class="pagination" data-form="<?=$form_id?>">
        <li>
            <a data-page="0">«</a>
        </li>
        <?php foreach ($pages as $page) { ?>
            <li>
                <a data-page="<?=$page?>" class="<?= $p == $page ? 'active' : '' ?>">
                    <?= $page + 1 ?>
                </a>
            </li>
        <?php } ?>
        <li><a data-page="<?=$pages_count - 1?>">»</a></li>
    </ul>
</div>