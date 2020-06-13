# AafnoBachat
Daily Expense tracker Site 

**Project Info**

| **License**  | **Code Style** |
| ------------- | ------------- |
| [![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)  | [![code style: prettier](https://img.shields.io/badge/code_style-prettier-ff69b4.svg?style=flat-square)](https://github.com/prettier/prettier)|

## Install on local machine

``` bash
# Set up database
Copy .env.example file to .env on the root folder i.e cp .env.example .env
Open your .env file and change the database name (DB_DATABASE) to whatever you have, username (DB_USERNAME) and password (DB_PASSWORD) field correspond to your configuration. 

# Generate key
php artisan key:generate

# Run Migrations
php artisan migrate

# fill database with dummy data
php artisan db:seed

# Install dependencies
composer install

# Run project
php artisan serve


```

# AaafnoBachat API 
<i> If you want to use only backend services</i>

> Laravel 7.x API that uses the API resources.

## Endpoints to access api

### Get earning details
``` bash
GET api/earning/
```

### Add new earning
``` bash
POST api/earning
```

### Get expense details
``` bash
GET api/expense/
```

### Add new expense
``` bash
POST api/expense

```
### Get receive details
``` bash
GET api/receive/
```

### Add new earning
``` bash
POST api/receive

```
### Get paying details
``` bash
GET api/earning/
```

### Add new paying
``` bash
POST api/paying/
```

### License

This project is licensed under the MIT License
