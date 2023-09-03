<?php

interface IUrlEncoder
{

    /**
     * @param string $url
     * @return string
     * @throws \InvalidArgumentException
     */
    public function encode(string $url): string;
}

interface IUrlDecoder
{
    /**
     * @param string $code
     * @return string
     * @throws \InvalidArgumentException
     */
    public function decode(string $code): string;
}

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

class OutPut implements IUrlDecoder
{
    public function decode(string $url): string
    {
        // TODO: Implement encode() method.
        $respons = '';
        if (filter_var($url, FILTER_VALIDATE_URL)) {
            $respons = "$url is a valid Short URL" . PHP_EOL;
        } else {
            throw new \InvalidArgumentException('invalid Short URL' . PHP_EOL);
        }

        return $respons;
    }

}

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

echo '*******************' . PHP_EOL;
echo 'Hi. Start program...' . PHP_EOL;
echo 'Write what do you want to do with your URL' . PHP_EOL;
$StoreURL = new OpenFile();
$UrlArray = $StoreURL->Array;
$action = trim(strtolower(readline('CODE or DECODE: ')), ' ');
switch ($action) {
    case 'code':
        $code = trim(readline('Enter long URL: '), " ");
        if (!trim($code, ' ')) {
            echo 'Empty field, enter Long URL' . PHP_EOL;
        } else {
            if (str_contains($code, 'https://vily/')) {
                echo 'Incorrect long URL, probably you entered short URL, check it please' . PHP_EOL;
            } else {
                $CheckExist = new CheckURL();
                $FoundV = $CheckExist->Search($UrlArray, $code);
                if ($FoundV >= 0) {
                    echo 'Short URL exists for this site, here it is:' . PHP_EOL;
                    echo "Short URL from our DB: " . $UrlArray[$FoundV - 1] . PHP_EOL;
                } elseif ($FoundV === -1) {
                    echo 'Short URL not exists in our DB. We are checking what we could do......' . PHP_EOL;
                    try {
                        $objCode = new Enter();
                        $ShortUrlNew = $objCode->encode($code);
                        $UrlArray[] = $ShortUrlNew . PHP_EOL;
                        echo 'New generated short URL: ' . $ShortUrlNew . PHP_EOL;
                    } catch (Exception $e) {
                        echo $e->getMessage();
                        exit('Exit of program' . PHP_EOL);
                    }
                    $UrlArray[] = $code . PHP_EOL;
                    $exist = new Exist($code);
                    $ff = new WriteFile($UrlArray);
                }
                break;
            }
        }
        break;
    case 'decode':
        $decode = trim(readline('Enter sort URL: '), " ");
        if (!trim($decode, ' ')) {
            echo 'Empty field, enter Short URL' . PHP_EOL;
        } else {
            if (str_contains($decode, 'https://vily/')) {
                try {
                    $ValidateShort = new OutPut();
                } catch (Exception $e) {
                    echo $e->getMessage();
                    exit('Exit of program' . PHP_EOL);
                }
                echo $ValidateShort->decode($decode);
                $CheckExist = new CheckURL();
                $FoundValDe = $CheckExist->Search($UrlArray, $decode);
                echo "Long URL: {$UrlArray[$FoundValDe+1]} which correspond short ULR: $UrlArray[$FoundValDe]";
            } else {
                echo 'Incorrect short URL' . PHP_EOL;
            }

        }
        break;
    default:
        echo 'We do not understand your request, make sure you provide correct info, choose CODE or DECODE' . PHP_EOL;
}
echo 'Finish program, Bye' . PHP_EOL;
echo '*******************' . PHP_EOL;
