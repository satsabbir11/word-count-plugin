<?php
/*
Plugin Name: word-count
Plugin URI: 
Description: A wordpress word count plugin
Version: 1.0
Author: satsabbir11
Author URI:
License: GPLv2 or later
Text Domain: word-count
Domain Path: /languages/
*/


function wordcount_load_textdomain(){
    load_plugin_textdomain('word-count',false,dirname(__FILE__)."/languages");
}
add_action("plugins_loaded","wordcount_load_textdomain");

function wordcount_content_wordnumber($content){
    $remove_stripped = strip_tags($content);
    $word_num        = str_word_count($remove_stripped);
    $label           = __("Total number of words","word-count");
    $content        .= sprintf("<h1>%s: %s</h1>",$label,$word_num);
    return $content;
}
add_filter("the_content","wordcount_content_wordnumber");