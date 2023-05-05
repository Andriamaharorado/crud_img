<?php session_start(); 
$page_recent = 'Accueil';
?>
<?php require('header.php');?>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between bg-secondary">
                        <h4 class="text-white">Accueil</h4>
                        <span><a href="create.php" class="btn btn-primary">Ajouter un nouveau Element</a></span>
                    </div>
                    
                    <div class="card-body">
                        <?php
                        if(isset($_SESSION['status']) && $_SESSION != '') { ?>
                                
                            <div class="alert alert-<?= $_SESSION['message']; ?> alert-dismissible fade show" role="alert">
                            
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                <strong> Message : </strong>  <?php echo $_SESSION['status']; ?>
                            </div>
                             <?php unset($_SESSION['status']);
                        } ?>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Produit</th>
                                    <th>Categorie</th>
                                    <th>Prix</th>
                                    <th>Image</th>
                                    <th style="text-align:center;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    require_once('connect.php');
                                    $query = " SELECT * FROM food_pdo ";
                                    $query_run = mysqli_query($connection, $query);
                                    if (mysqli_num_rows($query_run) >0) {
                                        
                                        foreach ($query_run as $row) {
                                ?>
                                            <tr>
                                                <td> <?php echo $row['id']; ?> </td>
                                                <td> <?php echo $row['name']; ?> </td>
                                                <td> <?php echo $row['class']; ?> </td>
                                                <td> <?php echo $row['price']; ?> </td>
                                                <td><img src="<?php echo 'upload/'.$row['image']; ?>" alt="image" width="100px" height="75px"></td>
                                                <td  class="d-flex justify-content-center">
                                    
                                                    <a href="edit.php?id=<?php echo $row['id'];?>" class="btn btn-info"> Modifier</a>

                                                    <form action="code.php" method="post">
                                                        <input type="hidden" name="delete_id" value="<?php echo $row['id'];?>">
                                                        <input type="hidden" name="delete_img" value="<?php echo $row['image'];?>">
                                                        
                                                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal_delete-<?= $row['id'];?>">
                                                            Supprimer
                                                        </button>
                                                        <div class="modal fade" id="modal_delete-<?= $row['id'];?>">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">

                                                                    <div class="modal-header">
                                                                        <h4 class="modal-title">Suppression d'un élement</h4>
                                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                    </div>

                                                                    <div class="modal-body">
                                                                        Veuillez Confirmer la suppression "<?= $row['name'];?>" !
                                                                    </div>

                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                                                        <button type="submit" name="delete" class="btn btn-danger">Valider </button>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                    
                                                </td>
                                            </tr>

                                        <?php }
                                        
                                    } else{
                                        ?>
                                    <tr>
                                        <td>No Record Available </td>
                                    </tr> 
                                    <?php }  ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php require('footer.php');?> 