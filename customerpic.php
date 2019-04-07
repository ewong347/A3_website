<!DOCTYPE HTML>
	<html>
		<head>
		    <meta charset='utf-8'>
		    <title>Boring Company</title>
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
	            	<!-- header title + spacing-->
				<?php include 'connectdb.php'?>				 
				<h1>Picture Submitted</h1>
					<!-- Positive feedback for the monkey (user) using the website-->
				
				<?php
					//Next two lines get the submitted url for the customer picture "$_POST" and CustomerID from the selection form 
					$url=$_POST["url"];
					$CustomerID= $_POST["CustomerID"];

					$query = "UPDATE customer SET custpic='" . $url . "' WHERE CustomerID=" . $CustomerID;
				 		//creates a query string with url + CustomerID variables inserted
					$result = mysqli_query($connection,$query);
						//sends in the query
				?>

		        <form action= "index2.php">
			        <!-- This takes us back to the homepage-->
			        <hr>
			        <h3>Click "Home" to go back to the main menu</h3><br>
			        <input type="submit" value= "Home">
		        </form>

			</div>

            <?php 
            	//House keeping functions:            
	            	mysqli_close($connection);
	            		//disconnects from db
	                    //free memory
            ?> 
		</body>
	</html>
