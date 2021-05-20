# SNSアプリ？？？？？？？
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
※M1チップでdockerが使えない場合は下記を参照<br>
https://genchan.net/it/virtualization/docker/13550/
2. プロジェクトへ移動する
```
$ cd blog
```
3. Sailを立ち上げる<br>
※初回は数分かかります。
```
$ ./vendor/bin/sail up
```
4. migrateする<br>
※sail upしている状態でmigrateをしてください。
```
$ ./vendor/bin/sail artisan migrate
```
5. http://localhost/  へアクセスする
6. 停止する場合<br>
Control　+ C

# メール送信に関して
- .envをの編集をお願いします。(gmailのsmtpを利用して送信など)


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
  local     blog_sailmysql
```
2. ボリュームの削除
```
$ docker volume rm blog_sailmysql
```






