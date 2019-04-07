<?php
	//This script checks the database for products not in the Boughtby table
	include 'connectdb.php';

	//Create a query, print out Product Name (Description) of productID's not in the list of Product Id's from the Boughtby table
	$query = "SELECT product.Description FROM product WHERE ProductID NOT IN(SELECT ProductID FROM Boughtby);";
    $Result = mysqli_query($connection,$query);
    
    while ($row = mysqli_fetch_assoc($Result)) {
	//run through list of items not ordered and print them on different lines
    	echo "<br>" . $row["Description"];
    }

    //House keeping
    mysqli_close($connection);
    mysqli_free_result($Result);
?>

