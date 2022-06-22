Priverse NFT Marketplace
 
# Requirements
 - Ubuntu 20.04 or newer 
 - PHP 7.4.3 or newer
 - MySQL Server 8.0.29 or newer
 - Apache Web Server 2.4.41 or newer

# Installation Steps
1. Upload source files to `/var/www/html/<your_folder_name>`
2. Import the `database.sql` file located in `import` folder with the following console command.

```mysql -u<username> -p<password> <databasename> < database.sql to mysql server.```

3. Update MySQL server connection variables in `db.php` file located in root folder.

You are done!
