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
    $mysqli = new mysqli("oniddb.cws.oregonstate.edu","ratlifri-db",$myPassword,"ratlifri-db");
    if ($mysqli->connect_errno) {
        # echo "MySQL connection failed: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
        myPrintError('lpl-connection',$mysqli->connect_errno);
    }

    $usr = htmlspecialchars($_POST["usr"]);
    $usr = strtolower($usr);

    $sql = "SELECT * FROM `plantlist` WHERE `username` = ?";

    if(!($stmt = $mysqli->prepare($sql))) {
        # echo "Prepare failed: (" . $mysqli->errno. ") " . $mysqli->error;
        myPrintError('lpl-prepare',$mysqli->errno);
    }

    $stmt->bind_param('s', $usr);

    if (!$stmt->execute()) {
        # echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
        myPrintError('lpl-execute',$stmt->errno);
    }

    $id = NULL;
    $user = NULL;
    $container = NULL;
    $plant = NULL;
    if (!$stmt->bind_result($id,$user,$container,$plant)) {
        # echo "Binding output parameters failed: (" . $stmt->errno . ") " . $stmt->error;
        myPrintError('lpl-bindres',$stmt->errno);
	}

    echo '            <thead>';
    echo '              <tr>';
    echo '                <th>#</th>';
    echo '                <th>Username</th>';
    echo '                <th>Container</th>';
    echo '                <th>Plant</th>';
    echo '              </tr>';
    echo '            </thead>';
    echo '            <tbody id=addRows>';
    while ( $stmt->fetch() ) {
        echo '              <tr>';
		printf("                <td>%s</td>\n",$id);
		printf("                <td>%s</td>\n",$user);
		printf("                <td>%s</td>\n",$container);
		printf("                <td>%s</td>\n",$plant);
        echo '              </tr>';
    }
    echo '            </tbody>';
    echo '            <p><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Add</button></p>';

?>
