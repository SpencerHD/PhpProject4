<?php

    /* ---------------------------------------------------------------------------
    * filename    : assign.php
    * author      : Spencer Huebler-Davis, shuebler@svsu.edu
    * description : This program updates an agent entry (table: users)
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
	}
	
	if ( !empty($_POST)) {
		// keep track validation errors
		$passwordError = null;
		
		// keep track post values
		$password = $_POST['password'];
		
		// validate input
		$valid = true;
		if (empty($password)) {
			$nameError = 'Please enter new Password';
			$valid = false;
		}
		
		// update data
		if ($valid) {
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "UPDATE users set password = ? WHERE id = ?";
			$q = $pdo->prepare($sql);
			$q->execute(array($password,$id));
			Database::disconnect();
			header("Location: index.php");
		}
	} else {
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM users where id = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($id));
		$data = $q->fetch(PDO::FETCH_ASSOC);
		$password = $data['password'];
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
		    			<h3>Change Password</h3>
		    		</div>
    		
	    			<form class="form-horizontal" action="password.php?id=<?php echo $id?>" method="post">
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
					  <div class="control-group <?php echo !empty($passwordError)?'error':'';?>">
					    <label class="control-label">Password</label>
					    <div class="controls">
					      	<input name="password" type="text"  placeholder="Password" value="<?php echo !empty($password)?$password:'';?>">
					      	<?php if (!empty($passwordError)): ?>
					      		<span class="help-inline"><?php echo $passwordError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>
					  <div class="form-actions">
						  <button type="submit" class="btn btn-success">Change</button>
						  <a class="btn" href="index.php">Back</a>
						</div>
					</form>
				</div>
				
    </div> <!-- /container -->
  </body>
</html>