# Project Title

Rest Services.

## Project Description

Created restful api for hotel booking reservation system, without payment. The platform can contain different hotels with several options. Also the hotel can have different type of rooms with various options. The platform also provide us opportunity filter rooms depending their options. The platform was created without the payment system, but the system is designed so that it can be added in the future. For front demonstration added DayPilot demo version.
To get more familiar with db, you can look at the ERD diagram, which you can find inside documents folder.

## Table of Contents

    - Rest
    - Project Description
    - Table of Contents
    - How to Install and Run the Project
    - How to Use the Project
    - Collaborate with team    
    - Test and Deploy
    - Visuals
    - Support
    - RoadMap
    - Contributing
    - Authors and acknowledgment
    - License
    - Project status

## How to Install and Run the Project

For Linux operation system
    Install web server nginx (currently used version is nginx/1.18.0) 
    - sudo apt update
    - sudo apt install nginx
    If you don't enable SSL certificate for your server yet, then allow http request on Nginx
    - sudo ufw allow 'Nginx HTTP'
    To be sure it's allowed or not, you can also check it's tatus
    - sudo ufw status
    Used distribution is Ubuntu 22.04
    Install PHP-FPM package manager without Apache
    - sudo apt update
    - sudo apt upgrade
    - sudo apt install php php-cli php-fpm php-json php-pdo php-mysql php-zip php-gd  php-mbstring php-curl php-xml php-pear php-bcmath
    (currently used version is php8.1)    
    Configure Nginx to Use the PHP Processor
    Currently used
    - sudo nano /etc/nginx/sites-available/hotel.loc.conf
                server {
                    listen 80;
                    listen [::]:80;
                    server_name hotel.loc www.hotel.loc;
                    root /var/www/html/hotel.loc;
                    index index.html index.php;
                    location / {
                        try_files $uri $uri/ /index.php?$args;
                    }
                    location ~ .php$ {
                        try_files $uri =404;
                        fastcgi_split_path_info ^(.+.php)(/.+)$;
                        fastcgi_pass unix:/run/php/php8.1-fpm.sock;
                        fastcgi_index index.php;
                        fastcgi_param  SCRIPT_FILENAME  /var/www/html/hotel.loc$fastcgi_script_name;
                        include fastcgi_params;
                    }
                }
    When you’ve made the above changes, you can save and close the file.
    Test your configuration file for syntax errors by typing:
    - sudo nginx -t
    When you are ready, reload Nginx to make the necessary changes:
    - sudo systemctl reload nginx
    Install MySQL, a database management system, to store and manage the data for our site.
    You can install this easily by typing: (Currently used version is 8.0.31)
    - sudo apt-get install mysql-server
    ou will be asked to supply a root (administrative) password for use within the MySQL system.
    The MySQL database software is now installed, but its configuration is not exactly complete yet.
    To secure the installation, we can run a simple security script that will ask whether we want to modify some insecure defaults. Begin the script by typing:
    - mysql_secure_installation
    Set your db username and pass
    Clone git repo inside your root folder (Currently is /var/www/html/hotel.loc)
    
## Hot to use the Project    

    Connect to your database
    Create your database (currently created db name is hotel)
    For test information you can import hotel.sql into your db. File located inside database folder.
    Start your services:
    - sudo service nginx start
    - sudo service php8.1-fpm start
    - sudo service mysql start

    Enjoy !!!

## Collaborate with team

    email: hayk.maryanyan@dataart.com
    skype: hayk.maryanyan


## Test and Deploy

You can test after doing all installation steps which are described above. For that used DatePicker demo version, also I have print all data, which you can find inside your browser developer tools, under Network section. If you don't want to run the whole application, you can use Postman or Swagger tools to send appropriate requests and receive responses. 
For that you can find requests collections file inside Document folder.

## Visuals

Depending on what we are making, you can check some gifes inside visuals folder.

## Support
If you will have any questions, I'm opening to discuss them.
My contacts:
email: hayk.maryanyan@dataart.com
skype: hayk.maryanyan

## RoadMap
Planning to add payment system in the feature.

## Contributing

Pull requests are welcome. For major changes, please open an issue first
to discuss what you would like to change.
Please make sure to update tests as appropriate.

## Authors and acknowledgment
The Project author and acknowledgment - Hayk Maryanyan.

## License
MIT License

Copyright (c) [2023] [Hayk Maryanyan]

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.

## Project status

The project completed according task requirements.
