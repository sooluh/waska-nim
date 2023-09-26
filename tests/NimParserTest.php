<?php

use Wastukancana\Nim;
use Wastukancana\Student;
use PHPUnit\Framework\TestCase;

final class NimParserTest extends TestCase
{
    const NIM_TEST = '211351143';

    public function testCanDump()
    {
        $parser = new Nim(self::NIM_TEST);
        $dump = $parser->dump();

        $student = new Student;
        $student->nim = self::NIM_TEST;
        $student->name = 'SULUH SULISTIAWAN';
        $student->admissionYear = 2021;
        $student->study = 'Teknik Informatika';
        $student->educationLevel = 'S1';
        $student->firstSemester = 1;
        $student->sequenceNumber = 143;

        $this->assertEquals($student, $dump);
    }

    public function testCanGetNim()
    {
        $parser = new Nim(self::NIM_TEST);
        $nim = $parser->getNIM();

        $this->assertEquals(self::NIM_TEST, $nim);
    }

    public function testCanGetName()
    {
        $parser = new Nim(self::NIM_TEST);
        $name = $parser->getName();

        $this->assertEquals('SULUH SULISTIAWAN', $name);
    }

    public function testCanGetFirstSemester()
    {
        $parser = new Nim(self::NIM_TEST);
        $semester = $parser->getFirstSemester();

        $this->assertEquals(1, $semester);
    }

    public function testCanGetSequenceNumber()
    {
        $parser = new Nim(self::NIM_TEST);
        $sequence = $parser->getSequenceNumber();

        $this->assertEquals(143, $sequence);
    }

    public function testIsValidAdmissionYear()
    {
        $parser = new Nim(self::NIM_TEST);
        $valid = $parser->isValidAdmissionYear();

        $this->assertTrue($valid);
    }

    public function testCanGetAdmissionYear()
    {
        $parser = new Nim(self::NIM_TEST);
        $year = $parser->getAdmissionYear();

        $this->assertEquals(2021, $year);
    }

    public function testIsValidStudy()
    {
        $parser = new Nim(self::NIM_TEST);
        $valid = $parser->isValidStudy();

        $this->assertTrue($valid);
    }

    public function testCanGetStudy()
    {
        $parser = new Nim(self::NIM_TEST);
        $study = $parser->getStudy();

        $this->assertEquals('Teknik Informatika', $study);
    }

    public function testCanGetEducationLevel()
    {
        $parser = new Nim(self::NIM_TEST);
        $level = $parser->getEducationLevel();

        $this->assertEquals('S1', $level);
    }

    public function testNimWithInvalidLengthThrowsException()
    {
        $this->expectException(\Exception::class);
        new Nim('1');
    }

    public function testNimWithNonNumericCharactersThrowsException()
    {
        $this->expectException(\Exception::class);
        new Nim('2113511a3');
    }

    public function testInvalidAdmissionYearThrowsException()
    {
        $this->expectException(\Exception::class);
        new Nim('991351143');
    }

    public function testNonExistentStudyThrowsException()
    {
        $this->expectException(\Exception::class);
        new Nim('210001143');
    }
}
