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


            <br> <h1>Welcome to the Boring Company</h1> <br>	
            <!-- Sets up our header properly, <br> for spacing-->
            <hr>
                <!-- this section lists all information about customers -->
                <!-- fulfills bullet point #1: List all the information about all the customers in alphabetical order by last name. When a user selects a customer, display all of his/her products that he/she has purchased.  -->
                <h2>Check Your Orders Here</h2>
                <form action="getpurchaseorder.php" method = "post">
                   
                    <!-- we're telling this form to send its output to getpurchaseorder.php - we need the customerID in order to pull that customer's purchases-->
                        <?php include 'getcustomerdata.php'?>
                            <!-- getcustomerdata.php is a php script that pulls customer data from the database to populate the table-->
                    <br>
                    <input type="submit" value= "Get Order Details">
                    <!-- pressing submit will call the action of the form, in this case, redirecting user to getpurchaseorder.php-->
                </form
            <hr>
               <!-- This section is to display Products, creates buttons so the user can choose the order in which products are displayed-->
               <!-- Fulfills bullet point #2: List all the products in alphabetical order by description OR in order by price. Allow the user to decide if the order is ascending or descending for both the description and price. -->
    
             <h2>Check Out Our Products!</h2>
                <form action="productdata.php" method = "post">
                    <!-- this form allows the user to pick which order the products will be desplayed with. Sends selection to productdata.php using "post"  -->
                   Choose Order: <br>
                     <input required type = "radio" name ="ProductOrder" value= "ItemCost ASC">Price Ascending<br>
                     <input	type = "radio" name ="ProductOrder" value= "ItemCost DESC">Price Descending<br>
                     <input	type = "radio" name ="ProductOrder" value= "Description ASC">Alphabetically Ascending<br>
                     <input	type = "radio" name ="ProductOrder" value= "Description DESC">Alphabetically Descending<br>
                     <input type= "submit" value = "Get Product Details">  
                </form> 


            <hr>
               <!-- This section allows users to submit new purchase orders using a form-->
               <!-- Fulfills bullet point #3-->
                <h2>New Purchase Order</h2>
                If you're ordering additional units of a product you have already ordered, your customer page will reflect your new balance <br><br>
                <form action= "NewOrder.php" method = "post">
                    <?php include "GetProduct.php"?><br><br>
                        <!-- This line calls upon the script GetProduct.php to populate a drop down menu so users can select their desired product -->
                    <?php include "getcustomerdata.php"?><br><br>
                        <!-- This line calls upon the script getcustomerdata.php to populate a table so the user can select which customer is ordering the above product -->
                    Order Quantity:
                    <input required type= "text" name ="OrderQuantity">
                        <!-- Simple text input to determine how many units of a product an user is ordering, required-->
                    <input type= "submit" value = "Add Order">
                        <!-- submits order quantity, product selection and customer selection to the NewOrder script using "post" metho-->
                </form>
                
            
            <hr>
               <!-- This section displays all prodcuts that haven't been ordered by customers-->   
               <!-- Fulfils bullet point #8, -->         
                <h2>These Products are Feeling Lonely without a home</h2>
                <b>Check out items that haven't been ordered:</b>
                  <?php include "UnorderedProducts.php"?>
                  <!-- calls upon UnorderedProducts.php script to find which products haven't been ordered before -->


            <hr>
                <!-- This section displays customers that have ordered more units than the user defined num-->
                <!-- Fulfills bullet points #7 -->
                <h2>How Many Products Have our Customers Bought?</h2>
                <form action= "CustomerQuantity.php" method = "post">
                    Base Number of Units:
                    <input required type= "text" name ="BaseNumber"><br>
                    <input type= "submit" value = "Search">             
                </form>

            <hr>
                <!-- This section displays Total # of purchases made of a user selected product-->
                <!-- Fulfills bullet #9 -->
                
                <h2>Product Revenue</h2>
                <form action="TotalPurchases.php" method = "post">
                    <?php include "GetProduct.php"?><br><br>
                        <!-- This line calls upon the script GetProduct.php to populate a drop down menu so users can select their desired product -->
                    <input type= "submit" value = "Submit">
                </form>           

            <hr>
            <!-- This form calls on addnewcustomer.php to allow user to add new customer-->
            <!-- Fulfills bullet point #4-->
                <h2>Add New Customer</h2>
                <form action="addnewcustomer.php" method="post">
                    <!-- This form requires the submission of  First, Last, City, Phone number and AgentID variables-->
                     First Name: <input required type="text" name="cusfname"><br>
                     Last Name: <input required type ="text" name="cuslname"><br>
                     Customer City: <input required type ="text" name="cuscity"><br>
                     Phone Number: <input required type ="text" name="PhoneNum1" maxlength="3"> - <input type ="text" name="PhoneNum2" maxlength="4"> <br>
                     <!-- Phone number broken into 2 parts because people will always mess up the (-), if they are given the chance. Max length for both boxes are chosen because people aren't smart-->
                     Agent ID: <?php include 'getagentdata.php'?><br>
                     <!-- calls on getagentdata.php to populate a drop down menu with possible agent names -->
                     <input type= "submit" value = "Submit Your Details">  
                </form> 
                
                
            <hr>
               <!-- This form allows users to delete a customer OR to modify their phone Number-->
                <h2>Delete/Modify Customer Info</h2>
                <form action="changecustomerinfo.php" method="post">
                   <!-- This form allows the user to choose if they want to delete or Modify a user --> 
                   <input required type ="radio" name ="ModificationChoice" value="delete">Delete Customer<br>
                   <input type ="radio" name ="ModificationChoice" value="Modify">Modify Phone Number<br>

                   <b>If Modifying Phone Number:</b><br></p>
                       <!-- Gives a text box for user to submit the new phone number--> 
                       New Phone Number: <input type ="text" name="PhoneNum1" maxlength="3"> - <input type ="text" name="PhoneNum2" maxlength="4"> </p><br>
                   <?php include 'GetCusNameNum.php'?>
                      <!-- Calls the GetCusNameNum.php script to populate a table with current Names + Numbers for user to choose from-->
                   <input type="submit" value= "Submit">
                </form>          
		<br><br><br>

        </div>
      </body>
    </html>



