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
                <br><h1>The Boring Company</h1><br>

        	<h2>Customer updated</h2>

                <?php include 'connectdb.php';?>
                <!-- Opens connection to database-->
                <?php
                    
                    //Next couple lines imports  the Phone Num + CustomerID variables
                	$cusnum1=$_POST["PhoneNum1"];	
                	$cusnum2=$_POST["PhoneNum2"];
                    $cusnum	=(string)$cusnum1. "-".	(string)$cusnum2;
                        //combines first + last digits of a phone number 
                    $customer= $_POST["customer"];
                        //obtains customerID

                    if ($_POST["ModificationChoice"]== "delete") {
                        //This is for if you chose to delete a person
			$DelBbQuery = "DELETE FROM Boughtby WHERE CustomerID = ".(string)$customer . ";" ;
			    //Need to delete customer purchases before deleting customer
                        $DelCusQuery = "DELETE FROM customer WHERE CustomerID = ".(string)$customer . ";";
                            //creates the delete customer query
			$result = mysqli_query($connection,$DelBbQuery);
                        $result = mysqli_query($connection,$DelCusQuery);
                            //calls the query 

                        echo"Customer Deleted";
                            //echos this statement for the customer to see
                    } 

                	if ($_POST["ModificationChoice"]=="Modify") {
                        //This is for if you chose to modify the Phone Number
                        $ModQuery = "UPDATE customer SET PhoneNumber =" . '"'.$cusnum. '"'." WHERE CustomerID = " . (string)$customer;
                            //this is the SQL UPDATE query 
                		$result = mysqli_query($connection,$ModQuery);
                            if (!$result) {
    	                        die("databases query failed.");
                            }   
                        }
            	?>               
            	<form action= "index2.php">
                    <!-- This takes us back to the homepage-->
            	<hr>
                    <h3>Click "Home" to go back to the main menu</h3>
                    <input type="submit" value= "Home">
            	</form>
            <?php 
                //House keeping functions
                    mysqli_close($connection);
                        //disconnect from db                        
            ?> 
       </div>
    </body>
  <html>
