# WordPress ローカル開発環境の構築

## WordPressローカルはwp-envで

- [WordPress制作環境の過去と現在、そして未来はどうなる？wp-envの使い方を紹介](https://liginc.co.jp/612383)

- [公式リファレンス](https://ja.wordpress.org/team/handbook/block-editor/reference-guides/packages/packages-env/)

インストール

```shell
npm init -y
npm i -D @wordpress/env
```

設定ファイルを作成する

- [.wp-env.json](.wp-env.json)

ログイン画面とユーザーの確認

- [ローカルログイン画面](http://localhost:10011/wp-login.php)

```sh
npx wp-env run cli wp user list

# 下記が出力
ℹ Starting 'wp user list' on the cli container. 

[+] Running 2/0
 ⠿ Container a0f834c401b07af63ad237f595ef346c-mysql-1      Running                                                                                                                                                                     0.0s
 ⠿ Container a0f834c401b07af63ad237f595ef346c-wordpress-1  Running                                                                                                                                                                     0.0s
+----+------------+--------------+-----------------------+---------------------+---------------+
| ID | user_login | display_name | user_email            | user_registered     | roles         |
+----+------------+--------------+-----------------------+---------------------+---------------+
| 1  | admin      | admin        | wordpress@example.com | 2023-02-27 01:31:55 | administrator |
+----+------------+--------------+-----------------------+---------------------+---------------+
✔ Ran `wp user list` in 'cli'. (in 3s 315ms)
```

パスワードは `password` です。


## 設定ファイル（.wp-env.json）を更新したら、更新する

```shell
npm run update
```

## giboでgitignoreファイルを生成する

- [giboでgitignoreを自動生成する](https://qiita.com/taquaki-satwo/items/358d2d473fff9a25d5eb)

- [公式](https://github.com/simonwhitaker/gibo)

```shell
gibo dump macOS Node VisualStudioCode >> .gitignore
```

必ず`.gitignore`ファイルを確認すること。

## Core Web Vital のための設定

### サーバの設定

- [【WV.1】リソース配信最適化のためのサーバー設定](https://capitalp.jp/2021/07/05/browser-cache-and-gzip/)

Apacheの場合`.htaccess`ファイルで制御する

- [htaccessサンプル](./backend/htaccess-wp-sample.text)

NginXの場合

- [server設定サンプル](./backend/nginx-wp-setting-sample.text)

### 画像配信の最適化

- [【WV.2】WordPressにおける画像の最適化と次世代画像配信](https://capitalp.jp/2021/07/06/%e3%80%90wv-2%e3%80%91wordpress%e3%81%ab%e3%81%8a%e3%81%91%e3%82%8b%e7%94%bb%e5%83%8f%e3%81%ae%e6%9c%80%e9%81%a9%e5%8c%96%e3%81%a8%e6%ac%a1%e4%b8%96%e4%bb%a3%e7%94%bb%e5%83%8f%e9%85%8d%e4%bf%a1/)

- [Apacheでのwebp出し分け設定サンプル](./backend/htaccess-webp-sample.text)

### ページキャッシュの設定

- [【WV.3】TTFBとページキャッシュ](https://capitalp.jp/2021/07/06/wordpress-and-ttfb/)

`wp-env.json`にプラグインの[`WP Super Cache`](https://ja.wordpress.org/plugins/wp-super-cache/)を設定。

### 動的WordPressのTTFB最適化

- [【WV.4】動的WordPressサイトでどこまでTTFBを下げられるか](https://capitalp.jp/2021/07/07/dyanamic-page-and-ttfb/)

プラグインで改善可能だがセキュリティ面も鑑みて、テンプレートに入れるのは見送るべき

### JSとCSSの遅延読み込み

- [【WV.5】WordPressにおけるJSとCSSの遅延読み込み](https://capitalp.jp/2021/07/07/lazy-loading-of-js-and-css/)

Critical などの処置をして、ファーストビュー対応の部分を切り出すなどの工夫が必要だが、CSSの遅延自体は効果あり。
また、JavaScriptファイルもレイアウトに影響のない部分は defer 対応で良い。

### テーマ作成時の画像の処理

- [【WV.6】WordPressテーマ作成における画像読み込みとサイズ最適化](https://capitalp.jp/2021/07/08/image-optimization-for-wordpress/)

### サードパーティーリソースの削減または改善

- [【WV.7】サードパーティーリソースの削減または改善](https://capitalp.jp/2021/07/09/remove-3rd-party-resources/)

### WordPressのJSおよびCSSを最適化する

- [【WV.8】WordPressのJSおよびCSSを最適化する](https://capitalp.jp/2021/07/12/optimize-css-and-js-in-wordpress/)

ここですね、

- webpack or vite でバンドルだけする（その他のリソースはタスクランナーでコピーのみする）
- vue3 + vite でMPA
- create-react-appでMPA

### プリフェッチとAMP, PWA, Signed Exchange（SXG）

- [【WV.9】Native AMP, PWA, Signed ExchangeとWordPress](https://capitalp.jp/2021/07/14/google-needs-acceleration/)

### チェックリスト

- [【WV.10】WordPress高速化のためのCore Web Vital チェックリスト](https://capitalp.jp/2021/08/03/check-list-for-wp-web-core-vital/)