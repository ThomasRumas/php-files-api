<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

    $configs = include_once('../config/config.php'); 
    
    try {
        $file = file_get_contents($configs['path'] . '/' . $_GET['folder'] . '/' . $_GET['file']);
        if($file == false) {
            http_response_code(404);
            echo json_encode('No file found');
        } else {
            http_response_code(200);
            echo json_encode($file);
        }        
    } catch(Exception $e) {
        http_response_code(500); 
        echo json_encode($e); 
    }
?>