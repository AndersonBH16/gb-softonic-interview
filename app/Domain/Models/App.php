<?php

namespace App\Domain\Models;

class App
{
    public string $id;
    public string $title;
    public string $version;
    public string $url;
    public string $shortDescription;
    public string $license;
    public string $thumbnail;
    public int $rating;
    public string $totalDownloads;
    public array $compatible;

    public function __construct(
        string $id,
        string $title,
        string $version,
        string $url,
        string $shortDescription,
        string $license,
        string $thumbnail,
        int $rating,
        string $totalDownloads,
        array $compatible
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->version = $version;
        $this->url = $url;
        $this->shortDescription = $shortDescription;
        $this->license = $license;
        $this->thumbnail = $thumbnail;
        $this->rating = $rating;
        $this->totalDownloads = $totalDownloads;
        $this->compatible = $compatible;
    }
}
