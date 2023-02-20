<?php

// use phpGPX\phpGPX;

require 'conexion.php';
require '../vendor/autoload.php';
$db = new Conexion();

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    //HAGO LA CONSULTA
    $sql = "SELECT id,route_name,distance,max_height,min_height,start_lat,start_lon,descripcion FROM rutas WHERE 1 ";

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

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $sql .= "AND user = $id ";
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
