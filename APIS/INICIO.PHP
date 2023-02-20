<?php

use Firebase\JWT\JWT;
use Firebase\JWT\key;

require '../vendor/autoload.php';
require 'conexion.php';
$db = new Conexion();

//INICIAR SESION BD

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //RECOJO EL JSON Y LO DECODIFICO
    $json = file_get_contents('php://input');
    if (isset($json)) {
        $user = json_decode($json);

        //RECOJO LOS PARAMETROS Y HAGO LA CONSULTA
        $username = $user->username;
        $pass = $user->pass;
        $sql = "SELECT id,username,pass FROM `users` WHERE username like '{$username}'";


        try {
            $result = $db->query($sql);
            $row = $result->fetch_assoc();

            $pass2 = $row['pass'];
            if (password_verify($pass, $pass2)) {
                // HAGO LAS VARIABLES DEL JWT Y LO CODIFICO
                $key = 'example_key';
                $payload = [
                    'username' => $username,
                    'id' => $sql,
                ];
                $jwt = JWT::encode($payload, $key, 'HS256');
                $result = $db->query($sql);

                //MANDO EN USERNAME , ID Y TOKEN
                $alumnos = [
                    "id" => $result->fetch_all(MYSQLI_ASSOC),
                    "token" => $jwt,
                    "username" => $username
                ];
                header("HTTP/1.1 201 Created");
                echo json_encode($alumnos);
            }
        } catch (mysqli_sql_exception $e) {
            header("HTTP/1.1 404 Not Found");
        }
    } else {
        header("HTTP/1.1 400 Bad Request");
    }
}
