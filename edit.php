<?php
session_start();
$page_recent = 'Modification';
?>

<?php require('header.php');?>
    <div class="container">
        <div class="row"><div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between bg-secondary">
                    <h4 class="text-white">Modification</h4>
                    <span><a href="index.php" class="btn btn-primary">Retour à la page d'accueil</a></span>
                </div>
                <div class="card-body">
                    <?php
                        require_once('connect.php');
                        $id = $_GET['id'];
                        $query = "SELECT * FROM food_pdo WHERE id='$id' ";
                        $query_run = mysqli_query($connection, $query);

                        if(mysqli_num_rows($query_run)> 0){
                            
                            foreach ($query_run as $row) {
                            
                                ?>
                                <form action="code.php" method="POST" enctype="multipart/form-data">
                                    
                                    <input type="hidden" value="<?php echo $row['id'];?>" name="id">
                                    <div class="form-group">
                                        <label>Produit</label>
                                        <input type="text" name="name" value ="<?php echo $row['name']; ?>" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Categorie</label>
                                        <input type="text" name="class" value ="<?php echo $row['class']; ?>" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Prix</label>
                                        <input type="text" name="price" value ="<?php echo $row['price']; ?>" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Image</label>
                                        <input type="file" name="image" value ="<?php echo $row['image']; ?>" class="form-control">
                                        <input type="hidden" name="old_image" value ="<?php echo $row['image']; ?>" >
                                    </div>
                                    <img src="<?php echo 'upload/'.$row['image']; ?>" width="100px" height="75px" alt="image">
                                    <div class="form-group">
                                        <button name="update" class="btn btn-primary" type="submit"> Mettre A jour</button>
                                    </div>

                                </form>
                            <?php }

                        } else {
                            echo "No record Available";
                        }
                    ?>
                    

                </div>
            </div>
        </div></div>
    </div>
<?php require('footer.php');?> 