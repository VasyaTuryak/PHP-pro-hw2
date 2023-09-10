<?php

class WriteFile
{
    public function __construct(array $array,string $path)
    {
        $this->write($array,$path);
    }

    protected function write(array $array,string $path): void
    {
        $file_new = fopen($path, 'w');
        $length = count($array);
        for ($i = 0; $i < $length; $i++) {
            fwrite($file_new, $array[$i]);
        }
    }

}