<?php 

    /* ---------------------------------------------------------------------------
    * filename    : join.php
    * author      : Spencer Huebler-Davis, shuebler@svsu.edu
    * description : This program joins a new agent (table: users)
    * ---------------------------------------------------------------------------
    */

    // include the class that handles database connections
    require '../database2.php';

	if ( !empty($_POST)) {
		// keep track validation errors
		$nameError = null;
		$codenameError = null;
        $passwordError = null;
		
		// keep track post values
		$name = $_POST['name'];
		$codename = $_POST['codename'];
        $password = $_POST['password'];
		
		// validate input
		$valid = true;
		if (empty($name)) {
			$nameError = 'Please enter Name';
			$valid = false;
		}
		
		$valid = true;
		if (empty($codename)) {
			$codenameError = 'Please enter Codename';
			$valid = false;
		}
                
        if (empty($password)) {
			$passwordError = 'Please enter Password';
			$valid = false;
		}
		
		// insert data
		if ($valid) {
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "INSERT INTO users (name,codename,password) values(?, ?, ?)";
			$q = $pdo->prepare($sql);
			$q->execute(array($name,$codename,$password));
			Database::disconnect();
			header("Location: login.php");
		}
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
		    			<h3>Join a New Agent</h3>
		    		</div>
    		
	    			<form class="form-horizontal" action="join.php" method="post">
					  <div class="control-group <?php echo !empty($nameError)?'error':'';?>">
					    <label class="control-label">Name</label>
					    <div class="controls">
					      	<input name="name" type="text"  placeholder="Name" value="<?php echo !empty($name)?$name:'';?>">
					      	<?php if (!empty($nameError)): ?>
					      		<span class="help-inline"><?php echo $nameError;?></span>
					      	<?php endif; ?>
					    </div>
					  </div>
					  <div class="control-group <?php echo !empty($codenameError)?'error':'';?>">
					    <label class="control-label">Codename</label>
					    <div class="controls">
					      	<input name="codename" type="text"  placeholder="Codename" value="<?php echo !empty($codename)?$codename:'';?>">
					      	<?php if (!empty($codenameError)): ?>
					      		<span class="help-inline"><?php echo $codenameError;?></span>
					      	<?php endif; ?>
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
                      <form action="login.php">
                            <input type="submit" class="btn btn-success" value="Join"/>
                      </form>
						  <a class="btn" href="login.php">Back</a>
						</div>
					</form>
				</div>
				
    </div> <!-- /container -->
  </body>
</html>