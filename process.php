<?php
require 'config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $category = $_POST['category'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $website = $_POST['website'];
    $email = $_POST['email'];

    $stmt = $pdo->prepare("INSERT INTO businesses 
        (name, description, category, address, phone, website, email) 
        VALUES (?, ?, ?, ?, ?, ?, ?)");
    
    if ($stmt->execute([$name, $description, $category, $address, $phone, $website, $email])) {
        header('Location: index.php?success=1');
    } else {
        header('Location: add-business.php?error=1');
    }
}
?>