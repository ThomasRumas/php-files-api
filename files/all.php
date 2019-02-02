<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

    $configs = include_once('../config/config.php'); 

    try {
        $arraySvg = scandir($configs['path']);
        $allSvg = array(); 
        //Because we don't need to have . and ..
        for($i = 2; $i < count($arraySvg); $i++) {
            $allSvg[$arraySvg[$i]] = array();  
            $scanFolder = scandir($configs['path'] . '/' . $arraySvg[$i]); 
            for($j = 2; $j < count($scanFolder); $j++) {
                array_push($allSvg[$arraySvg[$i]], $scanFolder[$j]); 
            } 
        }
        http_response_code(200);
        echo json_encode($allSvg);
    } catch(Exception $e) {
        http_response_code(500); 
        echo json_encode($e); 
    }
?>