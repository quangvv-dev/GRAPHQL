# Gralphql

API for a microblogging platform

## Getting Started

Clone the project repository by running the command below if you use SSH

```bash
git clone https://github.com/quangvv-dev/GRAPHQL.git
```

If you use https, use this instead

```bash
https://github.com/quangvv-dev/GRAPHQL.git
```

After cloning,run:

```bash
composer install
```

Duplicate `.env.example` and rename it `.env`

Then run:

```bash
php artisan key:generate
```

### Prerequisites

Be sure to fill in your database details in your `.env` file before running the migrations:

```bash
php artisan migrate
```

```bash
php artisan db:seed
```

And finally, start the application:

```bash
php artisan serve
```

and visit [http://localhost:8000/graphiql](http://localhost:8000/graphiql) to see the application in action.

## Built With

* [Laravel](https://laravel.com) - The PHP Framework For Web Artisans
* [GraphQL](https://graphql.org) - A query language for your API


