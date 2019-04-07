<!DOCTYPE html>
  <html>
    <head>
      <title>Boring Company- Our Products</title>
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

          <?php include 'connectdb.php';?>
           <!--This makes sure we open a connection to the db-->

          <!-- Header + page title -->       
          <br> <h1>The Boring Company</h1> <br>  
          <h1>Here are our Products</h1>

          
          <ol>
            <!-- this is a list-->

            <?php 
              //This bit of code creates a list of all products sold by the company, ordered based on a user selected category  

              $WhichOrder = $_POST["ProductOrder"];
                  // imports Group by Order from previous page
              $query = 'SELECT * FROM product ORDER BY '.$WhichOrder.'';
              $result = mysqli_query($connection,$query);
                  //creates query based on which option the user choose  

              while ($row= mysqli_fetch_assoc($result)) {
                echo $row["Description"] . " for $" . $row["ItemCost"] . "<br>";
              }
              mysqli_free_result($result);
            ?>

          </ol>

          <?php mysqli_close($connection);?>

          <form action= "index2.php">
            <!-- This takes us back to the homepage-->
            <hr><h3>Click me to go back to the main menu</h3><br>
            <input type="submit" value= "Home">
          </form>
          
        </div>
    </body>
</html>


