<?php

    session_start();
	echo '<br>';
    printf("print r SESSION<br>");
	print_r($_SESSION);
	echo '<br>';
    printf("print r COOKIE phpsessid<br>");
    print_r($_COOKIE["PHPSESSID"]);
	echo '<br>';
    printf("var dump COOKIE phpsessid<br>");
	var_dump($_COOKIE["PHPSESSID"]);
	echo '<br>';
    printf("printf COOKIE phpsessid<br>");
	printf("PHPSESSID cookie value = %s\n",$_COOKIE["PHPSESSID"]);
	echo '<br>';
    printf("echo COOKIE phpsessid<br>");
	echo $_COOKIE["PHPSESSID"];
	echo '<br>';
    printf("echo HTTP_COOKIE_VARS phpsessid<br>");
	echo $HTTP_COOKIE_VARS["PHPSESSID"];
	echo '<br>';
    printf("print r COOKIE phpsessid<br>");
	print_r($_COOKIE);
	echo '<br>';

    phpinfo();

?>
