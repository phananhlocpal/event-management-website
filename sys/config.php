<?php
    try {       
        $conn = new PDO('mysql:host=localhost;dbname=pclub', "root", "");
    } catch (PDOException $e) {
        die("Lỗi : " . $e->getMessage() ) ;  
    }
?>

