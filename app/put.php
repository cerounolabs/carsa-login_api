<?php
    $app->put('/v1/login/contrasehna', function($request) {
        require __DIR__.'/../src/connect.php';

        $val01      = strtoupper(trim($request->getParsedBody()['login_parm01']));
        $val02      = $request->getParsedBody()['login_parm02'];
        $val03      = $request->getParsedBody()['login_parm03'];
        $val04      = $request->getParsedBody()['login_parm04'];
        $val05      = $request->getParsedBody()['login_parm05'];
        $val06      = $request->getParsedBody()['login_parm06'];
        $val07      = $request->getParsedBody()['login_parm07'];
        $val08      = $request->getParsedBody()['login_parm08'];
        $val09      = $request->getParsedBody()['login_parm09'];
        $fecAct     = date('Y-m-d');
        $horAct     = date('H:m:i');

        $sql00      = "SELECT a.ClUsu AS user_usuario, a.ClCon AS user_contrasenha FROM FSD050 a WHERE a.ClUsu = ?";
        $sql01      = "SELECT * FROM HISTCON WHERE HSTCLUSU = ? AND HSTCLCON = ?";
        $sql02      = "SELECT a.FGParamVE AS parametro_dias FROM FGPARAM a WHERE a.FGParamNum = 5000500";
        $sql03      = "INSERT INTO HISTCON 
        (HSTCLUSU, HSTCLSEC, HSTCLCON, HSTCLNCO, HSTFCHIN, HSTFCHFN, HSTAFCH, HSTAHS, HSTAUS, HSTAPC) VALUES 
        (?, (SELECT (MAX(a.HstClSec)+1) FROM HISTCON a WHERE a.HSTCLUSU = ?), ?, ?, ?, ?, date('Y-m-d'), date('H:m:i'), ?, ?)";
        $sql04      = "UPDATE FSD050 SET CLCON = ?, CLFCHVCI = ?, CLFCHVCF = ? WHERE CLUSU = ? AND CLCON = ?";

        $banPass = getContrasenhaVal($val01, $val03);

        if ($banPass == true) {
            $passOld    = getContrasenhaEncr($val01, $val02);
            $passNew    = getContrasenhaEncr($val01, $val03);

            if (isset($val01) && isset($val02) && isset($val03) && isset($val04) && isset($val05) && isset($pass)) {
                try {
                    $connMSSQL      = getConnectionMSSQLv1();
                    $stmtMSSQL00    = $connMSSQL->prepare($sql00);
                    $stmtMSSQL00->execute([$val01]);
                    $row_mssql00    = $stmtMSSQL00->fetch(PDO::FETCH_ASSOC);

                    if (!$row_mssql00){
                        header("Content-Type: application/json; charset=utf-8");
                        $json = json_encode(array('code' => 401, 'status' => 'Error', 'message' => 'Error LOGIN: Usuario No Existe'), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
                    } else {
                        if($row_mssql00['user_contrasenha'] == $passOld) {
                            $stmtMSSQL01  = $connMSSQL->prepare($sql01);
                            $stmtMSSQL01->execute([$val01, $val03]);
                            $row_mssql01  = $stmtMSSQL01->fetch(PDO::FETCH_ASSOC);

                            if (!$row_mssql01){
                                $stmtMSSQL02= $connMSSQL->prepare($sql02);
                                $stmtMSSQL02->execute();
                                $row_mssql02= $stmtMSSQL02->fetch(PDO::FETCH_ASSOC);
                                $datEnd     = date('Y-m-d', strtotime($fecAct.'+ '.$row_mssql02['parametro_dias'].' day'));

                                $stmtMSSQL03= $connMSSQL->prepare($sql03);
                                $stmtMSSQL03->execute([$val01, $val01, $passOld, $passNew, ]);
                            } else {
                                header("Content-Type: application/json; charset=utf-8");
                                $json = json_encode(array('code' => 401, 'status' => 'Error', 'message' => 'Verifique, la contraseña es igual a alguna de las anteriores, favor modificar.!'), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
                            }
                        } else {
                            header("Content-Type: application/json; charset=utf-8");
                            $json = json_encode(array('code' => 401, 'status' => 'Error', 'message' => 'Error LOGIN: Usuario y/o Contraseña Incorrecto'), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
                        }
                    }

                    $stmtMSSQL00->closeCursor();

                    $stmtMSSQL00 = null;
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

        $connMSSQL  = null;
        
        return $json;
    });