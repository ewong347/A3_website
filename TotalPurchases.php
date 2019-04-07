</!DOCTYPE html>
<html>
	<head>
	       <meta charset= 'utf-8'>
	       <title>Boring Company- Total Purchases</title>
	</head>

	<body>
	        <style>
		       /*  This is the css style i've chosen for my company website*/

				table {
		    			border-collapse: collapse;
				}
					/* This takes away the default double border of tables*/

				table, td, th {
		    			border: 1px solid black;
				}
					/* This sets the default border of all tables as black*/

				body {
	                background-image: url("https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR0rbzW2pThLGUX-4sfF7VXANqjE5CNMv1I7IBzvoGbVoKHnoJcig");
		   			background-repeat: repeat-x ;
					background-color: Azure; 
				}
				/* Sets a header image (found online), repeats it horizontally (incase people are brousing on wide screen) and sets the default background color to azure*/

				.content {
					max-width: 700px;
				 	margin: auto;
				}
				/* Sets the default width of the entire screen (used in the <div> command )*/

	        </style>

			<div class="content">
				<?php include 'connectdb.php' ?>
					<!-- opens connection to database for our querries -->
	            <br> <h1>The Boring Company</h1> <br>	
            	<!-- Sets up our header properly, <br> for spacing-->
            <hr>
				<?php 
					$ProductID=$_POST["GetProduct"];
						//imports ProductID from the drop down menu 
					$ProductQuery= 'SELECT * FROM product WHERE ProductID='. $ProductID .';';
					$BoughtByQuery= 'SELECT SUM(Quantity) as revenue FROM Boughtby WHERE ProductID=' . $ProductID . ';';
						//Creates two queries: First one grabs all the product information for the selected productID
						//Second querry pulls the total # of the selected Product ordered by customers

					$ProductResult = mysqli_query($connection, $ProductQuery);
					$ProductResultRow =mysqli_fetch_assoc($ProductResult);
						//Parses the array returned by mysqli query
					$BoughtByResult = mysqli_query($connection, $BoughtByQuery);
					$BoughtByResultRow =mysqli_fetch_assoc($BoughtByResult);
						//Parses the array returned by mysqli query
					
					if ($BoughtByResultRow["revenue"]== Null) {
						// This sets the Number of Units ordered as 0 if the product hasn't been ordered yet
						// Lets us print "0" instead of NULL below
						$BoughtByResultRow["revenue"]= 0;
					}
					echo '<h2>' .$ProductResultRow["Description"].'</h2><br>';
						//header for the section
					echo 'Total Number of ' .$ProductResultRow["Description"]. ' ordered by our customers: '. $BoughtByResultRow["revenue"];
						//Prints out total number of units ordered
					echo '<br>';
					echo 'Revenue from ' .$ProductResultRow["Description"]. ': $' . $BoughtByResultRow["revenue"]* $ProductResultRow["ItemCost"];
						//Prints out Revenue from the product ordered

					mysqli_close($connection);
						//Close the db connection 
	             ?>
	             
			<form action= "index2.php">
		        <!-- This takes us back to the homepage-->
				<hr>
		        <h3>Click me to go back to the main menu</h3><br>
		        <input type="submit" value= "Home">
			</form> 

			</div>
	</body>
</html>
