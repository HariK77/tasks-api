## About Tasks API

This is a REST API application for Tasks with Sanctum authentication and Database seeder. You can interact with it by importing the Tasks API Postman collection included in the repo.

# Installation Instructions

## Prerequisites
- Ensure Docker is installed. If Docker is not available, you can run the project using Apache, Nginx, or `php artisan serve` (update database drivers and configurations based on your local environment).

## Environment Setup
Change into project directory before running any commands
- `cd /tasks-api`
  
Rename the .env.example file .env
- `cp .env.example .env`

## Setup Methods

### Docker Setup
Start the Docker containers:
- `./vendor/bin/sail up`
  
### Manual Setup
Update the database configuration in the .env file according to your local machine settings.
Install dependencies:
- `composer install`

Generate Key
Run `sail artisan key:generate` or `php artisan key:generate`

## Post Setup
Run database migrations:
- Using Sail: `sail artisan migrate`
- Without Sail: `php artisan migrate`
Seed the database:
- Using Sail: sail artisan db:seed
- Without Sail: php artisan db:seed
## Postman Collection
Import the provided Postman collection (Tasks Api Postman Collection.json) into your Postman application to interact with the API.

## Note for Postman
- TasksBaseUrl: Base URL of the API (e.g., http://localhost/api)
- TasksApiToken: Token for authentication (set automatically after login)
- Ensure that the TasksApiToken is set in the environment variables in Postman for authenticated requests.
  
## API Endpoints

Status
Endpoint: `GET {{TasksBaseUrl}}/status`
Description: Checks the status of the API.

Auth
Login
Endpoint: `POST {{TasksBaseUrl}}/login`
Body:
```json
{
 "email": "hari@gmail.com",
 "password": "password"
}
```
Description: Logs in a user and sets a collection variable TasksApiToken with the token received.

Register
Endpoint: `POST {{TasksBaseUrl}}/register`
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

Endpoint: `POST {{TasksBaseUrl}}/tasks`
```
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
```
Description: Adds a new task with the provided details.

Get Tasks

Endpoint: `GET {{TasksBaseUrl}}/tasks`
```
Query Parameters:
    filter[status]: "Incomplete"
    filter[due_date]: "2024-06-22"
    filter[priority]: "High"
    filter[notes]: "true"
    order[priority]: "Low"
    order[first]: "desc"
```
Description: Retrieves tasks with the specified filters and order.


