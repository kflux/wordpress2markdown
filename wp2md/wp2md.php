<?php

header('Content-Type: text/html; charset=UTF-8');

require_once('HTML_To_Markdown.php');
require_once('../wp-load.php');

$args = array(
    'post_type' => 'post',
    'post_status' => 'publish',
    'posts_per_page' => -1
);

$query = new WP_Query($args);
while ( $query->have_posts() ) : $query->the_post();
    $f = fopen(__DIR__ . '/' . basename(get_permalink()) . '.md', 'w');
    $content = 'Title: ' . html_entity_decode(urldecode(get_the_title())) . PHP_EOL;
    $content .= 'Date: ' . get_the_date("Y-m-d h:m") . PHP_EOL;
    
    // get categories
    // Pelican only supports one category, so make sure to clean this up later
    $content .= 'Category: ';
    $cats = array();
    foreach (get_the_category() as $cat) {
        $cats[] = $cat->cat_name;
    }
    $content .= implode(', ', $cats) . PHP_EOL;
    
    // get tags
    $posttags = get_the_tags();
    $tags = array();
    if ($posttags) {
        foreach($posttags as $tag) {
            $tags[] = $tag->name;
        }
        $content .= PHP_EOL . 'Tags: ';
        $content .= implode(', ', $tags);
    }
    $content .= PHP_EOL;
    
    $content .= 'Slug: ' . basename(get_permalink()) . PHP_EOL;
    $content .= 'Author: ' . get_the_author() . PHP_EOL;
    
    // get all custom fields except the WP internal ones starting with _underscore
    // plugins might add custom fields too, so make sure to clean this up too
    $customs = get_post_custom();
    foreach($customs as $key => $value) {
if(substr($key,0,1) != '_') $content .= $key . ': ' . $value[0] . PHP_EOL;
    }

    // convert the article HTML to vlid Markdown
    $content .= PHP_EOL;
    $content .= new HTML_To_Markdown($post->post_content);

    $content .= PHP_EOL . PHP_EOL;
    print_r($content);
    fwrite($f, $content);
    fclose($f);
endwhile;

?>
