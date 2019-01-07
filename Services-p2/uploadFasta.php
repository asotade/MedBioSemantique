<?
include "header.php";
?>
<div class="container-fluid">
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="#">Services</a>
    </li>
    <li class="breadcrumb-item active">Fasta à XML</li>
  </ol>

  <div class="card mb-3">
    <div class="card-header">
      Telecharger fichier fasta</div>
    <div class="card-body">
      <form  action="uploadfa.php" method="post" enctype="multipart/form-data">

        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text">selectionner le fichier depuis votre machine(fasta/fa)</span>
          </div>
          <div class="custom-file">
            <input required type="file" class="custom-file-input" name="fileToUpload" id="fileToUpload">
            <label class="custom-file-label" for="fileToUpload">Choisir un fichier</label>
          </div>
        </div>

        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="organ">Organisme de la sequence</span>
          </div>
          <input required type="text" class="form-control" placeholder="Entrer l'organisme de la sequence" name="organ" id="organ">
        </div>
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="organ">Date de la sequence</span>
          </div>
          <input required type="date" class="form-control" placeholder="Entrer la date de la sequence" name="date" id="date">
        </div>
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="organ">Machine Utilisé</span>
          </div>
          <input type="text" required class="form-control" placeholder="Entrer le nom de la machine utilisé" name="machine" id="machine">
        </div>

          <div class="input-group-prepend">
            <input class="btn btn-outline-success" type="submit" value="Suivant" name="submit">
          </div>


      </form>
    </div>
  </div>


</div>
<?
include "footer.php";
?>
