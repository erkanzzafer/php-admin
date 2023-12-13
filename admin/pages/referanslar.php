 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
     <!-- Content Header (Page header) -->
     <section class="content-header">
         <div class="container-fluid">
             <div class="row mb-2">
                 <div class="col-sm-6">
                     <h1>Referanslar</h1>
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
                             <h3 class="card-title">Referans Ekle</h3>
                             <?php
                                if ((isset($_POST['save']))   && ($_POST['save'] == "1001")) {
                                    // print_r($_FILES['image']);
                                    $title = $_POST['title'];
                                    $description = $_POST['description'];
                                    $image = 'images/' . $_FILES['image']['name'];
                                    $created_at = date('Y-m-d H:i:s');
                                    $user_id = 1;
                                    $status = $_POST['status'];
                                    $image_tmp = $_FILES['image']['tmp_name'];
                                    move_uploaded_file($image_tmp, $image);
                                    $sql = "INSERT INTO qp_referans (title,description,image,created_at,user_id,status) VALUES (?,?,?,?,?,?)";
                                    $args = [$title, $description, $image, $created_at, $user_id, $status];
                                    print($adminclass->pdoPrepare($sql, $adminclass->getSecurity($args)));
                                }
                                ?>
                         </div>
                         <!-- /.card-header -->
                         <!-- form start -->
                         <form method="post" enctype="multipart/form-data">
                             <div class="card-body">
                                 <div class="form-group">
                                     <label>Başlık</label>
                                     <input type="text" class="form-control" name="title">
                                 </div>
                                 <div class="form-group">
                                     <label>Açıklama</label>
                                     <textarea name="description" class="form-control" id="" cols="30" rows="5  "></textarea>
                                 </div>
                                 <div class="form-group">
                                     <label>Durum</label>
                                     <select name="status" class="form-control">
                                         <option value="1">Aktif</option>
                                         <option value="0">Pasif</option>
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
                                 </div>
                             </div>
                             <!-- /.card-body -->

                             <div class="card-footer">
                                 <input type="hidden" name="save" value="1001">
                                 <button type="submit" class="btn btn-success">Kaydet</button>
                             </div>
                         </form>
                     </div>
                     <div class="card">
                         <div class="card-header">
                             <h3 class="card-title">Referans Listesi</h3>
                         </div>
                         <!-- /.card-header -->
                         <div class="card-body">
                             <?php
                                if ((isset($_POST['deleteData'])) && ($_POST['deleteData'] == "1001")) {

                                    $deletedData = (implode("','", $_POST['deleteAll']));
                                    $sql1001 = "SELECT * FROM qp_referans WHERE id IN('$deletedData')";
                                    $stmt = $adminclass->pdoQuery($sql1001);
                                    if ($stmt) {
                                        foreach ($stmt as $value) {
                                            $unlink = unlink($value['image']);
                                        }
                                    }
                                    $sql = "DELETE FROM qp_referans WHERE id IN ('$deletedData')";
                                    $query = $adminclass->pdoPrepare($sql,);
                                    print($query);
                                }
                                ?>
                             <form action="" method="post">
                                 <button type="submit" class="btn btn-danger" onclick="return confirm('Silmek istiyor musunuz?');">Tümünü Sil</button>
                                 <input type="hidden" name="deleteData" value="1001">
                                 <table id="example2" class="table table-bordered table-hover">
                                     <thead>
                                         <tr>
                                             <th>ID</th>
                                             <th>Başlık</th>
                                             <th>Açıklama</th>
                                             <th>Resim</th>
                                             <th>Durum</th>
                                             <th>İşlem</th>
                                         </tr>
                                     </thead>
                                     <tbody>
                                         <?php
                                            $sql = "SELECT * from qp_referans";
                                            $query = $adminclass->pdoQuery($sql);
                                            if ($query) {
                                                foreach ($query as $value) {


                                            ?>
                                                 <tr>
                                                     <td><?php print($value['id']); ?></td>
                                                     <td><?php print($value['title']); ?></td>
                                                     <td><?php print($value['description']); ?></td>
                                                     <td><img src="<?php print $value["image"]; ?>" width="100" height="100" alt=""></td>
                                                     <td><?php print($adminclass->getStatus($value['status'])); ?></td>
                                                     <td>
                                                         <input type="checkbox" name="deleteAll[]" id="deleteAll" value="<?php print($value['id']); ?>">
                                                     </td>
                                                 </tr>
                                         <?php
                                                }
                                            }
                                            ?>
                                     </tbody>
                                     <tfoot>
                                         <tr>
                                             <th>ID</th>
                                             <th>Başlık</th>
                                             <th>Açıklama</th>
                                             <th>Resim</th>
                                             <th>Durum</th>
                                             <th>İşlem</th>
                                         </tr>

                                     </tfoot>
                                 </table>
                             </form>
                         </div>
                         <!-- /.card-body -->
                     </div>
                     <!-- /.card -->
                 </div>




             </div>
         </div>
     </section>
 </div>
 <!-- /.card -->