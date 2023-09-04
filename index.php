<?php
require_once 'autoload.php';

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
                    echo $ValidateShort->decode($decode);
                } catch (Exception $e) {
                    echo $e->getMessage();
                    exit('Exit of program' . PHP_EOL);
                }
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
