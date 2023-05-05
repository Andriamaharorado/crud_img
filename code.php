<?php
session_start();
require_once('connect.php');


// Create
if (isset($_POST['save'])) {

    
    $name = htmlspecialchars($_POST['name']);
    $class = htmlspecialchars($_POST['class']);
    $price = htmlspecialchars($_POST['price']);
    $image = $_FILES['image']['name'];
    $image_tmp= $_FILES["image"]["tmp_name"];
     
    
    // $filename = $_FILES['image']['name'];

    $allowed_extension = array('gif','png', 'jpg', 'jpeg');
    $file_extension = pathinfo($image, PATHINFO_EXTENSION);

    // check the file is an image
    if (!in_array($file_extension, $allowed_extension)){
        
        $_SESSION['status'] = "You are allowed with only jpg, png, jpeg and gif.";
        $_SESSION['message'] = "warning";
    }
    else{
        
        // check if the images already exists
        if(file_exists("upload/". $image)){
            //$filename = $_FILES['image']['name'];
            $_SESSION['status'] = "Image already exists ".$image;
            $_SESSION['message'] = "danger";

        } else {

            // send data if the images doesn't yet exist in data base
            $query = "INSERT INTO food_pdo (name, class, price, image) values ('$name', '$class', '$price', '$image')";
            $query_run = mysqli_query($connection, $query);

            if($query_run){
            
                // save the image into a folder
                move_uploaded_file($image_tmp, "upload/".$image);
        
                $_SESSION['status'] = "Element Stored Successfully";
                $_SESSION['message'] = "success";
            } else{
                $_SESSION['status'] = "Image not Inseted !";
                $_SESSION['message'] = "danger";
            }

        }

    }
    header('Location: create.php');

}

//update
if(isset($_POST['update'])){
    
    $id =$_POST['id'];
    $name = htmlspecialchars($_POST['name']);
    $class = htmlspecialchars($_POST['class']);
    $price = htmlspecialchars($_POST['price']);

    $new_image = $_FILES['image']['name'];
    $old_image = $_POST['old_image'];

    $update_filename = ($new_image != '') ? $_FILES['image']['name'] : $old_image;

    if(isset($_FILES['image']['name'])){
        if($new_image == $old_image && file_exists("upload/". $_FILES['image']['name'])){
            $filename = $_FILES['image']['name'];
            $_SESSION['status'] = "Image already exists ".$filename;
            $_SESSION['message'] = "danger";
        }
    else {
        // updating
        $query = "UPDATE food_pdo SET name='$name', price = '$price', class='$class',
        image ='$update_filename' WHERE  id= '$id' "; 
        $query_run = mysqli_query($connection, $query);

        if($query_run){
            if ($_FILES['image']['name'] != '') {
                move_uploaded_file($_FILES['image']['tmp_name'], "upload/".$_FILES['image']['name']);
                unlink('upload/'.$old_image);
            }
            $_SESSION['status'] = "Data update Successfully";
            $_SESSION['message'] = "success";
        }
        else{
            $_SESSION['status'] = "Data is not Updated";
            $_SESSION['message'] = "secondary";
        }
    }
    header('location: index.php');
    
}
}

//delete
if(isset($_POST['delete'])){
    $id = $_POST['delete_id'];
    $image = $_POST['delete_img'];

    $query = "DELETE FROM food_pdo WHERE id='$id' ";
    $query_run = mysqli_query($connection, $query);

    if($query_run){
        unlink('upload/'.$image);
        $_SESSION['status'] = "Suppression Reussi";
        $_SESSION['message'] = "info";
        header('location: index.php');
    } else{
        $_SESSION['status'] = "Suppression interompu";
        header('location: index.php');
    }
}
?>