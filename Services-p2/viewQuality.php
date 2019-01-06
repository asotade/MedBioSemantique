<?
include "header.php";
  //echo "session file  : ".$_SESSION["target_file"];
  //session_start();
  if(isset($_GET["viewFile"]) || isset($_SESSION["target_file"]) ){
    //echo "session set";
    if(isset($_GET["viewFile"])) {
      $target_file = $_GET["viewFile"];
    }else{
      $target_file = $_SESSION["target_file"];
    }

    $reads = getReadsFromFile($target_file);
    $readsInfo = getSeqInfo($reads);
    ?>
    <?
    if(isset($_GET["viewFile"])) {
      ?>
      <a download class="rounded" href="<?echo $_GET["viewFile"]; ?>" style="display: inline;position: fixed;right: 15px;top: 80px;width: 200px;height: 50px;text-align: center;color: #fff;background: rgba(52, 58, 64, 0.5);line-height: 46px;z-index:500;">
      <i class="fas fa-angle-down"></i>
      Telecharger le fichier
      </a>
      <?
    }else{
      ?>
      <a class="rounded" href="trimFile.php" style="display: inline;position: fixed;right: 15px;top: 80px;width: 150px;height: 50px;text-align: center;color: #fff;background: rgba(52, 58, 64, 0.5);line-height: 46px;z-index:500;">
      <i class="fas fa-angle-right"></i>
      page suivante
      </a>
      <?
    }
     ?>

    <div class="container-fluid">
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Services</a>
        </li>
        <li class="breadcrumb-item active">Rapport qualité</li>
      </ol>

      <div class="card mb-3">
        <div class="card-header">
          Informations de la sequence:</div>
        <div class="card-body">
          <strong>Nombre de reads :</strong>  <?echo $readsInfo->readCount;?> <br>
          <strong>Nombre de PB :</strong>  <?echo $readsInfo->count;?> <br>
          <strong>Range :</strong>  <?echo $readsInfo->minSeq;?> - <?echo $readsInfo->maxSeq;?> <br>
          <strong>Langueur moyenne :</strong>  <?echo $readsInfo->moySeq;?> <br>
          <strong>Score de Qualité :</strong>  <?echo $readsInfo->QScore;?> <br>
          <strong>CG% :</strong>  <?echo $readsInfo->CG;?> <br>
          <strong>Nombre de N :</strong>  <?echo $readsInfo->Ns;?> <br>

        </div>
      </div>
      <div class="card mb-3">
        <div class="card-header">
          <i class="fas fa-table"></i>
          Informations par read</div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Id</th>
                  <th>Sequence</th>
                  <th>Score</th>
                  <th>GC%</th>
                  <th>Ns</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Id</th>
                  <th>Sequence</th>
                  <th>Score</th>
                  <th>GC%</th>
                  <th>Ns</th>
                </tr>
              </tfoot>
              <tbody>
                <?foreach ($reads as $read){
                  $details= getSingleReadInfo($read);
                   ?>
                <tr>
                    <td><?echo $read->id;?></td>
                    <td><?echo $read->seq;?></td>
                    <td><?echo $details->QScore;?></td>
                    <td><?echo $details->CG;?></td>
                    <td><?echo $details->Ns;?></td>
                </tr>
                <?}?>
              </tbody>
            </table>
          </div>
        </div>

      </div>


    </div>




    <?

  }else{
    echo "Veuillez Telecharger un fichier d'habor. clickez <a href='index.php'>ici</a> pour allez a la page de telechargement.";
  }

function getSeqInfo($reads_table){
  $obj = (object)[];

  $obj->count = 0;
  $obj->readCount = sizeof($reads_table);

  $obj->minSeq = 10000000;
  $obj->maxSeq = 0;
  $seqence = "";
  $sommeLongeur=0;
  $sommeCGs = 0;
  $sommeQuality=0;
  $sommeNs=0;
  foreach ($reads_table as $read) {
    // code...
    $seqence .= $read->seq;
    $obj->count += strlen($read->seq);
    if(strlen($read->seq) > $obj->maxSeq){
      $obj->maxSeq = strlen($read->seq);
    }
    if(strlen($read->seq) < $obj->minSeq){
      $obj->minSeq = strlen($read->seq);
    }
    $sommeLongeur += strlen($read->seq);

    $details=getSingleReadInfo($read);
    $sommeQuality+=$details->QScore;
    $sommeCGs+=$details->CG;
    $sommeNs+=$details->Ns;
  }

  $obj->moySeq = $sommeLongeur / $obj->readCount;
  $obj->QScore = $sommeQuality / $obj->readCount;
  $obj->CG = $sommeCGs / $obj->readCount;
  $obj->Ns = $sommeNs / $obj->readCount;
  $obj->fullSeq = $seqence;

  return $obj;
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









include "footer.php";
?>
