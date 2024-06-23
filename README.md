## About Laravel

This is a REST API application for Tasks with Sanctum authentication, Database seeder. Play with it by importing the Tasks Api Postman collection included in the repo.


# Installation Instructions
Please make sure you have docker installed, if you don't have docker please run the project with apache, nginx or artisan serve (update database drivers and conf available in your machine).

rename the .env.example file .env
Run `sail artisan key:generate` or `php artisan key:generate`

Setup docker way:
    cd into projecy folder and run below commands
    ./vendor/bin/sail up

Setting up manual way
    change the database conf in .env according to your local machine settings
    run `composer install`.


Once setup is done, run below commands one by one

command `sail artisan migrate` or `php artisan migrate`;
command `sail artisan db:seed` or `php artisan db:seed`;


Import the Postman collection included in the into your postman collection


## About Tasks API

This is a REST API application for Tasks with Sanctum authentication and Database seeder. You can interact with it by importing the Tasks API Postman collection included in the repo.

# Installation Instructions

## Prerequisites
- Ensure Docker is installed. If Docker is not available, you can run the project using Apache, Nginx, or `php artisan serve` (update database drivers and configurations based on your local environment).

## Environment Setup
1. Rename the `.env.example` file to `.env`.
2. Generate the application key:
   - Using Sail: `sail artisan key:generate`
   - Without Sail: `php artisan key:generate`

## Setup Methods

### Docker Setup
    Navigate to the project folder:
    `cd tasks-api`

    Start the Docker containers:

    `./vendor/bin/sail up`
### Manual Setup
    Update the database configuration in the .env file according to your local machine settings.
    Install dependencies:
    `composer install`

## Post Setup
    Run database migrations:
        Using Sail: `sail artisan migrate`
        Without Sail: `php artisan migrate`
    Seed the database:
        Using Sail: sail artisan db:seed
        Without Sail: php artisan db:seed
## Postman Collection
    Import the provided Postman collection (Tasks Api Postman Collection.json) into your Postman application to interact with the API.

## Note

    TasksBaseUrl: Base URL of the API (e.g., http://localhost/api)
    TasksApiToken: Token for authentication (set automatically after login)
    Ensure that the TasksApiToken is set in the environment variables in Postman for authenticated requests.
## API Endpoints
   Auth
     Login
     Endpoint: POST {{TasksBaseUrl}}/login
     Body:
       ```json
       {
         "email": "hari@gmail.com",
         "password": "password"
       }
        ```
    Description: Logs in a user and sets a collection variable TasksApiToken with the token received.

    Register
    Endpoint: POST {{TasksBaseUrl}}/register
    Body:
       ```json
       {
         "name": "Hari",
         "email": "hari@gmail.com",
         "password": "password",
         "password_confirmation": "password"
       }
       ```
    Description: Registers a new user.

    Tasks
        Add Task

        Endpoint: POST {{TasksBaseUrl}}/tasks
        Body (form-data):
            subject: "Test Subject"
            description: "Test Description"
            start_date: "2024-06-22"
            due_date: "2024-06-25"
            status: "Incomplete"
            priority: "High"
            notes[0][subject]: "Test Title 1"
            notes[0][note]: "Test Note 1"
            notes[0][attachments][]: File
            notes[1][subject]: "Test Title 2"
            notes[1][note]: "Test Note 2"
            notes[1][attachments][]: File
        Description: Adds a new task with the provided details.

        Get Tasks
        
        Endpoint: GET {{TasksBaseUrl}}/tasks
        Query Parameters:
            filter[status]: "Incomplete"
            filter[due_date]: "2024-06-22"
            filter[priority]: "High"
            filter[notes]: "true"
            order[priority]: "Low"
            order[first]: "desc"
        Description: Retrieves tasks with the specified filters and order.
        Status
            Endpoint: GET {{TasksBaseUrl}}/status
            Description: Checks the status of the API.
            Environment Variables

