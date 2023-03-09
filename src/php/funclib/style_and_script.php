<?php
// CSS、JSの読み込み
// function_exists は 親テーマと子テーマ間で定義済みか、overrideすべきかの判断に利用されます。
if ( ! function_exists( 'my_theme_script_init' ) ) {
  function my_theme_script_init() {
    // style.css
    wp_enqueue_style('style', get_template_directory_uri() . '/style.css', array());  //css読み込み
    // 【Reactの利用】依存関係に wp-element を指定するとreactとreact-domが入ってくる。
    // wp_enqueue_script('my-script', get_theme_file_uri() . '/js/my-script.js?', ['wp-element'], '1.0.0', true);

    // js 第４引数を true にすると </body> の直前で呼ばれる false で headタグ内で呼ばれる
    wp_enqueue_script('js', get_template_directory_uri() . '/js/index.js', array(), '1.0.0', true); // index.js読み込み
  }
}
add_action( 'wp_enqueue_scripts', 'my_theme_script_init' );

// JavaScriptファイルの読み込みをコントロールする

// 全登録スクリプトのハンドル名を調べる
// 納品前に削除またはコメントアウト
// function my_inspect_scripts() {
//   if (!is_user_logged_in()) { return; }
//   global $wp_scripts;
//   $handles = array();
//   foreach ( $wp_scripts->queue as $handle ) {
//     array_push($handles, $handle);
//   }
//   echo implode(' , ', $handles);
// }
// add_action( 'wp_print_scripts', 'my_inspect_scripts' );

/// 特定プラグインのscriptタグにdefer="defer"を追加
// add_filter('script_loader_tag', 'my_add_defer_to_script', 10, 2);
// function my_add_defer_to_script($tag, $handle) {
//   $scripts_to_defer = array(
//     'jquery-migrate', // jQuery用
//   );
//   foreach($scripts_to_defer as $defer_script) {
//     if ($defer_script === $handle) {
//       return str_replace(
//         ' src', ' defer="defer" src', $tag);
//     }
//   }
//   return $tag;
// }

/// 特定プラグインのscriptタグに async を追加
add_filter('script_loader_tag', 'my_add_async_to_script', 10, 2);
function my_add_async_to_script($tag, $handle)
{
  if (!is_admin()) {
    $scripts_to_async = array(
      // 'jquery-core', // jQuery用
      'wp-block-navigation-view',
      'wp-block-navigation-view-2'
    );
    foreach ($scripts_to_async as $async_script) {
      if ($async_script === $handle) {
        return str_replace(
          ' src',
          ' async src',
          $tag
        );
      }
    }
  }
  return $tag;
}

// CSSファイルの読み込みをコントロールする

// 全登録スタイルのハンドル名を調べる
// 納品前に削除またはコメントアウト
// function my_inspect_styles() {
//   if (!is_user_logged_in()) { return; }
//   global $wp_styles;
//   $handles = array();
//   foreach ( $wp_styles->queue as $handle ) {
//     array_push($handles, $handle);
//   }
//   echo implode(' , ', $handles);
// }
// add_action( 'wp_print_styles', 'my_inspect_styles' );

// preload css in wordpress
add_filter('style_loader_tag',  'preload_css', 10, 2);
function preload_css($html, $handle)
{
  if (!is_admin()) {
    $targetHanlde = array(
      'wp-block-navigation',
      'wp-block-post-featured-image',
      'wp-block-library',
      'style',
    );
    if (in_array($handle, $targetHanlde)) {
      $html = str_replace(' href', ' rel="preload" href', $html);
    }
  }
  return $html;
}
