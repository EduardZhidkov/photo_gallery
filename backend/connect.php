<?php
$connection = new PDO('pgsql:host = localhost;dbname = Photo_gallery','postgres','12345');
if(!$connection){
    die('Error connect to DataBase!');
}
