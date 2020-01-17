<?php
    $app->post('/v1/login', function($request) {
        require __DIR__.'/../src/connect.php';

        $val01      = $request->getParsedBody()['login_parm01'];
        $val02      = $request->getParsedBody()['login_parm02'];
        $val03      = $request->getParsedBody()['login_parm03'];
        $val04      = $request->getParsedBody()['login_parm04'];
        $val05      = $request->getParsedBody()['login_parm05'];
        $val06      = $request->getParsedBody()['login_parm06'];
        $val07      = $request->getParsedBody()['login_parm07'];
        $val08      = $request->getParsedBody()['login_parm08'];

        $pass       = getContrasenha($val01, $val02);

        if (isset($val01) && isset($val02) && isset($val03) && isset($val04)) {
            $sql00  = "SELECT
            a.ClUsu                 AS      login_usuario,
            a.ClCon                 AS      login_contrasenha,
            a.FuCod                 AS      login_funcionario_codigo,
            a.ClNom                 AS      login_funcionario_nombre,

            b.COD_CARGO             AS      login_cargo_codigo,
            b.CARGO                 AS      login_cargo_nombre,
            b.COD_GERENCIA          AS      login_gerencia_codigo,
            b.GERENCIA              AS      login_gerencia_nombre,
            b.COD_DEPARTAMENTO_AREA AS      login_departamento_codigo,
            b.DEPARTAMENTO          AS      login_departamento_nombre,
            b.COD_UNIDAD            AS      login_unidad_codigo,
            b.UNIDAD                AS      login_unidad_nombre,
            b.COD_SUPERVISION       AS      login_supervision_codigo,
            b.SUPERVISION           AS      login_supervision_nombre,
            b.FOTO_TARGET           AS      login_foto,
            b.CORREO_ELECTRONICO    AS      login_email

            FROM FSD050 a
			INNER JOIN COLABORADOR_BASICOS b ON a.FuCod = b.COD_FUNC

            WHERE a.ClUsu = ?
            
            ORDER BY a.FuCod";

            $sql01  = "INSERT INTO FUNLOG (FUNLOGEST, FUNLOGUSU, FUNLOGPAS, FUNLOGSIS, FUNLOGDIR, FUNLOGHOS, FUNLOGAGE, FUNLOGREF, FUNLOGAFH) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

            try {
                $connMSSQL  = getConnectionMSSQLv1();
                $connMYSQL  = getConnectionMYSQL();

                $stmtMSSQL  = $connMSSQL->prepare($sql00);
                $stmtMYSQL  = $connMYSQL->prepare($sql01);

                $stmtMSSQL->execute([$val01]);
                
                $row_mssql  = $stmtMSSQL->fetch(PDO::FETCH_ASSOC);

                if (!$row_mssql){
                    $val00      = 'E';
                    $detalle    = array(
                        'login_usuario'             => '',
                        'login_funcionario_codigo'  => '',
                        'login_funcionario_nombre'  => '',
                        'login_cargo_codigo'        => '',
                        'login_cargo_nombre'        => '',
                        'login_gerencia_codigo'     => '',
                        'login_gerencia_nombre'     => '',
                        'login_departamento_codigo' => '',
                        'login_departamento_nombre' => '',
                        'login_unidad_codigo'       => '',
                        'login_unidad_nombre'       => '',
                        'login_supervision_codigo'  => '',
                        'login_supervision_nombre'  => '',
                        'login_foto'                => '',
                        'login_email'               => ''
                    );

                    header("Content-Type: application/json; charset=utf-8");
                    $json       = json_encode(array('code' => 201, 'status' => 'Error', 'message' => 'Error LOGIN: Usuario No Existe', 'data' => $detalle), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
                    
                } else {
                    if($row_mssql['login_contrasenha'] == $pass){
                        $val00      = 'O';
                        $detalle    = array(
                            'login_usuario'             => $row_mssql['login_usuario'],
                            'login_funcionario_codigo'  => $row_mssql['login_funcionario_codigo'],
                            'login_funcionario_nombre'  => $row_mssql['login_funcionario_nombre'],
                            'login_cargo_codigo'        => $row_mssql['login_cargo_codigo'],
                            'login_cargo_nombre'        => $row_mssql['login_cargo_nombre'],
                            'login_gerencia_codigo'     => $row_mssql['login_gerencia_codigo'],
                            'login_gerencia_nombre'     => $row_mssql['login_gerencia_nombre'],
                            'login_departamento_codigo' => $row_mssql['login_departamento_codigo'],
                            'login_departamento_nombre' => $row_mssql['login_departamento_nombre'],
                            'login_unidad_codigo'       => $row_mssql['login_unidad_codigo'],
                            'login_unidad_nombre'       => $row_mssql['login_unidad_nombre'],
                            'login_supervision_codigo'  => $row_mssql['login_supervision_codigo'],
                            'login_supervision_nombre'  => $row_mssql['login_supervision_nombre'],
                            'login_foto'                => $row_mssql['login_foto'],
                            'login_email'               => $row_mssql['login_email'],
                        );

                        header("Content-Type: application/json; charset=utf-8");
                        $json       = json_encode(array('code' => 200, 'status' => 'ok', 'message' => 'Success LOGIN', 'data' => $detalle), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
                    } else {
                        $val00      = 'I';
                        $detalle    = array(
                            'login_usuario'             => '',
                            'login_funcionario_codigo'  => '',
                            'login_funcionario_nombre'  => '',
                            'login_cargo_codigo'        => '',
                            'login_cargo_nombre'        => '',
                            'login_gerencia_codigo'     => '',
                            'login_gerencia_nombre'     => '',
                            'login_departamento_codigo' => '',
                            'login_departamento_nombre' => '',
                            'login_unidad_codigo'       => '',
                            'login_unidad_nombre'       => '',
                            'login_supervision_codigo'  => '',
                            'login_supervision_nombre'  => '',
                            'login_foto'                => '',
                            'login_email'               => ''
                        );

                        header("Content-Type: application/json; charset=utf-8");
                        $json       = json_encode(array('code' => 201, 'status' => 'Error', 'message' => 'Error LOGIN: Usuario y/o Contraseña Incorrecto', 'data' => $detalle), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
                    }
                }

                $stmtMYSQL->execute([$val00, $val01, $val02, $val03, $val04, $val05, $val06, $val07, $val08]); 
                
                $stmtMSSQL->closeCursor();
                $stmtMYSQL->closeCursor();

                $stmtMSSQL = null;
                $stmtMYSQL = null;
            } catch (PDOException $e) {
                header("Content-Type: application/json; charset=utf-8");
                $json = json_encode(array('code' => 204, 'status' => 'failure', 'message' => 'Error LOGIN: '.$e), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
            }
        } else {
            header("Content-Type: application/json; charset=utf-8");
            $json = json_encode(array('code' => 400, 'status' => 'error', 'message' => 'Verifique, algún campo esta vacio.'), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
        }

        $connMSSQL  = null;
        $connMYSQL  = null;
        
        return $json;
    });

    $app->post('/v2/login', function($request) {
        require __DIR__.'/../src/connect.php';

        $val01      = $request->getParsedBody()['login_parm01'];
        $val02      = $request->getParsedBody()['login_parm02'];
        $val03      = $request->getParsedBody()['login_parm03'];
        $val04      = $request->getParsedBody()['login_parm04'];
        $val05      = $request->getParsedBody()['login_parm05'];
        $val06      = $request->getParsedBody()['login_parm06'];
        $val07      = $request->getParsedBody()['login_parm07'];
        $val08      = $request->getParsedBody()['login_parm08'];

        $pass       = getContrasenha($val01, $val02);

        if (isset($val01) && isset($val02) && isset($val03) && isset($val04)) {
            $sql00  = "SELECT
            a.ClUsu                 AS      login_usuario,
            a.ClCon                 AS      login_contrasenha,
            a.FuCod                 AS      login_funcionario_codigo,
            a.ClNom                 AS      login_funcionario_nombre,

            b.COD_CARGO             AS      login_cargo_codigo,
            b.CARGO                 AS      login_cargo_nombre,
            b.COD_GERENCIA          AS      login_gerencia_codigo,
            b.GERENCIA              AS      login_gerencia_nombre,
            b.COD_DEPARTAMENTO_AREA AS      login_departamento_codigo,
            b.DEPARTAMENTO          AS      login_departamento_nombre,
            b.COD_UNIDAD            AS      login_unidad_codigo,
            b.UNIDAD                AS      login_unidad_nombre,
            b.COD_SUPERVISION       AS      login_supervision_codigo,
            b.SUPERVISION           AS      login_supervision_nombre,
            b.FOTO_TARGET           AS      login_foto,
            b.CORREO_ELECTRONICO    AS      login_email

            FROM FSD050 a
			INNER JOIN COLABORADOR_BASICOS b ON a.FuCod = b.COD_FUNC

            WHERE a.ClUsu = ?
            
            ORDER BY a.FuCod";

            $sql01  = "INSERT INTO FUNLOG (FUNLOGEST, FUNLOGUSU, FUNLOGPAS, FUNLOGSIS, FUNLOGDIR, FUNLOGHOS, FUNLOGAGE, FUNLOGREF, FUNLOGAFH) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

            try {
                $connMSSQL  = getConnectionMSSQLv2();
                $connMYSQL  = getConnectionMYSQL();

                $stmtMSSQL  = $connMSSQL->prepare($sql00);
                $stmtMYSQL  = $connMYSQL->prepare($sql01);

                $stmtMSSQL->execute([$val01]);
                
                $row_mssql  = $stmtMSSQL->fetch(PDO::FETCH_ASSOC);

                if (!$row_mssql){
                    $val00      = 'E';
                    $detalle    = array(
                        'login_usuario'             => '',
                        'login_funcionario_codigo'  => '',
                        'login_funcionario_nombre'  => '',
                        'login_cargo_codigo'        => '',
                        'login_cargo_nombre'        => '',
                        'login_gerencia_codigo'     => '',
                        'login_gerencia_nombre'     => '',
                        'login_departamento_codigo' => '',
                        'login_departamento_nombre' => '',
                        'login_unidad_codigo'       => '',
                        'login_unidad_nombre'       => '',
                        'login_supervision_codigo'  => '',
                        'login_supervision_nombre'  => '',
                        'login_foto'                => '',
                        'login_email'               => ''
                    );

                    header("Content-Type: application/json; charset=utf-8");
                    $json       = json_encode(array('code' => 201, 'status' => 'Error', 'message' => 'Error LOGIN: Usuario No Existe', 'data' => $detalle), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
                    
                } else {
                    if($row_mssql['login_contrasenha'] == $pass){
                        $val00      = 'O';
                        $detalle    = array(
                            'login_usuario'             => $row_mssql['login_usuario'],
                            'login_funcionario_codigo'  => $row_mssql['login_funcionario_codigo'],
                            'login_funcionario_nombre'  => $row_mssql['login_funcionario_nombre'],
                            'login_cargo_codigo'        => $row_mssql['login_cargo_codigo'],
                            'login_cargo_nombre'        => $row_mssql['login_cargo_nombre'],
                            'login_gerencia_codigo'     => $row_mssql['login_gerencia_codigo'],
                            'login_gerencia_nombre'     => $row_mssql['login_gerencia_nombre'],
                            'login_departamento_codigo' => $row_mssql['login_departamento_codigo'],
                            'login_departamento_nombre' => $row_mssql['login_departamento_nombre'],
                            'login_unidad_codigo'       => $row_mssql['login_unidad_codigo'],
                            'login_unidad_nombre'       => $row_mssql['login_unidad_nombre'],
                            'login_supervision_codigo'  => $row_mssql['login_supervision_codigo'],
                            'login_supervision_nombre'  => $row_mssql['login_supervision_nombre'],
                            'login_foto'                => $row_mssql['login_foto'],
                            'login_email'               => $row_mssql['login_email'],
                        );

                        header("Content-Type: application/json; charset=utf-8");
                        $json       = json_encode(array('code' => 200, 'status' => 'ok', 'message' => 'Success LOGIN', 'data' => $detalle), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
                    } else {
                        $val00      = 'I';
                        $detalle    = array(
                            'login_usuario'             => '',
                            'login_funcionario_codigo'  => '',
                            'login_funcionario_nombre'  => '',
                            'login_cargo_codigo'        => '',
                            'login_cargo_nombre'        => '',
                            'login_gerencia_codigo'     => '',
                            'login_gerencia_nombre'     => '',
                            'login_departamento_codigo' => '',
                            'login_departamento_nombre' => '',
                            'login_unidad_codigo'       => '',
                            'login_unidad_nombre'       => '',
                            'login_supervision_codigo'  => '',
                            'login_supervision_nombre'  => '',
                            'login_foto'                => '',
                            'login_email'               => ''
                        );

                        header("Content-Type: application/json; charset=utf-8");
                        $json       = json_encode(array('code' => 201, 'status' => 'Error', 'message' => 'Error LOGIN: Usuario y/o Contraseña Incorrecto', 'data' => $detalle), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
                    }
                }

                $stmtMYSQL->execute([$val00, $val01, $val02, $val03, $val04, $val05, $val06, $val07, $val08]); 
                
                $stmtMSSQL->closeCursor();
                $stmtMYSQL->closeCursor();

                $stmtMSSQL = null;
                $stmtMYSQL = null;
            } catch (PDOException $e) {
                header("Content-Type: application/json; charset=utf-8");
                $json = json_encode(array('code' => 204, 'status' => 'failure', 'message' => 'Error LOGIN: '.$e), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
            }
        } else {
            header("Content-Type: application/json; charset=utf-8");
            $json = json_encode(array('code' => 400, 'status' => 'error', 'message' => 'Verifique, algún campo esta vacio.'), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
        }

        $connMSSQL  = null;
        $connMYSQL  = null;
        
        return $json;
    });