# simpletter
- 会員登録機能
- つぶやきの投稿/更新/削除
- つぶやきに対するいいね機能
- つぶやきに対する返信機能
- ユーザー間のフォローフォロワー機能


# Laravel Sail
今回はLaravel Sailを使った実行方法です。Laravel Sailとは簡単に言えばLaravel専用のDockerイメージのような感じです。
必要な機能(composer(php),mysql,redis,npm,mail hog,laravel dusk)がまとめられているので基本的に他には何も要りません。


# 実行方法
1. Dockerをインストールする<br>
https://www.docker.com/<br>
- M1チップでdockerが使えない場合は下記を参照<br>
https://genchan.net/it/virtualization/docker/13550/
2. cloneする
```
$ git clone https://github.com/msd05keisuke/blog.git
```
3. プロジェクトへ移動<br>
```
$ .cd shimpletter
```
4. Composer依存関係のインストール
- お時間かかります
```
$ docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v $(pwd):/opt \
    -w /opt \
    laravelsail/php80-composer:latest \
    composer install --ignore-platform-reqs
```
5. .envの作成
- .env.exampleの名前を変更して.envにすれば良いです。
6. 環境変数の上書き 
- .envを編集してもいけるのかもしれないですが、自分の場合はうまく行かなかったのでインストールします。
- 今回はmysqlを利用するので0を押します。
```
$ php artisan sail:install

Which services would you like to install? [mysql]:
  [0] mysql
  [1] pgsql
  [2] mariadb
  [3] redis
  [4] memcached
  [5] meilisearch
  [6] mailhog
  [7] selenium
 > 0

Sail scaffolding installed successfully.

```
7. Bashエイリアスの設定
- やらなくても良いのですが、これをやった方が楽なのでやります。
```
$ alias sail='bash vendor/bin/sail'

エイリアス設定前
$ ./vendor/bin/sail up
エイリアス設定後
$ sail up

```
8. アプリケーションキーの設定
```
$ php artisan key:generate

```
9. sailを立ち上げる
```
$ sail up -d

```
10. migrateする
```
$ sail artisan migrate

```
11. http://localhost/  へアクセスする
- 一通り完了です。
- 会員登録して遊んでみてください。
12. 停止する場合
```
$ sail up down

```

# メール送信に関して
- .envをの編集をお願いします。


# エラーが吐かれた
- sail upした際に下記のエラーが吐かれる<br>
※M1チップ搭載macだと起こるらしいです。
```
ERROR: no matching manifest for linux/arm64/v8 in the manifest list entries
```
- 解決方法<br>
docker-compose.ymlのmysqlのところを'mariadb:10.5.8'に変更する。
```
（変更前）
mysql:
        image: 'mysql:8.0'
（変更後）
mysql:
        image: 'mariadb:10.5.8'
```

# ボリュームの削除
Laravel SailはDockerボリュームを使用しているのでコンテナを停止して再起動しても、データベースに保存されているデータは保持されます。不要になった場合は削除をお願いします。
1. ボリュームの一覧表示
```
$ docker volume ls
  DRIVER    VOLUME NAME
  local     simpletter_sailmysql
```
2. ボリュームの削除
```
$ docker volume rm simpletter_sailmysql
```






