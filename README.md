
# 📘 Student Management CRUD Application (Laravel)

A simple **Student Management System** built using **Laravel** that demonstrates core backend concepts such as CRUD operations, MVC architecture, database migrations, and form handling.

This project is intended as a **learning project** for backend internships.

---

##  Features

* Create new students
* View list of students
* Update student details
* Delete students
* Clean UI with Blade templates
* Uses Laravel Eloquent ORM
* Follows MVC architecture
* CSRF protected forms

---

##  Tech Stack

* **Backend:** PHP (Laravel)
* **Frontend:** Blade, HTML, CSS
* **Database:** SQLite (local) / MySQL (production-ready)
* **ORM:** Laravel Eloquent

---

##  Project Structure (Important Files)

```
app/
 ├── Models/Student.php
 └── Http/Controllers/StudentController.php

database/
 ├── migrations/
 └── database.sqlite

resources/
 └── views/
     ├── landing.blade.php
     └── students/
         ├── index.blade.php
         ├── create.blade.php
         └── edit.blade.php

routes/
 └── web.php
```

---

##  Requirements

Make sure you have the following installed:

* PHP >= 8.1
* Composer
* Git

(Optional)

* MySQL (for production use)

---

##  Local Setup Instructions

### 1️⃣ Clone the repository

```bash
git clone https://github.com/<your-username>/student-crud.git
cd student-crud
```

---

### 2️⃣ Install dependencies

```bash
composer install
```

---

### 3️⃣ Create environment file

```bash
cp .env.example .env
```

---

### 4️⃣ Generate application key

```bash
php artisan key:generate
```

---

### 5️⃣ Configure database (SQLite – recommended for local)

Edit `.env`:

```env
DB_CONNECTION=sqlite
```

Create database file:

```bash
touch database/database.sqlite
```

---

### 6️⃣ Run migrations

```bash
php artisan migrate
```

---

### 7️⃣ Start development server

```bash
php artisan serve
```

Open in browser:

```
http://127.0.0.1:8000
```

---

##  How the Application Works (Non-Technical Explanation)

* The app allows users to **manage student records**
* Each student has basic details (like name, email, etc.)
* Users can:

  * Add new students
  * See all students in a list
  * Edit student information
  * Remove students when needed
* All actions update the database instantly

This mimics a **real-world admin dashboard**.

---

##  Key Concepts Demonstrated

* Laravel MVC flow
* Routing and controllers
* Blade templating
* Form handling with validation
* CSRF protection
* Database migrations
* Eloquent ORM
* Environment-based configuration

---

## Security Notes

* CSRF protection enabled on all forms
* No sensitive credentials committed
* Uses Laravel’s built-in security features



##  Purpose of This Project

This project was built to:

* Practice Laravel backend development
* Demonstrate CRUD fundamentals
* Showcase deployment readiness
  

