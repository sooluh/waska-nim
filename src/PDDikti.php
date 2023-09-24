<?php

namespace Wastukancana;

use GuzzleHttp\Client;

class PDDikti
{
    private string $baseURL = 'aHR0cHM6Ly9hcGktZnJvbnRlbmQua2VtZGlrYnVkLmdvLmlk';
    private Client $http;

    private string $nim;
    // STT Wastukancana - PT ID
    private string $pt = '2CE2EA61-3574-43CA-81D5-E8EF77B6DDF7';

    public function __construct($nim)
    {
        $this->http = new Client();
        $this->nim = $nim;
    }

    private function getProdi()
    {
        $study = substr($this->nim, 2, 3);
        $studies = [
            '113' => '36AD4C43-3391-4665-B43E-18AF50755248', // Teknik Tekstil (S1)
            '115' => '771CDA74-824A-4208-8DD0-5746DD95D020', // Teknik Industri (S1)
            '123' => 'E18F7F44-DF9A-4F0E-9393-724A2D350717', // Teknik Mesin (D3)
            '125' => '55DFA1F3-C11E-447C-8A6D-B8A4343C8746', // Teknik Mesin (S1)
            '133' => '4C991E25-08AD-4E8A-B995-763B9247BAC8', // Manajemen Industri (D3)
            '135' => '93DFDCD6-CC63-4FF2-BC40-EF049BD9C35A', // Teknik Informatika (S1)
        ];

        return $studies[$study] ?? null;
    }

    public function getName()
    {
        $response = $this->http->post(base64_decode($this->baseURL) . '/search_mhs', [
            'json' => [
                'nama' => '',
                'nipd' => $this->nim,
                'pt' => $this->pt,
                'prodi' => $this->getProdi(),
            ],
            'headers' => [
                'Content-Type' => 'application/json',
            ],
        ]);

        $body = $response->getBody();
        $content = $body->getContents();
        $data = json_decode($content);

        return $data->mahasiswa[0]->nama ?? null;
    }
}
