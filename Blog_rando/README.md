# HikingProject

This project is a web application built using Symfony and Vite. Below are the instructions to set up the development environment.

## Prerequisites

Ensure you have the following installed on your system:

- **PHP** (version 7.2.5 or higher)
- **Composer** (dependency manager for PHP)
- **Node.js** (version 12.0 or higher)
- **npm** (Node package manager, comes with Node.js)

## Setup Instructions

1. **Clone the Repository**

    Clone this repository to your local machine and navigate into the project directory:

    ```sh
    git clone https://github.com/KJ-devs/HikingProject.git
    cd HikingProject
    ```

2. **Install Dependencies**

    - **Symfony (Backend)**

        Navigate to the Symfony project directory and install the PHP dependencies using Composer:

        ```sh
        cd back-end-rando
        composer install
        ```

    - **Vite (Frontend)**

        Navigate to the Vite project directory and install the JavaScript dependencies using npm:

        ```sh
        cd ../vite-project
        npm install
        ```

3. **Serve the Applications**

    - **Symfony (Backend)**

        To start the Symfony development server, use one of the following commands:

        - If you have the Symfony CLI installed:

          ```sh
          symfony serve
          ```

        - If you do not have the Symfony CLI installed:

          ```sh
          php -S localhost:8000 -t public
          ```

    - **Vite (Frontend)**

        In a separate terminal, start the Vite development server:

        ```sh
        npm run dev
        ```

4. **Access the Application**

    - Open your web browser and navigate to `http://localhost:8000` to access the Symfony application.
    - Open your web browser and navigate to `http://localhost:3000` to access the Vite (React) development server.

## Additional Commands

### Running Tests

To run the tests for the Symfony project, use the following command:

```sh
cd back-end-rando
./bin/phpunit
