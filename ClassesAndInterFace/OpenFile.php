<?php

class OpenFile
{
    public array $Array;

    public function __construct()
    {
        $this->OpenReadFile();
    }

    public function OpenReadFile(): void
    {
        $_File = fopen('StoreURL.txt', 'a+');
        $_OpenArray = array();
        while ($_line = fgets($_File)) {
            $_OpenArray[] = trim($_line, '');
        }
        $this->Array = $_OpenArray;
        fclose($_File);
    }
}