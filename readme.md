



Instructions:

1.copy the repository in your localhost/www directory.
2.import database from localhost.sql
3.after importing database make a config.php file in src folder with these parametrs:

<?php
//

 DB Config
define('DRIVER', 'mysql');
define('HOST', 'localhost');
define('DATABASE', 'quizzes');
define('USERNAME', 'homestead');
define('PASSWORD', 'secret');
define('CHARSET', 'utf8');
define('COLLATION', 'utf8_unicode_ci');
define('PREFIX', '');


4.install all required composer dependecies in root folder

    composer install
    
5.install all required npm modules in root folder

    npm install
    
    
Done.