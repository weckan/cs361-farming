<?php

    /* Turn on error reporting */
    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    /* test driver */
    require_once(dirname(__FILE__) . '/simpletest/autorun.php');

    /* web page test driver */
    require_once(dirname(__FILE__) . '/simpletest/web_tester.php');
    require_once(dirname(__FILE__) . '/simpletest/reporter.php');

    class TestLocal extends WebTestCase{

        /* optional constructor to name the test */
		function __construct() {
			//parent::__construct('Testing ...');
		}

        /* optional test setup */
		function setUp() {
			//set precondition
			$this->get('http://web.engr.oregonstate.edu/~ratlifri/farming/local.php');
			/* $this->showRequest(); */
			/* $this->showHeaders(); */
			/* $this->showSource(); */
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
			$this->assertResponse(200);
			$this->assertNoText('<table>');
			$this->assertText('Local Instructions');
			$this->assertText('Plant Name');
			$this->assertText('Water Amount');
			$this->assertText('Sun Level');
			$this->assertText('Sun Duration');
			$this->assertText('Sun xDay');
			$this->assertText('Sun xWeek');
			$this->assertText('Food Type');
			$this->assertText('Food Amount');
			$this->assertText('Food xWeek');
			$this->assertText('Food xMonth');
			$this->assertText('Groom Type');
			$this->assertText('Groom Detail');
			$this->assertText('Groom xMonth');
			$this->assertText('Organic Name');
			$this->assertText('Organic Amount');
			$this->assertText('Organic xWeek');
			$this->assertText('Organic xMonth');
			$this->assertText('Pesticide Type');
			$this->assertText('Pesticide Amount');
			$this->assertText('Pesticide xMonth');
		}

	}

$test = new TestLocal();
$test->run(new HtmlReporter());

?>
