<!-- Header -->
<?php
include_once("templates/header.php")
?>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">



    <!-- Navbar -->
    <?php include_once("templates/navbar.php"); ?>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <?php
    include_once("templates/sidebar.php");
    ?>

    <!-- Content -->

    <?php
    //Gelen Parametrelerin kontrolü
    if ($_GET) {
      //  print_r($_GET);
    } 

    if (isset($_GET['route'])) {
      $pages = 'pages/' . strtolower($_GET['route']) . '.php';
    } else {
      $pages = null;
    }

    if (file_exists($pages)) {
      include_once $pages;
    } else {
      include_once 'pages/index.php';
    }
    ?>

    <!-- /Content -->


    <!-- Footer -->
    <?php
    include_once("templates/footer.php");
    ?>