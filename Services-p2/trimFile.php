<?
include "header.php";


if(isset($_SESSION["target_file"])){
  saveBetterScore($_SESSION["target_file"],"uploads/downloadFile.fq");
  header("Location: viewQuality.php?viewFile=uploads/downloadFile.fq");
}else{
  echo "Veuillez Telecharger un fichier d'habor. clickez <a href='index.php'>ici</a> pour allez a la page de telechargement.";
}


function getReadsFromFile($file_path) {
  $reads_table = array();
  $handle = fopen($file_path, "r");

  while(! feof($handle))
  {
    $read = (object)[];
    $read->id = fgets($handle);
    $read->seq = fgets($handle);
    fgets($handle);
    $read->quality = fgets($handle);
    if($read->id != "" && $read->seq != "" && $read->quality != "")
    array_push($reads_table, $read);
  }
  return $reads_table;
}

function getSingleReadInfo($read){
  $obj = (object)[];
  $score_table = unpack("C*", $read->quality);
  $sumScore = 0;
  foreach ($score_table as $score) {
    // code...
    $sumScore += $score - 33;
  }
  $obj->QScore = $sumScore / strlen($read->seq);

  $taille = strlen($read->seq);
  $Cs = substr_count($read->seq,"C");
  $Gs = substr_count($read->seq,"G");
  $Ts = substr_count($read->seq,"T");
  $As = substr_count($read->seq,"A");
  $Ns = substr_count($read->seq,"N");
  $obj->CG = ($Cs+$Gs)/$taille;
  $obj->Ns = $Ns;
  return $obj;
}


function getReadsOfBetterScore($file_path){
  $readsTable = getReadsFromFile($file_path);
  $betterReads = array();
  foreach ($readsTable as $read) {
    // code...
    $details = getSingleReadInfo($read);
    if($details->QScore > 20){
      array_push($betterReads, $read);
    }

  }
  return $betterReads;
}

function saveBetterScore($source,$target)
{
  file_put_contents($target, "");
  $betterReads = getReadsOfBetterScore($source);
  foreach ($betterReads as $read) {
    // code...
    file_put_contents($target, $read->id, FILE_APPEND);
    file_put_contents($target, $read->seq, FILE_APPEND);
    file_put_contents($target, "+\n", FILE_APPEND);
    file_put_contents($target, $read->quality, FILE_APPEND);
  }

}



include "footer.php";

?>
