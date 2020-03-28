<?php
global $wpdb;
$total = $wpdb->get_var('SELECT count(*) FROM tablename');

$pagenum = 1;
    if (isset($_GET['pagenum']) && (int) $_GET['pagenum']) {
        $pagenum = (int) $_GET['pagenum'];
    }
    $limit = 24;
    $offset = ( $pagenum - 1 ) * $limit;

$results = $wpdb->get_results('SELECT * FROM tablename WHERE 1==1 LIMIT '.$limit.' OFFSET '.$offset);
?>
<div class="">
	<?php foreach ($results as $result) { 
		
	}?>
</div>
<div class="">
	<?php custom_paginator($total, 3, $limit, 'http://example.com'); ?>
</div>

<?php

function custom_paginator($total, $showPags, $post_per_page, $url) {
    $num_of_pages = ceil($total / $post_per_page);
    $curren_page = (int) $_GET['pagenum'];
    if ($num_of_pages > 1) {
        ?>
        <div class="custom-page-nav">
            <ul class="pagination justify-content-center">
                <li class="page-item">
                    <a class="page-link" href="<?php if ($curren_page - 1 > 0) echo $url."/".($curren_page - 1); ?>" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                <?php
                if ($curren_page == 1) {
                    $active_class = 'active';
                }
                $display_none = '';
                $display = '';
                if ($curren_page <= $showPags) {
                    $display_none = 'style = "display:none "';
                }
                if ($num_of_pages - $showPags < $curren_page) {
                    $display = 'style = "display:none "';
                }
                ?>
                <li class="page-item  <?php echo $active_class; ?>">
                    <a class="page-link" href="<?php echo $url."/1"; ?>">1</a>
                </li>
                <li class="page-item" <?php echo $display_none; ?> >
                    <span class="page-link page-point">...</span>
                </li>
                <?php
                for ($i = 2; $i < $num_of_pages; $i++) {
                    if ($i > $curren_page - $showPags && $i < $curren_page + $showPags) {
                        $active_class = '';
                        if ($curren_page == $i) {
                            $active_class = ' active';
                        }
                        ?>
                        <li class="page-item  <?php echo $active_class; ?>">
                            <a class="page-link" href="<?php echo $url."/".$i; ?>"><?php echo $i; ?></a>
                        </li>
                        <?php
                    }
                }
                if ($num_of_pages > $showPags) {
                    ?>
                    <li class="page-item" <?php echo $display; ?>>
                        <span class="page-link page-point">...</span>
                    </li>
                    <?php
                }
                if ($curren_page == $num_of_pages) {
                    $active = ' active';
                }
                ?>
                <li class="page-item <?php echo $active; ?>">
                    <a class="page-link" href="<?php echo $url."/".$num_of_pages; ?>"><?php echo $num_of_pages; ?></a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="<?php if ($curren_page + 1 <= $num_of_pages) echo $url."/".($curren_page + 1); ?>" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </div>
        <?php
    }
}