<?php
// WordPressバージョン情報の削除
remove_action('wp_head','wp_generator');
// ショートリンクの削除
remove_action('wp_head', 'wp_shortlink_wp_head');
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