<?php
session_start();
$result = array();
if(isset($_GET['action']) && $_GET['action']!=""){
session_destroy();

$result = array(
    'response' => 0
);
echo json_encode($result);
}
?>