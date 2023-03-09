<?php
// テーマごとの設定
// function_exists は 親テーマと子テーマ間で定義済みか、overrideすべきかの判断に利用されます。
if (!function_exists('my_theme_setup')) {
  /**
   * Sets up theme defaults and registers support for various WordPress features.
   *
   * Note that this function is hooked into the after_setup_theme hook, which runs
   * before the init hook.
   */
  function my_theme_setup()
  {
    // titleタグの自動挿入
    // eg 記事タイトル | サイトタイトル
    add_theme_support('title-tag');
    add_theme_support('custom-logo');

    // 全ページでアイキャッチ画像を設定する場合
    add_theme_support('post-thumbnails');

    // ブロックスタイル
    add_theme_support('wp-block-styles');

    // ウィジェットの機能を追加
    // add_theme_support('widgets');

    // v5.9以降 global-stylesのインラインCSS出力を排除する
    // add_action('wp_enqueue_scripts', 'remove_global_styles');
    // function remove_global_styles() {
    // wp_dequeue_style('global-styles');
    // }

    // v6.1以降 classic-theme.min.css の削除
    add_action('wp_enqueue_scripts', 'remove_classic_theme_style');
    function remove_classic_theme_style()
    {
      wp_dequeue_style('classic-theme-styles');
    }
    /*
    * Switch default core markup for search form, comment form, and comments
    * to output valid HTML5.
    */
    add_theme_support(
      'html5',
      array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'script',
        'style',
        'navigation-widgets',
      )
    );

    /*
    * Load additional block styles.
    */
    $styled_blocks = ['query-pagination-numbers'];
    foreach ( $styled_blocks as $block_name ) {
      $args = array(
        'handle' => "my_theme-$block_name",
        'src'    => get_theme_file_uri( "css/blocks/$block_name.css" ),
      );
      wp_enqueue_block_style( "core/$block_name", $args );
    }

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
  }
}
add_action('after_setup_theme', 'my_theme_setup');
