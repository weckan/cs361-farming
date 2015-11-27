<?php

    /* Turn on error reporting */
    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    /* test driver */
    require_once(dirname(__FILE__) . '/../simpletest/autorun.php');

    /* file under test */
    // require_once(dirname(__FILE__) . '/../file.php');

    class TestLogin extends UnitTestCase{

        /* optional constructor to name the test */
		function __construct() {
			parent::__construct('Testing file.php');
		}

        /* optional test setup */
		function setUp() {
			//set precondition
		}

        /* optional test clean up */
		function tearDown() {
			//delete temp file
		}

        /* optional helper method - name must NOT start with test */
		function getSomething() {
			//things for tests
		}

        /* one or more test functions - name must start with test */
		function testSomething() {
			//set up any needed variables
            // $good = 'value';
            // $bad = 'value2';

			//make assertions
			// $this->assertTrue(func_in_thing.php($good));
			// $this->assertFalse(func_in_thing.php($bad));

			//make more assertions - hardcoded here to demo reporting
			$this->assertTrue(1);
			$this->assertFalse(0);

		}

	}

?>
