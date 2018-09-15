# study-laravel
```
docker exec -it study-laravel_php-fpm bash
```
これでコンテナの中に入り、以下のコマンドでLaravelに必要なファイルをインストールする
```
composer install
npm install
```

localhost:8000で基本のページにアクセスできるようになる。

これを動かすための.envは現在公開していないので、以下のメールアドレスにご連絡を・・・

willow710kut@gmail.com

# テストを動かすには
1.mysqlのコンテナに入って
```
create database `study-laravel-test`
```

2.php-fpmのコンテナに入って
```
vendor/bin/phpunit
```