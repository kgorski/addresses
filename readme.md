# Address Book powered by Laravel and Elasticsearch


Simple address book for storing and displaying addresses. Addresses are stored in MySQL and Elasticsearch and displayed directly from Elasticsearch.

## System Requirements / Dependencies
* php 5.6.4+
* mysql 4.0+
* elasticsearch 2.0+

## Installation
### Checkout the repository
```
git clone git@github.com:kgorski/addresses.git
```

### Run composer install
```
php composer.phar install
```

### Create .env configuration file
Copy default configuration .env.example file to new .env file 
```
cp .env.example .env
```

### Setup database and Elasticsearch credentials in .env

* DB_CONNECTION=mysql
* DB_HOST=127.0.0.1
* DB_PORT=3306
* DB_DATABASE=addresses
* DB_USERNAME=user
* DB_PASSWORD=pass
* ELASTICSEARCH_HOSTS=localhost:9200

### Create database schema
```
php artisan migrate
```
