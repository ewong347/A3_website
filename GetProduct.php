<?php
  include 'connectdb.php';
  //php script to create a drop down menu with products
  
  //Create and run query to pull all data from product table
  $query = "SELECT * FROM product;";
  $result = mysqli_query($connection,$query);
  
  echo "<b>Choose Product Here</b> </br>";
    //Title line for drop down menu
  echo "<select required= 'required' name = 'GetProduct'>" . "<option size=30 > </options?>";
    //Start code for drop down menu 

  while ($row = mysqli_fetch_assoc($result)) {
    //Go through the returned table, create a different option for each row in the product table
    echo "<option value= " . (int)$row["ProductID"] . "> " . $row["Description"] . "</option>"; 
  }
  
  echo "</select>";
    //close code for drop down menu
  
  //House keeping functions:
    mysqli_free_result($result);
    mysqli_close($connection);
?>



