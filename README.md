
Setup sqlite:
```
touch database/database.sqlite
```

Start reverb server:
```
php artisan reverb:start --debug
php artisan reverb:start --port=8080 --debug
```

Make event:
```
php artisan make:event Example
```

Make model:
```
php artisan make:model Message -m
```
