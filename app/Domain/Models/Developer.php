<?php

namespace App\Domain\Models;

class Developer
{
    public string $name;
    public string $url;

    public function __construct(string $name, string $url)
    {
        $this->name = $name;
        $this->url = $url;
    }
}
