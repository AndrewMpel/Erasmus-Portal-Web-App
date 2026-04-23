# Erasmus Portal WebApp: Full-Stack student Mobility Management System

![Tech](https://img.shields.io/badge/Architecture-Full--Stack-blue.svg)
![Backend](https://img.shields.io/badge/Backend-PHP--API-777bb4.svg)
![Frontend](https://img.shields.io/badge/Frontend-JS--AJAX-yellow.svg)

ErasmusConnect is a full-stack web application developed to streamline the Erasmus+ mobility process. It serves as a centralized portal where students can explore partner universities, submit digital applications, and manage their academic profiles in real-time.

## Key Features

* **User Authentication & Authorization:** Robust **Login** and **Sign-up** systems for students and administrators, ensuring secure access to personal data and application forms.
* **Asynchronous Profile Management:** A dedicated user profile section where students can update their information (email, password, personal details) instantly via **AJAX**, without requiring a page refresh.
* **Interactive University Database:** Browse and filter collaborating universities by country, department, and language for informed decision-making.
* **Administrative Control Panel (API Driven):** A powerful backend interface for university coordinators to manage records. The admin dashboard utilizes a dedicated **PHP API** to perform CRUD operations on university data and evaluate student applications.

## Technical Stack

* **Frontend:** HTML5, CSS3, JavaScript (Vanilla).
* **Client-Server Communication:** **AJAX** for asynchronous profile updates and seamless data fetching.
* **Backend:** **PHP** (RESTful API architecture specifically utilized for Administrative functions and secure data handling).
* **Database:** **SQL** (MySQL) with a normalized relational schema.
* **Local Server Environment:** **XAMPP** (Apache server & MySQL).

## System Architecture

The application follows a modular architecture where the **PHP API** acts as a bridge between the **SQL Database** and the **JavaScript-driven Frontend**. This separation ensures data integrity, especially during high-load periods like application deadlines, while providing a responsive and modern UI.

## Installation & Setup

1.  **Environment:** Install **XAMPP** or a similar WAMP/MAMP stack.
2.  **Database Setup:**
    * Open `phpMyAdmin`.
    * Create a new database.
    * Import the provided SQL schema file (e.g., `database.sql`).
3.  **Deployment:**
    * Place the project folder inside the `htdocs` directory of your XAMPP installation.
    * Configure your database connection settings in the PHP config file.
4.  **Run:**
    * Start Apache and MySQL from the XAMPP Control Panel.
    * Navigate to `localhost/your-project-folder` in your browser.

## Contributors

This Website was developed as a university project by:
1.  **Andreas Belias**
2.  **Georgios Makantasis**
3.  **Spyridon Diamantis**
