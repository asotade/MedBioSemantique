<?
session_start();
?>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>MedBioSemantique - Services</title>

  <!-- Bootstrap core CSS-->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">

</head>

  <body id="page-top">

    <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

      <a class="navbar-brand mr-1" href="index.html">MedBioSemantique</a>

      <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
        <i class="fas fa-bars"></i>
      </button>

      <!-- Navbar Search -->


    </nav>

    <div id="wrapper">

      <!-- Sidebar -->
      <ul class="sidebar navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="../index.html">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Acceuil</span>
          </a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-folder"></i>
            <span>Étapes</span>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <h6 class="dropdown-header">Qualité et trim:</h6>
            <a class="dropdown-item" href="viewQuality.php">Qualité </a>
            <a class="dropdown-item" href="trimFile.php">Trimmer </a>
            <div class="dropdown-divider"></div>
            <h6 class="dropdown-header">(Semantique) XML:</h6>
            <a class="dropdown-item" href="uploadFasta.php">Fasta à XML</a>
            <div class="dropdown-divider"></div>
            <h6 class="dropdown-header">RESTful API:</h6>
            <a class="dropdown-item" href="#">Recherche</a>
            <a class="dropdown-item" href="#">Allignement</a>
          </div>
        </li>
      </ul>

      <div id="content-wrapper">
