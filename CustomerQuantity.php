<!DOCTYPE html>
  <html>
    <head>
      <title>Boring Company- Number of Customer Purchases </title>
      <meta charset = 'utf-8'>
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
            /* Sets a header image (found online), repeats it horizontally (incase people are browsing on wide screen) and sets the default background color to azure*/

            .content {
                max-width: 700px;
                margin: auto;
            }
            /* Sets the default width of the entire screen (used in the <div> command )*/

        </style>

        <div class="content">
            <br><h1>The Boring Company</h1><br>
            <!-- This page Displays customers who have purchased a quantity of products greater than some user defined value-->
        	<?php include 'connectdb.php'?>
                <!-- opens connection to the database -->
        	<?php
        		$BaseNumber= $_POST["BaseNumber"];
                    //imports the user defined value from the index page
        		$TotalPurchasesQuery = "SELECT SUM(Quantity) AS TotalPurchases, CustomerID FROM Boughtby, product WHERE Boughtby.productID= product.productID GROUP BY CustomerID HAVING TotalPurchases >". $BaseNumber;
                    //creates query using above number
                    //returns the total number of purchases from Boughtby per customer in the table above the base value defined by the user ($baseNumber)
                $TotalPurchaseresult = mysqli_query($connection,$TotalPurchasesQuery);
                    //Sends query to the database

                while ($row = mysqli_fetch_assoc($TotalPurchaseresult)) {
                    //Create a While loop to pull data from each returned row in the query
                    //each returned row represents one customer                 
                    $TotalPurchases= $row["TotalPurchases"];
                        // this line gives us the total purcahse number

                    // These next four lines gives us the customername
                    $whichCustomer= $row["CustomerID"];
                    $NameQuery = 'SELECT * FROM customer WHERE CustomerID=' . $whichCustomer;             
        	        $NameResult=mysqli_query($connection,$NameQuery);
                    $NameRow = mysqli_fetch_assoc($NameResult);
                    $CustomerName= $NameRow["FirstName"] . " " . $NameRow["LastName"];

                    // The next two lines gives us the product information of what they bought
                    $query = 'SELECT * FROM Boughtby, product WHERE Boughtby.productID=product.productID AND Boughtby.CustomerID="'.$whichCustomer.'"';
                    $result=mysqli_query($connection,$query);
                     
                    echo "<h2>". $CustomerName ."'s Purchases, Total Number= " .$TotalPurchases . "</h2>";
                        //header containing Customer Name and the Total Number of products they've bought
                    $DefaultString = "Nothing Purchased";
                        //Just incase the user puts "0" into the base number, 
                     
                    while ($row=mysqli_fetch_assoc($result)) {
                        //This while group prints prints out a list, breaking down the total purchase quantity by product
                        echo '<li>' . $row["Quantity"] . " units of ". $row["Description"];
                        unset($DefaultString);
                            //Deletes DefaultString variable if there is something returned in the query; i.e. the customer has purchased something
                    echo $DefaultString;
                        //prints the default string ( Nothing Purchased) if the variable hasn't been deleted. Will only do so if the Query returns NULL

                     }

        	     }
                //House keeping functions:
                    //Free up memory:
                        mysqli_free_result($result);
                        mysqli_free_result($NameResult);
                        mysqli_free_result($TotalPurchaseresult);
                    //Disoconnect from db;
                        mysqli_close($connection);
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
