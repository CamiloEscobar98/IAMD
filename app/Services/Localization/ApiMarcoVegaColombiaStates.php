<?php

namespace App\Services\Localization;

use GuzzleHttp\Client;

class ApiMarcoVegaColombiaStates
{
    /** @var string */
    protected $baseURL;

    /** @var Client */
    protected $curlClient;

    public function __construct()
    {
        $this->baseURL = "https://raw.githubusercontent.com/marcovega/colombia-json/master/colombia.min.json";

        $this->connect(30.0);
    }

    /**
     * Connect with Starship API
     * 
     * @param string $baseURI
     * @param float $timeOut
     * 
     * @return void
     */
    public function connect(float $timeOut)
    {
        $this->curlClient = new Client([
            'base_uri' => $this->baseURL,
            'timeout' => $timeOut
        ]);
    }

    /**
     * Get departmens
     * 
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getDepartments()
    {
        $request = $this->curlClient->get('');

        return collect(json_decode($request->getBody()));
    }
}
