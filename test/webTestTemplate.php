<?php

    /* Turn on error reporting */
    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    /* test driver */
    require_once(dirname(__FILE__) . '/../simpletest/autorun.php');

    /* web page test driver */
    require_once(dirname(__FILE__) . '/../simpletest/web_tester.php');

    class TestFrontPages extends WebTestCase{

        /* optional constructor to name the test */
		function __construct() {
			parent::__construct('Testing web pages');
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
			$this->get('http://url');
            $this->assertTitle('title1');
            $this->assertText('text');
            $this->click('link-text');
            $this->assertTitle('title2');
            $this->assertText('text');
            $this->back();
		}

	}

?>
