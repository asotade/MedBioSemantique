<?

//next example will recieve all messages for specific conversation
/*
$service_url = 'https://www.ebi.ac.uk/ena/data/search?query=kinase+homo+sapiens&resultcount';
$curl = curl_init();
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_URL, $service_url);
curl_setopt($curl,CURLOPT_SSL_VERIFYPEER, false);
$curl_response = curl_exec($curl);
if ($curl_response === false) {
    $info = curl_getinfo($curl);
    curl_close($curl);
    die('error occured during curl exec. <br> Additioanl info: ' . var_export($info));
}
curl_close($curl);
echo var_export($curl_response);
*/


$data["query"] = "kinase+homo+sapiens";
$data["result"] = "sequence_release";

$data["display"] = "fasta";
$data["offset"] = 1 ;//start
$data["length"] = 10 ; //start

//$data["resultcount"]="";

$url= "https://www.ebi.ac.uk/ena/data/search";

$test = sprintf("%s?%s", $url, http_build_query($data));
//echo $test;


$get_data = callAPI($data,$url);
echo $get_data;

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





?>
