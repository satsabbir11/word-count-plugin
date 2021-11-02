<?php
/*
Plugin Name: Word Count
Plugin URI: https://github.com/satsabbir11/word-count-plugin
Description: A wordpress word count plugin
Version: 1.0
Author: satsabbir11
Author URI: https://github.com/satsabbir11
License: GPLv2 or later
Text Domain: wordcount
Domain Path: /languages/
*/


function wordcount_load_textdomain(){
    load_plugin_textdomain('wordcount',false,dirname(__FILE__)."/languages");
}
add_action("plugins_loaded","wordcount_load_textdomain");


function wordcount_content_wordnumber($content){
    $remove_stripped = strip_tags($content);
    $word_num        = str_word_count($remove_stripped);
    $label           = __("Total number of words","word-count");
    $label           = apply_filters("wordcount_heading",$label);
    $tag             = apply_filters("wordcount_tag","h3");
    $content         .= sprintf("<%s>%s: %s</%s>",$tag,$label,$word_num,$tag);
    return $content;
}
add_filter("the_content","wordcount_content_wordnumber");

function wordcount_reading_time($content){
    $remove_stripped   = strip_tags($content);
    $word_num          = str_word_count($remove_stripped);
    $reading_minutes   = floor($word_num/120);
    $reading_seconds   = ceil(($word_num%120)/2);
    $label             =__("Total Time","word-count");
    $label             = apply_filters("wordcount_reading_heading",$label);
    $tag               = apply_filters("wordcount_reading_tag","h3");
    $is_visible        = apply_filters("wordcount_readingtime_showing",true);
    if($is_visible) {
        $content .= sprintf("<%s>%s: %s minutes, %s seconds</%s>", $tag, $label, $reading_minutes, $reading_seconds, $tag);
    }
    return $content;
}
add_filter("the_content","wordcount_reading_time");