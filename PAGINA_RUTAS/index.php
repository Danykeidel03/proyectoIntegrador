<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js" integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM=" crossorigin=""></script>
</head>

<style>
    p,
    h1,
    h4,
    h3,
    a {
        font-family: 'Cinzel', serif;
    }

    #foto {
        width: 100%;
        height: 800px;
    }

    #foto {
        width: 100%;
        height: 900px;
    }

    #letras_img {
        position: absolute;
        /* margin-top: -900px; */
        top: 200px;
        left: 2%;
        color: white;
        font: sans-serif;
    }

    #lista {
        position: absolute;
        top: 70%;
        left: 20%;
        font-size: 20px;
    }

    #titulo {
        font-size: 70px;
    }

    body {
        margin-top: 0px;
        margin-left: 0px;
        margin-right: 0px;
        margin-bottom: 0px;
    }

    h1 {
        text-align: center;
    }

    #rutas {
        display: flex;
        width: 100%;
        /* max-width: 1200px; */
        flex-wrap: wrap;
        justify-content: center;
        margin: auto;
        position: relative;

    }

    #routes {
        /* padding-left: 100px;
        padding-right: 100px; */
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        grid-template-rows: repeat(2, 1fr);
        margin: 40px;
        width: 750px;
        max-width: 750px;
        transition: all 0.15s;
        border-radius: 5px;
    }

    #routes:hover {
        box-shadow: 2px 2px 0px black;
        transform: translateY(-10px);
    }

    .map {
        grid-column: 3 / 4;
        grid-row: 1/3;
        text-align: center;
        /* background-color: grey; */
        border-radius: 5px;
        height: 100%;
        width: 100%;
        

    }

    #nameRuta {
        grid-column: 1 / 3;
        grid-row: 1/2;
        margin-top: -20px;
        font-size: 20px;

    }

    #infoRuta {
        grid-column: 1 / 3;
        grid-row: 2/2;
        font-size: 12px;

    }

    #dat {
        color: #8e8e8e;
    }

    input {
        border: black solid 0px;
        border-bottom: 1px black solid;
        width: 200px;
        text-align: left;
    }

    #añadirRuta {
        float: right
    }
</style>

<body>
    <header id="encabezado"></header>

    <div id="conGeneral">

        <!-- Imagen de fono y al principio de la pagina -->
        <img src="img/principio.png" id="foto">

        <!-- letras blancas dentro de la imagen -->
        <div id="letras_img">
            <p id="titulo">TODAS LAS RUTAS DISPONIBLES</p>
        </div>

        <h1>RUTAS</h1>
        <div id="añadirRuta"></div>


        <div id="form">

            <form>
                <input type="text" id="name" name="name" placeholder="Nombre Ruta">
                <input type="number" id="dist" name="dist" min="0" value="0" placeholder="Distancia Minima">
                <input type="number" id="dist1" name="dist1" min="0" value="10000000" placeholder="Distancia Maxima">
            </form>



        </div>
        <hr>

        <div id="rutas">
        </div>
    </div>
    <br>
    <footer id="footer"></footer>

</body>

<script src="index.js"></script>
<script src="http://localhost/dwes/PROYECTO_2TRI/PAGINA1/footer/añadirheadersfooters.js"></script>
<script>
    if (localStorage.getItem('token')) {
        let crearRuta = document.getElementById('añadirRuta');
        crearRuta.innerHTML = `<a href='http://localhost/dwes/PROYECTO_2TRI/PAGINA_RUTAS/insertar.php'>AÑADIR RUTA</a>`;
    }
</script>
<!-- <script>
    var map = L.map('map').setView([51.505, -0.09], 13);
</script> -->

</html>