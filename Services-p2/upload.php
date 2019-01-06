<?php
include 'header.php';
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$fileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
//echo $fileType;
$target_file = $target_dir . "currentFile." .$fileType;
// Check if file is fastq or not
if(isset($_POST["submit"])) {
    $isfq = $fileType == "fastq" || $fileType == "fq"? true : false;
    //echo "$target_file ; $fileType";
    if($isfq !== false) {
        $uploadOk = 1;
    } else {
        echo "le fichier n'est pas un fastq.<br>";
        $uploadOk = 0;
    }
}

if ($uploadOk == 0) {
    echo "Désolé, le fichier n'était pas telechargé.<br>";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
      // read file
      $check = checkFileStructure($target_file);
      if($check !== false){
        $_SESSION["target_file"] = $target_file;
        header("Location: viewQuality.php");
      }else{
        echo "Le fichier fastq que vous avez donner n'est pas valide.";
      }
    } else {
        echo "Désolé, il y'avait une erreur lors de telechargement de fichier.<br>";
    }
}


function checkFileStructure($file_path){
  $handle = fopen($file_path, "r");
  while(! feof($handle)){
    $id = fgets($handle);
    if($id[0] != "@" && $id != ""){
      echo "id - " . $id;
      return false;
    }
    fgets($handle);
    $plus = fgets($handle);
    if($plus[0] != "+" && $plus != ""){
      echo "pluuuss - " . $plus;
      return false;
    }
    fgets($handle);

  }
  return true;
}


include 'footer.php';
?>
