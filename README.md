# Simpletter
- 会員登録機能
- つぶやきの投稿/更新/削除
- つぶやきに対する返信機能
- つぶやきに対するいいね機能<br>
![いいね](https://user-images.githubusercontent.com/75054606/120490911-c4228d00-c3f3-11eb-80c9-d12b53176de6.gif "いいね")
- ユーザー間のフォローフォロワー機能<br>
![フォロー](https://user-images.githubusercontent.com/75054606/120492139-c5a08500-c3f4-11eb-8e84-146c483a726e.gif "フォロー")


# Laravel Sail
今回はLaravel Sailを使った実行方法です。Laravel Sailとは簡単に言えばLaravel専用のDockerイメージのような感じです。
必要な機能(composer(php),mysql,redis,npm,mail hog,laravel dusk)がまとめられているので基本的に他には何も要りません。


# 実行方法
※Dockerのインストールが必要です。<br>
```
// cloneする
$ git clone https://github.com/msd05keisuke/simpletter.git

// プロジェクトへ移動
$ cd simpletter

// Composer依存関係のインストール
$ docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v $(pwd):/opt \
    -w /opt \
    laravelsail/php80-composer:latest \
    composer install --ignore-platform-reqs
 
// .envの作成
$ cp .env.example .env

// 環境変数の上書き
$ php artisan sail:install

// エイリアスの設定
$ alias sail='bash vendor/bin/sail'

// アプリケーションキーの設定
$ php artisan key:generate

// sailを立ち上げる
$ sail up -d

// migrateとseedingの実行
$ sail artisan migrate:fresh --seed

// 停止する場合
$ sail down

```
- http://localhost/  simpletter

# phpmyadminを利用する場合
docker-compose.ymlに下記を追加
```
phpmyadmin:
        image: phpmyadmin/phpmyadmin
        links:
            - mysql:mysql
        ports:
            - 8080:80
        environment:
            MYSQL_USERNAME: '${DB_USERNAME}'
            MYSQL_ROOT_PASSWORD: '${DB_PASSWORD}'
            PMA_HOST: mysql
        networks:
            - sail
```

- http://localhost:8080/ phpmyadmin

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













