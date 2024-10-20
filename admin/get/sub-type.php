<?php 
session_start();
error_reporting(0);
require_once("../../config/config.inc.php");
if (isset($_POST['function']) && $_POST['function'] == 'productType') {
    $id = $_POST['id'];
    $sql = "SELECT pst_id, pst_name FROM products_sub_type WHERE productd_type='$id'";
    //   echo $sql;
    $query = mysqli_query($conn, $sql);
    $json = array();
    while ($result = mysqli_fetch_assoc($query)) {
      array_push($json, $result);
    }
    echo json_encode($json);
  }