PaymentApi

PaymentAPI is a RESTful API developed for credit card payments, intended to be integrated into a financial management system module adapted for microenterprises.

- Installation
Start the Docker containers:
```sh
docker-compose up -d
```

Access the Docker container's shell:
```sh
docker-compose exec app bash
```

Copy and Paste .env.example as .env
```sh
Copy the contents of .env.example and create a new file named .env. Then, paste the copied contents into .env. Ensure to adjust the variables according to your environment.
```

Install dependencies using Composer:
```sh
composer install
```

Run database migrations:
```sh
php artisan migrate
```

Seed the database with sample data:
```sh
php artisan db:seed
```

Run tests to ensure everything is set up correctly:
```sh
./vendor/bin/phpunit
```

- Swagger Documentation
```sh
http://localhost:8080/rest/documentation/
```

- API Authentication
```sh

{
"email": "paymentapi.user@gmail.com", 
"password": 1234567
}

For more details on how to authenticate with our API, refer to our API documentation.
```

- Contact
For any inquiries or support, please feel free to contact:
```sh
Pablo Fabrício - fabriciopablo2000@gmail.com
```
