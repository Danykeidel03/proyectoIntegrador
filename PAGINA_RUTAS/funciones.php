<?php
    // Parametros de la BD
    define("HOST", "localhost");
    define("USER", "proyecto2trim");
    define("PASS", "proyecto2trim");
    define("BD", "proyecto2trim");

    function obtenerRuta($id) {
        $ruta = false;
        try {
            $con = mysqli_connect(HOST, USER, PASS, BD);
            $sql = "SELECT * FROM rutas WHERE id='$id'";
            $ruta = $con->query($sql)->fetch_assoc();
            $usuario = $ruta['user'];
            $sqlUser = "SELECT username FROM users WHERE id='$usuario'";
            $user = @$con->query($sqlUser)->fetch_assoc();
            @$ruta['username'] = $user['username'];
        } catch(mysqli_sql_exception $e) {
            $ruta = false;
        }
        return $ruta;
    }
?>