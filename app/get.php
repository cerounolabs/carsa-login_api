<?php
    $app->get('/v1/100/cargo', function($request) {
        require __DIR__.'/../src/connect.php';

        $sql00  = "SELECT
        DISTINCT(a.COD_CARGO)           AS          tipo_cargo_codigo,
        a.CARGO                         AS          tipo_cargo_nombre

        FROM COLABORADOR_BASICOS a
        ORDER BY a.COD_CARGO";

        try {
            $connMSSQL  = getConnectionMSSQLv1();
            $stmtMSSQL  = $connMSSQL->prepare($sql00);
            $stmtMSSQL->execute();

            while ($rowMSSQL = $stmtMSSQL->fetch()) {                
                $detalle    = array(
                    'tipo_cargo_codigo'                                  => $rowMSSQL['tipo_cargo_codigo'],
                    'tipo_cargo_nombre'                                  => strtoupper($rowMSSQL['tipo_cargo_nombre'])
                );

                $result[]   = $detalle;
            }

            if (isset($result)){
                header("Content-Type: application/json; charset=utf-8");
                $json = json_encode(array('code' => 200, 'status' => 'ok', 'message' => 'Success SELECT', 'data' => $result), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
            } else {
                $detalle = array(
                    'tipo_cargo_codigo'                                        => '',
                    'tipo_cargo_nombre'                                       => ''
                );

                header("Content-Type: application/json; charset=utf-8");
                $json = json_encode(array('code' => 204, 'status' => 'ok', 'message' => 'No hay registros', 'data' => $detalle), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
            }

            $stmtMSSQL->closeCursor();
            $stmtMSSQL = null;
        } catch (PDOException $e) {
            header("Content-Type: application/json; charset=utf-8");
            $json = json_encode(array('code' => 204, 'status' => 'failure', 'message' => 'Error SELECT: '.$e), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
        }

        $connMSSQL  = null;
        
        return $json;
    });

    $app->get('/v1/100/jerarquia', function($request) {
        require __DIR__.'/../src/connect.php';

        $sql00  = "SELECT
        DISTINCT(a.COD_JERARQUIA)           AS          tipo_jerarquia_codigo,
        a.JERARQUIA                         AS          tipo_jerarquia_nombre

        FROM COLABORADOR_BASICOS a
        ORDER BY a.COD_JERARQUIA";

        try {
            $connMSSQL  = getConnectionMSSQLv1();
            $stmtMSSQL  = $connMSSQL->prepare($sql00);
            $stmtMSSQL->execute();

            while ($rowMSSQL = $stmtMSSQL->fetch()) {                
                $detalle    = array(
                    'tipo_jerarquia_codigo'         => $rowMSSQL['tipo_jerarquia_codigo'],
                    'tipo_jerarquia_nombre'         => strtoupper($rowMSSQL['tipo_jerarquia_nombre'])
                );

                $result[]   = $detalle;
            }

            if (isset($result)){
                header("Content-Type: application/json; charset=utf-8");
                $json = json_encode(array('code' => 200, 'status' => 'ok', 'message' => 'Success SELECT', 'data' => $result), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
            } else {
                $detalle = array(
                    'tipo_jerarquia_codigo'         => '',
                    'tipo_jerarquia_nombre'         => ''
                );

                header("Content-Type: application/json; charset=utf-8");
                $json = json_encode(array('code' => 204, 'status' => 'ok', 'message' => 'No hay registros', 'data' => $detalle), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
            }

            $stmtMSSQL->closeCursor();
            $stmtMSSQL = null;
        } catch (PDOException $e) {
            header("Content-Type: application/json; charset=utf-8");
            $json = json_encode(array('code' => 204, 'status' => 'failure', 'message' => 'Error SELECT: '.$e), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
        }

        $connMSSQL  = null;
        
        return $json;
    });

    $app->get('/v1/100/departamento', function($request) {
        require __DIR__.'/../src/connect.php';

        $sql00  = "SELECT
        DISTINCT(a.COD_DEPARTAMENTO_AREA)           AS          tipo_departamento_codigo,
        a.DEPARTAMENTO                              AS          tipo_departamento_nombre

        FROM COLABORADOR_BASICOS a
        ORDER BY a.COD_DEPARTAMENTO_AREA";

        try {
            $connMSSQL  = getConnectionMSSQLv1();
            $stmtMSSQL  = $connMSSQL->prepare($sql00);
            $stmtMSSQL->execute();

            while ($rowMSSQL = $stmtMSSQL->fetch()) {                
                $detalle    = array(
                    'tipo_departamento_codigo'         => $rowMSSQL['tipo_departamento_codigo'],
                    'tipo_departamento_nombre'         => strtoupper($rowMSSQL['tipo_departamento_nombre'])
                );

                $result[]   = $detalle;
            }

            if (isset($result)){
                header("Content-Type: application/json; charset=utf-8");
                $json = json_encode(array('code' => 200, 'status' => 'ok', 'message' => 'Success SELECT', 'data' => $result), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
            } else {
                $detalle = array(
                    'tipo_departamento_codigo'         => '',
                    'tipo_departamento_nombre'         => ''
                );

                header("Content-Type: application/json; charset=utf-8");
                $json = json_encode(array('code' => 204, 'status' => 'ok', 'message' => 'No hay registros', 'data' => $detalle), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
            }

            $stmtMSSQL->closeCursor();
            $stmtMSSQL = null;
        } catch (PDOException $e) {
            header("Content-Type: application/json; charset=utf-8");
            $json = json_encode(array('code' => 204, 'status' => 'failure', 'message' => 'Error SELECT: '.$e), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
        }

        $connMSSQL  = null;
        
        return $json;
    });

    $app->get('/v1/400/colaborador', function($request) {
        require __DIR__.'/../src/connect.php';

        $sql00  = "SELECT
        a.COD_FUNC                      AS          funcionario_codigo,
        a.USUARIO                       AS          funcionario_usuario,
        a.NOMBRE_Y_APELLIDO             AS          funcionario_completo,
        a.NRO_CEDULA                    AS          funcionario_documento,
        a.FEC_NACIMIENTO                AS          funcionario_fecha_nacimiento,
        a.EDAD                          AS          funcionario_edad,
        a.SEXO                          AS          funcionario_sexo,
        a.ESTADO_CIVIL                  AS          funcionario_estado_civil,
        a.NACIONALIDAD                  AS          funcionario_nacionalidad,
        a.CORREO_ELECTRONICO            AS          funcionario_email,
        a.FECHA_INGRESO                 AS          funcionario_fecha_ingreso,
        a.COD_CARGO                     AS          funcionario_cargo_codigo,
        a.CARGO                         AS          funcionario_cargo_nombre,
        a.COD_GERENCIA                  AS          funcionario_gerencia_codigo,
        a.GERENCIA                      AS          funcionario_gerencia_nombre,
        a.COD_DEPARTAMENTO_AREA         AS          funcionario_deparmento_codigo,
        a.DEPARTAMENTO                  AS          funcionario_deparmento_nombre,
        a.COD_JERARQUIA                 AS          funcionario_jerarquia_codigo,
        a.JERARQUIA                     AS          funcionario_jerarquia_nombre,
        a.COD_DEPARTAMENTO_AREA         AS          funcionario_departamento_codigo,
        a.DEPARTAMENTO                  AS          funcionario_departamento_nombre,
        a.COD_UNIDAD                    AS          funcionario_unidad_codigo,
        a.UNIDAD                        AS          funcionario_unidad_nombre,
        a.COD_SUPERVISION               AS          funcionario_supervision_codigo,
        a.SUPERVISION                   AS          funcionario_supervision_nombre,
        a.COD_SUPERIOR_INMEDIATO        AS          funcionario_superior_codigo,
        a.SUPERIOR_INMEDIATO            AS          funcionario_superior_nombre,
        a.FOTO_TARGET                   AS          funcionario_foto,
        a.ANTIGUEDAD                    AS          funcionario_antiguedad

        FROM COLABORADOR_BASICOS a
        ORDER BY a.COD_FUNC";

        try {
            $connMSSQL  = getConnectionMSSQLv1();
            $stmtMSSQL  = $connMSSQL->prepare($sql00);
            $stmtMSSQL->execute([]);

            while ($rowMSSQL = $stmtMSSQL->fetch()) {
                if (isset($rowMSSQL['funcionario_foto'])) {
                    $funcionario_foto = strtolower($rowMSSQL['funcionario_foto']);
                } else {
                    $funcionario_foto = '../assets/images/users/photo.png';
                }
                
                $detalle    = array(
                    'funcionario_codigo'                                        => $rowMSSQL['funcionario_codigo'],
                    'funcionario_usuario'                                       => strtoupper($rowMSSQL['funcionario_usuario']),
                    'funcionario_completo'                                      => strtoupper($rowMSSQL['funcionario_completo']),
                    'funcionario_documento'                                     => strtoupper($rowMSSQL['funcionario_documento']),
                    'funcionario_fecha_nacimiento'                              => date("d/m/Y", strtotime($rowMSSQL['funcionario_fecha_nacimiento'])),
                    'funcionario_edad'                                          => $rowMSSQL['funcionario_edad'],
                    'funcionario_sexo'                                          => strtoupper($rowMSSQL['funcionario_sexo']),
                    'funcionario_estado_civil'                                  => strtoupper($rowMSSQL['funcionario_estado_civil']),
                    'funcionario_nacionalidad'                                  => strtoupper($rowMSSQL['funcionario_nacionalidad']),
                    'funcionario_email'                                         => strtolower($rowMSSQL['funcionario_email']),
                    'funcionario_fecha_ingreso'                                 => date("d/m/Y", strtotime($rowMSSQL['funcionario_fecha_ingreso'])),
                    'funcionario_cargo_codigo'                                  => $rowMSSQL['funcionario_cargo_codigo'],
                    'funcionario_cargo_nombre'                                  => strtoupper($rowMSSQL['funcionario_cargo_nombre']),
                    'funcionario_gerencia_codigo'                               => $rowMSSQL['funcionario_gerencia_codigo'],
                    'funcionario_gerencia_nombre'                               => strtoupper($rowMSSQL['funcionario_gerencia_nombre']),
                    'funcionario_deparmento_codigo'                             => $rowMSSQL['funcionario_deparmento_codigo'],
                    'funcionario_deparmento_nombre'                             => strtoupper($rowMSSQL['funcionario_deparmento_nombre']),
                    'funcionario_unidad_codigo'                                 => $rowMSSQL['funcionario_unidad_codigo'],
                    'funcionario_unidad_nombre'                                 => strtoupper($rowMSSQL['funcionario_unidad_nombre']),
                    'funcionario_supervision_codigo'                            => $rowMSSQL['funcionario_supervision_codigo'],
                    'funcionario_supervision_nombre'                            => strtoupper($rowMSSQL['funcionario_supervision_nombre']),
                    'funcionario_superior_codigo'                               => $rowMSSQL['funcionario_superior_codigo'],
                    'funcionario_superior_nombre'                               => strtoupper($rowMSSQL['funcionario_superior_nombre']),
                    'funcionario_foto'                                          => $funcionario_foto,
                    'funcionario_antiguedad'                                    => strtoupper($rowMSSQL['funcionario_antiguedad'])
                );

                $result[]   = $detalle;
            }

            if (isset($result)){
                header("Content-Type: application/json; charset=utf-8");
                $json = json_encode(array('code' => 200, 'status' => 'ok', 'message' => 'Success SELECT', 'data' => $result), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
            } else {
                $detalle = array(
                    'funcionario_codigo'                                        => '',
                    'funcionario_usuario'                                       => '',
                    'funcionario_completo'                                      => '',
                    'funcionario_documento'                                     => '',
                    'funcionario_fecha_nacimiento'                              => '',
                    'funcionario_edad'                                          => '',
                    'funcionario_sexo'                                          => '',
                    'funcionario_estado_civil'                                  => '',
                    'funcionario_nacionalidad'                                  => '',
                    'funcionario_email'                                         => '',
                    'funcionario_fecha_ingreso'                                 => '',
                    'funcionario_cargo_codigo'                                  => '',
                    'funcionario_cargo_nombre'                                  => '',
                    'funcionario_gerencia_codigo'                               => '',
                    'funcionario_gerencia_nombre'                               => '',
                    'funcionario_deparmento_codigo'                             => '',
                    'funcionario_deparmento_nombre'                             => '',
                    'funcionario_unidad_codigo'                                 => '',
                    'funcionario_unidad_nombre'                                 => '',
                    'funcionario_supervision_codigo'                            => '',
                    'funcionario_supervision_nombre'                            => '',
                    'funcionario_superior_codigo'                               => '',
                    'funcionario_superior_nombre'                               => '',
                    'funcionario_foto'                                          => '../assets/images/users/photo.png',
                    'funcionario_antiguedad'                                    => ''
                );

                header("Content-Type: application/json; charset=utf-8");
                $json = json_encode(array('code' => 204, 'status' => 'ok', 'message' => 'No hay registros', 'data' => $detalle), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
            }

            $stmtMSSQL->closeCursor();
            $stmtMSSQL = null;
        } catch (PDOException $e) {
            header("Content-Type: application/json; charset=utf-8");
            $json = json_encode(array('code' => 204, 'status' => 'failure', 'message' => 'Error SELECT: '.$e), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
        }

        $connMSSQL  = null;
        
        return $json;
    });

    $app->get('/v1/400/colaborador/{codigo}', function($request) {
        require __DIR__.'/../src/connect.php';

        $val01      = $request->getAttribute('codigo');
        
        if (isset($val01)) {
            $sql00  = "SELECT
            a.COD_FUNC                      AS          funcionario_codigo,
            a.USUARIO                       AS          funcionario_usuario,
            a.NOMBRE_Y_APELLIDO             AS          funcionario_completo,
            a.NRO_CEDULA                    AS          funcionario_documento,
            a.FEC_NACIMIENTO                AS          funcionario_fecha_nacimiento,
            a.EDAD                          AS          funcionario_edad,
            a.SEXO                          AS          funcionario_sexo,
            a.ESTADO_CIVIL                  AS          funcionario_estado_civil,
            a.NACIONALIDAD                  AS          funcionario_nacionalidad,
            a.CORREO_ELECTRONICO            AS          funcionario_email,
            a.FECHA_INGRESO                 AS          funcionario_fecha_ingreso,
            a.COD_CARGO                     AS          funcionario_cargo_codigo,
            a.CARGO                         AS          funcionario_cargo_nombre,
            a.COD_GERENCIA                  AS          funcionario_gerencia_codigo,
            a.GERENCIA                      AS          funcionario_gerencia_nombre,
            a.COD_JERARQUIA                 AS          funcionario_jerarquia_codigo,
            a.JERARQUIA                     AS          funcionario_jerarquia_nombre,
            a.COD_DEPARTAMENTO_AREA         AS          funcionario_departamento_codigo,
            a.DEPARTAMENTO                  AS          funcionario_departamento_nombre,
            a.COD_UNIDAD                    AS          funcionario_unidad_codigo,
            a.UNIDAD                        AS          funcionario_unidad_nombre,
            a.COD_SUPERVISION               AS          funcionario_supervision_codigo,
            a.SUPERVISION                   AS          funcionario_supervision_nombre,
            a.COD_SUPERIOR_INMEDIATO        AS          funcionario_superior_codigo,
            a.SUPERIOR_INMEDIATO            AS          funcionario_superior_nombre,
            a.FOTO_TARGET                   AS          funcionario_foto,
            a.ANTIGUEDAD                    AS          funcionario_antiguedad

            FROM COLABORADOR_BASICOS a
            WHERE a.COD_FUNC = ?
            ORDER BY a.COD_FUNC";

            try {
                $connMSSQL  = getConnectionMSSQLv1();
                $stmtMSSQL  = $connMSSQL->prepare($sql00);
                $stmtMSSQL->execute([$val01]);

                while ($rowMSSQL = $stmtMSSQL->fetch()) {
                    if (isset($rowMSSQL['funcionario_foto'])) {
                        $funcionario_foto = strtolower($rowMSSQL['funcionario_foto']);
                    } else {
                        $funcionario_foto = '../assets/images/users/photo.png';
                    }
                    
                    $detalle    = array(
                        'funcionario_codigo'                                        => $rowMSSQL['funcionario_codigo'],
                        'funcionario_usuario'                                       => strtoupper($rowMSSQL['funcionario_usuario']),
                        'funcionario_completo'                                      => strtoupper($rowMSSQL['funcionario_completo']),
                        'funcionario_documento'                                     => strtoupper($rowMSSQL['funcionario_documento']),
                        'funcionario_fecha_nacimiento'                              => date("d/m/Y", strtotime($rowMSSQL['funcionario_fecha_nacimiento'])),
                        'funcionario_edad'                                          => $rowMSSQL['funcionario_edad'],
                        'funcionario_sexo'                                          => strtoupper($rowMSSQL['funcionario_sexo']),
                        'funcionario_estado_civil'                                  => strtoupper($rowMSSQL['funcionario_estado_civil']),
                        'funcionario_nacionalidad'                                  => strtoupper($rowMSSQL['funcionario_nacionalidad']),
                        'funcionario_email'                                         => strtolower($rowMSSQL['funcionario_email']),
                        'funcionario_fecha_ingreso'                                 => date("d/m/Y", strtotime($rowMSSQL['funcionario_fecha_ingreso'])),
                        'funcionario_cargo_codigo'                                  => $rowMSSQL['funcionario_cargo_codigo'],
                        'funcionario_cargo_nombre'                                  => strtoupper($rowMSSQL['funcionario_cargo_nombre']),
                        'funcionario_gerencia_codigo'                               => $rowMSSQL['funcionario_gerencia_codigo'],
                        'funcionario_gerencia_nombre'                               => strtoupper($rowMSSQL['funcionario_gerencia_nombre']),
                        'funcionario_jerarquia_codigo'                              => $rowMSSQL['funcionario_jerarquia_codigo'],
                        'funcionario_jerarquia_nombre'                              => strtoupper($rowMSSQL['funcionario_jerarquia_nombre']),
                        'funcionario_departamento_codigo'                           => $rowMSSQL['funcionario_departamento_codigo'],
                        'funcionario_departamento_nombre'                           => strtoupper($rowMSSQL['funcionario_departamento_nombre']),
                        'funcionario_unidad_codigo'                                 => $rowMSSQL['funcionario_unidad_codigo'],
                        'funcionario_unidad_nombre'                                 => strtoupper($rowMSSQL['funcionario_unidad_nombre']),
                        'funcionario_supervision_codigo'                            => $rowMSSQL['funcionario_supervision_codigo'],
                        'funcionario_supervision_nombre'                            => strtoupper($rowMSSQL['funcionario_supervision_nombre']),
                        'funcionario_superior_codigo'                               => $rowMSSQL['funcionario_superior_codigo'],
                        'funcionario_superior_nombre'                               => strtoupper($rowMSSQL['funcionario_superior_nombre']),
                        'funcionario_foto'                                          => $funcionario_foto,
                        'funcionario_antiguedad'                                    => strtoupper($rowMSSQL['funcionario_antiguedad'])
                    );

                    $result[]   = $detalle;
                }

                if (isset($result)){
                    header("Content-Type: application/json; charset=utf-8");
                    $json = json_encode(array('code' => 200, 'status' => 'ok', 'message' => 'Success SELECT', 'data' => $result), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
                } else {
                    $detalle = array(
                        'funcionario_codigo'                                        => '',
                        'funcionario_usuario'                                       => '',
                        'funcionario_completo'                                      => '',
                        'funcionario_documento'                                     => '',
                        'funcionario_fecha_nacimiento'                              => '',
                        'funcionario_edad'                                          => '',
                        'funcionario_sexo'                                          => '',
                        'funcionario_estado_civil'                                  => '',
                        'funcionario_nacionalidad'                                  => '',
                        'funcionario_email'                                         => '',
                        'funcionario_fecha_ingreso'                                 => '',
                        'funcionario_cargo_codigo'                                  => '',
                        'funcionario_cargo_nombre'                                  => '',
                        'funcionario_gerencia_codigo'                               => '',
                        'funcionario_gerencia_nombre'                               => '',
                        'funcionario_deparmento_codigo'                             => '',
                        'funcionario_deparmento_nombre'                             => '',
                        'funcionario_unidad_codigo'                                 => '',
                        'funcionario_unidad_nombre'                                 => '',
                        'funcionario_supervision_codigo'                            => '',
                        'funcionario_supervision_nombre'                            => '',
                        'funcionario_superior_codigo'                               => '',
                        'funcionario_superior_nombre'                               => '',
                        'funcionario_foto'                                          => '../assets/images/users/photo.png',
                        'funcionario_antiguedad'                                    => ''
                    );

                    header("Content-Type: application/json; charset=utf-8");
                    $json = json_encode(array('code' => 204, 'status' => 'ok', 'message' => 'No hay registros', 'data' => $detalle), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
                }

                $stmtMSSQL->closeCursor();
                $stmtMSSQL = null;
            } catch (PDOException $e) {
                header("Content-Type: application/json; charset=utf-8");
                $json = json_encode(array('code' => 204, 'status' => 'failure', 'message' => 'Error SELECT: '.$e), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
            }
        } else {
            header("Content-Type: application/json; charset=utf-8");
            $json = json_encode(array('code' => 400, 'status' => 'error', 'message' => 'Verifique, algún campo esta vacio.'), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
        }

        $connMSSQL  = null;
        
        return $json;
    });

    $app->get('/v1/400/cargo/{codigo}', function($request) {
        require __DIR__.'/../src/connect.php';

        $val01      = $request->getAttribute('codigo');
        
        if (isset($val01)) {
            $sql00  = "SELECT
                a.COD_FUNC                      AS          funcionario_codigo,
                a.USUARIO                       AS          funcionario_usuario,
                a.NOMBRE_Y_APELLIDO             AS          funcionario_completo,
                a.NRO_CEDULA                    AS          funcionario_documento,
                a.FEC_NACIMIENTO                AS          funcionario_fecha_nacimiento,
                a.EDAD                          AS          funcionario_edad,
                a.SEXO                          AS          funcionario_sexo,
                a.ESTADO_CIVIL                  AS          funcionario_estado_civil,
                a.NACIONALIDAD                  AS          funcionario_nacionalidad,
                a.CORREO_ELECTRONICO            AS          funcionario_email,
                a.FECHA_INGRESO                 AS          funcionario_fecha_ingreso,
                a.COD_CARGO                     AS          funcionario_cargo_codigo,
                a.CARGO                         AS          funcionario_cargo_nombre,
                a.COD_GERENCIA                  AS          funcionario_gerencia_codigo,
                a.GERENCIA                      AS          funcionario_gerencia_nombre,
                a.COD_JERARQUIA                 AS          funcionario_jerarquia_codigo,
                a.JERARQUIA                     AS          funcionario_jerarquia_nombre,
                a.COD_DEPARTAMENTO_AREA         AS          funcionario_departamento_codigo,
                a.DEPARTAMENTO                  AS          funcionario_departamento_nombre,
                a.COD_UNIDAD                    AS          funcionario_unidad_codigo,
                a.UNIDAD                        AS          funcionario_unidad_nombre,
                a.COD_SUPERVISION               AS          funcionario_supervision_codigo,
                a.SUPERVISION                   AS          funcionario_supervision_nombre,
                a.COD_SUPERIOR_INMEDIATO        AS          funcionario_superior_codigo,
                a.SUPERIOR_INMEDIATO            AS          funcionario_superior_nombre,
                a.FOTO_TARGET                   AS          funcionario_foto,
                a.ANTIGUEDAD                    AS          funcionario_antiguedad

            FROM COLABORADOR_BASICOS a
            WHERE a.COD_CARGO = ?
            ORDER BY a.COD_FUNC";

            try {
                $connMSSQL  = getConnectionMSSQLv1();
                $stmtMSSQL  = $connMSSQL->prepare($sql00);
                $stmtMSSQL->execute([$val01]);

                while ($rowMSSQL = $stmtMSSQL->fetch()) {
                    if (isset($rowMSSQL['funcionario_foto'])) {
                        $funcionario_foto = strtolower($rowMSSQL['funcionario_foto']);
                    } else {
                        $funcionario_foto = '../assets/images/users/photo.png';
                    }
                    
                    $detalle    = array(
                        'funcionario_codigo'                                        => $rowMSSQL['funcionario_codigo'],
                        'funcionario_usuario'                                       => strtoupper($rowMSSQL['funcionario_usuario']),
                        'funcionario_completo'                                      => strtoupper($rowMSSQL['funcionario_completo']),
                        'funcionario_documento'                                     => strtoupper($rowMSSQL['funcionario_documento']),
                        'funcionario_fecha_nacimiento'                              => date("d/m/Y", strtotime($rowMSSQL['funcionario_fecha_nacimiento'])),
                        'funcionario_edad'                                          => $rowMSSQL['funcionario_edad'],
                        'funcionario_sexo'                                          => strtoupper($rowMSSQL['funcionario_sexo']),
                        'funcionario_estado_civil'                                  => strtoupper($rowMSSQL['funcionario_estado_civil']),
                        'funcionario_nacionalidad'                                  => strtoupper($rowMSSQL['funcionario_nacionalidad']),
                        'funcionario_email'                                         => strtolower($rowMSSQL['funcionario_email']),
                        'funcionario_fecha_ingreso'                                 => date("d/m/Y", strtotime($rowMSSQL['funcionario_fecha_ingreso'])),
                        'funcionario_cargo_codigo'                                  => $rowMSSQL['funcionario_cargo_codigo'],
                        'funcionario_cargo_nombre'                                  => strtoupper($rowMSSQL['funcionario_cargo_nombre']),
                        'funcionario_gerencia_codigo'                               => $rowMSSQL['funcionario_gerencia_codigo'],
                        'funcionario_gerencia_nombre'                               => strtoupper($rowMSSQL['funcionario_gerencia_nombre']),
                        'funcionario_jerarquia_codigo'                              => $rowMSSQL['funcionario_jerarquia_codigo'],
                        'funcionario_jerarquia_nombre'                              => strtoupper($rowMSSQL['funcionario_jerarquia_nombre']),
                        'funcionario_departamento_codigo'                           => $rowMSSQL['funcionario_departamento_codigo'],
                        'funcionario_departamento_nombre'                           => strtoupper($rowMSSQL['funcionario_departamento_nombre']),
                        'funcionario_unidad_codigo'                                 => $rowMSSQL['funcionario_unidad_codigo'],
                        'funcionario_unidad_nombre'                                 => strtoupper($rowMSSQL['funcionario_unidad_nombre']),
                        'funcionario_supervision_codigo'                            => $rowMSSQL['funcionario_supervision_codigo'],
                        'funcionario_supervision_nombre'                            => strtoupper($rowMSSQL['funcionario_supervision_nombre']),
                        'funcionario_superior_codigo'                               => $rowMSSQL['funcionario_superior_codigo'],
                        'funcionario_superior_nombre'                               => strtoupper($rowMSSQL['funcionario_superior_nombre']),
                        'funcionario_foto'                                          => $funcionario_foto,
                        'funcionario_antiguedad'                                    => strtoupper($rowMSSQL['funcionario_antiguedad'])
                    );

                    $result[]   = $detalle;
                }

                if (isset($result)){
                    header("Content-Type: application/json; charset=utf-8");
                    $json = json_encode(array('code' => 200, 'status' => 'ok', 'message' => 'Success SELECT', 'data' => $result), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
                } else {
                    $detalle = array(
                        'funcionario_codigo'                                        => '',
                        'funcionario_usuario'                                       => '',
                        'funcionario_completo'                                      => '',
                        'funcionario_documento'                                     => '',
                        'funcionario_fecha_nacimiento'                              => '',
                        'funcionario_edad'                                          => '',
                        'funcionario_sexo'                                          => '',
                        'funcionario_estado_civil'                                  => '',
                        'funcionario_nacionalidad'                                  => '',
                        'funcionario_email'                                         => '',
                        'funcionario_fecha_ingreso'                                 => '',
                        'funcionario_cargo_codigo'                                  => '',
                        'funcionario_cargo_nombre'                                  => '',
                        'funcionario_gerencia_codigo'                               => '',
                        'funcionario_gerencia_nombre'                               => '',
                        'funcionario_deparmento_codigo'                             => '',
                        'funcionario_deparmento_nombre'                             => '',
                        'funcionario_unidad_codigo'                                 => '',
                        'funcionario_unidad_nombre'                                 => '',
                        'funcionario_supervision_codigo'                            => '',
                        'funcionario_supervision_nombre'                            => '',
                        'funcionario_superior_codigo'                               => '',
                        'funcionario_superior_nombre'                               => '',
                        'funcionario_foto'                                          => '../assets/images/users/photo.png',
                        'funcionario_antiguedad'                                    => ''
                    );

                    header("Content-Type: application/json; charset=utf-8");
                    $json = json_encode(array('code' => 204, 'status' => 'ok', 'message' => 'No hay registros', 'data' => $detalle), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
                }

                $stmtMSSQL->closeCursor();
                $stmtMSSQL = null;
            } catch (PDOException $e) {
                header("Content-Type: application/json; charset=utf-8");
                $json = json_encode(array('code' => 204, 'status' => 'failure', 'message' => 'Error SELECT: '.$e), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
            }
        } else {
            header("Content-Type: application/json; charset=utf-8");
            $json = json_encode(array('code' => 400, 'status' => 'error', 'message' => 'Verifique, algún campo esta vacio.'), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
        }

        $connMSSQL  = null;
        
        return $json;
    });

    $app->get('/v1/400/jerarquia/{codigo}', function($request) {
        require __DIR__.'/../src/connect.php';

        $val01      = $request->getAttribute('codigo');
        
        if (isset($val01)) {
            $sql00  = "SELECT
                a.COD_FUNC                      AS          funcionario_codigo,
                a.USUARIO                       AS          funcionario_usuario,
                a.NOMBRE_Y_APELLIDO             AS          funcionario_completo,
                a.NRO_CEDULA                    AS          funcionario_documento,
                a.FEC_NACIMIENTO                AS          funcionario_fecha_nacimiento,
                a.EDAD                          AS          funcionario_edad,
                a.SEXO                          AS          funcionario_sexo,
                a.ESTADO_CIVIL                  AS          funcionario_estado_civil,
                a.NACIONALIDAD                  AS          funcionario_nacionalidad,
                a.CORREO_ELECTRONICO            AS          funcionario_email,
                a.FECHA_INGRESO                 AS          funcionario_fecha_ingreso,
                a.COD_CARGO                     AS          funcionario_cargo_codigo,
                a.CARGO                         AS          funcionario_cargo_nombre,
                a.COD_GERENCIA                  AS          funcionario_gerencia_codigo,
                a.GERENCIA                      AS          funcionario_gerencia_nombre,
                a.COD_JERARQUIA                 AS          funcionario_jerarquia_codigo,
                a.JERARQUIA                     AS          funcionario_jerarquia_nombre,
                a.COD_DEPARTAMENTO_AREA         AS          funcionario_departamento_codigo,
                a.DEPARTAMENTO                  AS          funcionario_departamento_nombre,
                a.COD_UNIDAD                    AS          funcionario_unidad_codigo,
                a.UNIDAD                        AS          funcionario_unidad_nombre,
                a.COD_SUPERVISION               AS          funcionario_supervision_codigo,
                a.SUPERVISION                   AS          funcionario_supervision_nombre,
                a.COD_SUPERIOR_INMEDIATO        AS          funcionario_superior_codigo,
                a.SUPERIOR_INMEDIATO            AS          funcionario_superior_nombre,
                a.FOTO_TARGET                   AS          funcionario_foto,
                a.ANTIGUEDAD                    AS          funcionario_antiguedad

            FROM COLABORADOR_BASICOS a
            WHERE a.COD_JERARQUIA = ?
            ORDER BY a.COD_FUNC";

            try {
                $connMSSQL  = getConnectionMSSQLv1();
                $stmtMSSQL  = $connMSSQL->prepare($sql00);
                $stmtMSSQL->execute([$val01]);

                while ($rowMSSQL = $stmtMSSQL->fetch()) {
                    if (isset($rowMSSQL['funcionario_foto'])) {
                        $funcionario_foto = strtolower($rowMSSQL['funcionario_foto']);
                    } else {
                        $funcionario_foto = '../assets/images/users/photo.png';
                    }
                    
                    $detalle    = array(
                        'funcionario_codigo'                                        => $rowMSSQL['funcionario_codigo'],
                        'funcionario_usuario'                                       => strtoupper($rowMSSQL['funcionario_usuario']),
                        'funcionario_completo'                                      => strtoupper($rowMSSQL['funcionario_completo']),
                        'funcionario_documento'                                     => strtoupper($rowMSSQL['funcionario_documento']),
                        'funcionario_fecha_nacimiento'                              => date("d/m/Y", strtotime($rowMSSQL['funcionario_fecha_nacimiento'])),
                        'funcionario_edad'                                          => $rowMSSQL['funcionario_edad'],
                        'funcionario_sexo'                                          => strtoupper($rowMSSQL['funcionario_sexo']),
                        'funcionario_estado_civil'                                  => strtoupper($rowMSSQL['funcionario_estado_civil']),
                        'funcionario_nacionalidad'                                  => strtoupper($rowMSSQL['funcionario_nacionalidad']),
                        'funcionario_email'                                         => strtolower($rowMSSQL['funcionario_email']),
                        'funcionario_fecha_ingreso'                                 => date("d/m/Y", strtotime($rowMSSQL['funcionario_fecha_ingreso'])),
                        'funcionario_cargo_codigo'                                  => $rowMSSQL['funcionario_cargo_codigo'],
                        'funcionario_cargo_nombre'                                  => strtoupper($rowMSSQL['funcionario_cargo_nombre']),
                        'funcionario_gerencia_codigo'                               => $rowMSSQL['funcionario_gerencia_codigo'],
                        'funcionario_gerencia_nombre'                               => strtoupper($rowMSSQL['funcionario_gerencia_nombre']),
                        'funcionario_jerarquia_codigo'                              => $rowMSSQL['funcionario_jerarquia_codigo'],
                        'funcionario_jerarquia_nombre'                              => strtoupper($rowMSSQL['funcionario_jerarquia_nombre']),
                        'funcionario_departamento_codigo'                           => $rowMSSQL['funcionario_departamento_codigo'],
                        'funcionario_departamento_nombre'                           => strtoupper($rowMSSQL['funcionario_departamento_nombre']),
                        'funcionario_unidad_codigo'                                 => $rowMSSQL['funcionario_unidad_codigo'],
                        'funcionario_unidad_nombre'                                 => strtoupper($rowMSSQL['funcionario_unidad_nombre']),
                        'funcionario_supervision_codigo'                            => $rowMSSQL['funcionario_supervision_codigo'],
                        'funcionario_supervision_nombre'                            => strtoupper($rowMSSQL['funcionario_supervision_nombre']),
                        'funcionario_superior_codigo'                               => $rowMSSQL['funcionario_superior_codigo'],
                        'funcionario_superior_nombre'                               => strtoupper($rowMSSQL['funcionario_superior_nombre']),
                        'funcionario_foto'                                          => $funcionario_foto,
                        'funcionario_antiguedad'                                    => strtoupper($rowMSSQL['funcionario_antiguedad'])
                    );

                    $result[]   = $detalle;
                }

                if (isset($result)){
                    header("Content-Type: application/json; charset=utf-8");
                    $json = json_encode(array('code' => 200, 'status' => 'ok', 'message' => 'Success SELECT', 'data' => $result), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
                } else {
                    $detalle = array(
                        'funcionario_codigo'                                        => '',
                        'funcionario_usuario'                                       => '',
                        'funcionario_completo'                                      => '',
                        'funcionario_documento'                                     => '',
                        'funcionario_fecha_nacimiento'                              => '',
                        'funcionario_edad'                                          => '',
                        'funcionario_sexo'                                          => '',
                        'funcionario_estado_civil'                                  => '',
                        'funcionario_nacionalidad'                                  => '',
                        'funcionario_email'                                         => '',
                        'funcionario_fecha_ingreso'                                 => '',
                        'funcionario_cargo_codigo'                                  => '',
                        'funcionario_cargo_nombre'                                  => '',
                        'funcionario_gerencia_codigo'                               => '',
                        'funcionario_gerencia_nombre'                               => '',
                        'funcionario_deparmento_codigo'                             => '',
                        'funcionario_deparmento_nombre'                             => '',
                        'funcionario_unidad_codigo'                                 => '',
                        'funcionario_unidad_nombre'                                 => '',
                        'funcionario_supervision_codigo'                            => '',
                        'funcionario_supervision_nombre'                            => '',
                        'funcionario_superior_codigo'                               => '',
                        'funcionario_superior_nombre'                               => '',
                        'funcionario_foto'                                          => '../assets/images/users/photo.png',
                        'funcionario_antiguedad'                                    => ''
                    );

                    header("Content-Type: application/json; charset=utf-8");
                    $json = json_encode(array('code' => 204, 'status' => 'ok', 'message' => 'No hay registros', 'data' => $detalle), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
                }

                $stmtMSSQL->closeCursor();
                $stmtMSSQL = null;
            } catch (PDOException $e) {
                header("Content-Type: application/json; charset=utf-8");
                $json = json_encode(array('code' => 204, 'status' => 'failure', 'message' => 'Error SELECT: '.$e), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
            }
        } else {
            header("Content-Type: application/json; charset=utf-8");
            $json = json_encode(array('code' => 400, 'status' => 'error', 'message' => 'Verifique, algún campo esta vacio.'), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
        }

        $connMSSQL  = null;
        
        return $json;
    });

    $app->get('/v1/400/departamento/{codigo}', function($request) {
        require __DIR__.'/../src/connect.php';

        $val01      = $request->getAttribute('codigo');
        
        if (isset($val01)) {
            $sql00  = "SELECT
                a.COD_FUNC                      AS          funcionario_codigo,
                a.USUARIO                       AS          funcionario_usuario,
                a.NOMBRE_Y_APELLIDO             AS          funcionario_completo,
                a.NRO_CEDULA                    AS          funcionario_documento,
                a.FEC_NACIMIENTO                AS          funcionario_fecha_nacimiento,
                a.EDAD                          AS          funcionario_edad,
                a.SEXO                          AS          funcionario_sexo,
                a.ESTADO_CIVIL                  AS          funcionario_estado_civil,
                a.NACIONALIDAD                  AS          funcionario_nacionalidad,
                a.CORREO_ELECTRONICO            AS          funcionario_email,
                a.FECHA_INGRESO                 AS          funcionario_fecha_ingreso,
                a.COD_CARGO                     AS          funcionario_cargo_codigo,
                a.CARGO                         AS          funcionario_cargo_nombre,
                a.COD_GERENCIA                  AS          funcionario_gerencia_codigo,
                a.GERENCIA                      AS          funcionario_gerencia_nombre,
                a.COD_JERARQUIA                 AS          funcionario_jerarquia_codigo,
                a.JERARQUIA                     AS          funcionario_jerarquia_nombre,
                a.COD_DEPARTAMENTO_AREA         AS          funcionario_departamento_codigo,
                a.DEPARTAMENTO                  AS          funcionario_departamento_nombre,
                a.COD_UNIDAD                    AS          funcionario_unidad_codigo,
                a.UNIDAD                        AS          funcionario_unidad_nombre,
                a.COD_SUPERVISION               AS          funcionario_supervision_codigo,
                a.SUPERVISION                   AS          funcionario_supervision_nombre,
                a.COD_SUPERIOR_INMEDIATO        AS          funcionario_superior_codigo,
                a.SUPERIOR_INMEDIATO            AS          funcionario_superior_nombre,
                a.FOTO_TARGET                   AS          funcionario_foto,
                a.ANTIGUEDAD                    AS          funcionario_antiguedad

            FROM COLABORADOR_BASICOS a
            WHERE a.COD_DEPARTAMENTO_AREA = ?
            ORDER BY a.COD_FUNC";

            try {
                $connMSSQL  = getConnectionMSSQLv1();
                $stmtMSSQL  = $connMSSQL->prepare($sql00);
                $stmtMSSQL->execute([$val01]);

                while ($rowMSSQL = $stmtMSSQL->fetch()) {
                    if (isset($rowMSSQL['funcionario_foto'])) {
                        $funcionario_foto = strtolower($rowMSSQL['funcionario_foto']);
                    } else {
                        $funcionario_foto = '../assets/images/users/photo.png';
                    }
                    
                    $detalle    = array(
                        'funcionario_codigo'                                        => $rowMSSQL['funcionario_codigo'],
                        'funcionario_usuario'                                       => strtoupper($rowMSSQL['funcionario_usuario']),
                        'funcionario_completo'                                      => strtoupper($rowMSSQL['funcionario_completo']),
                        'funcionario_documento'                                     => strtoupper($rowMSSQL['funcionario_documento']),
                        'funcionario_fecha_nacimiento'                              => date("d/m/Y", strtotime($rowMSSQL['funcionario_fecha_nacimiento'])),
                        'funcionario_edad'                                          => $rowMSSQL['funcionario_edad'],
                        'funcionario_sexo'                                          => strtoupper($rowMSSQL['funcionario_sexo']),
                        'funcionario_estado_civil'                                  => strtoupper($rowMSSQL['funcionario_estado_civil']),
                        'funcionario_nacionalidad'                                  => strtoupper($rowMSSQL['funcionario_nacionalidad']),
                        'funcionario_email'                                         => strtolower($rowMSSQL['funcionario_email']),
                        'funcionario_fecha_ingreso'                                 => date("d/m/Y", strtotime($rowMSSQL['funcionario_fecha_ingreso'])),
                        'funcionario_cargo_codigo'                                  => $rowMSSQL['funcionario_cargo_codigo'],
                        'funcionario_cargo_nombre'                                  => strtoupper($rowMSSQL['funcionario_cargo_nombre']),
                        'funcionario_gerencia_codigo'                               => $rowMSSQL['funcionario_gerencia_codigo'],
                        'funcionario_gerencia_nombre'                               => strtoupper($rowMSSQL['funcionario_gerencia_nombre']),
                        'funcionario_jerarquia_codigo'                              => $rowMSSQL['funcionario_jerarquia_codigo'],
                        'funcionario_jerarquia_nombre'                              => strtoupper($rowMSSQL['funcionario_jerarquia_nombre']),
                        'funcionario_departamento_codigo'                           => $rowMSSQL['funcionario_departamento_codigo'],
                        'funcionario_departamento_nombre'                           => strtoupper($rowMSSQL['funcionario_departamento_nombre']),
                        'funcionario_unidad_codigo'                                 => $rowMSSQL['funcionario_unidad_codigo'],
                        'funcionario_unidad_nombre'                                 => strtoupper($rowMSSQL['funcionario_unidad_nombre']),
                        'funcionario_supervision_codigo'                            => $rowMSSQL['funcionario_supervision_codigo'],
                        'funcionario_supervision_nombre'                            => strtoupper($rowMSSQL['funcionario_supervision_nombre']),
                        'funcionario_superior_codigo'                               => $rowMSSQL['funcionario_superior_codigo'],
                        'funcionario_superior_nombre'                               => strtoupper($rowMSSQL['funcionario_superior_nombre']),
                        'funcionario_foto'                                          => $funcionario_foto,
                        'funcionario_antiguedad'                                    => strtoupper($rowMSSQL['funcionario_antiguedad'])
                    );

                    $result[]   = $detalle;
                }

                if (isset($result)){
                    header("Content-Type: application/json; charset=utf-8");
                    $json = json_encode(array('code' => 200, 'status' => 'ok', 'message' => 'Success SELECT', 'data' => $result), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
                } else {
                    $detalle = array(
                        'funcionario_codigo'                                        => '',
                        'funcionario_usuario'                                       => '',
                        'funcionario_completo'                                      => '',
                        'funcionario_documento'                                     => '',
                        'funcionario_fecha_nacimiento'                              => '',
                        'funcionario_edad'                                          => '',
                        'funcionario_sexo'                                          => '',
                        'funcionario_estado_civil'                                  => '',
                        'funcionario_nacionalidad'                                  => '',
                        'funcionario_email'                                         => '',
                        'funcionario_fecha_ingreso'                                 => '',
                        'funcionario_cargo_codigo'                                  => '',
                        'funcionario_cargo_nombre'                                  => '',
                        'funcionario_gerencia_codigo'                               => '',
                        'funcionario_gerencia_nombre'                               => '',
                        'funcionario_deparmento_codigo'                             => '',
                        'funcionario_deparmento_nombre'                             => '',
                        'funcionario_unidad_codigo'                                 => '',
                        'funcionario_unidad_nombre'                                 => '',
                        'funcionario_supervision_codigo'                            => '',
                        'funcionario_supervision_nombre'                            => '',
                        'funcionario_superior_codigo'                               => '',
                        'funcionario_superior_nombre'                               => '',
                        'funcionario_foto'                                          => '../assets/images/users/photo.png',
                        'funcionario_antiguedad'                                    => ''
                    );

                    header("Content-Type: application/json; charset=utf-8");
                    $json = json_encode(array('code' => 204, 'status' => 'ok', 'message' => 'No hay registros', 'data' => $detalle), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
                }

                $stmtMSSQL->closeCursor();
                $stmtMSSQL = null;
            } catch (PDOException $e) {
                header("Content-Type: application/json; charset=utf-8");
                $json = json_encode(array('code' => 204, 'status' => 'failure', 'message' => 'Error SELECT: '.$e), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
            }
        } else {
            header("Content-Type: application/json; charset=utf-8");
            $json = json_encode(array('code' => 400, 'status' => 'error', 'message' => 'Verifique, algún campo esta vacio.'), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
        }

        $connMSSQL  = null;
        
        return $json;
    });

    $app->get('/v1/400/gerencia/{codigo}', function($request) {
        require __DIR__.'/../src/connect.php';

        $val01      = $request->getAttribute('codigo');
        
        if (isset($val01)) {
            $sql00  = "SELECT
                a.COD_FUNC                      AS          funcionario_codigo,
                a.USUARIO                       AS          funcionario_usuario,
                a.NOMBRE_Y_APELLIDO             AS          funcionario_completo,
                a.NRO_CEDULA                    AS          funcionario_documento,
                a.FEC_NACIMIENTO                AS          funcionario_fecha_nacimiento,
                a.EDAD                          AS          funcionario_edad,
                a.SEXO                          AS          funcionario_sexo,
                a.ESTADO_CIVIL                  AS          funcionario_estado_civil,
                a.NACIONALIDAD                  AS          funcionario_nacionalidad,
                a.CORREO_ELECTRONICO            AS          funcionario_email,
                a.FECHA_INGRESO                 AS          funcionario_fecha_ingreso,
                a.COD_CARGO                     AS          funcionario_cargo_codigo,
                a.CARGO                         AS          funcionario_cargo_nombre,
                a.COD_GERENCIA                  AS          funcionario_gerencia_codigo,
                a.GERENCIA                      AS          funcionario_gerencia_nombre,
                a.COD_JERARQUIA                 AS          funcionario_jerarquia_codigo,
                a.JERARQUIA                     AS          funcionario_jerarquia_nombre,
                a.COD_DEPARTAMENTO_AREA         AS          funcionario_departamento_codigo,
                a.DEPARTAMENTO                  AS          funcionario_departamento_nombre,
                a.COD_UNIDAD                    AS          funcionario_unidad_codigo,
                a.UNIDAD                        AS          funcionario_unidad_nombre,
                a.COD_SUPERVISION               AS          funcionario_supervision_codigo,
                a.SUPERVISION                   AS          funcionario_supervision_nombre,
                a.COD_SUPERIOR_INMEDIATO        AS          funcionario_superior_codigo,
                a.SUPERIOR_INMEDIATO            AS          funcionario_superior_nombre,
                a.FOTO_TARGET                   AS          funcionario_foto,
                a.ANTIGUEDAD                    AS          funcionario_antiguedad

            FROM COLABORADOR_BASICOS a
            WHERE a.COD_JERARQUIA = 11 AND a.COD_GERENCIA = ?
            ORDER BY a.COD_FUNC";

            try {
                $connMSSQL  = getConnectionMSSQLv1();
                $stmtMSSQL  = $connMSSQL->prepare($sql00);
                $stmtMSSQL->execute([$val01]);

                while ($rowMSSQL = $stmtMSSQL->fetch()) {
                    if (isset($rowMSSQL['funcionario_foto'])) {
                        $funcionario_foto = strtolower($rowMSSQL['funcionario_foto']);
                    } else {
                        $funcionario_foto = '../assets/images/users/photo.png';
                    }
                    
                    $detalle    = array(
                        'funcionario_codigo'                                        => $rowMSSQL['funcionario_codigo'],
                        'funcionario_usuario'                                       => strtoupper($rowMSSQL['funcionario_usuario']),
                        'funcionario_completo'                                      => strtoupper($rowMSSQL['funcionario_completo']),
                        'funcionario_documento'                                     => strtoupper($rowMSSQL['funcionario_documento']),
                        'funcionario_fecha_nacimiento'                              => date("d/m/Y", strtotime($rowMSSQL['funcionario_fecha_nacimiento'])),
                        'funcionario_edad'                                          => $rowMSSQL['funcionario_edad'],
                        'funcionario_sexo'                                          => strtoupper($rowMSSQL['funcionario_sexo']),
                        'funcionario_estado_civil'                                  => strtoupper($rowMSSQL['funcionario_estado_civil']),
                        'funcionario_nacionalidad'                                  => strtoupper($rowMSSQL['funcionario_nacionalidad']),
                        'funcionario_email'                                         => strtolower($rowMSSQL['funcionario_email']),
                        'funcionario_fecha_ingreso'                                 => date("d/m/Y", strtotime($rowMSSQL['funcionario_fecha_ingreso'])),
                        'funcionario_cargo_codigo'                                  => $rowMSSQL['funcionario_cargo_codigo'],
                        'funcionario_cargo_nombre'                                  => strtoupper($rowMSSQL['funcionario_cargo_nombre']),
                        'funcionario_gerencia_codigo'                               => $rowMSSQL['funcionario_gerencia_codigo'],
                        'funcionario_gerencia_nombre'                               => strtoupper($rowMSSQL['funcionario_gerencia_nombre']),
                        'funcionario_jerarquia_codigo'                              => $rowMSSQL['funcionario_jerarquia_codigo'],
                        'funcionario_jerarquia_nombre'                              => strtoupper($rowMSSQL['funcionario_jerarquia_nombre']),
                        'funcionario_departamento_codigo'                           => $rowMSSQL['funcionario_departamento_codigo'],
                        'funcionario_departamento_nombre'                           => strtoupper($rowMSSQL['funcionario_departamento_nombre']),
                        'funcionario_unidad_codigo'                                 => $rowMSSQL['funcionario_unidad_codigo'],
                        'funcionario_unidad_nombre'                                 => strtoupper($rowMSSQL['funcionario_unidad_nombre']),
                        'funcionario_supervision_codigo'                            => $rowMSSQL['funcionario_supervision_codigo'],
                        'funcionario_supervision_nombre'                            => strtoupper($rowMSSQL['funcionario_supervision_nombre']),
                        'funcionario_superior_codigo'                               => $rowMSSQL['funcionario_superior_codigo'],
                        'funcionario_superior_nombre'                               => strtoupper($rowMSSQL['funcionario_superior_nombre']),
                        'funcionario_foto'                                          => $funcionario_foto,
                        'funcionario_antiguedad'                                    => strtoupper($rowMSSQL['funcionario_antiguedad'])
                    );

                    $result[]   = $detalle;
                }

                if (isset($result)){
                    header("Content-Type: application/json; charset=utf-8");
                    $json = json_encode(array('code' => 200, 'status' => 'ok', 'message' => 'Success SELECT', 'data' => $result), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
                } else {
                    $detalle = array(
                        'funcionario_codigo'                                        => '',
                        'funcionario_usuario'                                       => '',
                        'funcionario_completo'                                      => '',
                        'funcionario_documento'                                     => '',
                        'funcionario_fecha_nacimiento'                              => '',
                        'funcionario_edad'                                          => '',
                        'funcionario_sexo'                                          => '',
                        'funcionario_estado_civil'                                  => '',
                        'funcionario_nacionalidad'                                  => '',
                        'funcionario_email'                                         => '',
                        'funcionario_fecha_ingreso'                                 => '',
                        'funcionario_cargo_codigo'                                  => '',
                        'funcionario_cargo_nombre'                                  => '',
                        'funcionario_gerencia_codigo'                               => '',
                        'funcionario_gerencia_nombre'                               => '',
                        'funcionario_deparmento_codigo'                             => '',
                        'funcionario_deparmento_nombre'                             => '',
                        'funcionario_unidad_codigo'                                 => '',
                        'funcionario_unidad_nombre'                                 => '',
                        'funcionario_supervision_codigo'                            => '',
                        'funcionario_supervision_nombre'                            => '',
                        'funcionario_superior_codigo'                               => '',
                        'funcionario_superior_nombre'                               => '',
                        'funcionario_foto'                                          => '../assets/images/users/photo.png',
                        'funcionario_antiguedad'                                    => ''
                    );

                    header("Content-Type: application/json; charset=utf-8");
                    $json = json_encode(array('code' => 204, 'status' => 'ok', 'message' => 'No hay registros', 'data' => $detalle), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
                }

                $stmtMSSQL->closeCursor();
                $stmtMSSQL = null;
            } catch (PDOException $e) {
                header("Content-Type: application/json; charset=utf-8");
                $json = json_encode(array('code' => 204, 'status' => 'failure', 'message' => 'Error SELECT: '.$e), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
            }
        } else {
            header("Content-Type: application/json; charset=utf-8");
            $json = json_encode(array('code' => 400, 'status' => 'error', 'message' => 'Verifique, algún campo esta vacio.'), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
        }

        $connMSSQL  = null;
        
        return $json;
    });