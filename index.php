<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Test Teamleader</title>
</head>
<body>

<?php
echo '<strong><u>Customers array:</u></strong><br>';
$str = file_get_contents('http://www.digital-productions.be/dev/teamleader/data/customers.json');
$json = json_decode($str, true); // decoderen van JSON naar een associative array
echo '<pre>' . print_r($json, true) . '</pre>';

echo '<br><br>';

echo '<strong><u>Orders array:</u></strong><br>';
$str1 = file_get_contents('http://www.digital-productions.be/dev/teamleader/example-orders/order1.json');
$json1 = json_decode($str1, true); // decoderen van JSON naar een associative array
$json1b[] = $json1;

$str2 = file_get_contents('http://www.digital-productions.be/dev/teamleader/example-orders/order2.json');
$json2 = json_decode($str2, true); // decoderen van JSON naar een associative array
$json2b[] = $json2;

$str3 = file_get_contents('http://www.digital-productions.be/dev/teamleader/example-orders/order3.json');
$json3 = json_decode($str3, true); // decoderen van JSON naar een associative array
$json3b[] = $json3;

//Samenvoegen van de 3 arrays
$merge = array_merge($json1b, $json2b, $json3b);

echo '<pre>'; 
print_r($merge);
echo '</pre>';		

echo '<br><br>';

echo '<strong><u>Products array:</u></strong><br>';
$str4 = file_get_contents('http://www.digital-productions.be/dev/teamleader/data/products.json');
$json4 = json_decode($str4, true); // decoderen van JSON naar een associative array
echo '<pre>' . print_r($json4, true) . '</pre>';

echo '<br><br>';




//A customer who has already bought for over € 1000, gets a discount of 10% on the whole order.
echo '<strong><u>Vraag 1:</u></strong><br>';
foreach($json as $item) {
    
	if ($item['revenue'] > 1000) {
		echo '<br>Match gevonden in customers!<br>';
		echo 'id: '.$item['id']. '<br>';
		echo 'name: '.$item['name']. '<br>';
		echo 'since: '.$item['since']. '<br>';
		echo 'Revenue: '.$item['revenue'] .'<br>';
		
		
foreach($merge as $m) {
    
    if ($m['customer-id'] == $item['id']) {
	    echo '<br>Match gevonden in orders!';
		echo '<br>name: '.$item['name'];
		echo '<br>Order total: '.$m['total'];
		
          //Indien [total] geen key zou zijn in array kan onderstaande gebruikt worden,
		  //deze code zal dan de 3 regels onder deze blok vervangen
		  //$tot = 0;
		  //foreach($m['items'] as $it) {
			  //$total_discount = ($it['total'] * 10) / 100;
			  //$new_total = $it['total'] - $total_discount;
			  //$tot += $new_total;
		  //}
		  //echo '<br>'. $tot;
		
		$discount = ($m['total'] * 10) / 100;
		$new_total = $m['total'] - $discount;
		echo '<br>Order total with discount: '.$new_total;
    }
	
} // End foreach 'merge'
		
		
	} // End if statement
	
} // End foreach 'json'






//For every products of category "Switches" (id 2), when you buy five, you get a sixth for free.
echo '<br><br>';

echo '<strong><u>Vraag 2:</u></strong><br>';
echo '<br>Match gevonden in products!';

foreach($json4 as $item4) {
    
	//Producten beperken tot enkel de 'switches', deze hebben id 2
	if ($item4['category'] == '2') {
		echo '<br>'.$item4['description'].' - '.$item4['id'].'<br>';
		

//Checken of we hier order hebben waar switches in zitten
//Rekening houden ook met de gratis switchen vanaf 5 stuks, 10 stuks, ...
foreach($merge as $m1) {
    
		
		  foreach($m1['items'] as $it1) {
			  if($item4['id'] == $it1['product-id']) {
			     //echo '<br>Match gevonden in orders!<br>';
				 echo '<br>'.$it1['product-id'].' - '.$it1['quantity'].' stuks';
				 
				 if (($it1['quantity'] >= 5) && $it1['quantity'] < 10) {
					 echo '<br>+ extra switch gratis<br>';
				 }
				 if (($it1['quantity'] >= 10) && $it1['quantity'] < 20) {
					 echo '<br>+ 2 extra switchen gratis<br>';
				 }
				 //...
				 
		      }
		  }

	
} // End foreach 'merge'
		
echo '<br>';
		
		
	} // End if 'item4'
	
} // End foreach 'json4'

	
	
	

		
//If you buy two or more products of category "Tools" (id 1), you get a 20% discount on the cheapest product.
echo '<br><br>';

echo '<strong><u>Vraag 3:</u></strong><br>';

//Tellen van aantal producten die in aanmerking komen
$i = 0;
foreach($json4 as $item5) {
    
	if ($item5['category'] == '1') {
		echo '<br>'.$item5['description'].' - '.$item5['id'];
		$i++;
	}
	
}
        
		//Check om te zien of er meer of gelijk aan 2 items in de loop zitten
        if($i >= 2) {
		    echo '<br><br>2 of meer items in de loop, dus we kunnen verder<br>';
			echo '<br>Match gevonden in products!<br>';



//Laten zien welke producten in aanmerking komen		
foreach($json4 as $item5) {
		
	if ($item5['category'] == '1') {
		echo '<br>'.$item5['description'].' - '.$item5['price'];
	}
		
}

echo '<br><br>';

        //Zoeken naar het goedkooopste product en discount berekenen
		foreach ($json4 as $k => $v) {
	       if ($v['category'] == '1') {
               $tArray[$k] = $v['price'];
	       }
        }
        $cheapest = min($tArray);
		$discount1 = ($cheapest * 20)/100;
		$disc_tot = $cheapest - $discount1;
		echo 'Cheapest price: '.$cheapest.'<br>';
		echo 'Cheapest price with discount: '.$disc_tot;

			
			
			
		//Geen 2 items in de loop? Dan stopt het hier	
		} else {
			echo '<br>Minder dan 2 in de loop, hier stopt het';
		}

?>

</body>
</html>
