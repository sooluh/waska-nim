<?php

use Wastukancana\Nim;
use Wastukancana\Student;
use PHPUnit\Framework\TestCase;

final class NimParserTest extends TestCase
{
    const NIM_TEST = '211351143';

    private Nim $nim;

    public function __construct()
    {
        parent::__construct();
        $this->nim = new Nim(self::NIM_TEST);
    }

    public function testIsValidAdmissionYear()
    {
        $valid = $this->nim->isValidAdmissionYear();
        $this->assertTrue($valid);
    }

    public function testIsValidStudy()
    {
        $valid = $this->nim->isValidStudy();
        $this->assertTrue($valid);
    }

    public function testCanDump()
    {
        $dump = $this->nim->dump();

        $student = new Student;
        $student->nim = self::NIM_TEST;
        $student->name = 'SULUH SULISTIAWAN';
        $student->gender = 'M';
        $student->isGraduated = false;
        $student->admissionYear = 2021;
        $student->study = 'Teknik Informatika';
        $student->educationLevel = 'S1';
        $student->firstSemester = 1;
        $student->sequenceNumber = 143;

        $this->assertEquals($student, $dump);
    }

    public function testCanGetNim()
    {
        $nim = $this->nim->getNIM();
        $this->assertEquals(self::NIM_TEST, $nim);
    }

    public function testCanGetName()
    {
        $name = $this->nim->getName();
        $this->assertEquals('SULUH SULISTIAWAN', $name);
    }

    public function testCanGetGender()
    {
        $gender = $this->nim->getGender();
        $this->assertEquals('M', $gender);
    }

    public function testCanGetIsGraduated()
    {
        $isGraduated = $this->nim->getIsGraduated();
        $this->assertEquals(false, $isGraduated);
    }

    public function testCanGetFirstSemester()
    {
        $semester = $this->nim->getFirstSemester();
        $this->assertEquals(1, $semester);
    }

    public function testCanGetSequenceNumber()
    {
        $sequence = $this->nim->getSequenceNumber();
        $this->assertEquals(143, $sequence);
    }

    public function testCanGetAdmissionYear()
    {
        $year = $this->nim->getAdmissionYear();
        $this->assertEquals(2021, $year);
    }

    public function testCanGetStudy()
    {
        $study = $this->nim->getStudy();
        $this->assertEquals('Teknik Informatika', $study);
    }

    public function testCanGetEducationLevel()
    {
        $level = $this->nim->getEducationLevel();
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
