<?php

/* ---------------------------------------------------------------------------
* filename    : index.php
* author      : Spencer Huebler-Davis, shuebler@svsu.edu
* description : This program displays the list for the
*               database (table: customer)
* ---------------------------------------------------------------------------
*/

session_start();
if (!$_SESSION) {
header("Location: login.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">
    		<div class="row">
                    <p>
			<a href="https://github.com/SpencerHD/PhpProject4">Github Repo</a>
                    </p>
    			<h3>Customers</h3></h3>
    		</div>
			<div class="row">
				<p>
					<a href="create.php" class="btn btn-success">Create</a>
					<a style="background: gray;" href="logout.php" class="btn btn-success">Logout</a>
				</p>
				
				<table class="table table-striped table-bordered">
		              <thead>
		                <tr>
		                  <th>Name</th>
		                  <th>Email Address</th>
		                  <th>Mobile Number</th>
		                  <th>Action</th>
		                </tr>
		              </thead>
		              <tbody>
		              <?php
                                            require '../database.php';
                                            $pdo = Database::connect();
                                            $sql = 'SELECT * FROM customer ORDER BY id DESC';
                                            foreach ($pdo->query($sql) as $row) {
                                                                 echo '<tr>';
                                                                 echo '<td>'. $row['name'] . '</td>';
                                                                 echo '<td>'. $row['email'] . '</td>';
                                                                 echo '<td>'. $row['mobile'] . '</td>';
                                                                 echo '<td width=250>';
                                                                 echo '<a class="btn" href="read.php?id='.$row['id'].'">Read</a>';
                                                                 echo '&nbsp;';
                                                                 echo '<a class="btn btn-success" href="update.php?id='.$row['id'].'">Update</a>';
                                                                 echo '&nbsp;';
                                                                 echo '<a class="btn btn-danger" href="delete.php?id='.$row['id'].'">Delete</a>';
                                                                 echo '</td>';
                                                                 echo '</tr>';
                                            }
                                            Database::disconnect();
                                            ?>
				      </tbody>
	            </table>
        
    	</div>
    <!-- links to diagrams -->
    <a href='../CustomerUML.png' target='_blank'>UML Diagram</a><br />
    <a href='../screenflowdiagram.png' target='_blank'>Screen Flow Chart</a><br />
    </div> <!-- /container -->
  </body>
</html>