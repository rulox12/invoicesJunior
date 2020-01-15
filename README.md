# Invoices Junior

This is the project for junior developer

## Configuration

To configure the roject for the first time

Once you have the database created and configured in the .env file
```
php artisan key:generate
php artisan migrate:regfresh --seed
composer update
composer clear-cache
composer dump-autoload
npm install
npm run dev
php artisan config:cache
php artisan serve
```


## Import Invoices Excel

It is important to manage the structure that can be seen in the 
sample file that you can download [here](https://drive.google.com/open?id=10b_xJ94fCwb4JShHft0CxvdHc9kj1Eb8)
#### Description of the response codes.

| Field       | Value                | Description                                                                            |
|-------------|----------------------|----------------------------------------------------------------------------------------|
| due_date    | YYYY-mm-dd hh:mm:ss  | Expiration date must be greater than today example: 2020-01-16 12:12:00,               |
| type        | Varchar(max:50)      | Corresponds to the type of invoice example: Factura de venta                           |
| description | Varchar(max:256)     | Corresponds to the description of invoice example: factura para pagar impuesto         |
| total       | Integer              | Corresponds to the total of invoice example: 12000, the tax is calculate automatic 16% |
| customer    | Varchar              | Document custmer example 102222203                                                     |
| seller      | Varchar              | Document custmer example 1211203                                                       |

Note: to upload the invoices, customers and sellers must be created

