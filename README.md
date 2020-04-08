# docker-lemp-composer1

- laravel と cakephp がすぐに使える docker 環境が欲しかった

## php コンテナの bash を実行する

1. このリポジトリをクローンして中に入る

   ```
   git clone https://github.com/Yuzunoha/docker-lemp-composer1.git

   cd docker-lemp-composer1
   ```

1. docker/php/Dockerfile の DOCKER_UID をホストと合わせる

   ```
   # ホストのuidを調べる
   id -u

   # php/Dockerfile の ARG DOCKER_UID=1000 の右辺を↑で調べた値にする
   vim docker/php/Dockerfile
   ```

1. 起動する

   ```
   docker-compose up -d
   ```

1. php コンテナの bash を実行する

   ```
   docker-compose exec bash
   ```

## laravel をインストールする

1. php コンテナの `/var/www/html` で下記コマンドを実行する
   ```
   composer create-project --prefer-dist laravel/laravel=6.* laravelapp
   ```

## cakephp をインストールする

1. php コンテナの `/var/www/html` で下記コマンドを実行する
   ```
   composer create-project --prefer-dist cakephp/app:^3.8 cakephpapp
   ```

## 備考

- コーディング

  - ホスト側で、php コンテナがマウントしている html/ 配下を編集する

- DB 接続
  - db ホストは `mysql`
  - db のアカウントは docker-compose.yml を参照
    - MYSQL_DATABASE: docker_db
    - MYSQL_ROOT_PASSWORD: root
    - MYSQL_USER: docker_db_user
    - MYSQL_PASSWORD: docker_db_user_pass
