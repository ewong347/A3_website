<?php
   //This script querries the database for customer data, ordering data by CustomerID, then creates a table with CustomerID, Customer Name and Customer Phone Num

   include 'connectdb.php';
    //opens connection to database

   //Next couple lines creates a query to load customer data from the database, oders them by CustomerID
   $query = "SELECT * FROM customer ORDER BY CustomerID";
   $result = mysqli_query($connection,$query);
   if (!$result) {
        die("databases query failed.");
    }
   
   //Next block of code creates + populates the table with customer info

   echo '<b>Customer Name & Phone Number: </b></br>';
    //Header + spacing
   echo "<table>  <col width='60'>  <col width= '60'><col width='150'>  <col width='100'> <tr>";
    //Table properties
   echo '<tr><th>Selection</th><th>Customer ID</th><th>Name</th><th>Phone Number</th></tr>';
    //Table row names
   while ($row = mysqli_fetch_assoc($result)) {
      //While loop runs through every entry in the table
        echo '<tr><td align="center"> <input type="radio" name="customer" value="' . $row["CustomerID"] . '"></td>';
          //Creates the radio button with the value of CustomerID
        echo '<td align="center">' .$row["CustomerID"].'</td>'; 
          //Prints CustomerID number
        echo '<td align="center">' . $row["FirstName"] . " ". $row["LastName"] . "</td>";
          //Concactenates First + last name before printing it into table
        echo '<td align="center">'. $row["PhoneNumber"]. '</td></tr>';
          // Prints Phone Number into table   
   }
   echo '</table>';
    // closes the table
   mysqli_free_result($result);
    //deletes the $result var
   mysqli_close($connection);
    //disconnects from db
?>


