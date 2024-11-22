<?php

namespace Wastukancana;

use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;

class PDDikti
{
    private Client $http;
    private string $nim;

    private array $headers = [
        'Accept' => 'application/json',
        'X-Api-Key' => '3ed297db-db1c-4266-8bf4-a89f21c01317',
    ];

    private ?string $id = null;
    private ?string $name = null;
    private ?string $gender = null;
    private ?bool $isGraduated = null;

    public function __construct(string $nim)
    {
        $this->http = new Client([
            'base_uri' => 'https://pddikti.kemdikbud.go.id',
            'verify' => false,
        ]);
        $this->nim = $nim;
    }

    private function fetchData(string $endpoint): ?object
    {
        try {
            $response = $this->http->request('GET', $endpoint, ['headers' => $this->headers]);
            return $this->parseResponse($response);
        } catch (\Exception $e) {
            return null;
        }
    }

    private function parseResponse(ResponseInterface $response): ?object
    {
        $content = $response->getBody()->getContents();
        return json_decode($content);
    }

    private function prepareList(): void
    {
        if ($this->id !== null) {
            return;
        }

        $data = $this->fetchData("api/pencarian/all/$this->nim");

        if (!$data || empty($data->mahasiswa)) {
            return;
        }

        $filtered = array_filter(
            $data->mahasiswa,
            fn($i) => isset($i->sinkatan_pt) && $i->sinkatan_pt === 'STT WASTUKANCANA'
        );

        $selected = !empty($filtered) ? reset($filtered) : null;

        $this->id = $selected->id ?? null;
        $this->name = $selected->nama ?? null;
    }

    private function prepareDetail(): void
    {
        if ($this->gender !== null) {
            return;
        }

        $this->prepareList();

        if (!$this->id) {
            return;
        }

        $data = $this->fetchData("api/detail/mhs/$this->id");

        if (!$data) {
            return;
        }

        $this->gender = $data->jenis_kelamin === 'L' ? 'M' : 'F';
        $this->isGraduated = stripos($data->status_saat_ini ?? '', 'lulus') !== false;
    }

    public function getName(): ?string
    {
        $this->prepareList();
        return $this->name;
    }

    public function getGender(): ?string
    {
        $this->prepareDetail();
        return $this->gender;
    }

    public function getIsGraduated(): ?bool
    {
        $this->prepareDetail();
        return $this->isGraduated;
    }
}
