<?php
 /*
    Author: Jim Westergren, Jeedo Aquino & Flynsarmy
    File: index-with-redis.php
    Updated: 2012-10-25
 
    This is a redis caching system for wordpress.
    see more here: www.jimwestergren.com/wordpress-with-redis-as-a-frontend-cache/
 
    Originally written by Jim Westergren but improved by Jeedo Aquino.
 
    some caching mechanics are different from jim's script which is summarized below:
 
    - cached pages do not expire not unless explicitly deleted or reset
    - appending a ?c=y to a url deletes the entire cache of the domain, only works when you are logged in
    - appending a ?r=y to a url deletes the cache of that url
    - submitting a comment deletes the cache of that page
    - refreshing (f5) a page deletes the cache of that page
    - includes a debug mode, stats are displayed at the bottom most part after </html>
 
    for setup and configuration see more here:
    www.jeedo.net/lightning-fast-wordpress-with-nginx-redis/
*/
 

// change vars here
$debug = 1;			// set to 1 if you wish to see execution time and cache actions
define('PAGE_EXPIRE_SECONDS', 10*60);
define('HOMEPAGE_EXPIRE_SECONDS', 3*60);

 
$start = microtime();   // start timing page exec
 
// if cloudflare is enabled
if ( isset($_SERVER['HTTP_CF_CONNECTING_IP']) ) {
    $_SERVER['REMOTE_ADDR'] = $_SERVER['HTTP_CF_CONNECTING_IP'];
}
 
// from wp
define('WP_USE_THEMES', true);
 
// init predis
require './predis/src/Autoloader.php';
Predis\Autoloader::register();
$redis = new Predis\Client();
 
// init vars
$cached = 0;
$domain = $_SERVER['HTTP_HOST'];
$url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
$url = str_replace('?r=y', '', $url);
$url = str_replace('?c=y', '', $url);
$dkey = $domain; // md5($domain);
$ukey = $url; //md5($url);
 
// check if page isn't a comment submission
$submit = false; // isset($_SERVER['HTTP_CACHE_CONTROL']) && $_SERVER['HTTP_CACHE_CONTROL'] == 'max-age=0';
 
// check if logged in to wp
$cookie = var_export($_COOKIE, true);
$loggedin = preg_match("/wordpress_logged_in/", $cookie);
 
// check if a cache of the page exists
if (!$loggedin && !$submit && $redis->get($ukey) && !strpos($url, '/feed/')) {
 
    echo $redis->get($ukey);
    $cached = 1;
    $msg = 'this is a cache';
 
// if a comment was submitted or clear page cache request was made delete cache of page
} else if ($submit || substr($_SERVER['REQUEST_URI'], -4) == '?r=y') {
 
    include('./wp-blog-header.php');
    $redis->hdel($dkey, $ukey);
    $msg = 'cache of page deleted';
 
// delete entire cache, works only if logged in
} else if ($loggedin && substr($_SERVER['REQUEST_URI'], -4) == '?c=y') {
 
    include('./wp-blog-header.php');
    if ($redis->exists($dkey)) {
        $redis->del($dkey);
        $msg = 'domain cache flushed';
    } else {
        $msg = 'no cache to flush';
    }
 
// if logged in don't cache anything
} else if ($loggedin) {
 
    include('./wp-blog-header.php');
    $msg = 'not cached';
 
// cache the page
} else {
 
    // turn on output buffering
    ob_start();
 
    include('./wp-blog-header.php');
 
    // get contents of output buffer
    $html = ob_get_contents();
 
    // clean output buffer
    ob_end_clean();
    echo $html;
 

    if (!is_404() ) {
        // store html contents to redis cache
        if( $_SERVER['REQUEST_URI'] == '/') {
            $redis->setex($ukey, HOMEPAGE_EXPIRE_SECONDS, $html);
        }else{
            $redis->setex($ukey, PAGE_EXPIRE_SECONDS, $html);
        }
        $msg = 'cache is set';
    }
}
 
$end = microtime(); // get end execution time
 
// show messages if debug is enabled
if ($debug) {
    echo "<!-- REDIS DEBUG\n";
    echo $msg.': ' .  t_exec($start, $end);
    echo ' -->';
}
 

 
// time diff
function t_exec($start, $end) {
    $t = (getmicrotime($end) - getmicrotime($start));
    return round($t,5);
}
 
// get time
function getmicrotime($t) {
    list($usec, $sec) = explode(" ",$t);
    return ((float)$usec + (float)$sec);
}
