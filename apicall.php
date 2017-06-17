<?php
include_once("print.php");
include_once("amazonadd.php");

echo "<br/><a href='search.php'>Go Back</a>";
echo "<br/><a href='displayDB.php'>Display database</a>";
//Amazon
if(isset($_POST['Search'])) {
	$name = $_POST['keywords'];

// Your AWS Access Key ID, as taken from the AWS Your Account page
$aws_access_key_id = "AKIAIAQRDD3EJNDPPSNQ";

// Your AWS Secret Key corresponding to the above ID, as taken from the AWS Your Account page
$aws_secret_key = "i1+KYmnXdZXmwyMoQWxiDVr12PZ0BiKlyf7eocid";

// The region you are interested in
$endpoint = "webservices.amazon.in";

$uri = "/onca/xml";

$params = array(
    "Service" => "AWSECommerceService",
    "Operation" => "ItemSearch",
    "AWSAccessKeyId" => "AKIAIAQRDD3EJNDPPSNQ",
    "AssociateTag" => "blue01b-21",
    "SearchIndex" => "Books",
    "ResponseGroup" => "ItemAttributes, Offers, Images",
    "Keywords" => $name,
    "Availability" => "Available"
);

// Set current timestamp if not set
if (!isset($params["Timestamp"])) {
    $params["Timestamp"] = gmdate('Y-m-d\TH:i:s\Z');
}

// Sort the parameters by key
ksort($params);

$pairs = array();

foreach ($params as $key => $value) {
    array_push($pairs, rawurlencode($key)."=".rawurlencode($value));
}

// Generate the canonical query
$canonical_query_string = join("&", $pairs);

// Generate the string to be signed
$string_to_sign = "GET\n".$endpoint."\n".$uri."\n".$canonical_query_string;

// Generate the signature required by the Product Advertising API
$signature = base64_encode(hash_hmac("sha256", $string_to_sign, $aws_secret_key, true));

// Generate the signed URL
$request_url = 'http://'.$endpoint.$uri.'?'.$canonical_query_string.'&Signature='.rawurlencode($signature);

//echo "Signed URL: \"".$request_url."\"";

//Catch the response in the $response object
$response = file_get_contents($request_url);
$parsed_xml = simplexml_load_string($response);
//printSearchResults($parsed_xml, $SearchIndex);

//Verify a successful request
if(isset($parsed_xml->OperationRequest->Errors->Error)){
foreach($parsed_xml->OperationRequest->Errors->Error as $error){
   echo "Error code: " . $error->Code . "\r\n";
   echo $error->Message . "\r\n";
   echo "\r\n";
}}
printSearchResults($parsed_xml);
amazonAddToDB($parsed_xml, $mysqli);
}

?>
<?php
//FlipKart
include_once("flpkprint.php");
include_once("flipkartadd.php");
if(isset($_POST['Search'])) {
	$query = urlencode($_POST['keywords']);

$url= "https://affiliate-api.flipkart.net/affiliate/1.0/search.json?query=" . $query . "&resultCount=10";



    	//Make sure cURL is available
    	if (function_exists('curl_init') && function_exists('curl_setopt')){
	        //The headers are required for authentication
	        $headers = array(
	            'Cache-Control: no-cache',
	            'Fk-Affiliate-Id: athirali4',
	            'Fk-Affiliate-Token: 035e8cb5cf8444b0b01704f35a7c1e25'
	            );
	        $ch = curl_init();
	        curl_setopt($ch, CURLOPT_URL, $url);
	        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	        //curl_setopt($ch, CURLOPT_USERAGENT, 'sai/0.1');
	        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
	        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	        $result = curl_exec($ch);
	        curl_close($ch);
			$array=json_decode($result, true);
			printFlipkartResults($array);
			//$json = json_encode(json_decode($result), JSON_PRETTY_PRINT);
			//echo $json;
	        flipkartAddToDB($array, $mysqli);

		}
mysqli_close($mysqli);}
?>