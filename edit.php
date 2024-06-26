<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $databse = "myshop";

    $conn = new mysqli($servername,$username,$password,$databse);


    $id = "";
    $name = "";
    $email = "";
    $phoe = "";
    $address = "";

    $errorMessage = "";
    $successMessage = "";

    if($_SERVER['REQUEST_METHOD'] == 'GET'){
        if(!isset($_GET["id"])){
            header("location: /myshop/index.php");
            exit;
        }

        $id = $_GET["id"];

        $sql = "SELECT * FROM clients WHERE id=$id";
        $result = $conn->query($sql);

        $row = $result->fetch_assoc();


        if(!$row){
            header("location: /myshop/index.php");
            exit;
        }


        $name = $row["name"];
        $email =$row["email"];
        $phoe = $row["phone"];
        $address = $row["address"];


    }else {
        
        $id = $_POST["id"];
        $name = $_POST["name"];
        $email = $_POST["email"];
        $phoe = $_POST["phone"];
        $address = $_POST["address"];
    }


    do{
        if(empty($id) || empty($name) || empty($email) || empty($phoe) || empty($address)){
            $errorMessage = "All the field Required";
            break;
        }

        $sql = "UPDATE clients " . 
        "SET name = '$name' , email = '$email' , phone = '$phoe' , address = '$address' " . "WHERE id = $id"; 
    
        $result = $conn->query($sql);
    
        
        if(!$result){
            die("Invalid Query" .$conn->error);
            break;
        }

        $successMessage = "Client Update Successfully";

    }while(false);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <div class="container my-5 ">
        <h2>Create New Client</h2>
        <?php
            if (!empty($errorMessage)){
                echo "
                <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                <strong>$errorMessage</strong>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>
                ";
            }
        ?>
        <form method = "POST">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label"> <b> Your Name :</b> </label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name = "name" value = " <?php echo $name;?> " >
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label"> <b> Your Email:</b> </label>
                <div class="col-sm-6">
                    <input type="email" class="form-control" name = "email" value = "<?php echo $email;?>" >
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label"> <b> Your Phone  :</b> </label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name = "phone" value = "<?php echo $phoe;?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label"> <b> Your Address :</b> </label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name = "address" value = "<?php echo $address;?>" >
                </div>
            </dev> 
            <?php
                if (!empty( $successMessage)){
                    echo "

                    <div class='row mb-3 mt-3' >
                        <div class='offset-sm-3 col-sm-6'>
                            <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                            <strong>$successMessage</strong>
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                            </div>
                        </div>
                    </div>
                    ";
                }
            ?>
            
            <div class="row mb-3 mt-3" >
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type = "submit" class="btn btn-primary" >Submit</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a href="/myshop/index.php" class=" btn btn-outline-primary" role="button" > Cancel</a>
                </div>
            </div>
        </form>
    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>