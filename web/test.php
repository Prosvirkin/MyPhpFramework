<?php

require 'rb.php';
$db = require '../config/config_db.php';
R::setup($db["dsn"], $db["user"], $db["pass"], $options);
R::freeze();
R::fancyDebug();

//var_dump(R::testConnection());

// CREATE
//$category = R::dispense('category');
//$category->title = 'Категория 3';
//$id = R::store($category);


// READ
//$cat = R::load('category', 2);

// UPDATE
//$cat = R::load('category', 4);
//$cat->title = "категория3";
//R::store($cat);

//DELETE
//$cat = R::load('category', 5);
//R::trash($cat);

//WIPE
//R::wipe("category");

// FINDALL
//$cats = R::findAll('category', 'id > ?', [2]);
//$cats = R::findAll('category', 'title LIKE ?', ["%Cat%"]);


// FINDONE
$cats = R::findOne('category', 'id = 2');
echo "<pre>";
print_r($cats);

