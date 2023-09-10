<?php

class OpenFile
{
    public array $array_of_url;

    public function __construct(string $path)
    {
        $this->openReadFile($path);
    }

    private function openReadFile(string $path): void
    {
        $open_file = fopen($path, 'a+');
        $open_array = array();
        while ($line = fgets($open_file)) {
            $open_array[] = trim($line, '');
        }
        $this->array_of_url = $open_array;
        fclose($open_file);
    }
}