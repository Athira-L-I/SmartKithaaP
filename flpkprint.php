<?php
function printFlipkartResults($array)
{
	$x=0;  print("<table>");
	while($x < count($array['productInfoList'])){

		$title      = $array['productInfoList'][$x]['productBaseInfoV1']['title'];
		$edition     = $array['productInfoList'][$x]['categorySpecificInfoV1']['keySpecs'];
		$price = "INR ".$array['productInfoList'][$x]['productBaseInfoV1']['flipkartSellingPrice']['amount'];
		$productUrl = $array['productInfoList'][$x]['productBaseInfoV1']['productUrl'];
		$imageUrl   = $array['productInfoList'][$x]['productBaseInfoV1']['imageUrls']['200x200'];
		$publYear   = $array['productInfoList'][$x]['categorySpecificInfoV1']['booksInfo']['year']; 
		$author   = $array['productInfoList'][$x]['categorySpecificInfoV1']['booksInfo']['authors']; 
		$discount = $array['productInfoList'][$x]['productBaseInfoV1']['discountPercentage'];
		echo "<tr>";
		echo "<br><td><img src=".$imageUrl."></td>";
		echo "<td>";
		print("<td><font size='-1'><b>".$title."</b>");
		echo "<br> Title: ".$title;
		if(isset($author[0]))
		echo "<br> Author: ".$author[0];
		if(isset($edition[4]))
		echo "<br>" .$edition[4];
		if(isset($publYear))
		echo "<br> Publication  Date: ".$publYear;
		if(isset($price))
		echo "<br> Price: ".$price;
		if(isset($discount))
		echo " (".$discount."% off)";
		
		print( "<br><a href=".$productUrl.">Go to Flipkart Page</a>" );
		echo "</td>";
		
		$x++;
	}
}
	?>