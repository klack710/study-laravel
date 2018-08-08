# study-laravel
```
docker exec -it study-laravel_php-fpm bash
```
これでコンテナの中に入り、以下のコマンドでLaravelのプロジェクト作る
```
composer create-project laravel/laravel study-laravel --prefer-dist
```

localhost:8000で基本のページにアクセスできるようになる。