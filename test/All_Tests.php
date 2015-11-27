<?php

    /* Turn on error reporting */
    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    require_once('showPasses.php');
    require_once('../simpletest/simpletest.php');
    SimpleTest::prefer(new ShowPasses());
    require_once(dirname(__FILE__) . '/../simpletest/autorun.php');

    class AllTests extends TestSuite {

		function __construct() {
			parent::__construct('All Tests');

			$this->addFile('testDemo.php');
			$this->addFile('testFrontPages.php');
		}

	}

?>
