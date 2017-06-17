<?php

include_once("config.php");

function amazonAddToDB($parsed_xml, $mysqli){
	
	$numOfItems = $parsed_xml->Items->TotalResults;
  if($numOfItems>0)
{
	foreach($parsed_xml->Items->Item as $current){
		
	  $numOfOffers=$current->Offers->TotalOffers;
	  if($numOfOffers>0){
		  
		if(isset($current->MediumImage->URL))
		  	$imgUrl= $current->MediumImage->URL;	
		else $imgUrl="";	
		
		if(isset($current->ItemAttributes->Title))
			$title= $current->ItemAttributes->Title;	
		else $title="";
		
		if(isset($current->ItemAttributes->Author))
			$author=$current->ItemAttributes->Author;		
		else $author="";
		
		if(isset($current->ItemAttributes->Edition))
			$edition=$current->ItemAttributes->Edition;		
		else $edition="";
		
		if(isset($current->ItemAttributes->PublicationDate))
			$publYear= $current->ItemAttributes->PublicationDate;		
		else $publYear="";
		
		if(isset($current->Offers->Offer->OfferListing->Price->FormattedPrice))
			$price= $current->Offers->Offer->OfferListing->Price->FormattedPrice;		
		else $price=""; 
		
		if(isset($current->Offers->Offer->OfferListing->PercentageSaved))
			$discount= $current->Offers->Offer->OfferListing->PercentageSaved;		
		else $discount="";
		
		if(isset($current->DetailPageURL))
			$productUrl=$current->DetailPageURL;		
		else $productUrl="";
		
		if(isset($current->Offers->MoreOffersUrl))
			$moreOffersUrl=$current->Offers->MoreOffersUrl;		
		else $moreOffersUrl="";
				
		if (isset($current->OfferSummary->LowestNewPrice->FormattedPrice)) 
			$lowestPrice=$current->OfferSummary->LowestNewPrice->FormattedPrice;
		else $lowestPrice="";
						
		
				
			
		
		
			$result = mysqli_query($mysqli, "INSERT INTO books(title, author, edition, publYear, price, discount, productUrl, imgUrl, moreOffersUrl, lowestPrice, source) VALUES('$title', '$author', '$edition', '$publYear', '$price', '$discount', '$productUrl', '$imgUrl', '$moreOffersUrl', '$lowestPrice', 'a')");	
}
	}
}
}
?>
