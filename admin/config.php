<?php
session_start();
define("DB_DRIVER","mysql");
define("DB_HOST","localhost");
define("DB_NAME","veterinaria");
define("DB_USER","veterinario");
define("DB_PASSWORD","123");
define("DB_PORT","3306");
class Config {
    function getImageSize(){
        return 512000;
    }
    function getImageType(){
        return array("image/gif", "image/png", "image/jpeg", "image/bmp", "image/jpg" , "image/webp","image/tiff" , "image/x-png");
    }

}
?>