<?php

require_once("inc/connection.php");

function deliver_response($api_response){
 
    // HTTP responses
    $http_response_code = array(
        200 => 'OK',
        400 => 'Bad Request',
        401 => 'Unauthorized',
        403 => 'Forbidden',
        404 => 'Not Found'
    );
 
    // Set HTTP Response
    header('HTTP/1.1 '.$api_response['status'].' '.$http_response_code[ $api_response['status'] ]);
 
    // Set HTTP Response Content Type
    header('Content-Type: application/json; charset=utf-8');
 
    // Format data
    $json_response = json_encode($api_response);
 
    // Deliver data
    echo $json_response;
 
    exit;
 
}
 
// Define response codes and related HTTP response
$api_response_code = array(
    0 => array('HTTP Response' => 400, 'Message' => 'Unknown Error'),
    1 => array('HTTP Response' => 200, 'Message' => 'Success'),
    2 => array('HTTP Response' => 403, 'Message' => 'HTTPS Required'),
    3 => array('HTTP Response' => 401, 'Message' => 'Authentication Required'),
    4 => array('HTTP Response' => 401, 'Message' => 'Authentication Failed'),
    5 => array('HTTP Response' => 404, 'Message' => 'Invalid Request'),
    6 => array('HTTP Response' => 400, 'Message' => 'Invalid Response Format')
);

// Set default HTTP response of 'ok'
$response['code'] = 0;
$response['status'] = 404;
$response['data'] = NULL; 
 
$method = $_SERVER['REQUEST_METHOD'];


switch ($method) {
  case 'GET':
    $query = "SELECT original FROM urls WHERE id = " . $_GET['method'];
    $result = mysql_query($query);
    $row = mysql_fetch_row($result);
    mysql_close( $connection );
  
    $response['code'] = 1;
    $response['status'] = $api_response_code[ $response['code'] ]['HTTP Response'];
    $response['data'] = $row[0];
  
    // Return response
    deliver_response($response);
  
    break;
  
  case 'POST':
     // Authorize
    if( empty($_POST['username']) || empty($_POST['password']) ){
      $response['code'] = 3;
      $response['status'] = $api_response_code[ $response['code'] ]['HTTP Response'];
      $response['data'] = $api_response_code[ $response['code'] ]['Message'];

      // Return response
      deliver_response($response);
    }

    // Return an error if password fails
    elseif( $_POST['username'] != 'foo' || $_POST['password'] != 'bar' ){
      $response['code'] = 4;
      $response['status'] = $api_response_code[ $response['code'] ]['HTTP Response'];
      $response['data'] = $api_response_code[ $response['code'] ]['Message'];

      // Return response
      deliver_response($response);
    }
    
    // Create short URL
    else {
      
      $urlinput = mysql_real_escape_string($_GET['method']); 
      
      $id = rand(10000,99999);
      
      $shorturl = base_convert($id,20,36);
      
      $query = "INSERT INTO urls VALUES('$id',now(),'$urlinput','$shorturl')";
      
      $result = mysql_query($query,$connection);
      
      $query = "SELECT * FROM urls WHERE id = $id";
      
      //echo $query;
      
      $result = mysql_query($query);
      
      $results = array();
      
      while ( $row = mysql_fetch_array( $result ) ) {
        array_push( $results, $row[0] );
        array_push( $results, $row[2] );
        array_push( $results, $row[3] );
      }
      
      mysql_close($connection);
      
      $response['code'] = 1;
      $response['status'] = $api_response_code[ $response['code'] ]['HTTP Response'];
      $response['data'] = json_encode($results);
    
      // Return response
      deliver_response($response);
    
    }
    
  break;
}

 

?>