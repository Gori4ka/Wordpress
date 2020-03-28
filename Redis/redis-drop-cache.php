<?php
define('WP_DEBUG', true);
define('WP_USE_THEMES', false);
include('./wp-blog-header.php');
redis_invalidate_all();
echo 'DONE!';