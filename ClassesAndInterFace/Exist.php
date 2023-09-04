<?php

class Exist
{
    public function __construct($url)
    {
        $this->exist($url);
    }

    public function exist($url): void
    {
        $header = get_headers($url);
        if ($header) {
            echo "The site exists. Server response: " . $header[0] . PHP_EOL;
        } elseif ($header === false) {
            echo "Server does not exist. Make sure you need short URL for this" . PHP_EOL;
        };
    }
}