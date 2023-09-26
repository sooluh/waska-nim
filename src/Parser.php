<?php

namespace Wastukancana;

class Parser
{
    protected string $nim;

    protected $studies = [
        '113' => [
            'level' => 'S1',
            'name' => 'Teknik Tekstil',
        ],
        '115' => [
            'level' => 'S1',
            'name' => 'Teknik Industri',
        ],
        '123' => [
            'level' => 'D3',
            'name' => 'Teknik Mesin',
        ],
        '125' => [
            'level' => 'S1',
            'name' => 'Teknik Mesin',
        ],
        '133' => [
            'level' => 'D3',
            'name' => 'Manajemen Industri',
        ],
        '135' => [
            'level' => 'S1',
            'name' => 'Teknik Informatika',
        ],
    ];

    public function __construct($nim)
    {
        $this->nim = trim($nim);
    }

    public function getNIM()
    {
        return $this->nim;
    }

    protected function getAdmissionYearCode()
    {
        return substr($this->nim, 0, 2);
    }

    protected function getStudyCode()
    {
        return substr($this->nim, 2, 3);
    }

    protected function getEducationLevelCode()
    {
        return substr($this->nim, 2, 3);
    }

    public function getFirstSemester()
    {
        return intval(substr($this->nim, 5, 1));
    }

    public function getSequenceNumber()
    {
        return intval(substr($this->nim, 6, 3));
    }
}
