# jaysoftnet
Run composer install to install all dependencies
```
composer install
```

Run npm install and npm dev to install all assets
```
npm install && npm run dev
```

Copy .env.example to .env
```
cp .env .env.example
```

Edit you database config in the env

Migrate and seed the database
```
php artisan migrate --seed
```
