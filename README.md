# 💼 Invoice Management System

A simple yet efficient web-based **Invoice Management System** built using **Laravel 10**, **MySQL**, and **Bootstrap 5**.  
This project was developed collaboratively as part of a team learning experience in full-stack web development.

---

## 🌟 Overview

This system allows users to manage customers, products, and invoices with ease.  
It automatically calculates invoice totals, supports PDF exports, and provides an overview of essential business data.

---

## ⚙️ Features

✅ Manage **Customers** (Create, View, Edit, Delete)  
✅ Manage **Products** (CRUD + Stock Tracking)  
✅ Manage **Invoices** (generate, calculate prices, due dates)  
✅ Automatic **Total Amount Calculation**  
✅ **PDF Export** for invoices  
✅ Dashboard with **basic statistics** and recent activity  

---

## 🧑‍💻 Tech Stack

- **Backend:** Laravel 10 (PHP 8+)
- **Frontend:** Blade Templates, Bootstrap 5
- **Database:** MySQL
- **Libraries:** DomPDF (for PDF export)
- **Version Control:** Git & GitHub

---

## 👥 Team Roles

### 🧱 Member 1 (Day 1–2):Me   –  *Project Setup*
- Set up a Laravel project and MySQL configuration.
- Created migrations for Customers, Products, Invoices, and InvoiceItems.
- Defined models, relationships, factories, and seeders.
- Later Contributed to testing and final enhancements(dashboard,alerts,styling).

### 👤 Member 2 (Day 2 onward):[Nourien Mohamed](https://github.com/Nourien01)  –  *Customers Module*
- Developed the Customers module (CRUD).
- Implemented validation for customer data (e.g., unique email, required fields).
- Designed Blade templates for listing, adding, editing, and deleting customers.
- Tested module using dummy customer data for accuracy.

### 📦 Member 3 (Day 2 onward):[Farid Dehne](https://github.com/FareedDehne) – *Products Module*
- Developed the Products module (CRUD).
- Designed Blade templates for listing, adding, editing, and deleting products.
- Implemented validation for product  data (name,SKU,stock,price).
- Tested module using dummy product data for accuracy.

### 🧾 Member 4 (Day 3–4 onward):[Amjad Alrays](https://github.com/amjad639) – *Invoices Module*

- Built the Invoices module (customer selection, product selection, totals).
- Implemented validation (e.g., due date ≥ invoice date).
- Saved invoice items to DB.
- Implemented PDF export feature.

---
