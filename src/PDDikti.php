<?php

namespace Wastukancana;

use GuzzleHttp\Client;

class PDDikti
{
    private $headers = [
        'User-Agent' => 'curl/7.81.0',
        'Accept' => 'application/json',
    ];
    private Client $http;

    /** @var string */
    private string $nim;

    /** @var string|null */
    private ?string $id = null;

    /** @var string|null */
    private ?string $name = null;

    /** @var string|null */
    private ?string $gender = null;

    /** @var bool|null */
    private ?bool $isGraduated = null;

    public function __construct($nim)
    {
        $this->http = new Client([
            'base_uri' => 'https://pddikti.kemdikbud.go.id',
            'verify' => false,
        ]);
        $this->nim = $nim;
    }

    private function parseResponse(\Psr\Http\Message\ResponseInterface $response)
    {
        $body = $response->getBody();
        $content = $body->getContents();
        $data = json_decode($content);

        return $data;
    }

    private function prepareList()
    {
        if ($this->id) {
            return;
        }

        $response = $this->http->request('GET', "api/pencarian/mhs/$this->nim", [
            'headers' => $this->headers,
        ]);
        $data = $this->parseResponse($response);

        $this->id = $data[0]->id ?? null;
        $this->name = $data[0]->nama ?? null;
    }

    private function prepareDetail()
    {
        $this->prepareList();

        if ($this->gender) {
            return;
        }

        $response = $this->http->request('GET', "api/detail/mhs/$this->id", [
            'headers' => $this->headers,
        ]);
        $data = $this->parseResponse($response);

        $this->gender = $data->jenis_kelamin === 'L' ? 'M' : 'F';
        $this->isGraduated = stripos($data->status_saat_ini, 'lulus') !== false;
    }

    public function getName()
    {
        $this->prepareList();

        return $this->name;
    }

    public function getGender()
    {
        $this->prepareDetail();

        return $this->gender;
    }

    public function getIsGraduated()
    {
        $this->prepareDetail();

        return $this->isGraduated;
    }
}
