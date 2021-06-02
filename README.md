# Simpletter
- 会員登録機能
- つぶやきの投稿/更新/削除
- つぶやきに対する返信機能
- つぶやきに対するいいね機能<br>
![いいね](https://user-images.githubusercontent.com/75054606/120490911-c4228d00-c3f3-11eb-80c9-d12b53176de6.gif "いいね")
- ユーザー間のフォローフォロワー機能
![フォロー](https://user-images.githubusercontent.com/75054606/120492139-c5a08500-c3f4-11eb-8e84-146c483a726e.gif "フォロー")


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
$ git clone https://github.com/msd05keisuke/simpletter.git
```
3. プロジェクトへ移動<br>
```
$ cd simpletter
```
4. Composer依存関係のインストール
- 数分かかります。
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
10. migrateとseeding(初期データの挿入)を同時に行う
```
$ sail artisan migrate:fresh --seed

// 初期データがいらない場合はこちら
$ sail artisan migrate

```
11. http://localhost/  へアクセスする
- 一通り完了です。
- 会員登録して遊んでみてください。
12. 停止する場合
```
$ sail down

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
# phpmyadmin
- http://localhost:8080/

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






