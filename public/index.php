<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

    require_once __DIR__ . '/../src/functions.php';
    require_once __DIR__ . '/../src/config.php';

    // Default index page
    route('GET', '^/$', function() {
        echo '<a href="users">List users</a><br>';
    });

    // GET request to /users
    route('GET', '^/users$', function() {
        echo '<a href="users/1000">Show user: 1000</a>';
    });

    // With named parameters
    route('GET', '^/users/(?<id>\d+)$', function($params) {
        echo "You selected User-ID: ";
        var_dump($params);
    });

    // POST request to /users
    route('POST', '^/users$', function() {
        header('Content-Type: application/json');
        $json = json_decode(file_get_contents('php://input'), true);
        echo json_encode(['result' => 1]);
    });

    route('GET', '^/all$', function() {
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
    }); 

    route('GET', '^/get/(?<folder>\d+)/(?<file>\d+)$', function($params) {
        var_dump($params);
        try {
            $file = file_get_contents($configs['path'] . '/' . $params['folder'] . '/' . $params['file']);
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