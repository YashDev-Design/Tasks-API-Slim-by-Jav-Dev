# 🧩 Tasks API (Slim Framework Edition)

**Developed by:** Javeed Mohammad (Yash – Dev)  
**Framework:** Slim 4 (PHP Microframework)  
**Database:** MySQL  
**Environment:** XAMPP on macOS

---

## 📖 Project Overview

This project is a backend REST API system built using **Slim Framework 4** and **MySQL**.  
It manages a collection of tasks through standard CRUD operations (Create, Read, Update, Delete), plus an additional **PATCH** endpoint to toggle task completion.

This project was developed as an upgraded version of a Core PHP Tasks API to demonstrate the transition from plain PHP to a modern framework architecture.

---

## ⚙️ Folder Structure

```
tasks-slim/
├── public/
│   └── index.php              # Entry point for Slim application
├── src/
│   ├── db.php                 # Database connection (PDO)
│   └── routes.php             # All API routes (CRUD + PATCH)
├── vendor/                    # Composer dependencies
├── composer.json              # Composer configuration
└── composer.lock              # Dependency lock file
```

---

## 🧠 Key Features

✅ RESTful API structure  
✅ Modular architecture using Slim routes  
✅ PDO database connection (secure and clean)  
✅ Error middleware handling  
✅ Postman-ready JSON responses  
✅ PATCH route for task status toggle

---

## 🧰 Tech Stack

| Technology                   | Purpose                       |
| ---------------------------- | ----------------------------- |
| **PHP 8.2+**                 | Backend logic                 |
| **Slim 4**                   | Lightweight routing framework |
| **MySQL**                    | Database for task storage     |
| **Composer**                 | Dependency management         |
| **Postman / Thunder Client** | API testing tools             |

---

## 🛠️ Setup & Installation

### 1️⃣ Clone this repository

```bash
git clone https://github.com/YashDev-Design/Tasks-API-Slim-by-Jav-Dev.git
cd tasks-slim
```

### 2️⃣ Install dependencies

```bash
composer install
```

### 3️⃣ Configure Database

1. Start **XAMPP** (Apache + MySQL)
2. Open **phpMyAdmin** → Create a database named `tasks_db`
3. Run this SQL:

```sql
CREATE TABLE tasks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    status ENUM('pending','in_progress','completed') DEFAULT 'pending',
    priority ENUM('low','medium','high') DEFAULT 'medium',
    due_date DATE DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

### 4️⃣ Update DB credentials

In `src/db.php`, change:

```php
$pdo = new PDO("mysql:host=localhost;dbname=tasks_db;charset=utf8mb4", "root", "");
```

### 5️⃣ Run Slim development server

```bash
php -S localhost:8080 -t public
```

---

## 🔗 API Endpoints

| Method     | Endpoint             | Description        |
| ---------- | -------------------- | ------------------ |
| **GET**    | `/tasks`             | Fetch all tasks    |
| **POST**   | `/tasks`             | Create new task    |
| **PUT**    | `/tasks/{id}`        | Update task        |
| **DELETE** | `/tasks/{id}`        | Delete task        |
| **PATCH**  | `/tasks/{id}/toggle` | Toggle task status |

---

## 🧪 Testing the API

You can test all endpoints using **Postman Web** or **Thunder Client (VS Code)**.  
Import the included collection file:  
👉 `Tasks_API_Slim.postman_collection.json`

Make sure your Slim server is running at:

```
http://localhost:8080/
```

---

## 📊 Example JSON Response

```json
[
  {
    "id": 1,
    "title": "Finish PHP midterm",
    "description": "Implement Tasks API with Slim",
    "status": "in_progress",
    "priority": "high",
    "due_date": "2025-10-22",
    "created_at": "2025-10-13 14:22:11"
  }
]
```

---

## 🎯 Project Purpose

This project demonstrates modern backend development using PHP’s Slim framework and serves as a comparison to a traditional Core PHP API structure, emphasizing:

- Cleaner code organization
- Scalability
- PSR-compliant routing
- Easy testing and maintainability

---

## 👨‍💻 Author

**Javeed Mohammad (Yash – Dev)**  
📍 _Auburn University at Montgomery_  
📧 [yashdev.design@gmail.com](mailto:yashdev.design@gmail.com)  
💼 [GitHub: YashDev-Design](https://github.com/YashDev-Design)

---

## 🏁 License

This project is for **educational purposes only** as part of a Backend Development coursework demonstration.
