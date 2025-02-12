# Auto Part Inventory Management Demo

This is a **demo version** of an auto part inventory management system. It uses Laravel with Inertia.js for rendering and is designed to showcase a basic inventory management workflow.

> **Note:** This version has minimal error handling and very basic validation. Future improvements could include more robust error handling, enhanced validation (e.g. ensuring proper formatting and uniqueness of serial numbers), and other features.

---

## Table of Contents

- [Features](#features)
- [Requirements](#requirements)
- [Installation](#installation)
- [Running the Application](#running-the-application)
- [Database Setup](#database-setup)
- [Project Structure](#project-structure)
- [Known Issues & Future Improvements](#known-issues--future-improvements)
- [License](#license)

---

## Features

- **Demo Version:** Basic functionality for managing auto parts and vehicles.
- **Inventory Managment** Adding, removing or editing records in the table.
- **Minimal Validation & Error Handling:** Provides a starting point for further development.

---

## Requirements

Before you begin, ensure you have installed the following:

- [Node.js](https://nodejs.org/)
- [Composer](https://getcomposer.org/)
- [PHP](https://www.php.net/) (compatible version with laravel 11)
- [Docker](https://www.docker.com/) (with docker-compose)

---

## Installation

1. **Clone the Repository**

   ```bash
   git clone <repository_url>
   cd <repository_directory>
   ```

2. **Create an .env file**

   Create an env file from .env.dist.

3. **Navigate to the Application Directory**

   ```bash
   cd auto-part-inventory-managment
   ```

4. **Install PHP Dependencies**

   ```bash
   composer install
   ```

5. **Install Node.js Dependencies & Build Assets**

   ```bash
   npm install
   npm run build
   ```

---

## Running the Application

1. **Start Docker Containers**

   ```bash
   docker-compose up
   ```

2. **Run the Laravel Development Server**

   Open another terminal window and execute:

   ```bash
   composer run dev
   ```

Your application should now be running. Visit the appropriate URL (e.g., [http://localhost:8000](http://localhost:8000)) to view the demo.

---

## Database Setup

To populate the database with initial data, run:

```bash
php artisan migrate:fresh --seed
```

This command will run all migrations and seed the database with demo data.

---

## Known Issues & Future Improvements

- **Error Handling:** Current error handling is minimal.
- **Validation:** The demo includes only basic validation.
  - **Suggestion:** Add more concise validation rules (e.g., format and uniqueness for serial numbers).
- **Enhancements:** Additional UI/UX improvements and features can be implemented in future versions.
- **Removing comments:** There are a lot of comments currently because I would like to continue on and add private inventories.
- **Documentation:** Making the documentation deeper and more comprehensive.
