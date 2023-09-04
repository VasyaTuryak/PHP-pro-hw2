<?php
use Interface\IUrlEncoder;
class Enter implements IUrlEncoder
{
    protected string $prefix = "vily/";

    protected function generateRandomURL(): string
    {
        $n = 10 - strlen($this->prefix); //10 is max length of new URL
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        for ($i = 0; $i < $n; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
        }
        return "https://" . $this->prefix . $randomString;
    }

    public function encode(string $url): string
    {
        // TODO: Implement encode() method.
        if (filter_var($url, FILTER_VALIDATE_URL)) {
            echo("$url is a valid URL" . PHP_EOL);
        } else {
            throw new \InvalidArgumentException('Invalid Long URL' . PHP_EOL);
        }

        return $this->generateRandomURL();
    }

}