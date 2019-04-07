<!DOCTYPE html>
  <html>
    <head>
      <title>Boring Company- Your Orders</title>
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
            /* Sets a header image (found online), repeats it horizontally (incase people are brousing on wide screen) and sets the default background color to azure*/

            .content {
                max-width: 700px;
                margin: auto;
            }
            /* Sets the default width of the entire screen (used in the <div> command )*/
        </style>

        <div class="content">

          <br><h1>Welcome to the Boring Company</h1><br>
            <!-- properly spaces the title banner -->

          <?php include 'connectdb.php';?>
             <!--This makes sure we open a connection to the db-->
             
      	  <?php
             // This chunk of php code Prints out the page title (customer's name) + Customer Info in a table
             $whichCustomer= $_POST["customer"];
             $NameQuery = 'SELECT * FROM customer WHERE CustomerID=' ."'$whichCustomer'";            
             $QueryResult=mysqli_query($connection,$NameQuery);
             $NameResult=mysqli_fetch_assoc($QueryResult);
      	     $CustomerName= $NameResult["FirstName"] . " " . $NameResult["LastName"];

      	      echo '<h1>' . $CustomerName . '</h1>';
       	      echo "<h2> Customer's info</h2>";	
      			
      	     
              $CustomerID = $_POST["customer"];
      		    $query = "SELECT * FROM customer WHERE CustomerID=" . $CustomerID;
      		    $result = mysqli_query($connection,$query);
      		    $row = mysqli_fetch_assoc($result);
         
              echo '<table border = "1" ><col width="150"><col width="180">';
               //initiate table + create settings
                 echo "<tr> <td align = 'center' > Name: </td> <td align = 'center' >" . $row['FirstName']. " " . $row['LastName'] . "</td> </tr>";
                  //Row with "Name" and its value
                 echo "<tr> <td align = 'center' > City: </td> <td align = 'center' >" . $row['City'] . "</td> </tr>";
                  //Row with "City" + its value
                 echo "<tr> <td align = 'center' > Phone Number: </td> <td align = 'center'>" . $row['PhoneNumber'] . "</td> </tr>";
                  //Row with "PhoneNumber" + its value
                 echo "<tr> <td align = 'center' > Customer ID: </td> <td align = 'center'>" . $row['CustomerID'] . "</td> </tr>";
                  //Row with "CustomerID" + its value
                 echo "<tr> <td align = 'center' > Agent ID: </td> <td align = 'center' >" . $row['AgentID'] . "</td> </tr>";
                  //Row with "AgentID" + its value
              echo "</table>";
               //close table
      	   ?>

          <h2>Customer Photo</h2>
      	  
          <?php
            	//This chunk of PHP code displays customer picture (if they have it), if they don't have a pic- it creates a form to ask the customer if they want to submit one
              $whichCustomer = $_POST["customer"];          	

              //Creates a query to check if the customer has a picture
              $PhotoQuery = 'SELECT custpic FROM customer WHERE CustomerID=' .$whichCustomer .';';
            	$QueryResult=mysqli_query($connection,$NameQuery);
            	$Photo=mysqli_fetch_assoc($QueryResult);

            	if ($Photo["custpic"] == NULL) {
                //if photo doesn't exist, prompt the user for a url of a picture
            	  echo "No picture found, do you want to submit an url?";
            	  echo "<form action='customerpic.php' method='post'>";
          	     //Create a form to take customerpic url
                  echo '<input type="text" name="url">'; 
          	      echo '<input type= "submit" name = "Submit">';	
          	      echo '<input type="hidden" name="CustomerID" value=' . $whichCustomer . '>';
                    // this line is to give the customerpic.php the correct CustomerID
        	      echo '</form>';
            	}

            	if ($Photo["custpic"] != Null) {
            	 //if photo does exist, display the picture using the following attributes:
                echo '<img height = 300 width = 200 src=" '. $Photo["custpic"] . '">';
            	}
              //House keeping
		mysqli_free_result($QueryResult);
      	   ?>

          <?php 
              //This function runs a query to get the customer name for the title banner, same code as up above 
              $whichCustomer= $_POST["customer"];
                 //we get this from the last page
              $NameQuery = 'SELECT * FROM customer WHERE CustomerID=' ."'$whichCustomer'";
      	      $QueryResult=mysqli_query($connection,$NameQuery);
      	      $NameResult=mysqli_fetch_assoc($QueryResult);
      	      $CustomerName= $NameResult["FirstName"] . " " . $NameResult["LastName"];	            	
              echo '<h2>' . $CustomerName . "'s Purchases</h2>";

              //Housekeeping:
              mysqli_free_result($QueryResult);
      	   ?>

      	<ol>
      	   
          <?php
              //This chunk of php code checks if the customer has ordered something, if they have it prints out a list of the customer's orders 
              //The list includes Product description + quantity 
             
              //Next two lines creates the query and runs it
              $query = 'SELECT * FROM Boughtby, product WHERE Boughtby.productID=product.productID AND Boughtby.CustomerID="'.$whichCustomer.'"';
      	      $result=mysqli_query($connection,$query);
      	       
              $DefaultString= "Nothing Ordered";
                 //Creates a default string for the scenario in which no items were ordered by customer
              while ($row=mysqli_fetch_assoc($result)) {
                 //While loop to check the returned table for the selected customer's CustomerID, if it is present, print out the description of the item + quantity  purchased
                 echo '<li>' . $row["Quantity"] . " units of " . $row["Description"]; 
  		           unset($DefaultString);
                   //"deletes" the Default string
              }
              echo $DefaultString;
                //Prints out the default string, if the while loop found the customerID in the boughtby table, then NULL will be printed out, if not "Nothing ordered" 
              
              //Housekeeping
              mysqli_free_result($result);
          ?>
        </ol>

      	<form action= "index2.php">
              <!-- This takes us back to the homepage-->
      	<hr>
              <h3>Click "Home" to go back to the main menu</h3><br>
              <input type="submit" value= "Home">
      	</form>                          

        <?php mysqli_close($connection); ?>

      </div>
    </body>
  </html>


