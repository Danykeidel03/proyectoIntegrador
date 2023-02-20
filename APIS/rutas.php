<?php

// use phpGPX\phpGPX;

require 'conexion.php';
require '../vendor/autoload.php';
$db = new Conexion();

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    //HAGO LA CONSULTA
    $sql = "SELECT id,route_name,distance,max_height,min_height,start_lat,start_lon,descripcion,points FROM rutas WHERE 1 ";

    try {

        //APLICO LOS FILTROS
        if (isset($_GET['name'])) {
            $name = $_GET['name'];
            $sql .= "AND route_name LIKE '%$name%' ";
        }

        if (isset($_GET['min_dist'])) {
            $min_dist = $_GET['min_dist'];
            $sql .= "AND distance >= $min_dist ";
        }

        if (isset($_GET['max_dist'])) {
            $max_dist = $_GET['max_dist'];
            $sql .= "AND distance <= $max_dist ";
        }

        $result = $db->query($sql)->fetch_all(MYSQLI_ASSOC);
        header("HTTP/1.1 200 OK");
        echo json_encode($result);
    } catch (mysqli_sql_exception $e) {
        header("HTTP/1.1 404 Not Found");
        echo json_encode($sql);
    }
    exit;
} else {
    header("HTTP/1.1 400 Bad Request");
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //RECOJO EL JSON Y LO DECODIFICO
    $json = file_get_contents('php://input');
    if (isset($json)) {
        $ruta = json_decode($json);

        //RECOJO TODOS LOS PARAMETROS

        $nombre = $ruta->nombre;
        $distancia = $ruta->distancia;
        $max_height = $ruta->max_height;
        $min_height = $ruta->min_height;
        $pos_slope = $ruta->pos_slope;
        $neg_slope = $ruta->neg_slope;
        $start_lat = $ruta->start_lat;
        $start_lon = $ruta->start_lon;
        $points = $ruta->points;
        $descripcion = $ruta->descripcion;
        $id = $ruta -> id;

        //CONSULTA

        $sql = "INSERT INTO `rutas` (`route_name`, `distance`, `max_height`, `min_height`, `pos_slope`, `neg_slope`, `start_lat`, `start_lon`, `descripcion`, `user`,`points`) VALUES ('$nombre', ' $distancia', '$max_height', '$min_height', '$pos_slope', '$neg_slope', '$start_lat', '$start_lon', '$descripcion', '$id','$points'); ";

        //CONSULTA PARA COMPROBAR QUE EXISTE
        $sql2 = "SELECT * FROM rutas WHERE route_name = '$nombre'";

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
