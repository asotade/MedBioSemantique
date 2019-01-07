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

  <form class="" action="gotoFindREST.php" method="post">

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




function getDataFromAPI($data){

}

function getCountFromAPI($data){
  $data["resultcount"]="";
  return callAPI($data);
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
