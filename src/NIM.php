<?php

namespace Wastukancana;

class NIM
{
    private string $nim;
    private PDDikti $pddikti;

    public function __construct($nim)
    {
        $this->nim = trim($nim);

        $this->isValid();

        $this->pddikti = new PDDikti($nim);
    }

    private function isValid()
    {
        if (strlen($this->nim) !== 9) {
            throw new \Exception('NIM must be 9 characters');
        }
    }

    public function getNIM()
    {
        return $this->nim;
    }

    public function isValidAdmissionYear()
    {
        $year = intval(substr($this->nim, 0, 2));
        $now = date('y');

        // start from 2001
        return $year >= 1 && $year <= $now;
    }

    public function getAdmissionYear()
    {
        $year = substr($this->nim, 0, 2);
        return intval('20' . $year);
    }

    public function isValidStudy()
    {
        $study = substr($this->nim, 2, 3);
        return in_array($study, ['113', '115', '123', '125', '133', '135']);
    }

    public function getStudy()
    {
        $study = substr($this->nim, 2, 3);
        $studies = [
            '113' => 'Teknik Tekstil',
            '115' => 'Teknik Industri',
            '123' => 'Teknik Mesin',
            '125' => 'Teknik Mesin',
            '133' => 'Manajemen Industri',
            '135' => 'Teknik Informatika',
        ];

        return $studies[$study] ?? null;
    }

    public function getEducationLevel()
    {
        $study = substr($this->nim, 2, 3);
        $levels = [
            '113' => 'S1',
            '115' => 'S1',
            '123' => 'D3',
            '125' => 'S1',
            '133' => 'D3',
            '135' => 'S1',
        ];

        return $levels[$study] ?? null;
    }

    public function isValidFirstSemester()
    {
        $semester = substr($this->nim, 5, 1);
        return strlen($semester) >= 1 && strlen($semester) <= 8;
    }

    public function getFirstSemester()
    {
        return intval(substr($this->nim, 5, 1));
    }

    public function getSequenceNumber()
    {
        return intval(substr($this->nim, 6, 3));
    }

    public function dump(): Student
    {
        $student = new Student;
        $student->nim = $this->getNIM();
        $student->name = $this->pddikti->getName();
        $student->admissionYear = $this->getAdmissionYear();
        $student->study = $this->getStudy();
        $student->educationLevel = $this->getEducationLevel();
        $student->firstSemester = $this->getFirstSemester();
        $student->sequenceNumber = $this->getSequenceNumber();

        return $student;
    }
}
