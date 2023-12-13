<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>MİSYONUMUZ</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <?php

    /*
if ($_POST) {
    print_r($_POST);
    die();
}*/
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        if (isset($_POST['save']) && (@$_POST['save'] == "1001")) {
            //  print_r($_SERVER['REQUEST_METHOD']);
            $title = $_POST['title'];
            $description = $_POST['description'];
            $status = $_POST['status'];
            $created_at = date('Y-m-d H:i:s');
            $user_id = 1;
            $sql = "INSERT INTO qp_mission(title,description,created_at,user_id,status) VALUES(?,?,?,?,?)";
            $args = [$title, $description, $created_at, $user_id, $status];
            print($adminclass->pdoInsert($sql, $adminclass->getSecurity($args)));
        } elseif (isset($_POST['dataDelete'])) {
            $deleteId = $_POST['dataDelete'];
            $sql = "DELETE FROM qp_mission WHERE id= ? ";
            $args = [$deleteId];
            $result = $adminclass->pdoDelete($sql, $args);
            print($result);
        } elseif (isset($_POST['update'])  && (@$_POST['update'] == "1002")) {
            $updateId = $_POST['id'];
            $title = $_POST['title'];
            $description = $_POST['description'];
            $status = $_POST['status'];
            $sql = "UPDATE qp_mission SET title=? , description=?,status=? WHERE id=? ";
            $args = [$title, $description, $status, $updateId];
            print($adminclass->pdoPrepare($sql, $adminclass->getSecurity($args)));
        }
    }


    ?>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-default">
                                YENİ EKLE
                            </button>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Başlık</th>
                                        <th>Açıklama</th>
                                        <th>Durum</th>
                                        <th>Tarih</th>
                                        <th>İşlem</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    //$variable = $adminclass->getAbout();
                                    $sql = "SELECT * FROM qp_mission ORDER BY id DESC";
                                    $variable = $adminclass->pdoQuery($sql);
                                    if ($variable) {
                                        foreach ($variable as $value) {
                                    ?>
                                            <tr>
                                                <td><?php print $value['id']; ?></td>
                                                <td><?php print $value['title']; ?></td>
                                                <td><?php print $value['description']; ?></td>
                                                <td><?php print $value['status']; ?></td>
                                                <td><?php print $value['created_at']; ?></td>
                                                <td>
                                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-delete<?php print $value['id']; ?>">
                                                        Sil</button>
                                                    <div class="modal fade" id="modal-delete<?php print $value['id']; ?>">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title">Hakkımızda | Sil <?php print $value['id']; ?></h4>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <!-- general form elements disabled -->
                                                                    <div class="card card-warning">

                                                                        <!-- /.card-header -->
                                                                        <div class="card-body">
                                                                            <form method="post" action="" autocomplete="off">
                                                                                <div class="modal-footer justify-content-between">
                                                                                    <input type="hidden" name="dataDelete" value="<?php print $value['id']; ?>">
                                                                                    <p><?php print $value['title']; ?> Bölümünü Silmek istediğinize emin misiniz?</p>
                                                                                    <button type="button" class="btn btn-success" data-dismiss="modal">Vazgeç</button>
                                                                                    <button type="submit" class="btn btn-danger">Sil</button>
                                                                                </div>

                                                                            </form>
                                                                        </div>
                                                                        <!-- /.card-body -->
                                                                    </div>
                                                                </div>

                                                            </div>
                                                            <!-- /.modal-content -->
                                                        </div>
                                                        <!-- /.modal-dialog -->
                                                    </div>
                                                    <!-- /.modal Sil -->

                                                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal-update<?php print $value['id']; ?>">
                                                        Güncelle</button>
                                                    <div class="modal fade" id="modal-update<?php print $value['id']; ?>">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title">Hakkımızda | Güncelle</h4>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <!-- general form elements disabled -->
                                                                    <div class="card card-warning">

                                                                        <!-- /.card-header -->
                                                                        <div class="card-body">
                                                                            <form method="post" action="" autocomplete="off">
                                                                                <div class="row">
                                                                                    <div class="col-sm-12">
                                                                                        <!-- text input -->
                                                                                        <div class="form-group">
                                                                                            <label>Başlık</label>
                                                                                            <input type="text" class="form-control" name="title" value="<?php print $value['title']; ?>">
                                                                                        </div>
                                                                                    </div>

                                                                                </div>
                                                                                <div class="row">
                                                                                    <div class="col-sm-12">
                                                                                        <!-- textarea -->
                                                                                        <div class="form-group">
                                                                                            <label>Açıklama</label>
                                                                                            <textarea class="form-control" name="description" rows="5"><?php print $value['description']; ?></textarea>
                                                                                        </div>
                                                                                    </div>

                                                                                </div>
                                                                                <div class="row">
                                                                                    <div class="col-sm-12">
                                                                                        <!-- select -->
                                                                                        <div class="form-group">
                                                                                            <label>Durum</label>
                                                                                            <select name="status" class="form-control">
                                                                                                <option value="1" <?php echo $value['status'] == 1 ? "selected" : ""; ?>>Aktif</option>
                                                                                                <option value="0" <?php echo $value['status'] == 0 ? "selected" : ""; ?>>Pasif</option>
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="modal-footer justify-content-between">
                                                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Kapat</button>
                                                                                    <button type="submit" class="btn btn-success">Güncelle</button>
                                                                                </div>
                                                                                <input type="hidden" name="update" value="1002">
                                                                                <input type="hidden" name="id" value="<?php print $value['id']; ?>">
                                                                            </form>
                                                                        </div>
                                                                        <!-- /.card-body -->
                                                                    </div>
                                                                </div>

                                                            </div>
                                                            <!-- /.modal-content -->
                                                        </div>
                                                        <!-- /.modal-dialog -->
                                                    </div>
                                                    <!-- /.modal update -->
                                                </td>
                                            </tr>
                                    <?php
                                        }
                                    }else {
                                     //   print("veri yok");
                                    }
                                    ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>ID</th>
                                        <th>Başlık</th>
                                        <th>Açıklama</th>
                                        <th>Durum</th>
                                        <th>Tarih</th>
                                        <th>İşlem</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>





<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Hakkımızda | Yeni Ekle</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- general form elements disabled -->
                <div class="card card-warning">

                    <!-- /.card-header -->
                    <div class="card-body">
                        <form method="post" action="" autocomplete="off">
                            <div class="row">
                                <div class="col-sm-12">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label>Başlık</label>
                                        <input type="text" class="form-control" name="title" placeholder="Enter ...">
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <!-- textarea -->
                                    <div class="form-group">
                                        <label>Açıklama</label>
                                        <textarea class="form-control" name="description" rows="5" placeholder="Enter ..."></textarea>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <!-- select -->
                                    <div class="form-group">
                                        <label>Durum</label>
                                        <select name="status" class="form-control">
                                            <option value="1">Aktif</option>
                                            <option value="0">Pasif</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Kapat</button>
                                <button type="submit" class="btn btn-success">Ekle</button>
                            </div>
                            <input type="hidden" name="save" value="1001">
                        </form>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal default -->