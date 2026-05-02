# Backend Developer Test

This project is a solution for the **Backend Developer Test**.\
It demonstrates a simple full-stack implementation using **Laravel**,
**Vue**, and **MySQL**.

The application imports customer data from a CSV file into a database
and exposes it through a paginated API.\
A Vue frontend asynchronously loads and displays the data in a list of
customer cards.

------------------------------------------------------------------------

# Tech Stack

### Backend

-   PHP
-   Laravel
-   MySQL

### Frontend

-   Vue 3
-   Pinia (state management)
-   TailwindCSS
-   Vite

### Infrastructure

-   Docker
-   Nginx
-   PHP-FPM

------------------------------------------------------------------------

# Project Structure

    app
     ├─ Console
     │   └─ Commands
     │       └─ parseCustomerData.php
     ├─ Http
     │   └─ Controllers
     │       └─ Api
     │           └─ CustomerController.php

    resources
     ├─ js
     │   ├─ components
     │   │   └─ CustomerCard.vue
     │   ├─ stores
     │   │   └─ customerStore.js
     │   └─ app.js

    data
     └─ customers.csv

    routes
     └─ api.php

------------------------------------------------------------------------

# Installation

Clone the repository:

    git clone <repository-url>
    cd be-dev-test

------------------------------------------------------------------------

# Start with Docker (recommended)

Build and start containers:

    docker compose up -d --build

Install dependencies:

    docker compose exec app composer install
    cp .env.example .env  OR  copy .env.example .env
    docker compose exec app php artisan key:generate

Run database migrations:

    docker compose exec app php artisan migrate

Import the CSV file:

    docker compose exec app php artisan app:parse-customer-data

Install frontend dependencies:

    npm install
    npm run dev

------------------------------------------------------------------------

# Open the Application

Frontend:

    http://localhost:8080

API endpoint:

    http://localhost:8080/api/customers

Example:

    http://localhost:8080/api/customers?page=1

------------------------------------------------------------------------
