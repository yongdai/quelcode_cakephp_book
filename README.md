# docker-lemp-composer1

- laravel と cakephp がすぐに使える docker 環境が欲しかった

## php コンテナの bash を実行するまで

1. このリポジトリをクローンして中に入る

   ```
   git clone https://github.com/Yuzunoha/docker-lemp-composer1.git

   cd docker-lemp-composer1
   ```

1. docker/php/Dockerfile の DOCKER_UID をホストと合わせる

   ```
   # ホストのuidを調べる
   id -u

   # docker/php/Dockerfile の ARG DOCKER_UID=1000 の右辺を↑で調べた値にする
   vim docker/php/Dockerfile
   ```

1. 起動する

   ```
   docker-compose up -d
   ```

1. php コンテナの bash を実行する

   ```
   docker-compose exec php bash
   ```

1. コンテナの bash を抜ける

   ```
   # 下記のショートカットキーを入力する
   ctrl + p + q
   ```

## laravel をインストールする

- php コンテナの /var/www/html で下記のコマンドを実行する
  ```
  composer create-project --prefer-dist laravel/laravel=6.* mylaravelapp
  ```

## cakephp をインストールする

- php コンテナの /var/www/html で下記のコマンドを実行する
  ```
  composer create-project --prefer-dist cakephp/app:^3.8 mycakephpapp
  ```

## nginx のドキュメントルートを変更する

1. docker/nginx/default.conf を下記のように書き換える

   - mylaravelapp という名前の laravel アプリを作成した場合

     ```diff
     server {
     - root  /var/www/html;
     + root  /var/www/html/mylaravelapp/public;
       index index.php index.html;
       ...
     ```

   - mycakephpapp という名前の cakephp アプリを作成した場合
     ```diff
     server {
     - root  /var/www/html;
     + root  /var/www/html/mycakephpapp/webroot;
       index index.php index.html;
       ...
     ```

1. コンテナを再起動する

   ```
   # 停止
   docker-compose down

   # 起動
   docker-compose up -d
   ```

1. ブラウザで http://localhost:10080 にアクセスすると laravel または cakephp のトップページが表示される

## 備考

- php コンテナの bash ユーザ: docker について

  - パスワード: docker
  - sudo 可能

- コーディング

  - ホスト側で php コンテナがマウントしている html 配下を編集する

- DB 接続(本番リリースを想定する場合は必ず再設定してください)
  - DB ホストは mysql
  - mysql の port は 3306
  - mysql のアカウントは docker-compose.yml を参照
    - MYSQL_DATABASE: docker_db
    - MYSQL_ROOT_PASSWORD: root
    - MYSQL_USER: docker_db_user
    - MYSQL_PASSWORD: docker_db_user_pass
