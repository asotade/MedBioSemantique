<!DOCTYPE html>
<?include 'header.php'?>
<div class="container-fluid">
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="#">Services</a>
    </li>
    <li class="breadcrumb-item active">Telecharger un fichier</li>
  </ol>

  <h3>Telecharger un fichier fasq</h3>
  <hr>
  <form id="" action="upload.php" method="post" enctype="multipart/form-data">
      selectionner le fichier depuis votre machine:
      <input type="file" name="fileToUpload" id="fileToUpload">
      <input class="" type="submit" value="Suivant" name="submit">
  </form>


</div>


<?include 'footer.php';?>
