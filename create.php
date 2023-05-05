<?php
session_start();
$page_recent = 'Création';
?>
<?php require('header.php');?>
    <div class="container">
        <div class="row"><div class="col-md-12">
            <div class="card">
            <div class="card-header d-flex justify-content-between bg-secondary">
                    <h4 class="text-white">Creation</h4>
                    <span><a href="index.php" class="btn btn-primary">Retour à la page d'accueil</a></span>
                </div>
                <div class="card-body">

                    <?php
                    if(isset($_SESSION['status']) && $_SESSION != ''){ ?>
                            
                        <div class="alert alert-<?= $_SESSION['message']; ?> alert-dismissible fade show" role="alert">
                         
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <strong> Message : </strong> <?php echo $_SESSION['status']; ?>
                           
                        </div>
                        <?php unset($_SESSION['status']);
                    } ?>
                    
                    <form action="code.php" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="">Produit</label>
                            <input type="text" name="name" id="" class="form-control" placeholder="Enter name" required>
                        </div>
                        <div class="form-group">
                            <label for="">Categorie</label>
                            <input type="text" name="class" id="" class="form-control" placeholder="Enter class" required>
                        </div>
                        <div class="form-group">
                            <label for="">Prix</label>
                            <input type="text" name="price" id="" class="form-control" placeholder="Enter contact" required>
                        </div>
                        <div class="form-group">
                            <label for="">Image</label>
                            <input type="file" name="image" id="" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <button name="save" class="btn btn-primary" type="submit">Ajouter</button>
                        </div>

                    </form>

                </div>
            </div>
        </div></div>
    </div>
<?php require('footer.php');?> 