 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
     <!-- Content Header (Page header) -->
     <section class="content-header">
         <div class="container-fluid">
             <div class="row mb-2">
                 <div class="col-sm-6">
                     <h1>Referans Güncelle</h1>
                 </div>
                 <div class="col-sm-6">
                 </div>
             </div>
         </div><!-- /.container-fluid -->
     </section>

     <!-- Main content -->
     <section class="content">
         <div class="container-fluid">
             <div class="row">
                 <!-- left column -->
                 <div class="col-md-12">
                     <!-- general form elements -->
                     <div class="card card-primary">
                         <div class="card-header">
                             <h3 class="card-title">Referans Güncelle</h3>
                             <?php
                                if ((isset($_POST['save']))   && ($_POST['save'] == "1001")) {
                                    // print_r($_FILES['image']);
                                    $id=$_POST['id'];
                                    $title = $_POST['title'];
                                    $description = $_POST['description'];  
                                    $created_at = date('Y-m-d H:i:s');
                                    $user_id = 1;
                                    $status = $_POST['status'];

                                   
                                    $sql = "UPDATE qp_referans SET title=?, description=?, created_at=?, user_id=?, status=? WHERE id=?";
                                    $args = [$title, $description, $created_at, $user_id, $status,$id];
                                    print($adminclass->pdoPrepare($sql, $adminclass->getSecurity($args)));

                                    /*
                                    $image = 'images/' . $_FILES['image']['name'];
                                    $image_tmp = $_FILES['image']['tmp_name'];
                                    if (file_exists($image)) {
                                        print('<div class="alert alert-danger">Aynı isimde dosya mevcut...</div>');
                                    } else {
                                        move_uploaded_file($image_tmp, $image);
                                      
                                    }*/
                                }

                                if (isset($_GET['id'])) {
                                    $id = $adminclass->getSecurity($_GET['id']);
                                   // print($id);
                                }
                                ?>
                         </div>
                         <!-- /.card-header -->
                         <!-- form start -->
                         <form method="post" enctype="multipart/form-data">
                             <input type="hidden" name="id" value="<?php print $id; ?>">
                             <?php
                                $sql = "SELECT * FROM qp_referans WHERE id={$id}";
                                $query = $adminclass->pdoQuery($sql);
                                if ($query) {
                                ?>
                                 <div class="card-body">
                                     <div class="form-group">
                                         <label>Başlık</label>
                                         <input type="text" class="form-control" name="title" value="<?php echo $query[0]['title']; ?>">
                                     </div>
                                     <div class="form-group">
                                         <label>Açıklama</label>
                                         <textarea name="description" class="form-control" id="" cols="30" rows="5  "><?php echo $query[0]['description']; ?></textarea>
                                     </div>
                                     <div class="form-group">
                                         <label>Durum</label>
                                         <select name="status" class="form-control">
                                             <option value="1" <?php echo $query[0]['status'] == "1" ? 'selected' : ''; ?>>Aktif</option>
                                             <option value="0" <?php echo $query[0]['status'] == "0" ? 'selected' : ''; ?>>Pasif</option>
                                         </select>
                                     </div>
                                     <div class="form-group">
                                         <label for="exampleInputFile">File input</label>
                                         <div class="input-group">
                                             <div class="custom-file">
                                                 <input type="file" class="custom-file-input" name="image">
                                                 <label class="custom-file-label" for="exampleInputFile">Resim Yükle</label>
                                             </div>
                                         </div>
                                         <img src=" <?php echo $query[0]['image']; ?>" width="100" height="100" alt="">
                                     </div>
                                 </div>
                             <?php  } ?>
                             <!-- /.card-body -->

                             <div class="card-footer">
                                 <input type="hidden" name="save" value="1001">
                                 <button type="submit" class="btn btn-success">Güncelle</button>
                             </div>
                         </form>
                     </div>

                     <!-- /.card -->
                 </div>




             </div>
         </div>
     </section>
 </div>
 <!-- /.card -->