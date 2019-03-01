<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

    require_once __DIR__ . '/../src/functions.php';

    route('GET', '^/all$', function() {
        try {
            $arraySvg = scandir('/files');
            $allSvg = array(); 
            //Because we don't need to have . and ..
            for($i = 2; $i < count($arraySvg); $i++) {
                $allSvg[$arraySvg[$i]] = array();  
                $scanFolder = scandir('/files' . '/' . $arraySvg[$i]); 
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
    }); 

    route('GET', '^/get/(?<folder>\X+)/(?<file>\X+)$', function($params) {
        try {
            $file = file_get_contents('/files' . '/' . $params['folder'] . '/' . $params['file']);
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
    }); 

    header("HTTP/1.0 404 Not Found");
    echo '404 Not Found';
    
?>