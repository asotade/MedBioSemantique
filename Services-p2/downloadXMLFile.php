<?
include "header.php";
if(isset($_SESSION["fa_target_file"])) {
  ?>


  <div class="container-fluid">
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="#">Services</a>
      </li>
      <li class="breadcrumb-item active">Télecharger XML</li>
    </ol>
    <a href="downloads/sequence.xml"><i class="fas fa-angle-down"></i> Telecharger le fichier XML</a>
  </div>
  <?
}else{
  echo "Veuillez Telecharger un fichier d'habor. clickez <a href='index.php'>ici</a> pour allez a la page de telechargement.";
}
include "footer.php";
?>
