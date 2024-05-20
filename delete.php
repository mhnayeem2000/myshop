<?php
    if(isset($_GET["id"])){
        $id = $_GET["id"];
        
        $servername = "localhost";
        $username = "root";
        $password = "";
        $databse = "myshop";
    
        $conn = new mysqli($servername,$username,$password,$databse);

        $sql =  "DELETE FROM clients WHERE id= $id";
        $conn->query($sql);
    }
    header("Location: /myshop/index.php");
    exit;

?>