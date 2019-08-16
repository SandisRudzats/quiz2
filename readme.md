



Instructions:

1.copy the repository in your localhost/www directory.
2.import database from localhost.sql
3.after importing database make a config.php file in src folder with these parametrs:

<?php


define ('DRIVER', 'mysql');
define ('HOST', 'localhost');
define  ('DATABASE', 'testdb');
define ('USERNAME','homestead');
define ('PASSWORD', 'secret');
define ('CHARSET', 'utf8');
define ('COLLATION', 'utf8_unicode_ci');
define ('PREFIX', '');


Done.
