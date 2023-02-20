<?php

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

require '../vendor/autoload.php';
require 'conexion.php';
$db = new Conexion();

//INSERTAR USUARIOS A LA BASE DE DATOS

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //RECOJO EL JSON Y LO DECODIFICO
    $json = file_get_contents('php://input');
    if (isset($json)) {
        $user = json_decode($json);

        //RECOJO TODOS LOS PARAMETROS

        $fullname = $user->fullname;
        $username = $user->username;
        $email = $user->email;
        $pass = $user->pass;
        $height = $user->height;
        $weight = $user->weight;
        $birthday = $user->birthday;
        $activities = $user->activities;
        $password_hash = password_hash($pass, PASSWORD_BCRYPT);

        //CONSULTA

        $sql = "INSERT INTO users (fullname, username, email, pass, height, weight, birthday, activities) VALUES('$fullname', '$username', '$email', '$password_hash', '$height', '$weight', '$birthday', '$activities')";

        //CONSULTA PARA COMPROBAR QUE EXISTE
        $sql2 = "SELECT * FROM users WHERE username = '$username'";

        try {
            //SI XSITE NO LO INSERTA SI NO, SI
            $usuarios = $db->query($sql2)->fetch_all(MYSQLI_ASSOC);
            if (count($usuarios) > 0) {
                header("HTTP/1.1 409 Username exist");
                header("Content-Type: application/json");
                echo json_encode([
                    'success' => false,
                    'msg' => "El nombre de usuario ya existe"
                ]);
            } else {
                $db->query($sql);
                header("HTTP/1.1 201 Created");
                header("Content-Type: application/json");
                echo json_encode([
                    'success' => true,
                    'msg' => "El usuario se ha creado correctamente"
                ]);
            }
        } catch (mysqli_sql_exception $e) {
            header("HTTP/1.1 400 Bad Request");
        }
    } else {
        header("HTTP/1.1 400 Bad Request");
    }
}

// EDITAR PERFIL DE USUARIO

if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
    //RECOJO EL JSON Y LO DECODIFICO
    $json = file_get_contents('php://input');
    $user = json_decode($json);
    //DECODIFICO EL TOKEN Y LO COMPRUEBO
    $decoded = JWT::decode($user->token, new Key('example_key', 'HS256'));
    if ($user->username == $decoded->username) {
        if (
            // SI LOS CAMPOS HAN SIDO SELECCIONADOS
            isset($user->fullname)
            && isset($user->id) && isset($user->height) && isset($user->weight) && isset($user->activities)
        ) {
            //HAGO LA CONSULTA Y RECOJO LOS VALORES
            $id = $user->id;
            $fullname = $user->fullname;
            $height = $user->height;
            $weight = $user->weight;
            $activities = $user->activities;
            $sql = "UPDATE users SET fullname='$fullname',
            height='$height', weight='$weight',
            activities='$activities' WHERE id='$id'";
            try {
                $db->query($sql);
                header("HTTP/1.1 200 OK");
                echo json_encode($db->insert_id);
            } catch (mysqli_sql_exception $e) {
                header("HTTP/1.1 400 Bad Request");
            }
        } else {
            header("HTTP/1.1 400 Bad Request");
        }
    } else {
        header("HTTP/1.1 401 Bad Request");
    }

    exit;
}

//ELIMINAR USUARIO

if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    //RECOJO EL JSON Y LO DECODIFICO
    $json = file_get_contents('php://input');
    $user = json_decode($json);
    //DECODIFICO EL TOKEN Y LO COMPRUEBO
    $decoded = JWT::decode($user->token, new Key('example_key', 'HS256'));
    if ($user->username == $decoded->username) {
        //HAGO LA CONSULTA
        $sql = "DELETE FROM users WHERE id = '$user->id'";
        try {
            $db->query($sql);
            header("HTTP/1.1 200 OK");
            echo json_encode($user->id);
        } catch (mysqli_sql_exception $e) {
            header("HTTP/1.1 400 Bad Request");
        }
    } else {
        header("HTTP/1.1 401 Bad Request");
    }
    exit;
}
