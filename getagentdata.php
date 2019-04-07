<?php
  include 'connectdb.php';
  //php script pulling Agent name and AgentID from the agent table
  //populates a dropdown menu that contains all agents
  $query = "SELECT * FROM agent";
  $result = mysqli_query($connection,$query);
      //Creates and submits query to database

  echo "Which Agent Are You Using? </br>";
    //Header for the drop down menu

  echo "<select required= 'required' name = 'cusAgentID'>";
    //Creation of drop down menu
    echo "<option size=30 option > </options?>";

    while ($row = mysqli_fetch_assoc($result)) {
      //Goes through the returned values and creates a different option for each row in the agent table 
      echo "<option value= " . $row["AgentID"] . "> " . $row["FirstName"] . " " . $row["LastName"] . "</option>";

    }

  echo "</select>";
    //closes selection menu 
  mysqli_free_result($result);
    //Deletes result from variables to save memory
  mysqli_close($connection);
    //closes database connection 
?>
