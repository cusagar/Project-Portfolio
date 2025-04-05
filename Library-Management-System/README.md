# 📚 Library Management System

This is a simple web-based **Library Management System** built using **PHP**, **HTML**, and **MySQL**. It allows library administrators to manage books, patrons, check-ins, check-outs, and more through a set of user-friendly interfaces.

> 🛠️ Originally created as a proof-of-concept project — updated for clarity and usage.

---

## ✨ Features

- Add, edit, and delete library items
- Manage patron records
- Check-in and check-out transactions
- View and print checkout receipts
- Reshelving management
- Simple login and homepage navigation
- Backend powered by PHP and MySQL
- Frontend with basic HTML/CSS (minimal design)

---

## 📁 Project Structure

Some of the core files:

| File/Folder           | Purpose                                |
|-----------------------|----------------------------------------|
| `index.html`          | Main landing page                      |
| `login.html`          | Login screen (not functional without auth) |
| `Create.php`          | Add new book/item                      |
| `Delete.php`          | Remove a book/item                     |
| `ManageItems.php`     | List and manage all items              |
| `CheckInScan.php`     | Scan and check-in items                |
| `CheckOutItems.php`   | Scan and check-out items               |
| `CheckOutReceipt.php` | Display receipt after checkout         |
| `ManagePatrons.php`   | View and manage library patrons        |
| `CreatePatron.php`    | Add new patron                         |
| `schema.sql`          | MySQL database schema                  |

---

## 🛠️ Setup Instructions

1. **Clone the repository**

```bash
git clone https://github.com/cusagar/Library-management-.git
 Import the database

Use the schema.sql file to create the database and required tables in your MySQL server.

Set up a local server

Use XAMPP  to run a local PHP server.

Place all files in the htdocs directory.

Access the system

Visit http://localhost/Library-management-/index.html in your browser.
