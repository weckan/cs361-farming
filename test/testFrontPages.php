<?php

    /* Turn on error reporting */
    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    /* test driver */
    require_once(dirname(__FILE__) . '/../simpletest/autorun.php');

    /* web page test driver */
    require_once(dirname(__FILE__) . '/../simpletest/web_tester.php');

    /* file under test */
    //require_once(dirname(__FILE__) . '/../file.php');

    class TestFrontPages extends WebTestCase{

        /* optional constructor to name the test */
		function __construct() {
			parent::__construct('Test Front Pages');
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
			$this->get('http://web.engr.oregonstate.edu/~ratlifri/farming/index.html');
            $this->assertTitle('Home Farming');
            $this->assertText('Home Farming Management');
            $this->click('View details...');
            $this->assertTitle('Home Farming');
            $this->assertText('About');
            $this->assertText('Software for home farming');
            $this->back();
            $this->click('Create account...');
            $this->assertTitle('Home Farming');
            $this->assertText('Signup');
            $this->assertText('For new users - choose/setup your username and password');
            $this->back();
            $this->click('See your farm...');
            $this->assertTitle('Home Farming');
            $this->assertText('Login');
            $this->assertText('Existing users - start a new session');
            $this->back();
            $this->click('CS 361 Fall 2015');
            $this->assertTitle('CS 361: Software Engineering I, Fall 2015');
            $this->assertText('CS 361: Software Engineering I, Fall 2015');
            $this->back();
		}

	}

?>
