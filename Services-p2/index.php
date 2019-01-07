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



      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text">selectionner le fichier depuis votre machine(fastq/fq)</span>
        </div>
        <div class="custom-file">
          <input type="file" class="custom-file-input" name="fileToUpload" id="fileToUpload">
          <label class="custom-file-label" for="fileToUpload">Choisir un fichier</label>
        </div>
        <div class="input-group-prepend">
          <input class="btn btn-outline-secondary" type="submit" value="Suivant" name="submit">
        </div>
      </div>

  </form>


</div>


<?include 'footer.php';?>
