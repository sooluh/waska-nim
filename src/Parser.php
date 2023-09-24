<?php

namespace Wastukancana;

class Parser
{
    protected string $nim;

    protected $studies = [
        '113' => [
            'level' => 'S1',
            'name' => 'Teknik Tekstil',
            'code' => '36AD4C43-3391-4665-B43E-18AF50755248',
        ],
        '115' => [
            'level' => 'S1',
            'name' => 'Teknik Industri',
            'code' => '771CDA74-824A-4208-8DD0-5746DD95D020',
        ],
        '123' => [
            'level' => 'D3',
            'name' => 'Teknik Mesin',
            'code' => 'E18F7F44-DF9A-4F0E-9393-724A2D350717',
        ],
        '125' => [
            'level' => 'S1',
            'name' => 'Teknik Mesin',
            'code' => '55DFA1F3-C11E-447C-8A6D-B8A4343C8746',
        ],
        '133' => [
            'level' => 'D3',
            'name' => 'Manajemen Industri',
            'code' => '4C991E25-08AD-4E8A-B995-763B9247BAC8',
        ],
        '135' => [
            'level' => 'S1',
            'name' => 'Teknik Informatika',
            'code' => '93DFDCD6-CC63-4FF2-BC40-EF049BD9C35A',
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
