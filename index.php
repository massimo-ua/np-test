<?php
spl_autoload_register(function ($class_name) {
    include './classes/' . $class_name . '.class.php';
});
$controller = new Controller();
$controller->index();
