<?php

    // Include template database connection
    include_once("../config/config.php");

    // Store POST request as object
    $reqData = getPostData();
    // $retData = '{}';

    // Create database query to create user
    $stmt = $mysqli->prepare("INSERT INTO user (fname, lname, user, password) VALUES(?, ?, ?, ?)");
    $stmt->bind_param("ssss", $reqData["fname"], $reqData["lname"], $reqData["user"], $reqData["password"]);
    $result = $stmt->execute();

    // Send back 201(Created) or 409(Conflict)
    if ($result)
    {
        http_response_code(201);
        exit;
    }
    else
    {
        http_response_code(409);
    }
    
    // Helper Functions
    function getPostData()
    {
        return json_decode(file_get_contents('php://input'), true);
    }

    // This code is for printing request recieved from front-end
    // header('Content-Type: application/json');
    // echo file_get_contents('php://input');