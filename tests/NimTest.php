<?php

use Wastukancana\Nim;
use PHPUnit\Framework\TestCase;

final class NimTest extends TestCase
{
    const NIM_TEST = '211351143';

    /** @covers \Wastukancana\Parser::getNIM */
    public function testCanGetNim()
    {
        $parser = new Nim(self::NIM_TEST);
        $nim = $parser->getNIM();

        $this->assertEquals(self::NIM_TEST, $nim);
    }

    /** @covers \Wastukancana\Nim::getName */
    public function testCanGetName()
    {
        $parser = new Nim(self::NIM_TEST);
        $name = $parser->getName();

        $this->assertEquals('SULUH SULISTIAWAN', $name);
    }

    /** @covers \Wastukancana\Parser::getFirstSemester */
    public function testCanGetFirstSemester()
    {
        $parser = new Nim(self::NIM_TEST);
        $semester = $parser->getFirstSemester();

        $this->assertEquals(1, $semester);
    }

    /** @covers \Wastukancana\Parser::getSequenceNumber */
    public function testCanGetSequenceNumber()
    {
        $parser = new Nim(self::NIM_TEST);
        $sequence = $parser->getSequenceNumber();

        $this->assertEquals(143, $sequence);
    }

    /** @covers \Wastukancana\Nim::isValidAdmissionYear */
    public function testIsValidAdmissionYear()
    {
        $parser = new Nim(self::NIM_TEST);
        $valid = $parser->isValidAdmissionYear();

        $this->assertTrue($valid);
    }

    /** @covers \Wastukancana\Nim::getAdmissionYear */
    public function testCanGetAdmissionYear()
    {
        $parser = new Nim(self::NIM_TEST);
        $year = $parser->getAdmissionYear();

        $this->assertEquals(2021, $year);
    }

    /** @covers \Wastukancana\Nim::isValidStudy */
    public function testIsValidStudy()
    {
        $parser = new Nim(self::NIM_TEST);
        $valid = $parser->isValidStudy();

        $this->assertTrue($valid);
    }

    /** @covers \Wastukancana\Nim::getStudy */
    public function testCanGetStudy()
    {
        $parser = new Nim(self::NIM_TEST);
        $study = $parser->getStudy();

        $this->assertEquals('Teknik Informatika', $study);
    }

    /** @covers \Wastukancana\Nim::getEducationLevel */
    public function testCanGetEducationLevel()
    {
        $parser = new Nim(self::NIM_TEST);
        $level = $parser->getEducationLevel();

        $this->assertEquals('S1', $level);
    }

    /** @covers \Wastukancana\Nim::isValid */
    public function testNimWithInvalidLengthThrowsException()
    {
        $this->expectException(\Exception::class);

        $parser = new Nim('1');
        $parser->dump();
    }

    /** @covers \Wastukancana\Nim::isValid */
    public function testNimWithNonNumericCharactersThrowsException()
    {
        $this->expectException(\Exception::class);

        $parser = new Nim('2113511a3');
        $parser->dump();
    }

    /** @covers \Wastukancana\Nim::isValid */
    public function testInvalidAdmissionYearThrowsException()
    {
        $this->expectException(\Exception::class);

        $parser = new Nim('991351143');
        $parser->dump();
    }

    /** @covers \Wastukancana\Nim::isValid */
    public function testNonExistentStudyThrowsException()
    {
        $this->expectException(\Exception::class);

        $parser = new Nim('210001143');
        $parser->dump();
    }
}
