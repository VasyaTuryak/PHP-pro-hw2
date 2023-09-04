<?php

class CheckURL
{
    public function Search(array $c, string $code): int
    {
        $a = -1;
        foreach ($c as $key => $value) {
            if (trim($value, "\n") === $code) {
                $a = $key;
            }
        }
        return $a;
    }
}