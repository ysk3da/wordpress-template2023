<?php
// WordPressバージョン情報の削除
remove_action('wp_head','wp_generator');
// Windows Live Writerの削除
remove_action('wp_head', 'wlwmanifest_link');
// 絵文字設定の削除
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
// フィード配信の削除
remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'feed_links_extra', 3);
// RSDの削除
remove_action( 'wp_head', 'rsd_link' );

// v6.1以降 classic-theme.min.css の削除
add_action( 'wp_enqueue_scripts', 'remove_classic_theme_style' );
function remove_classic_theme_style() {
	wp_dequeue_style( 'classic-theme-styles' );
}

// 全ページでアイキャッチ画像を設定する場合
add_theme_support('post-thumbnails');

// titleタグの自動挿入
// eg 記事タイトル | サイトタイトル
add_theme_support('title-tag');

/* ウィジェットの機能を追加 */
add_theme_support('widgets');

// CSS、JSの読み込み
function my_script_init() {
  // style.css
  wp_enqueue_style('style', get_template_directory_uri() . 'style.css', array('reset'));  //css読み込み
  // js
  wp_enqueue_script('js', get_template_directory_uri() . '/js/index.js', array(), '1.0.0', true); // index.js読み込み
}

add_action('wp_enqueue_scripts', 'my_script_init');

/* 投稿管理画面にあるビジュアルモードタブを非表示 */
// function disable_visual_editor_pg()
// {
//   add_filter('user_can_richedit', 'disable_visual_editor');
// }
// function disable_visual_editor()
// {
//   return false;
// }
// add_action('load-post.php', 'disable_visual_editor_pg');
// add_action('load-post-new.php', 'disable_visual_editor_pg');
