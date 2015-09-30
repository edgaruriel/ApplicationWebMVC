<?php
class ClientTest extends PHPUnit_Framework_TestCase{

	public function testOne(){
		$x = 1;
		$this->assertTrue($x==1,"Test fail");
	}
	
	public function testTwo(){
		$x = 1;
		$this->assertTrue($x==2,"Test fail");
	}
}