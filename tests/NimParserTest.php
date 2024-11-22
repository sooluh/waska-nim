<?php

use Wastukancana\Nim;
use Wastukancana\Student;
use PHPUnit\Framework\TestCase;

final class NimParserTest extends TestCase
{
    const NIM_TEST = '211351143';
    const EXPECTED_NAME = 'SULUH SULISTIAWAN';
    const EXPECTED_GENDER = 'M';
    const EXPECTED_GRADUATION = false;
    const EXPECTED_YEAR = 2021;
    const EXPECTED_STUDY = 'Teknik Informatika';
    const EXPECTED_LEVEL = 'S1';
    const EXPECTED_SEMESTER = 1;
    const EXPECTED_SEQUENCE = 143;

    private Nim $nim;

    protected function setUp(): void
    {
        $this->nim = new Nim(self::NIM_TEST);
    }

    public function testIsValidAdmissionYear()
    {
        $this->assertTrue($this->nim->isValidAdmissionYear());
    }

    public function testIsValidStudy()
    {
        $this->assertTrue($this->nim->isValidStudy());
    }

    public function testCanDump()
    {
        $dump = $this->nim->dump();

        $student = new Student;
        $student->nim = self::NIM_TEST;
        $student->name = self::EXPECTED_NAME;
        $student->gender = self::EXPECTED_GENDER;
        $student->isGraduated = self::EXPECTED_GRADUATION;
        $student->admissionYear = self::EXPECTED_YEAR;
        $student->study = self::EXPECTED_STUDY;
        $student->educationLevel = self::EXPECTED_LEVEL;
        $student->firstSemester = self::EXPECTED_SEMESTER;
        $student->sequenceNumber = self::EXPECTED_SEQUENCE;

        $this->assertEquals($student, $dump);
    }

    public function testCanGetNim()
    {
        $this->assertEquals(self::NIM_TEST, $this->nim->getNIM());
    }

    public function testCanGetName()
    {
        $this->assertEquals(self::EXPECTED_NAME, $this->nim->getName());
    }

    public function testCanGetGender()
    {
        $this->assertEquals(self::EXPECTED_GENDER, $this->nim->getGender());
    }

    public function testCanGetIsGraduated()
    {
        $this->assertEquals(self::EXPECTED_GRADUATION, $this->nim->getIsGraduated());
    }

    public function testCanGetFirstSemester()
    {
        $this->assertEquals(self::EXPECTED_SEMESTER, $this->nim->getFirstSemester());
    }

    public function testCanGetSequenceNumber()
    {
        $this->assertEquals(self::EXPECTED_SEQUENCE, $this->nim->getSequenceNumber());
    }

    public function testCanGetAdmissionYear()
    {
        $this->assertEquals(self::EXPECTED_YEAR, $this->nim->getAdmissionYear());
    }

    public function testCanGetStudy()
    {
        $this->assertEquals(self::EXPECTED_STUDY, $this->nim->getStudy());
    }

    public function testCanGetEducationLevel()
    {
        $this->assertEquals(self::EXPECTED_LEVEL, $this->nim->getEducationLevel());
    }

    public function testNimWithInvalidLengthThrowsException()
    {
        $this->expectException(\InvalidArgumentException::class);
        new Nim('1');
    }

    public function testNimWithNonNumericCharactersThrowsException()
    {
        $this->expectException(\InvalidArgumentException::class);
        new Nim('2113511a3');
    }

    public function testInvalidAdmissionYearThrowsException()
    {
        $this->expectException(\InvalidArgumentException::class);
        new Nim('991351143');
    }

    public function testNonExistentStudyThrowsException()
    {
        $this->expectException(\InvalidArgumentException::class);
        new Nim('210001143');
    }
}
