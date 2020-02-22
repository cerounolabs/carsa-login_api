<?php
    $app->put('/v1/login/contrasehna', function($request) {
        require __DIR__.'/../src/connect.php';

        $val01      = $request->getParsedBody()['login_parm01'];
        $val02      = $request->getParsedBody()['login_parm02'];
        $val03      = $request->getParsedBody()['login_parm03'];
        $val04      = $request->getParsedBody()['login_parm04'];
        $val05      = $request->getParsedBody()['login_parm05'];
        $val06      = $request->getParsedBody()['login_parm06'];
        $val07      = $request->getParsedBody()['login_parm07'];
        $val08      = $request->getParsedBody()['login_parm08'];
        $val09      = $request->getParsedBody()['login_parm09'];

        $sql00      = 'SELECT * FROM HISTCON WHERE HSTCLUSU = ? AND HSTCLCON = ?'
        $sql01      = 'UPDATE ';

        if ($val02 == $val03) {
            $banPass = getContrasenhaVal($val01, $val02);

            if ($banPass == true) {
                $pass    = getContrasenhaEncr($val01, $val02);

                if (isset($val01) && isset($val02) && isset($val03) && isset($val04) && isset($val05) && isset($pass)) {
                    try {
                        $connMSSQL  = getConnectionMSSQLv1();
                        $stmtMSSQL  = $connMSSQL->prepare($sql00);
                        $stmtMSSQL->execute([$val01, $val03]);
                        $row_mssql  = $stmtMSSQL->fetch(PDO::FETCH_ASSOC);

                        if ($row_mssql){
                            header("Content-Type: application/json; charset=utf-8");
                            $json = json_encode(array('code' => 401, 'status' => 'Error', 'message' => 'Verifique, la contraseña es igual a alguna de las anteriores, favor modificar.!'), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
                        } else {
                            header("Content-Type: application/json; charset=utf-8");
                            $json = json_encode(array('code' => 201, 'status' => 'Error', 'message' => 'Error LOGIN: Usuario y/o Contraseña Incorrecto', 'data' => $detalle), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
                        }

                        $stmtMSSQL->closeCursor();

                        $stmtMSSQL = null;
                    } catch (PDOException $e) {
                        header("Content-Type: application/json; charset=utf-8");
                        $json = json_encode(array('code' => 401, 'status' => 'failure', 'message' => 'Error LOGIN: '.$e), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
                    }
                } else {
                    header("Content-Type: application/json; charset=utf-8");
                    $json = json_encode(array('code' => 400, 'status' => 'error', 'message' => 'Verifique, algún campo esta vacio.'), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
                }
            } else {
                header("Content-Type: application/json; charset=utf-8");
                $json = json_encode(array('code' => 401, 'status' => 'error', 'message' => 'Verifique, la contraseña nueva no es segura.! Debe estar compuesta por al menos: \n 1 Mayúscula. \n 1 Minúscula. \n 1 Número. \n 1 Caracter Especial (*,-+/._#&@;$!).'), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
            }
        } else {
            header("Content-Type: application/json; charset=utf-8");
            $json = json_encode(array('code' => 401, 'status' => 'error', 'message' => 'Verifique, las contraseñas no son identicas.'), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
        }

        $connMSSQL  = null;
        
        return $json;
    });