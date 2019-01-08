<?
include "header.php";

?>
<div class="container-fluid">
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="#">Services</a>
    </li>
    <li class="breadcrumb-item active">Recherche</li>
  </ol>

  <form class="" action="findREST.php" method="get">

    <div class="card mb-3">
      <div class="card-header">
        Entrer des mots clé pour votre recherche</div>
      <div class="card-body">

        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="mots-cles">Veuillez entrer les mots clés</span>
          </div>
          <div class="form-control">
            <input type="text" required  placeholder="Entrer les mots clés" name="mots-cles" id="mots-cles" data-role="tagsinput"/>
          </div>

          <div class="input-group-prepend">
            <input type="submit" class="btn btn-outline-primary" name="submit" value="Recherche">
          </div>
        </div>

    </div>
  </form>
</div>
<?

if(isset($_GET["mots-cles"])){

  $tags = formTagsToApiTags($_GET["mots-cles"]);
  $data["query"] = $tags;
  $data["result"] = "sequence_release";
  $data["display"] = "xml";
  $data["offset"] = 1 ;//start
  $data["length"] = 100 ; //start
  $xmlString = callAPI($data);
  libxml_use_internal_errors(true);
  $xml = simplexml_load_string($xmlString);
  //echo "<h1>".count($xml)."</h1>";
  file_put_contents("downloads/restSearchResult.xml", $xmlString);

  ?>

  <div class="card mb-3">
    <div class="card-header">
      <i class="fas fa-table"></i>
      Résultat de Recherche - <a href="downloads/restSearchResult.xml"> telecharger la résultat</a> </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Id</th>
              <th>Description</th>
              <th>Premier publication</th>
              <th>Dernier Mis a jour</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>Id</th>
              <th>Description</th>
              <th>Premier publication</th>
              <th>Dernier Mis a jour</th>
            </tr>
          </tfoot>
          <tbody>







  <?
  if(count($xml) >1 ){
  foreach ($xml as $element) {
    // code...
    $row = sprintf("<tr> <td> %s </td>  <td> %s </td>  <td> %s </td>  <td> %s </td> </tr>",$element["accession"],$element->description,$element["firstPublic"],$element["lastUpdated"]);
    echo $row;
  }
}

?>

          </tbody>
        </table>
      </div>
    </div>

  </div>

<?
//echo formTagsToApiTags($_GET["mots-cles"]);

}



function formTagsToApiTags($formTags){
  $tagsArray = explode(",",$formTags);
  $apiTags = "";
  foreach ($tagsArray as $tag) {
    // code...
    $apiTags .= $tag ."+";
  }
  $apiTags = substr($apiTags,0,strlen($apiTags)-1);
  return $apiTags;
}





function callAPI($data=false, $url="https://www.ebi.ac.uk/ena/data/search",  $method="GET"){
   $curl = curl_init();

   switch ($method){
      case "POST":
         curl_setopt($curl, CURLOPT_POST, 1);
         if ($data)
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
         break;
      case "PUT":
         curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
         if ($data)
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
         break;
      default:
         if ($data)
            $url = sprintf("%s?%s", $url, http_build_query($data));
   }

   // OPTIONS:
   curl_setopt($curl, CURLOPT_URL, $url);
   curl_setopt($curl,CURLOPT_SSL_VERIFYPEER, false);
   curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
   curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);

   // EXECUTE:
   $result = curl_exec($curl);
   if(!$result){die("Connection Failure");}
   curl_close($curl);
   return $result;
}


include "footer.php";
?>
