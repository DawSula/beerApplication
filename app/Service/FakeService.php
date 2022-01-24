<?php

namespace App\Service;

class FakeService
{
    private string $config;

    /**
     * @param string $config
     */
    public function __construct(string $config)
    {
        $this->config = $config;
    }

    /**
     * @return string
     */
    public function getConfig(): string
    {
        return $this->config;
    }


}
