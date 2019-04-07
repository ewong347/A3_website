<?php
    //This script first checks if the customer has already bought the item that they are ordering
    //If they have already bought the item before, the Boughtby table is updated with the quantity increased by the quantity specificied in the new order
    //If they haven't already bought the item before, the order is Inserted as a new row in the boughby table
    include 'connectdb.php';
    //Start by importing variables from the previous form 
        $OrderQuantity=$_POST["OrderQuantity"];
        $GetProduct=$_POST["GetProduct"];
        $customer=$_POST["customer"];

    $FirstTimebuyer = TRUE;
        //By default, the customer is a first time buyer, this will be changed if we find the customer in the Boughtby table

    //Query the database to get all orders from the Boughtby table where the CustomerID matches with the customer selected by the user,
    $initQuery= "SELECT * FROM Boughtby WHERE CustomerID=".$customer. ";";
    $initresult = mysqli_query($connection,$initQuery);

    while ($row = mysqli_fetch_assoc($initresult)) {
        //Run through each row in the Bought by table
        if ($row["ProductID"]==$GetProduct) {
            //Check if the ProductID in the Row matches the product that the user wants to buy, if it matches, run the following code:
            $newQuant= $row["Quantity"]+ $OrderQuantity;
                //Sum the existing order quantity and the new order quantity
            
            //Update the database with the new quantity
            $ModQuery="UPDATE Boughtby SET Quantity =" . $newQuant ." WHERE CustomerID = " . (string)$customer . " AND ProductID = " . $GetProduct;
            $result = mysqli_query($connection,$ModQuery);
            
            $FirstTimebuyer = FALSE;   
                //We know that the customer has already purchased this product, so set this var = FALSE

            echo "Order Added, Thanks for choosing the Boring Company";

            //Prints out the form to bring user back to the Homepage 
            echo " <form action= 'index2.php'>" ;
                echo "<!-- This takes us back to the homepage-->";
                echo "<hr>";
                echo "<h3>Click me to go back to the main menu</h3><br>";
                echo "<input type='submit' value= 'Home'>";
            echo "</form>";
        }
    }  

    if ($FirstTimebuyer == TRUE) {
        //This if statement only runs when the above if statement doesn't set the var = FALSE
        //Since the customer hasn't already ordered the specified product, we need to insert a new row into the Boughtby table instead of updating a row

        //Insert query below:
        $ModQuery ="INSERT INTO Boughtby Values (Quantity = " . $OrderQuantity .", CustomerID = " . (string)$customer . ", ProductID =  " . $GetProduct . ");" ;
        $result = mysqli_query($connection, $ModQuery);

        //Prints out the form to bring user back to the Homepage:
        echo "Order Added, Thanks for choosing the Boring Company";
        echo "<form action= 'index2.php'>" ;
            echo "<!-- This takes us back to the homepage-->";
            echo "<hr>";
            echo "<h3>Click me to go back to the main menu</h3><br>";
            echo "<input type='submit' value= 'Home'>";
        echo "</form>";
    }

    //Housekeeping functions:
        mysqli_close($connection);
   
?>
