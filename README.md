<img src="https://image.prntscr.com/image/W0qWcchESjK8Y7u00ACizQ.png" width="100%"/>

# Artsy _Project EWA Publishing Lab_
Artsy is an application to publish your researches. The purpose of Artsy is to share arts and science researches. 
The project is created with the framework Laravel. While this is our first time using Laravel,
we believe the end result is good enough to publish.

## Preview
<img src="https://image.ibb.co/mseU46/artsy.gif" width="700px"/>


## What is included
- `laravelcollective/html` package to use html form.
- `Barryvdh\DomPDF` package to make PDF's.
- `MercurySeries\Flashy` to make fancy notifications.
- `Unisharp\Ckeditor` to use a text editor.


## Usage
1. Install [Composer](https://getcomposer.org)
   <br>You can find the install guide [here](https://getcomposer.org/download)
2. After step 1, setup the database with the included `empty_database.sql` file.
3. Make a connection with the database by editing the `.env.example` file.

the following must be edited:
```
  DB_CONNECTION=mysql
  DB_HOST=127.0.0.1
  DB_PORT=3306
  DB_DATABASE=homestead
  DB_USERNAME=homestead
  DB_PASSWORD=secret
  ```
  
4. Rename`.env.example` to `.env`.

5. Link the public folder with the storage folder by executing the following Artisan command:
``` 
php artisan storage:link
```
 

  
  
## Core Developers
- Nikhil Kumar - [GitHub](https://github.com/NikhKu)
- Jordy Quak - [Github](https://github.com/jrquak)
- Tom van Etten - [Github](https://github.com/TomvEtten)
- Jimmy  Egberts - [Github](https://github.com/JimmyEgberts)
- Elwin Slokker - [Github](https://github.com/ElwinBran)  
  
  
  
  
## License
 [MIT](https://github.com/nishanths/license/blob/master/LICENSE)