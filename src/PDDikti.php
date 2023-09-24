<?php

namespace Wastukancana;

use GuzzleHttp\Client;

class PDDikti
{
    private string $baseURL = 'aHR0cHM6Ly9hcGktZnJvbnRlbmQua2VtZGlrYnVkLmdvLmlk';
    private Client $http;

    private string $nim;
    private string $prodi;
    // STT Wastukancana PT ID
    private string $pt = '2CE2EA61-3574-43CA-81D5-E8EF77B6DDF7';

    public function __construct($nim, $prodi)
    {
        $this->http = new Client();

        $this->nim = $nim;
        $this->prodi = $prodi;
    }

    public function getName()
    {
        $response = $this->http->post(base64_decode($this->baseURL) . '/search_mhs', [
            'json' => [
                'nama' => '',
                'nipd' => $this->nim,
                'pt' => $this->pt,
                'prodi' => $this->prodi,
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
