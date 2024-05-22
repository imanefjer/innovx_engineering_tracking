# InnovX Engineering Activity Tracking App

## Project Description

This project is a web application designed to manage engineering activities within InnovX. The application replaces the traditional Excel-based system with a modern web interface, improving efficiency, collaboration, and scalability. The main objective is to track the working hours of engineers and monitor the time spent on each task within a project.

## Features

- **Project Management**:
  - Create, update, and delete projects.
  - Assign engineers to projects and define their roles.
- **Task Management**:
  - Create, update, and delete tasks.
  - Track task status (pending, in progress, completed).
  - Log time spent on tasks.
- **User Management**:
  - Secure login system with different user roles (engineers, managers, administrators).
  - Manage user profiles and permissions.
- **Reporting and Analytics**:
  - Visualize task status and engineer contributions with charts.
  - Track project progress and completion percentages.

## Technologies Used

- **Backend**: Laravel
- **Frontend**: Blade Templates, Bootstrap, JavaScript
- **Database**: MySQL
- **Version Control**: Git

## Installation

1. **Clone the Repository**:
   ```sh
   git clone https://github.com/imanefjer/innovx_engineering_tracking
   cd innovx_engineering_tracking
   ```
2. **Install Dependencies**:
   ```sh
   composer install
   npm install
   ```

3. **Environment Configuration**:
    Configure the .env file with database credentials

4. **Generate Application Key**:
    ```sh
    php artisan key:generate
    ```

5. **Run Migrations**:
    ```sh
    php artisan migrate
    ```

6. **Seed the Database (optional)**:
    ```sh
    php artisan db:seed
    ```

7. **Build Assets**:
    ```sh
    npm run dev
    ```

8. **Run the Development Server**:
    ```sh
    php artisan serve
    ```

## Usage

1. **Access the Application**:

    - Open your browser and navigate to http://127.0.0.1:8000.

2. **Login**:

    - Use the default credentials or register a new account.
3. **Manage Projects and Tasks**:

    - As a manager or administrator, create and manage projects and tasks.
4. **Log Time and Update Tasks**:

    - As an engineer, log time spent on tasks and update their status.
