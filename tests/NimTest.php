<?php

use Wastukancana\Nim;
use PHPUnit\Framework\TestCase;

final class NimTest extends TestCase
{
    const NIM_TEST = '211351143';

    /** @covers ::getNIM */
    public function testCanGetNim()
    {
        $parser = new Nim(self::NIM_TEST);
        $nim = $parser->getNIM();

        $this->assertEquals(self::NIM_TEST, $nim);
    }

    /** @covers ::getName */
    public function testCanGetName()
    {
        $parser = new Nim(self::NIM_TEST);
        $name = $parser->getName();

        $this->assertEquals('SULUH SULISTIAWAN', $name);
    }

    /** @covers ::getFirstSemester */
    public function testCanGetFirstSemester()
    {
        $parser = new Nim(self::NIM_TEST);
        $semester = $parser->getFirstSemester();

        $this->assertEquals(1, $semester);
    }

    /** @covers ::getSequenceNumber */
    public function testCanGetSequenceNumber()
    {
        $parser = new Nim(self::NIM_TEST);
        $sequence = $parser->getSequenceNumber();

        $this->assertEquals(143, $sequence);
    }

    /** @covers ::isValidAdmissionYear */
    public function testIsValidAdmissionYear()
    {
        $parser = new Nim(self::NIM_TEST);
        $valid = $parser->isValidAdmissionYear();

        $this->assertTrue($valid);
    }

    /** @covers ::getAdmissionYear */
    public function testCanGetAdmissionYear()
    {
        $parser = new Nim(self::NIM_TEST);
        $year = $parser->getAdmissionYear();

        $this->assertEquals(2021, $year);
    }

    /** @covers ::isValidStudy */
    public function testIsValidStudy()
    {
        $parser = new Nim(self::NIM_TEST);
        $valid = $parser->isValidStudy();

        $this->assertTrue($valid);
    }

    /** @covers ::getStudy */
    public function testCanGetStudy()
    {
        $parser = new Nim(self::NIM_TEST);
        $study = $parser->getStudy();

        $this->assertEquals('Teknik Informatika', $study);
    }

    /** @covers ::getEducationLevel */
    public function testCanGetEducationLevel()
    {
        $parser = new Nim(self::NIM_TEST);
        $level = $parser->getEducationLevel();

        $this->assertEquals('S1', $level);
    }

    /** @covers ::isValid */
    public function testNimWithInvalidLengthThrowsException()
    {
        $this->expectException(\Exception::class);

        $parser = new Nim('1');
        $parser->dump();
    }

    /** @covers ::isValid */
    public function testNimWithNonNumericCharactersThrowsException()
    {
        $this->expectException(\Exception::class);

        $parser = new Nim('2113511a3');
        $parser->dump();
    }

    /** @covers ::isValid */
    public function testInvalidAdmissionYearThrowsException()
    {
        $this->expectException(\Exception::class);

        $parser = new Nim('991351143');
        $parser->dump();
    }

    /** @covers ::isValid */
    public function testNonExistentStudyThrowsException()
    {
        $this->expectException(\Exception::class);

        $parser = new Nim('210001143');
        $parser->dump();
    }
}
