<?php

# Autoload da framework Slim
require '../vendor/autoload.php';

# Autoload das classes que criamos
spl_autoload_register( function ( $class_name ){

    $filename = "..".DIRECTORY_SEPARATOR.$class_name.".class.php";

	if (file_exists(($filename))) {
		require_once($filename);
    }
});