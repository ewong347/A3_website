<!DOCTYPE html>
  <html>
    <head>
       <meta charset= 'utf-8'>
       <title>Boring Company- Add New Customer</title>
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
			
	        <?php include 'connectdb.php';?>
	        <!-- Opens connection to database -->
		    <br><h1>The Boring Company</h1><br><br>
		    <!-- Create the header + space it properlly  -->

	       <?php
	     	// Next 7 lines takes the input from the form on the previous page and assigns them to variable names 
			$cusfname=$_POST["cusfname"];
			$cuslname=$_POST["cuslname"];
			$cuscity=$_POST["cuscity"];
			$cusnum1=$_POST["PhoneNum1"];
			$cusnum2=$_POST["PhoneNum2"];
			$cusnum =$cusnum1. "-". $cusnum2;
			$cusAgentID=$_POST["cusAgentID"];
				
			//Next couple lines deals with Creating a Unique CustomerID
			$query1= 'SELECT MAX(CustomerID) as maxid from customer';
	        	//This lets us avoid any collisions 
			$result=mysqli_query($connection,$query1);
				//Sends our query in 
			if(!$result) {
			     die("database max query failed.");
			}
			$row=mysqli_fetch_assoc($result);
		        $newkey=intval($row["maxid"])+1;
			    // now we're creating the new CusID key- increment the max CustomerID by one
			$CusID=(string)$newkey;
				//turns our $newkey into a string 


			$query2 = 'INSERT INTO customer values(' . $CusID . ', "' . (string)$cusfname . '", "' . (string)$cuslname . '", "' . (string)$cuscity . '", "' . $cusnum . '", ' . $cusAgentID .', NULL);';
			    // This is the sql command to insert the new customer into the DB, Last var is NULL because we won't provide ability to add picture until user checks customer data
			if (!mysqli_query($connection,$query2)){
			     die("Error: insert failed".mysqli_error($connection));
	                }
			// this sends the command to our db

			echo "<b>Your details were added! Thanks for choosing the boring company</b>";
			//print this on the webpage to confirm addition

			//House keeping functions
				mysqli_close($connection);
					//Close the db connection 
				mysqli_free_result($result);
	            	//free up memory
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
