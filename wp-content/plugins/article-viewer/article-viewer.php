<?php
/*
Plugin Name: Article viewer
Description: Navigate through articles
Author: Vincent Delsalle
Version: 1.0
*/

//script js and css
add_action( 'wp_enqueue_scripts', 'article_viewer_enqueue' );
function article_viewer_enqueue() {
    //js
    wp_enqueue_script('jquery');
    wp_enqueue_script('viewer', plugins_url('js/art_viewer.js', __FILE__));
    
    //on passe un objet avec url admin ajax pour eviter de mettre url en dur
    wp_localize_script( 'viewer', 'ajax_object',
            array( 'api_url' => site_url()) );
    
            //css
  wp_enqueue_style('viewer', plugins_url('css/art_viewer.css', __FILE__));
}


//add shortcode to homepage "/"
add_shortcode('categories-viewer', 'categories_viewer');

function categories_viewer(){
    $html = '<div id="categories_viewer">Loading...</div>';
    return $html;
}

//add shortcode to page Article Viewer "/viewer"
add_shortcode('article-viewer', 'article_viewer');

function article_viewer(){
    $html = '<h4>NAVIGATE THROUGH THE ARTICLES</h4>';
    $html .= '<p>Press K to display the previous article<br>Press J to display the next article</p>';
    $html .= '<div id="next-arrow"><span id="after" style="display: none;">< NEXT</span></div>';
    $html .= '<div id="previous-arrow"><span id="before" style="display: none;">PREV ></span></div>';
    $html .= '<div id="article_viewer">Loading...</div>';
    return $html;
}