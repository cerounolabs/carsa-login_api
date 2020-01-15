<?php
    function getConnectionMSSQL(){
        $serverName = "SRVDESA01";
        $serverPort = "1433";
        $serverDb   = "DESTRASJUD";
        $serverUser = "czelaya";
        $serverPass = "carsa_2019";
        
        try {
            $conn = new PDO("sqlsrv:Server=$serverName,$serverPort;Database=$serverDb;ConnectionPooling=0", $serverUser, $serverPass,
                array(
                    PDO::ATTR_PERSISTENT => false,
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
                )
            );
        } catch (PDOException $e) {
            header("Content-Type: application/json; charset=utf-8");
            echo json_encode(array('code' => 204, 'status' => 'failure', 'message' => 'Error Connecting to MSSQL: '.$e), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
            die();
        }

        return $conn;
    }

    function getConnectionMYSQL(){
        $serverName = "192.168.16.17";
        $serverPort = "3306";
        $serverDb   = "carsa_login";
        $serverUser = "talento_admin";
        $serverPass = "dlFGaCp2v48iPjHK";
        
        try {
            $conn = new PDO("mysql:host=$serverName;port=$serverPort;dbname=$serverDb;charset=utf8", $serverUser, $serverPass,
                array(
                    PDO::ATTR_PERSISTENT => true,
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
                )
            );
        } catch (PDOException $e) {
            header("Content-Type: application/json; charset=utf-8");
            echo json_encode(array('code' => 204, 'status' => 'failure', 'message' => 'Error Connecting to MYSQL: '.$e), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
            die();
        }

        return $conn;
    }

    function getContrasenha($var01, $var02){
        $usuLen     = strlen($var01);
        $pasLen     = strlen($var02);
        $result     = '';
        
        $usuArray   = array(
            "A" => 92, "B" => 66, "C" => 51, "D" => 70, "E" => 45, "F" => 76, "G" => 37, "H" => 64, "I" => 83, "J" => 33, "K" => 86, "L" => 97, "M" => 67, "N" => 71, "O" => 89, "P" => 61, "Q" => 57, "R" => 25, "S" => 94, "T" => 62, "U" => 99, "V" => 35, "W" => 87, "X" => 53, "Y" => 74, "Z" => 88, 
            "0" => 41, "1" => 38, "2" => 90, "3" => 93, "4" => 95, "5" => 98, "6" => 81, "7" => 84, "8" => 85, "9" => 72, " " => 75
        );

        $pasArray   = array(
            "A" => 54, "B" => 85, "C" => 92, "D" => 78, "E" => 97, "F" => 47, "G" => 91, "H" => 68, "I" => 44, "J" => 82, "K" => 58, "L" => 99, "M" => 83, "N" => 74, "O" => 73, "P" => 79, "Q" => 65, "R" => 95, "S" => 12, "T" => 51, "U" => 42, "V" => 77, "W" => 39, "X" => 86, "Y" => 75, "Z" => 59,
            "0" => 93, "1" => 98, "2" => 80, "3" =>  8, "4" =>  7, "5" =>  5, "6" => 23, "7" => 21, "8" => 31, "9" => 45, " " => 43,
            "a" => 11, "b" => 13, "c" => 28, "d" => 34, "e" =>  3, "f" => 17, "g" => 63, "h" => 10, "i" => 27, "j" => 24, "k" => 32, "l" => 18, "m" => 53, "n" => 26, "o" => 66, "p" => 15, "q" => 37, "r" => 22, "s" => 49, "t" => 36, "u" => 20, "v" => 52, "w" => 25, "x" => 14, "y" => 50, "z" => 33,
            "*" => 19, "-" =>  1, "+" => 16, "/" => 56, "." => 29, "_" => 40, "#" => 48, "&" =>  2, "@" => 30, ";" => 51, "," => 90, "$" =>  4, "!" =>  6
        );

        for ($i = 0; $i < 10; $i++) { 
            $usuIndex   = 0;
            $pasIndex   = 0;

            if ($i < $usuLen){
                $usuIndex   = substr($var01, $i, 1);
                $usuData    = $usuArray[$usuIndex];
            } else {
                $usuIndex   = '';
                $usuData    = 75;
            }

            if ($i < $pasLen){
                $pasIndex   = substr($var02, $i, 1);
                $pasData    = $pasArray[$pasIndex];
            } else {
                $pasIndex   = '';
                $pasData    = 43;
            }

            $resSuma = $usuData + $pasData;

            if($resSuma < 10){
                $resData = '  '.(string)$resSuma;
            }elseif ($resSuma > 9 && $resSuma < 100){
                $resData = ' '.(string)$resSuma;
            }elseif ($resSuma > 99){
                $resData = ''.(string)$resSuma;
            }

            $result = $result.''.$resData;
        }

        return $result;
    }