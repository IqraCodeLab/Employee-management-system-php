
# 💼 Employee Management System - PHP CRUD Application

A simple, modern, and fully responsive **Employee Management System** built using **PHP (MySQLi)** and custom **Dark Glassmorphism CSS**. This application performs complete **CRUD (Create, Read, Update, Delete)** operations alongside dynamic profile photo uploading and automated database setup.

---

## 📸 Application Preview

Below is the single-page dashboard featuring both the Employee Form and live Employee Directory Table:

![Employee Management System Preview](https://raw.githubusercontent.com/IqraCodeLab/Employee-management-system-php/main/images/form.png)

---

## ✨ Features

* **Create (Add Employee):** Add new employee details including Name, Email, Position, and Profile Photo.
* **Read (Display List):** View all added records instantly inside an organized table layout.
* **Update (Edit Records):** Click "Edit" to load employee details directly into the form for updating text fields or changing photos.
* **Delete (Remove Records):** Delete employees easily with an automatic confirmation check.
* **Automatic Database & Table Creation:** No need to manually import `.sql` files! The script automatically creates the database (`Employee`) and table (`employeesystem`) on first load.
* **Modern Glassmorphism Design:** Dark-themed UI featuring soft glows, clean inputs, and styled action buttons.

---

## 🛠️ Tech Stack

* **Backend:** PHP (Procedural MySQLi)
* **Database:** MySQL
* **Frontend:** HTML5, CSS3 (Custom Glassmorphism)
* **Local Server:** WAMP / XAMPP Server

---

## 🚀 How to Run This Project Locally

If you are running a PHP project for the first time, follow these step-by-step instructions:

### Prerequisites
Make sure you have **XAMPP** or **WAMP Server** installed on your computer.

---

### Step-by-Step Setup Guide

1. **Copy Project Folder:**
   Place your project folder inside your local server's web directory:
   * **For WAMP Users:** `C:\wamp64\www\your_folder_name`
   * **For XAMPP Users:** `C:\xampp\htdocs\your_folder_name`

2. **Ensure `images/` Folder Exists:**
   Make sure you have an `images` folder inside your project directory to store uploaded profile photos and preview images.

3. **Start Local Server:**
   * Open **WAMP** or **XAMPP Control Panel**.
   * Start both **Apache** and **MySQL** services.

4. **Run in Web Browser:**
   Open Chrome, Edge, or Firefox and enter the following URL:
   ```text
   http://localhost/your_folder_name/form.php
(Replace your_folder_name with the exact name of your project folder).

All Done!
The application will automatically connect to MySQL, create the necessary tables, and load the dashboard interface.

📝 License
This project is open-source and created for learning and portfolio usage.
