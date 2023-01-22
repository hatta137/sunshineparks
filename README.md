# WS202223_GWPDWP_SunshineParks


## Git Repo

```
sudo apt install git
cd existing_repo
git clone https://git.ai.fh-erfurt.de/sunshine-parks/ws202223_gwpdwp_sunshineparks.git
```

The project is in the SuPa folder.
The project files database folder only contains files that we used to create the database. 
Please do not use for database import. For database import see the Installation Steps Area.


## Installation Guide

### Lampp (Linux)
follow the Instructions from: https://de.wikihow.com/XAMPP-unter-Linux-installieren
   -> Pay attention to the correct file name during installation


### Get Webserver ready

1. clone Git-Repo as described above
2. copy the folder SuPa to /opt/lampp/htdocs (use sudo)
3. Import the Database Backup (SuPa/backend/database):
   - open https://localhost/phpmyadmin/ (accept Security Warnings)
   - Import->File to Import->Browse 
   - Select Database File
   - scroll down to import





### Troubleshooting

If an error occurs when importing the database, a mysql_upgrade must be performed:

```
1. cd /opt/lampp/bin
2. sudo ./mysql_upgrade
```


If an error occurs when creating a rental (permission denied), the following authorizations must be set:
```
sudo find /opt/lampp/htdocs/SuPa/assets/graphics -type d -exec chmod 777 '{}' \;
```
## Testing

### Startpage: http://localhost/SuPa/backend/index.php?

### Testable functionalities:

- show Rentals (all/filter)

After Login:
- show Employees (as Admin)
- edit Employees (as Admin)
- rentalmanagement (as Admin)
  - new Rental     (as Admin)
- registration (as Guest)
- delete my account (Guest himself)


## Login-Credentials

### Guest Login
- E-Mail:     bernd.hahn@guest.de
- Password:   test

### Manager Login
- E-Mail:     Birgitt.Schmidt@sunshineparks.de
- Password:   test

### Intern Login (Admin)
- E-Mail:     hendrik.lendeckel@fh-erfurt.de
- Password:   test

The area of the rental manager ("Objektverwaltung") can also be reached via the administrator.

## Tested with the following versions
     
- PHP/Zend Engine:     8.2.0 / v4.2.0
- MySQL:               10.4.27-MariaDB
- Apache:              2.4.54

***
