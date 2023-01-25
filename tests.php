<?php

namespace MarsRover;

//include "index.php";

use MarsRover\Geo\Position;
use PHPUnit\Framework\TestCase;

class tests extends TestCase
{
    //$this->expectException(InvalidArgumentException::class);
    function testRoverInitialised()
    {
        $longitude = 0;
        $latitude = 0;
        $direction = 'N';
        $rover = RoverFactory::createRover($longitude, $latitude, $direction);
        $this->assertNotNull($rover);
    }

    function testRoverInitialisedWithPosition()
    {
        $latitude = 5;
        $longitude = 10;
        $rover = RoverFactory::createRover($latitude, $longitude, 'N');
        $position = new Position(5, 10);
        $this->assertEquals($position, $rover->getPosition());
    }

    function testRoverInitialisedWithDirection()
    {
        $direction = 'N';
        $rover = RoverFactory::createRover(0, 0, $direction);
        $this->assertEquals('N', $rover->getDirection());
    }

    function testRoverInitialisedWithInvalidDirection()
    {
        $direction = 'R';
        $this->expectException('InvalidArgumentException');
        $rover = RoverFactory::createRover(0, 0, $direction);
    }

    function testSingleForwardCommandHeadingNorthFromEquator()
    {
        $rover = RoverFactory::createRover(0, 0, 'N');
        $rover->executeCommands('F');
        $position = new Position(1, 0);
        $this->assertEquals($position, $rover->getPosition());
    }

    function testSingleForwardCommandHeadingNorthFromNorthPole()
    {
        $rover = RoverFactory::createRover(90, 0, 'N');
        $rover->executeCommands('F');
        $this->assertEquals(new Position(89, 180), $rover->getPosition());
    }

    function testTwoForwardCommandsHeadingNorthFromNorthPole()
    {
        $rover = RoverFactory::createRover(88, 0, 'N');
        $rover->executeCommands('F');
        $this->assertEquals(new Position(89, 0), $rover->getPosition());
        $rover->executeCommands('F');
        $this->assertEquals(new Position(90, 0), $rover->getPosition());
        $rover->executeCommands('F');
        $this->assertEquals(new Position(89, 180), $rover->getPosition());
        $rover->executeCommands('F');
        $this->assertEquals(new Position(88, 180), $rover->getPosition());
    }

    function testTwoForwardCommandsHeadingSouthFromSouthPole()
    {
        $rover = RoverFactory::createRover(-88, 0, 'S');
        $rover->executeCommands('F');
        $this->assertEquals(new Position(-89, 0), $rover->getPosition());
        $rover->executeCommands('F');
        $this->assertEquals(new Position(-90, 0), $rover->getPosition());
        $rover->executeCommands('F');
        $this->assertEquals(new Position(-89, 180), $rover->getPosition());
        $rover->executeCommands('F');
        $this->assertEquals(new Position(-88, 180), $rover->getPosition());
    }

    function testSingleForwardCommandHeadingNorthFromSouthPole()
    {
        $rover = RoverFactory::createRover(-90, 0, 'N');
        $rover->executeCommands('F');
        $position = new Position(-89, 0);
        $this->assertEquals($position, $rover->getPosition());
    }

    function testSingleForwardCommandHeadingSouthFromEquator()
    {
        $rover = RoverFactory::createRover(0, 0, 'S');
        $rover->executeCommands('F');
        $position = new Position(-1, 0);
        $this->assertEquals($position, $rover->getPosition());
    }

    function testSingleForwardCommandHeadingSouthFromNorthPole()
    {
        $rover = RoverFactory::createRover(90, 0, 'S');
        $rover->executeCommands('F');
        $position = new Position(89, 0);
        $this->assertEquals($position, $rover->getPosition());
    }

    function testSingleForwardCommandHeadingSouthFromSouthPole()
    {
        $rover = RoverFactory::createRover(-90, 0, 'S');
        $rover->executeCommands('F');
        $this->assertEquals(new Position(-89, 180), $rover->getPosition());
    }

    function testSingleBackwardCommandHeadingSouthFromSouthPole()
    {
        $rover = RoverFactory::createRover(-90, 0, 'S');
        $rover->executeCommands('B');
        $position = new Position(-89, 0);
        $this->assertEquals($position, $rover->getPosition());
    }

    function testTwoForwardCommandsHeadingNorthFromNorthPole2()
    {
        $rover = RoverFactory::createRover(90, 0, 'N');
        $rover->executeCommands('F');
        $rover->executeCommands('F');
        $position = new Position(88, 180);
        $this->assertEquals($position, $rover->getPosition());
    }

    function testReverseOverNorthPoleEndUpFacingNorth()
    {
        $rover = RoverFactory::createRover(89, 0, 'S');
        $rover->executeCommands('BB');
        $this->assertEquals('N', $rover->getDirection());
        $this->assertEquals(new Position(89, 180), $rover->getPosition());
    }

    function testTurnLeft()
    {
        $rover = RoverFactory::createRover(90, 0, 'N');
        $rover->executeCommands('L');
        $this->assertEquals('W', $rover->getDirection());
    }

    function testTurnRight()
    {
        $rover = RoverFactory::createRover(90, 0, 'N');
        $rover->executeCommands('R');
        $this->assertEquals('E', $rover->getDirection());
    }

