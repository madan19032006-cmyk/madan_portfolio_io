AGRICULTURE MANAGEMENT SYSTEM (BCA MINI PROJECT)
Technology: PHP, MySQL/MariaDB, XAMPP, HeidiSQL, Dreamweaver 8
Database: agriculture_management
Project folder: C:\xampp\htdocs\Agriculture_Management\

FEATURES
- Dashboard with crop, farmer and sales totals
- Add and search crop records
- Delete crop records
- Register and view farmers
- Record and view crop sales
- Responsive CSS design
- Simple database with no foreign keys

INSTALLATION
1. Install and start Apache and MySQL in XAMPP.
2. Create folder C:\xampp\htdocs\Agriculture_Management\
3. Copy all project files into that folder.
4. Open HeidiSQL and connect to your local MySQL server (usually host 127.0.0.1, user root, blank password; use your own port if configured).
5. Open database.sql in HeidiSQL and execute the entire file.
6. If your MySQL root password is not blank, edit db.php and set $password.
7. Open this URL in your browser:
   http://localhost/Agriculture_Management/
8. To edit pages, open the project folder in Dreamweaver 8.

FILES
index.php       Dashboard
db.php          Database connection
crops.php       Crop list and search
crop_add.php    Add a crop
crop_delete.php Delete a crop
farmers.php     Farmer list
farmer_add.php  Register farmer
sales.php       Sales list
sale_add.php    Record a sale
style.css       Design
database.sql    Database and sample data

NOTES
- This starter project has no login page and no foreign keys, as requested for a simple mini-project.
- This is an educational starter project. Add authentication and role checks before using it with real farm data.
- If MySQL uses port 3308, the standard mysqli connection in db.php may need a port argument:
  mysqli_connect($host, $user, $password, $database, 3308);
