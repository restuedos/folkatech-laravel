# Folkatech Laravel Application

This is a simple Laravel application to manage Companies and Employees with authentication, CRUD operations, and tests.

## Features

- Basic authentication using Laravel Breeze.
- CRUD functionality for managing companies and employees.
- Admin panel for managing the application.
- Unit tests for `Company` and `Employee` models.
- Email notifications when a new employee is added to a company.

## Prerequisites

Before you begin, make sure you have the following installed:

- PHP >= 8.1
- Composer
- MySQL or SQLite
- Node.js and NPM (for frontend assets)

## Installation

Follow these steps to set up the project on your local machine.

### 1. Clone the repository

```bash
git clone https://github.com/restuedos/folkatech-laravel.git
cd folkatech-laravel
```

### 2. Install dependencies

Run the following command to install PHP dependencies:

```bash
composer install
```

Then, install the frontend dependencies:

```bash
npm install
```

### 3. Set up the environment file

Copy the .env.example file to .env:

```bash
cp .env.example .env
```

### 4. Set up the database

Ensure your database is properly configured in .env file. You can use MySQL or SQLite for local development. If you're using SQLite, you can set it like this:

```env
DB_CONNECTION=sqlite
DB_DATABASE=/path_to_your_project/database/database.sqlite
```

Alternatively, for MySQL, set:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=folkatech_db
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Run migrations and seed the database

Run the migrations and seed the database with the default user:

```bash
php artisan migrate --seed
```

This will create the necessary tables in the database and also create the default admin user with the following credentials:

Email: `admin@folkatech.com`
Password: `password`

### 6. Build and run frontend assets

Compile the frontend assets using the following commands:

```bash
npm run dev
```

For production:
```bash
npm run build
```

### 7. Start the development server

Run the Laravel development server:

```bash
php artisan serve
```

You can now access the application at `http://127.0.0.1:8000`.

---

## Usage
- Authentication: Use the default admin credentials (`admin@folkatech.com` / `password`) to log in.
- Manage Companies and Employees: Navigate to the `Companies` and `Employees` sections in the admin panel to manage records.

---

## Running Tests

To run the unit tests for the `Company` and `Employee` models, use the following command:

```bash
php artisan test
```

This will run all the tests, including those that test CRUD functionality for Company and Employee.

## Project Structure

- app/Models - Contains the main application models (`Company`, `Employee`, etc.).
- app/Http/Controllers - Controllers that manage the business logic for `Company` and `Employee` models.
- app/Http/Requests - Manages request validation for `Company` and `Employee` data inputs.
- app/Notifications - Includes notification logic, such as notifying administrators of new employees.
- database/factories - Provides factory definitions for generating test data for `Company` and `Employee`.
- database/migrations - Database migrations for setting up the necessary tables.
- database/seeders - Seeder classes to populate the database with sample data.
- resources/views/companies - Contains Blade templates for the `Company` feature's user interface.
- resources/views/employees - Contains Blade templates for the `Employee` feature's user interface.
- routes - Defines application routes, including those for `Company` and `Employee` features.
- tests/Unit - Unit tests to ensure functionality for `Company` and `Employee`.

## Contributing

If you'd like to contribute to the project, feel free to fork the repository and submit a pull request. Please ensure that all tests pass before submitting.

## License

This project is licensed under the MIT License - see the LICENSE file for details.
