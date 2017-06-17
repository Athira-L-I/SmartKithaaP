
<?php
include_once("config.php");
function flipkartAddToDB($array, $mysqli)
{
	$x=0;  
	while($x < count($array['productInfoList'])){
		$title="";
		$author="";
		$edition="";
		$publYear="";
		$price="";
		$discount="";
		$productUrl="";
		$imgUrl="";
		//$moreOffersUrl="";
		
		$title      .= $array['productInfoList'][$x]['productBaseInfoV1']['title'];
		$editionArr     = $array['productInfoList'][$x]['categorySpecificInfoV1']['keySpecs'];
		$price .= "INR ".$array['productInfoList'][$x]['productBaseInfoV1']['flipkartSellingPrice']['amount'];
		$productUrl .= $array['productInfoList'][$x]['productBaseInfoV1']['productUrl'];
		$imgUrl   .= $array['productInfoList'][$x]['productBaseInfoV1']['imageUrls']['200x200'];
		$publYear   .= $array['productInfoList'][$x]['categorySpecificInfoV1']['booksInfo']['year']; 
		$authorArr   = $array['productInfoList'][$x]['categorySpecificInfoV1']['booksInfo']['authors']; 
		$discount .= $array['productInfoList'][$x]['productBaseInfoV1']['discountPercentage'];
		
		if(isset($authorArr[0]))
		$author  .= $authorArr[0];
		if(isset($editionArr[4]))
		$edition .= $editionArr[4];
		$result = mysqli_query($mysqli, "INSERT INTO books(title, author, edition, publYear, price, discount, productUrl, imgUrl, source) VALUES('$title', '$author', '$edition', '$publYear', '$price', '$discount', '$productUrl', '$imgUrl', 'f')");	
		
		$x++;
	}
}
	?>