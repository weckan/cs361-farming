<?php

    error_reporting(0); #(E_ALL);
    ini_set('display_errors', 'Off');

    function myPrintError ($parm,$errno) {
        echo '<div class="alert alert-danger alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
              <h4>Error!</h4>
              <p>Sorry there was a server problem. Try again later. ('.$parm.'-'.$errno.')</p></div>';
    	die();
    }

    require 'storedInfo.php';
    # $mysqli = new mysqli("oniddb.cws.oregonstate.edu","ratlifri-db",$myPassword,"ratlifri-db");
    $mysqli = new mysqli("oniddb.cws.oregonstate.edu","petleya-db",$myPassword,"petleya-db");
    if ($mysqli->connect_errno) {
        # echo "MySQL connection failed: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
        myPrintError('s1-connection',$mysqli->connect_errno);
    }

    $usr = htmlspecialchars($_POST["usr"]);
    $psw = htmlspecialchars($_POST["psw"]);
    $usr = strtolower($usr);
    $psw = strtolower($psw);

    # $sql = "SELECT DISTINCT `username` FROM `accounts` WHERE `username` = ?";
    $sql = "SELECT DISTINCT `username` FROM `zuser` WHERE `username` = ?";

    if(!($stmt = $mysqli->prepare($sql))) {
        # echo "Prepare failed: (" . $mysqli->errno. ") " . $mysqli->error;
        myPrintError('s1-prepare',$mysqli->errno);
    }

    $stmt->bind_param('s', $usr);

    if (!$stmt->execute()) {
        # echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
        myPrintError('s1-execute',$stmt->errno);
    }

    $outName = NULL;
    if (!$stmt->bind_result($outName)) {
        # echo "Binding output parameters failed: (" . $stmt->errno . ") " . $stmt->error;
        myPrintError('s1-bindres',$stmt->errno);
	}

    $cnt = 0;
    while ( $stmt->fetch() ) {
		$cnt++;
    }

    if ( $cnt > 0 ) {
        echo '<div class="alert alert-danger alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
              <h4>Error!</h4>
              <p>Username "' . $outName . '" is already in use. Please try again.</p></div>';
		die();
    }

    # $sql = "INSERT INTO `ratlifri-db`.`accounts` (`id`, `username`, `password`) 
    $sql = "INSERT INTO `petleya-db`.`zuser` (`uid`, `username`, `password`) 
            VALUES (NULL, '$usr', '$psw');";

    if(!($stmt = $mysqli->prepare($sql))) {
        # echo "Prepare failed: (" . $mysqli->errno. ") " . $mysqli->error;
        myPrintError('s2-prepare',$mysqli->errno);
    }

    if (!$stmt->execute()) {
        # echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
        myPrintError('s2-execute',$stmt->errno);
    }

    echo '<div class="alert alert-success alert-dismissible" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
          <h4>Success!</h4>
          <p>You have successfully signed up. Now login to start a session and to enter the site.</p>
          <p>
          <button type="button" class="btn btn-success" onclick=loadLogin()>Go to Login</button>
          </p>
          </div>';

?>
