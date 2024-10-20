<?php
session_start();
// Include your database connection file
require_once("./config/config.inc.php");

if(isset($_POST['selectData'])) {
    $selectData = $_POST['selectData'];
    $username = $_SESSION['store'];
    
    $sqlGetPayment = "SELECT store_payment.*, payment_name, bank_name FROM `store_payment` 
                        LEFT JOIN payment_method ON store_payment.bank_type = payment_method.payment_id
                        LEFT JOIN bank ON store_payment.bank = bank.bank_id
                        WHERE username = '$username' and bank_type = '$selectData'";
    
    $resultGetPayment = $conn->query($sqlGetPayment);
    $rowGetPayment = $resultGetPayment->fetch_assoc();
    
    // Prepare data to be sent back as JSON
    $responseData = array(
        'bank_name' => $rowGetPayment['bank_name'],
        'branch' => $rowGetPayment['branch'],
        'account_name' => $rowGetPayment['account_name'],
        'account_number' => $rowGetPayment['account_number'],
        'qr_code' => $rowGetPayment['qr_code']
    );
    
    // Encode data as JSON and send it back
    echo json_encode($responseData);
}
?>
