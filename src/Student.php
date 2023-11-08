<?php

namespace Wastukancana;

class Student
{
    public string $nim;

    /** @var string|null */
    public string $name;

    /** @var string|null */
    public string $gender;

    /** @var bool|null */
    public bool $isGraduated;

    public int $admissionYear;
    public string $study;
    public string $educationLevel;
    public int $firstSemester;
    public int $sequenceNumber;
}
