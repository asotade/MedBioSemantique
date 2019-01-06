<?
include "header.php";
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$fileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
//echo $fileType;
$target_file = $target_dir . "fastafile." .$fileType;
// Check if file is fastq or not
if(isset($_POST["submit"])) {
    $isfq = $fileType == "fasta" || $fileType == "fa"? true : false;
    //echo "$target_file ; $fileType";
    if($isfq !== false) {
        $uploadOk = 1;
    } else {
        echo "le fichier n'est pas un fasta.<br>";
        $uploadOk = 0;
    }
}

if ($uploadOk == 0) {
    echo "Désolé, le fichier n'était pas telechargé.<br>";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
      // read file
      //save file
      $readsTable = getReadsFromFile($target_file);
      if(isset($_POST["organ"]) && isset($_POST["date"]) && isset($_POST["machine"]))
      {
        $details["organ"] = $_POST["organ"];
        $details["date"] = $_POST["date"];
        $details["machine"] = $_POST["machine"];
        saveAsXML($readsTable,'downloads/sequence.xml',$details);
        $_SESSION["fa_target_file"] = $target_file;
        header("Location: downloadXMLFile.php");
      }

    } else {
        echo "Désolé, il y'avait une erreur lors de telechargement de fichier.<br>";
    }
}







function saveAsXML($readsTable, $target,$info){
  $doc = new DOMDocument('1.0');
  $doc->formatOutput = true;
  $root = $doc->createElement('fasta');
  $root = $doc->appendChild($root);

  $em = $doc->createElement("organisme");
  $text = $doc->createTextNode($info["organ"]);
  $em->appendChild($text);
  $root->appendChild($em);
  $em = $doc->createElement("date");
  $text = $doc->createTextNode($info["date"]);
  $em->appendChild($text);
  $root->appendChild($em);

  $em = $doc->createElement("machine");
  $text = $doc->createTextNode($info["machine"]);
  $em->appendChild($text);
  $root->appendChild($em);
  $em = $doc->createElement("sequence");
  foreach($readsTable as $read)
  {
    $subEm = $doc->createElement("id");
    $text = $doc->createTextNode($read->id);
    $subEm->appendChild($text);
    $em->appendChild($subEm);

    $subEm = $doc->createElement("read");
    $text = $doc->createTextNode($read->seq);
    $subEm->appendChild($text);
    $em->appendChild($subEm);
  }
  $root->appendChild($em);
  $doc->save($target);
}

function getReadsFromFile($file_path) {
  $reads_table = array();
  $handle = fopen($file_path, "r");

  while(! feof($handle))
  {
    $read = (object)[];
    $read->id = fgets($handle);
    $read->seq = fgets($handle);

    if($read->id != "" && $read->seq != "") array_push($reads_table, $read);
  }
  return $reads_table;
}




include "footer.php";
?>
