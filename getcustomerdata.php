<?php
  //This script pulls customer data from the database, ordering it by last name and creates a table for it
  include 'connect.db';
  $query = "SELECT * FROM customer ORDER BY LastName";
    //create the query
  $result = mysqli_query($connection,$query);
    //then send it in 

  echo "<b>Customer info</b>: </br>";
    //Title for table
  echo "<table border = '1' style = 'width:80%'>";
    //initiate table  + style options

   echo "<tr>";
      echo "<th align = 'center' >Select Customer</th> <th align = 'center' >Last Name</th> <th align = 'center' >First Name</th> <th align= 'center'>City</th>";
      echo "<th align = 'center' >Phone Number</th> <th align = 'center' >CustomerID</th>";
   echo "</tr>";
    //Create the table header row - split up the lines for easier reading 
   while ($row = mysqli_fetch_assoc($result)) {
      //run through each row in the returned $result array, Parse through the array and print out the following values in rows 
      echo "<tr>";
        echo "<td align= 'center'><input required type='radio' name='customer' value='" . $row["CustomerID"] . "'></td><td align= 'center'>" . $row["LastName"] . "</td>";
        echo "<td align= 'center'>" . $row["FirstName"] . "</td><td align= 'center'>" . $row["City"] . "</td><td align= 'center'>" .  $row["PhoneNumber"] ."</td>";
        echo "<td align= 'center'>".  $row["CustomerID"];
      echo "</tr>";
      //Split the lines up for easier reading again 
   }

   echo "</table>";
    //close off table  
   
   //House keeping functions
     mysqli_free_result($result);
      //free data up 
     mysqli_close($connection);
      //close connection to database
?>
