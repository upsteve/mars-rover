<?php

namespace MarsRover;

//include "index.php";
use PHPUnit\Framework\TestCase;

class tests extends TestCase
{
    //$this->expectException(InvalidArgumentException::class);
    function testRoverInitialised()
    {
        $longitude = 0;
        $latitude = 0;
        $direction = 'N';
        $rover = new Rover3($longitude, $latitude, $direction);
        $this->assertNotNull($rover);
    }

    function testRoverInitialisedWithPosition()
    {
        $latitude = 5;
        $longitude = 10;
        $rover = new Rover3($latitude, $longitude, 'N');
        $position = new Position(5, 10);
        $this->assertEquals($position, $rover->getPosition());
    }

    function testRoverInitialisedWithDirection()
    {
        $direction = 'N';
        $rover = new Rover3(0, 0, $direction);
        $this->assertEquals('N', $rover->getDirection());
    }

    function testRoverInitialisedWithInvalidDirection()
    {
        $direction = 'R';
        $this->expectException('InvalidArgumentException');
        $rover = new Rover3(0, 0, $direction);
    }

    function testSingleForwardCommandHeadingNorthFromEquator()
    {
        $rover = new Rover3(0, 0, 'N');
        $rover->processCommandCodes('F');
        $position = new Position(1, 0);
        $this->assertEquals($position, $rover->getPosition());
    }

    function testSingleForwardCommandHeadingNorthFromNorthPole()
    {
        $rover = new Rover3(90, 0, 'N');
        $rover->processCommandCodes('F');
        $this->assertEquals(new Position(89, 180), $rover->getPosition());
    }

    function testTwoForwardCommandsHeadingNorthFromNorthPole()
    {
        $rover = new Rover3(88, 0, 'N');
        $rover->processCommandCodes('F');
        $this->assertEquals(new Position(89, 0), $rover->getPosition());
        $rover->processCommandCodes('F');
        $this->assertEquals(new Position(90, 0), $rover->getPosition());
        $rover->processCommandCodes('F');
        $this->assertEquals(new Position(89, 180), $rover->getPosition());
        $rover->processCommandCodes('F');
        $this->assertEquals(new Position(88, 180), $rover->getPosition());
    }

    function testTwoForwardCommandsHeadingSouthFromSouthPole()
    {
        $rover = new Rover3(-88, 0, 'S');
        $rover->processCommandCodes('F');
        $this->assertEquals(new Position(-89, 0), $rover->getPosition());
        $rover->processCommandCodes('F');
        $this->assertEquals(new Position(-90, 0), $rover->getPosition());
        $rover->processCommandCodes('F');
        $this->assertEquals(new Position(-89, 180), $rover->getPosition());
        $rover->processCommandCodes('F');
        $this->assertEquals(new Position(-88, 180), $rover->getPosition());
    }

    function testSingleForwardCommandHeadingNorthFromSouthPole()
    {
        $rover = new Rover3(-90, 0, 'N');
        $rover->processCommandCodes('F');
        $position = new Position(-89, 0);
        $this->assertEquals($position, $rover->getPosition());
    }

    function testSingleForwardCommandHeadingSouthFromEquator()
    {
        $rover = new Rover3(0, 0, 'S');
        $rover->processCommandCodes('F');
        $position = new Position(-1, 0);
        $this->assertEquals($position, $rover->getPosition());
    }

    function testSingleForwardCommandHeadingSouthFromNorthPole()
    {
        $rover = new Rover3(90, 0, 'S');
        $rover->processCommandCodes('F');
        $position = new Position(89, 0);
        $this->assertEquals($position, $rover->getPosition());
    }

    function testSingleForwardCommandHeadingSouthFromSouthPole()
    {
        $rover = new Rover3(-90, 0, 'S');
        $rover->processCommandCodes('F');
        $this->assertEquals(new Position(-89, 180), $rover->getPosition());
    }

    function testSingleBackwardCommandHeadingSouthFromSouthPole()
    {
        $rover = new Rover3(-90, 0, 'S');
        $rover->processCommandCodes('B');
        $position = new Position(-89, 0);
        $this->assertEquals($position, $rover->getPosition());
    }

    function testTwoForwardCommandsHeadingNorthFromNorthPole2()
    {
        $rover = new Rover3(90, 0, 'N');
        $rover->processCommandCodes('F');
        $rover->processCommandCodes('F');
        $position = new Position(88, 180);
        $this->assertEquals($position, $rover->getPosition());
    }

