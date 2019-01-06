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
          selectionner le fichier depuis votre machine:
          <input type="file" name="fileToUpload" id="fileToUpload"><br><br>
          <table>
            <tr>
              <td><label for="organ">Organisme de la sequence : </label></td>
              <td><input required type="text" id="organ"name="organ" value=""></td>
            </tr>
            <tr>
              <td><label for="date">Date de la sequence : </label></td>
              <td><input required type="date" id="date"name="date" value=""></td>
            </tr>
            <tr>
              <td><label for="machine">Machine Utilisé : </label></td>
              <td><input required type="text" id="machine"name="machine" value=""></td>
            </tr>
            <tr>
              <td></td>
              <td><input class="" type="submit" value="Suivant" name="submit"></td>
            </tr>
          </table>
            <br>
            <br>
            <br>

      </form>
    </div>
  </div>


</div>
<?
include "footer.php";
?>
