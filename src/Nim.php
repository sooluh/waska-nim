<?php

namespace Wastukancana;

class Nim extends Parser
{
    private PDDikti $pddikti;

    public function __construct($nim)
    {
        parent::__construct($nim);
        $this->isValid();
        $this->pddikti = new PDDikti($this->nim);
    }

    private function isValid()
    {
        if (strlen($this->nim) !== 9) {
            throw new \Exception('NIM must be 9 characters');
        }

        if (!ctype_digit($this->nim)) {
            throw new \Exception('NIM must contain only numbers');
        }

        if (!$this->isValidAdmissionYear()) {
            throw new \Exception('Admission year is invalid');
        }

        if (!$this->isValidStudy()) {
            throw new \Exception('Study cannot be found');
        }

        return true;
    }

    public function getName()
    {
        return $this->pddikti->getName();
    }

    public function getGender()
    {
        return $this->pddikti->getGender();
    }

    public function getIsGraduated()
    {
        return $this->pddikti->getIsGraduated();
    }

    public function isValidAdmissionYear()
    {
        $now = date('y');
        $year = intval($this->getAdmissionYearCode());

        // start from 2001
        return $year >= 1 && $year <= $now;
    }

    public function getAdmissionYear()
    {
        $year = $this->getAdmissionYearCode();
        return intval('20' . $year);
    }

    public function isValidStudy()
    {
        return in_array($this->getStudyCode(), array_keys($this->studies));
    }

    public function getStudy()
    {
        return $this->studies[$this->getStudyCode()]['name'];
    }

    public function getEducationLevel()
    {
        return $this->studies[$this->getStudyCode()]['level'];
    }

    public function dump(): Student
    {
        $student = new Student;
        $student->nim = $this->getNIM();
        $student->name = $this->pddikti->getName();
        $student->gender = $this->pddikti->getGender();
        $student->isGraduated = $this->pddikti->getIsGraduated();
        $student->admissionYear = $this->getAdmissionYear();
        $student->study = $this->getStudy();
        $student->educationLevel = $this->getEducationLevel();
        $student->firstSemester = $this->getFirstSemester();
        $student->sequenceNumber = $this->getSequenceNumber();

        return $student;
    }
}
