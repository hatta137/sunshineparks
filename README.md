# WS202223_GWPDWP_SunshineParks


## Git Repo

```
cd existing_repo
git remote add origin https://git.ai.fh-erfurt.de/sunshine-parks/ws202223_gwpdwp_sunshineparks.git
git branch -M main
git push -uf origin main
```

## Installation Steps

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

If an error occurs when creating a rental (permission denied), the following authorizations must be set:
```
sudo find /opt/lampp/htdocs/assets/graphics -type d -exec chmod 777 '{}' \;
```


***