    function testTurn360Clockwise()
    {
        $rover = RoverFactory::createRover(90, 0, 'N');
        $rover->executeCommands('R');
        $this->assertEquals('E', $rover->getDirection());
        $rover->executeCommands('R');
        $this->assertEquals('S', $rover->getDirection());
        $rover->executeCommands('R');
        $this->assertEquals('W', $rover->getDirection());
        $rover->executeCommands('R');
        $this->assertEquals('N', $rover->getDirection());
    }

    function testTurn360AntiClockwise()
    {
        $rover = RoverFactory::createRover(90, 0, 'N');
        $rover->executeCommands('L');
        $this->assertEquals('W', $rover->getDirection());
        $rover->executeCommands('L');
        $this->assertEquals('S', $rover->getDirection());
        $rover->executeCommands('L');
        $this->assertEquals('E', $rover->getDirection());
        $rover->executeCommands('L');
        $this->assertEquals('N', $rover->getDirection());
    }

    function testFromNullIslandGoForwardEast()
    {
        $rover = RoverFactory::createRover(0, 0, 'E');
        $rover->executeCommands('F');
        $this->assertEquals(new Position(0, 1), $rover->getPosition());
    }

    function testFromNullIslandGoForwardWest()
    {
        $rover = RoverFactory::createRover(0, 0, 'W');
        $rover->executeCommands('F');
        $this->assertEquals(new Position(0, -1), $rover->getPosition());
    }

    function testCommandInvoker()
    {
        $rover = RoverFactory::createRover(0, 0, 'W');
        $rover->executeCommands("FFFF");
        $this->assertEquals(new Position(0, -4), $rover->getPosition());
    }

    function testCommandInvoker2()
    {
        $rover = RoverFactory::createRover(89, 0, 'N');
        $rover->executeCommands("FFLLFFLL");
        $this->assertEquals(new Position(89, 0), $rover->getPosition());
    }

    function testGlobeWithCraterAtNullIsland()
    {
        $craters = [[0, 0], [0, 1]];
        $globe = new Planet($craters);
        $this->assertTrue($globe->isCrater(new Position(0, 0)));
    }

    function testGlobeWithCraterAtSomePosition()
    {
        $craters = [[0, 0], [83, 179]];
        $globe = new Planet($craters);
        $this->assertTrue($globe->isCrater(new Position(83, 179)));
    }

    function testGlobeWithCraterNotAtPosition()
    {
        $craters = [[0, 0], [83, 179]];
        $globe = new Planet($craters);
        $this->assertFalse($globe->isCrater(new Position(67, -52)));
    }

    function testRoverMovingForwardNoCraterInWay()
    {
        $craters = [[10, 0]];
        $globe = new Planet($craters);
        $rover = RoverFactory::createRover(-1, 0, 'N', $globe);
        $result = $rover->executeCommands('FFF');
        $this->assertTrue($result);
        $this->assertEquals(new Position(2, 0), $rover->getPosition());
    }

    function testRoverMovingIntoCrater()
    {
        $craters = [[1, 0]];
        $globe = new Planet($craters);
        $rover = RoverFactory::createRover(-1, 0, 'N', $globe);
        $result = $rover->executeCommands('FFFFLFF');
        $this->assertFalse($result);
        $this->assertEquals(new Position(0, 0), $rover->getPosition());
        $this->assertEquals(new Position(1, 0), $rover->getObstacle());
    }

    function testRoverMovingPastCrater()
    {
        $craters = [[1, 0]];
        $globe = new Planet($craters);
        $rover = RoverFactory::createRover(-1, 0, 'N', $globe);
        $result = $rover->executeCommands('FRFLFFLFR');
        $this->assertTrue($result);
        $this->assertEquals(new Position(2, 0), $rover->getPosition());
        $this->assertEquals('N', $rover->getDirection());
    }

    function testRoverCheckForObstacleWithoutMoving()
    {
        $craters = [[1, 0]];
        $globe = new Planet($craters);
        $rover = RoverFactory::createRover(0, 0, 'N', $globe);
        $this->assertNull($rover->getObstacle());
    }

    function testRover3()
    {
        //$rover = RoverFactory::createRover(new NorthFacing(new Position(0,0)));
        $rover = RoverFactory::createRover(0, 0, 'N');
        $rover->executeCommands("F");
        $this->assertEquals(new Position(1, 0), $rover->getPosition());
    }

    function testRoverHandlesEmptyCommand()
    {
        $rover = RoverFactory::createRover(0, 0, 'N');
        $this->expectException('InvalidArgumentException');
        $rover->executeCommands("");
    }

    // TODO Edge case...if you're at a pole you can only face away from it (N or S)
    // Turning will change your longitude when you move forward
    // This would need new conditional logic for the poles, and effecting the polar crossing code upon reaching the pole.
    function testTurningEastAtTheNorthPole()
    {
        $rover = RoverFactory::createRover(89, 0, 'N');
        $rover->executeCommands("F");
        $this->assertEquals(new Position(90, 0), $rover->getPosition());
        $this->assertEquals('N', $rover->getDirection());
        $rover->executeCommands("R");
        $this->assertEquals(new Position(90, 90), $rover->getPosition());
        $this->assertEquals('S', $rover->getDirection());
        $rover->executeCommands("F");
        $this->assertEquals(new Position(89, 90), $rover->getPosition());
        $this->assertEquals('E', $rover->getDirection());
    }

}
