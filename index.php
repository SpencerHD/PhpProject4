<?php

/* ---------------------------------------------------------------------------
* filename    : index.php
* author      : Spencer Huebler-Davis, shuebler@svsu.edu
* description : This program displays the list for the
*               database (table: users)
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
                    <p>
                        <img src="Pletona.png" alt="Logo" style="width:360px;height:150px;">
                    </p>
    			<h3>All Active Agents</h3></h3>
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
		                  <th>Codename</th>
		                  <th>Assignment</th>
		                  <th>Location</th>
		                  <th>Action</th>
		                </tr>
		              </thead>
		              <tbody>
		              <?php
                                            require '../database2.php';
                                            $pdo = Database::connect();
                                            $sql = 'SELECT * FROM users ORDER BY id DESC';
                                            if(is_array($pdo->query($sql)) || is_object($pdo->query($sql))){
                                                foreach ($pdo->query($sql) as $row) {
                                                                     echo '<tr>';
                                                                     echo '<td>'. $row['name'] . '</td>';
                                                                     echo '<td>'. $row['codename'] . '</td>';
                                                                     echo '<td>'. $row['assignment'] . '</td>';
                                                                     echo '<td>'. $row['location'] . '</td>';
                                                                     echo '<td width=300>';
                                                                     echo '<a class="btn" href="display.php?id='.$row['id'].'">Display</a>';
                                                                     echo '&nbsp;';
                                                                     echo '<a class="btn btn-success" href="assign.php?id='.$row['id'].'">Assign</a>';
                                                                     echo '&nbsp;';                     
                                                                     echo '<a class="btn btn-danger" href="delete.php?id='.$row['id'].'">Delete</a>';
                                                                     echo '&nbsp;';
                                                                     echo '<a class="btn" href="change.php?id='.$row['id'].'">Change Codename</a>';
                                                                     echo '&nbsp;';
                                                                     echo '<a class="btn" href="password.php?id='.$row['id'].'">Change Password</a>';
                                                                     echo '</td>';
                                                                     echo '</tr>';
                                                }
                                            }
                                            Database::disconnect();
                                            ?>
				      </tbody>
	            </table>
        
    	</div>
    <!-- links to diagrams -->
    <a href='agent_flowchart.png' target='_blank'>Screen Flow Chart</a><br />
    </div> <!-- /container -->
  </body>
</html>