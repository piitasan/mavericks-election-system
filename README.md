# 🗳️ Digital Ballot Management System

[![PHP](https://img.shields.io/badge/PHP-7.4%2B-blue?logo=php)](https://www.php.net/)
[![MySQL](https://img.shields.io/badge/MySQL-5.7%2B-orange?logo=mysql)](https://www.mysql.com/)
[![Bootstrap](https://img.shields.io/badge/Bootstrap-5.x-purple?logo=bootstrap)](https://getbootstrap.com/)
[![License](https://img.shields.io/badge/License-Academic-lightgrey)](#license)

A **web-based student election system** enabling secure online voting and efficient election lifecycle management, from partylist and candidate creation to real-time results publication.

## 🌐 Live Demo

Check out the live site here: [https://mvrcks-elections.wuaze.com/](https://mvrcks-elections.wuaze.com/)

---

## ✨ **Features**

### 🧑‍🎓 **User Features**
- Secure user registration and login
- View available candidates
- Cast votes for preferred candidates
- View election results after voting closes

### 🛠️ **Admin Features**
- Secure admin authentication
- Create and manage elections
- Add, edit, or delete candidates, positions, and parties
- View real-time results
- Generate and download election reports
- Clear database for system resets

### ⚙️ **System Functionalities**
- Robust user authentication and session management
- Responsive and intuitive interface for students and administrators
- Structured database storing:
  - User data
  - Votes cast
  - Candidate, party, and position information
  - Election details

---

## 🗂️ **Tech Stack**

- **Frontend:** HTML5, CSS3, JavaScript
- **Framework:** Bootstrap
- **Backend:** PHP (Procedural/PDO)
- **Database:** MySQL (via phpMyAdmin)
- **Server:** XAMPP (Apache, MySQL)
- **Host:** InfinityFree (wuaze domain)

---

## 🚀 **Setup Instructions**

1. **Open Visual Studio Code and Go To Command Prompt**
   
3. **Clone My Repository**
```bash
git clone https://github.com/piitasan/mavericks-election-system.git
```

3. **Import the Database**
- Open phpMyAdmin
- Create a new database ```db_maverick_studio```
- Download and import the provided ```.sql``` in the ```Database``` folder OR:
[⬇️ Download db_maverick_studio.sql](./Database/db_maverick_studio.sql) and hit ctrl + shift + s

4. **Run the project**
    - Start **XAMPP Apache and MySQL**
    - Navigate to `http://localhost/mavericks-election-system` in your browser
    - **❗NOTE❗** its directory structure should be like this:
    - ```
      ├── xampp
      │   ├── htdocs
      │   │   ├── mavericks-election-system
      ```

## 🔑 Default Admin Credentials
```
| Username | Password |
| admin001 | admin123 |
```
 ⚠️ Don't commit a real credentials in the database, dummy credentials are fine.


## 🗂️ **Project Structure**

```
mavericks-election-system-main
│
├── Admin
│   │   └── dbImageUploads
│   ├── admin_clear_database.php
│   ├── admin_dashboard.php
│   ├── admin_dashboard_script.js
│   ├── admin_dashboard_style.js
│   ├── admin_login.php
│   ├── admin_style.css
│   ├── admin_tasks.php
│   ├── candidate_maintenance.css
│   ├── candidate_maintenance.php
│   ├── db_connect.php
│   ├── download_election_report.php
│   ├── edit_candidate.php
│   ├── edit_party.php
│   ├── edit_position.php
│   ├── election_report.php
│   ├── logout.php
│   ├── party_maintenance.css
│   ├── party_maintenance.php
│   ├── position_maintenance.php
│   ├── version.php
│   ├── view_voter.php
│   └── voter_maintenance.php
│
├── Student
│   ├── db_connect.php
│   ├── logout.php
│   ├── student_dashboard.php
│   ├── student_login.php
│   ├── student_registration.php
│   ├── student_style.css
│   ├── view_result.php
│   ├── vote.php
│   └── vote_process.php
│
├── Database
│   └── db_maverick_studio.sql
│
├── mavericks_portal.php
└── portal_style.css
```

## 📄 **License**

This project is licensed for **educational and academic purposes only**.
