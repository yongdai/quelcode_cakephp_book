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
