<?php include('../test/Components/header.php');?>
<?php require_once '../test/Classes/Product.php';?>
<?php require_once '../test/Classes/User.php'; ?>

<?php

$database = new Database();
$conn = $database->getConnection();


$product = new Product($conn);


$product->getProduct(1);