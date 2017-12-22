# LOMOND ADVENTURES
This project was developed in HTML, CSS, PHP and MySQL as part of a University module in web design.

## INSTALLATION

To install, please place all files at the route of the web server.

You will need to run the DB import script which can be found in the root of the folder.

## CONFIGURATION

You will need to add your DB details in the includes/dbConnect.php

Update these to suit your configuration.
```php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "lomond";
```

Lastly, in the includes/config.php file, please enter the URL of the website as it should appear on your system along with open weather API key if different.
```php
$localurl = "http://outdoor.localhost/";
$weatherapi = "2f5a5ba80cfc30c4f61d0b683f2b99f9";
```