    function testTurnLeft()
    {
        $rover = new Rover3(90, 0, 'N');
        $rover->processCommandCodes('L');
        $this->assertEquals('W', $rover->getDirection());
    }

    function testTurnRight()
    {
        $rover = new Rover3(90, 0, 'N');
        $rover->processCommandCodes('R');
        $this->assertEquals('E', $rover->getDirection());
    }

    function testTurn360Clockwise()
    {
        $rover = new Rover3(90, 0, 'N');
        $rover->processCommandCodes('R');
        $this->assertEquals('E', $rover->getDirection());
        $rover->processCommandCodes('R');
        $this->assertEquals('S', $rover->getDirection());
        $rover->processCommandCodes('R');
        $this->assertEquals('W', $rover->getDirection());
        $rover->processCommandCodes('R');
        $this->assertEquals('N', $rover->getDirection());
    }

    function testTurn360AntiClockwise()
    {
        $rover = new Rover3(90, 0, 'N');
        $rover->processCommandCodes('L');
        $this->assertEquals('W', $rover->getDirection());
        $rover->processCommandCodes('L');
        $this->assertEquals('S', $rover->getDirection());
        $rover->processCommandCodes('L');
        $this->assertEquals('E', $rover->getDirection());
        $rover->processCommandCodes('L');
        $this->assertEquals('N', $rover->getDirection());
    }

    function testFromNullIslandGoForwardEast()
    {
        $rover = new Rover3(0, 0, 'E');
        $rover->processCommandCodes('F');
        $this->assertEquals(new Position(0, 1), $rover->getPosition());
    }

    function testFromNullIslandGoForwardWest()
    {
        $rover = new Rover3(0, 0, 'W');
        $rover->processCommandCodes('F');
        $this->assertEquals(new Position(0, -1), $rover->getPosition());
    }

    function testCommandInvoker()
    {
        $rover = new Rover3(0, 0, 'W');
        $rover->processCommandCodes("FFFF");
        $this->assertEquals(new Position(0, -4), $rover->getPosition());
    }

    function testCommandInvoker2()
    {
        $rover = new Rover3(89, 0, 'N');
        $rover->processCommandCodes("FFLLFFLL");
        $this->assertEquals(new Position(89, 0), $rover->getPosition());
    }

    function testGlobeWithCraterAtNullIsland()
    {
        $craters = [[0, 0], [0, 1]];
        $globe = new Globe($craters);
        $this->assertTrue($globe->isCrater(new Position(0, 0)));
    }

    function testGlobeWithCraterAtSomePosition()
    {
        $craters = [[0, 0], [83, 179]];
        $globe = new Globe($craters);
        $this->assertTrue($globe->isCrater(new Position(83, 179)));
    }

    function testGlobeWithCraterNotAtPosition()
    {
        $craters = [[0, 0], [83, 179]];
        $globe = new Globe($craters);
        $this->assertFalse($globe->isCrater(new Position(67, -52)));
    }

    function testRoverMovingForwardNoCraterInWay()
    {
        $craters = [[10, 0]];
        $globe = new Globe($craters);
        $rover = new Rover3(-1, 0, 'N', $globe);
        $result = $rover->processCommandCodes('FFF');
        $this->assertTrue($result);
        $this->assertEquals(new Position(2, 0), $rover->getPosition());
    }

    // TODO disabled no collision detection for Rover3
    function NOtestRoverMovingIntoCrater()
    {
        $craters = [[1, 0]];
        $globe = new Globe($craters);
        $rover = new Rover3(-1, 0, 'N', $globe);
        $result = $rover->processCommandCodes('FFF');
        $this->assertFalse($result);
        $this->assertEquals(new Position(0, 0), $rover->getPosition());
        $this->assertEquals(new Position(1, 0), $rover->getLastObstacle());
    }

    function testRoverMovingPastCrater()
    {
        $craters = [[1, 0]];
        $globe = new Globe($craters);
        $rover = new Rover3(-1, 0, 'N', $globe);
        $result = $rover->processCommandCodes('FRFLFFLFR');
        $this->assertTrue($result);
        $this->assertEquals(new Position(2, 0), $rover->getPosition());
        $this->assertEquals('N', $rover->getDirection());
    }

    function testRover3()
    {
        //$rover = new Rover3(new NorthFacing(new Position(0,0)));
        $rover = new Rover3(0, 0, 'N');
        $rover->processCommandCodes("F");
        $this->assertEquals(new Position(1, 0), $rover->getPosition());
    }

}
