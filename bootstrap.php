<?php

define('PROJECT_ROOT', __DIR__);

$dsn  = 'mysql:dbname=php-oo-blog;host=localhost;port=3306';
$user = 'php-oo-blog';
$pwd  = 'php-oo-blog';

// Auto-chargement de classes
spl_autoload_register(function($class) {
    require __DIR__ . '/src/' . $class . '.php';
});

$connection = new PDO($dsn, $user, $pwd, [
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
]);

