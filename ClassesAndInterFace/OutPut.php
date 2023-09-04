<?php
use Interface\IUrlDecoder;
class OutPut implements IUrlDecoder
{
    public function decode(string $code): string
    {
        // TODO: Implement encode() method.
        $respons = '';
        if (filter_var($code, FILTER_VALIDATE_URL)) {
            $respons = "$code is a valid Short URL" . PHP_EOL;
        } else {
            throw new \InvalidArgumentException('Invalid Short URL, check that' . PHP_EOL);
        }

        return $respons;
    }

}