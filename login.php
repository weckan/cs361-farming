<?php

    error_reporting(0); #(E_ALL);
    ini_set('display_errors', 'Off');

    #
    # Common error print function of failing parameter and error number.
    # Print an error button.
    #

    function myPrintError ($parm,$errno) {
        echo '<div class="alert alert-danger alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
              <h4>Error!</h4>
              <p>Sorry there was a server problem. Try again later. ('.$parm.'-'.$errno.')</p></div>';
    	die();
    }

    #
    # Connect to database.
    #

    require 'storedInfo.php';
    # $mysqli = new mysqli("oniddb.cws.oregonstate.edu","ratlifri-db",$myPassword,"ratlifri-db");
    $mysqli = new mysqli("oniddb.cws.oregonstate.edu","petleya-db",$myPassword,"petleya-db");
    if ($mysqli->connect_errno) {
        # echo "MySQL connection failed: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
        myPrintError('L1-connection',$mysqli->connect_errno);
    }

    $usr = htmlspecialchars($_POST["usr"]);
    $psw = htmlspecialchars($_POST["psw"]);
    $usr = strtolower($usr);
    $psw = strtolower($psw);

    #
    # Check if posted username exists in database, i.e. signup was completed.
    # There should only be one record if signup error checking worked.
    # But we will check for that again here.
    #

    # $sql = "SELECT `username` FROM `accounts` WHERE `username` = ?";
    $sql = "SELECT DISTINCT `username` FROM `zuser` WHERE `username` = ?";

    if(!($stmt = $mysqli->prepare($sql))) {
        # echo "Prepare failed: (" . $mysqli->errno. ") " . $mysqli->error;
        myPrintError('L1-prepare',$mysqli->errno);
    }

    $stmt->bind_param('s', $usr);

    if (!$stmt->execute()) {
        # echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
        myPrintError('L1-execute',$stmt->errno);
    }

    $outName = NULL;
    if (!$stmt->bind_result($outName)) {
        # echo "Binding output parameters failed: (" . $stmt->errno . ") " . $stmt->error;
        myPrintError('L1-bindres',$stmt->errno);
	}

    $cnt = 0;
    while ( $stmt->fetch() ) {
		$cnt++;
    }

    #
    # Error checking for unique username result. Print appropriate error button.
    #

    if ( $cnt < 1 ) {
        echo '<div class="alert alert-danger alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
              <h4>Error!</h4>
              <p>Username "' . $usr . '" was not found. Please try again.</p></div>';
		die();
    } else if ( $cnt > 1 ) {
        echo '<div class="alert alert-danger alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
              <h4>Database Error!</h4>
              <p>Username "' . $usr . '" found multiple times. Please try again.</p></div>';
		die();
	}

    #
    # Now check for username and password combination is correct.
    #

    # $sql = "SELECT * FROM `accounts` WHERE `username` = ? AND `password` = ?";
    $sql = "SELECT * FROM `zuser` WHERE `username` = ? AND `password` = ?";

    if(!($stmt = $mysqli->prepare($sql))) {
        # echo "Prepare failed: (" . $mysqli->errno. ") " . $mysqli->error;
        myPrintError('L2-prepare',$mysqli->errno);
    }

    $stmt->bind_param('ss', $usr, $psw);

    if (!$stmt->execute()) {
        # echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
        myPrintError('L2-execute',$stmt->errno);
    }
/*
    $outName = NULL;
    if (!$stmt->bind_result($outName)) {
        # echo "Binding output parameters failed: (" . $stmt->errno . ") " . $stmt->error;
        myPrintError('L2-bindres',$stmt->errno);
	}
*/
    $cnt = 0;
    while ( $stmt->fetch() ) {
		$cnt++;
    }

    #
    # Error checking for username and password combination. Print appropriate error button.
    #

    if ( $cnt < 1 ) {
        echo '<div class="alert alert-danger alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
              <h4>Error!</h4>
              <p> "Username/password combination incorrect. Please try again.</p></div>';
		die();
    } else if ( $cnt > 1 ) {
        echo '<div class="alert alert-danger alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
              <h4>Database Error!</h4>
              <p>Multiple username/password combinations found. Please try again.</p></div>';
		die();
	}

    #
    # Login is valid - start a new session.
    #

    session_start();
    setcookie('PHPSESSID', '0', time()-3600);
    $_SESSION = array();
    session_destroy();
    session_start();
    session_regenerate_id(true);

    if ( session_status() == PHP_SESSION_ACTIVE ) {
        $_SESSION['usr'] = $usr;
        $_SESSION['valid'] = 1;
        $_SESSION['visits'] = 1;
	} else {
        $_SESSION['usr'] = "";
        $_SESSION['valid'] = "";
        $_SESSION['visits'] = "";
        echo "<h4 style='color:red'>";
        echo "You do not have a valid session.";
        echo "</h4>";
        exit;
	}

    #
    # Success, if made it here, so print a success button.
    #

    echo '<div class="alert alert-success alert-dismissible" role="alert">
          <h4>Success!</h4>
          <p>You have successfully logged in.</p>
          <p>
          <button type="button" class="btn btn-success" onclick=loadSite()>Enter site</button>
          </p>
          </div>';

?>
