<?php 

    /* ---------------------------------------------------------------------------
    * filename    : display.php
    * author      : Spencer Huebler-Davis, shuebler@svsu.edu
    * description : This program reads an agent's entry (table: user)
    * ---------------------------------------------------------------------------
    */

    session_start();
    if (!$_SESSION) {
    header("Location: login.php");
    }

    // include the class that handles database connections
    require '../database2.php';
    
	$id = null;
	if ( !empty($_GET['id'])) {
		$id = $_REQUEST['id'];
	}
	
	if ( null==$id ) {
		header("Location: index.php");
	} else {
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM users where id = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($id));
		$data = $q->fetch(PDO::FETCH_ASSOC);
		Database::disconnect();
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
    
    			<div class="span10 offset1">
    			    <p>
                        <img src="Pletona.png" alt="Logo" style="width:360px;height:150px;">
                    </p>
    				<div class="row">
		    			<h3>Displaying Agent</h3>
		    		</div>
		    		
	    			<div class="form-horizontal" >
					  <div class="control-group">
					    <label class="control-label">Name</label>
					    <div class="controls">
						    <label class="checkbox">
						     	<?php echo $data['name'];?>
						    </label>
					    </div>
					  </div>
					  <div class="control-group">
					    <label class="control-label">Codename</label>
					    <div class="controls">
						    <label class="checkbox">
						     	<?php echo $data['codename'];?>
						    </label>
					    </div>
					  </div>
					  <div class="control-group">
					    <label class="control-label">Assignment</label>
					    <div class="controls">
					      	<label class="checkbox">
						     	<?php echo $data['assignment'];?>
						    </label>
					    </div>
					  </div>
					  <div class="control-group">
					    <label class="control-label">Location</label>
					    <div class="controls">
					      	<label class="checkbox">
						     	<?php echo $data['location'];?>
						    </label>
					    </div>
					  </div>
                                          <div class="control-group">
					    <label class="control-label">Password</label>
					    <div class="controls">
					      	<label class="checkbox">
						     	<?php echo $data['password'];?>
						    </label>
					    </div>
					  </div>
					    <div class="form-actions">
						  <a class="btn" href="index.php">Back</a>
					   </div>
					
					 
					</div>
				</div>
				
    </div> <!-- /container -->
  </body>
</html>