<?php

    /* Turn on error reporting */
    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    require_once('showPasses.php');
    require_once('../simpletest/simpletest.php');
    SimpleTest::prefer(new ShowPasses());
    require_once(dirname(__FILE__) . '/../simpletest/autorun.php');

    class AllTestsShowPasses extends TestSuite {

		function __construct() {
			$this->addFile('testFrontPages.php');
			$this->addFile('testLocal.php');
			$this->addFile('testDispense.php');
			$this->addFile('testLighting.php');
			$this->addFile('testNotify.php');
		}

	}

?>
