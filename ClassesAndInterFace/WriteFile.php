<?php

class WriteFile
{
    public function __construct($a)
    {
        $this->write($a);
    }

    public function write($a): void
    {
        $_FileNew = fopen('StoreURL.txt', 'w');
        $Length = count($a);
        for ($i = 0; $i < $Length; $i++) {
            fwrite($_FileNew, $a[$i]);
        }
    }

}