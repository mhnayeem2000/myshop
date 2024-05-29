<?php
    include('connection.php');
    if(isset($_POST['submit'])){
        $file_name = $_FILES['image']['name'];
        $tempname = $_FILES['image']['tmp_name'];
        $folder = 'images/'. $file_name;



        $query = mysqli_query($con , "Insert into images (file) values ('$file_name')");
        if(move_uploaded_file($tempname, $folder)){
            echo " <h2> File Uploaded Succesfully </h2>";
        }else {
            echo " <h2> File Not Uploaded </h2>";
        }

    }
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Images</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <form method = "POST" enctype = "multipart/form-data">
            <input type="file" name = "image" /> 
            <br><br>
            <button type ="submit" name = "submit">Submit</button>
        </form>

        <div>
            <?php
            $res =  mysqli_query($con, "select * from images");
            while ($row = mysqli_fetch_assoc($res)) {
            ?>    
                <img src="images/<?php echo $row['file'] ?> "/>
            <?php }?>
            
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>