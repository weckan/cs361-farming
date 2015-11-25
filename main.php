<?php
    session_start();
    if ( session_status() == PHP_SESSION_ACTIVE ) {
		if ( !isset($_SESSION['valid']) ) {
            header('Content-Type: text/html');
			echo '<!DOCTYPE html>
			      <html lang="en">
					<head>
					  <link href="css/bootstrap.min.css" rel="stylesheet">
					</head>
					<body>
					  <div class="alert alert-danger alert-dismissible" role="alert">
					  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					  <span aria-hidden="true">&times;</span></button>
					  <h1>Error!</h1>
					  <h3>You do not have a valid session.</h3>
					  <p><button type="button" class="btn btn-danger btn-lg" onclick=loadHome()>Click here to go to main site</button>
                      </p></div>
					  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
					  <script src="js/bootstrap.min.js"></script>
					  <script src="interaction.js"></script>
					</body>
			      </html>
                 ';
            die();
		}
	}

    header('Content-Type: text/html');
    include('protectedSite.html');
?>
