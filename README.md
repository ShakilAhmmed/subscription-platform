# SUBSCRIPTION PLATFORM

API Provider application for SUBSCRIPTION PLATFORM

## Installation

```bash
  cp .env.example .env
```

##### Write your NGINX and PHPMYADMIN PORT in .env and Set username and password for database

```bash 
    sudo docker-compose up -d 
    sudo docker exec -it subscription-platform-application bash
    composer install
    php artisan key:generate
    php artisan migrate
    php artisan db:seed
```
### Implemented API ENDPOINTS

```bash
   -Websites
        1. [GET] 
            /api/v1/websites
   -Posts
        1. [POST] 
            /api/v1/posts
        2. [GET] 
            /api/v1/posts
        3. [POST]  
            /api/v1/posts/{id}
  -Subscriptions
        1. [POST] 
            /api/v1/subscriptions
```

### API DOCS URI

```bash
    http://127.0.0.1:8000/api/docs
```

### Run Code Analysis [must be into docker container]

```bash
    sudo docker exec -it subscription-platform-application  bash
    php artisan insights
```

### Dev Tools

```bash
    1. PHP CS FIXER
    2. PHP Insights [ code quality analysis]
    3. Symfony Dump Server [dump and debug without effetcing browsers response]
```

