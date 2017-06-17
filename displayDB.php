<?php
include_once("config.php");

$result=mysqli_query($mysqli, "SELECT * FROM books");
?>
<html>
<head>  <title>  Search Results </title> </head>

<body>

<a href=search.php> Search a New Book</a>  <br/> <br/>
<table>
<?php     
    while($r= mysqli_fetch_array($result))
    {
		$img= $r['imgUrl'];
		$title=$r['title'];
		$author=$r['author'];
		$edition=$r['edition'];
		$publYear=$r['publYear'];
		$price=$r['price'];
		$discount=$r['discount'];
		$productUrl=$r['productUrl'];
		$moreOffersUrl=$r['moreOffersUrl'];
		$lowestPrice=$r['lowestPrice'];
		$s= $r['source'];
    	echo "<tr><td>";
		if (isset($img))	echo "<img src=".$img.">";
		echo "</td>";
		
		echo "<td>";
    	if (isset($title)) {
				print("<br>Title: ".$title);
			} 
		if (isset($author)) {
				print("<br>Author: ".$author);
			} 
		if (isset($edition)) {
				print("<br>Edition: ".$edition);
			} 
		if (isset($publYear)) {
				print("<br>Publishing Year: ".$publYear);
			} 
    	if (isset($price)) {
				print("<br>Amount: ".$price);
			} 
		if (isset($discount)) {
				print(" (".$discount."% off)");
			} 
		if (isset($productUrl)) {
				print( "<br><a href=".$productUrl.">Buy Now from " );
				if($s=='a')
					print("Amazon</a>");
				else if($s=='f')
					print("Flipkart</a>");
			} 
		if (isset($moreOffersUrl)&&isset($lowestPrice)) {
				print("<br><a href=".$moreOffersUrl.">More offers from ".$lowestPrice." </a>");
			} 
    	echo "</td></tr>";      
		
  
}
?>
</table>
</body>
</html>
