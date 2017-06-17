<?php
function printSearchResults($parsed_xml){
	
	//echo "Signed URL: \"".$request_url."\"";
  print("<table>");
  
  $numOfItems = $parsed_xml->Items->TotalResults;
  if($numOfItems>0)
{
	foreach($parsed_xml->Items->Item as $current){
		
	  echo "<tr>";
	  $numOfOffers=$current->Offers->TotalOffers;
	  if($numOfOffers>0){
		  
		  	$imgPath= $current->MediumImage->URL;
			echo "<br><td><img src=".$imgPath."></td>";
		
			print("<td><font size='-1'><b>".$current->ItemAttributes->Title."</b>");
			/*if (isset($current->ASIN)) {
				print("<br>ASIN: ".$current->ASIN);
			} */
	
			if (isset($current->ItemAttributes->Title)) {
				print("<br>Title: ".$current->ItemAttributes->Title);
			} 
			if(isset($current->ItemAttributes->Author)) {
				print("<br>Author: ".$current->ItemAttributes->Author);
			}
			/*if (isset($current->ItemAttributes->Binding)) {
				print("<br>Binding: ".$current->ItemAttributes->Binding);
			} */
			if (isset($current->ItemAttributes->Edition)) {
				print("<br>Edition: ".$current->ItemAttributes->Edition);
			} 
			if (isset($current->ItemAttributes->PublicationDate)) {
				print("<br>Publication Date: ".$current->ItemAttributes->PublicationDate);
			} 
			if(isset($current->Offers->Offer->OfferListing->Price->FormattedPrice)){
				print("<br>Price: ".$current->Offers->Offer->OfferListing->Price->FormattedPrice);
				if(isset($current->Offers->Offer->OfferListing->PercentageSaved))
					print("\n (".$current->Offers->Offer->OfferListing->PercentageSaved."% off)");
			}
		
			if (isset($current->DetailPageURL)) {
				$url=$current->DetailPageURL;
				print( "<br><a href=".$url.">Go to Amazon Page</a>" );
			} 
			if (isset($current->OfferSummary->LowestNewPrice->FormattedPrice)&&isset($current->Offers->MoreOffersUrl)) {
			
				$lowestPrice=$current->OfferSummary->LowestNewPrice->FormattedPrice;
				$moreOffers=$current->Offers->MoreOffersUrl;
				print("\n\n\n <a href=".$moreOffers.">More offers from ".$lowestPrice." </a></td>");
			}	 
		}
		echo "</tr>";
	}
}
else
	print("<center>No matches found.</center>");
}
?>