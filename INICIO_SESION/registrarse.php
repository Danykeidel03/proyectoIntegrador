<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <title>Document</title>
</head>

<style>
    body {
        /* background: linear-gradient(97deg, rgba(255,255,255,1) 0%, rgba(255,255,255,1) 14%, rgba(151,193,233,1) 36%);  */
        background-image: url("imgs/fondo1.png");
        background-size: cover;
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-position: center bottom;
        background-color: greenyellow;
    }

    #sesion {
        width: 600px;
        height: 750px;
        border: 1px black solid;
        /* centrar vertical y horizontalmente */
        margin-top: 6%;
        margin-left: auto;
        margin-right: auto;
        border-radius: 25px;
        background-color: white;
    }



    #titulo {
        text-align: center;
        top: 30px;
        position: relative;

    }

    #form {
        text-align: center;
        top: 30px;
        position: relative;
    }

    input,
    select {
        border: black solid 0px;
        border-bottom: 1px black solid;
        width: 400px;
        text-align: left;
    }

    input:focus {
        outline: none;
    }

    th {
        text-align: left;
    }

    #crear {
        background-color: greenyellow;
        padding: 10px;
        border-radius: 20px;
        width: 400px;
        margin-bottom: 10px;
        margin-top: 10px;
    }

    #salir {
        background-color: #ff4d4d;
        padding: 10px;
        border-radius: 20px;
        width: 400px;
    }

    #tx {
        padding: 10px;
    }
</style>

<body>

    <div id="sesion">
        <div id="titulo">
            <h1>REGISTRARSE</h1>
            <hr>
        </div>
        <div id="form">
            <form>
                <div id="tx">
                    <!-- <label for="nombre">Nombre Completo:</label> -->
                    <input type="text" id="nombre" name="nombre" placeholder="Nombre Completo">
                </div>
                <div id="tx">
                    <!-- <label for="usu">Usuario:</label> -->
                    <input type="text" id="usu" name="usu" placeholder="Usuario">
                </div>
                <div id="tx">
                    <!-- <label for="mail">Email:</label> -->
                    <input type="text" id="mail" name="mail" placeholder="Email">
                </div>
                <div id="tx">
                    <!-- <label for="pass">Contraseña:</label> -->
                    <input type="password" id="pass" name="pass" placeholder="Contraseña">
                </div>
                <div id="tx">
                    <!-- <label for="pass1">Repetir Contraseña:</label> -->
                    <input type="password" id="pass1" name="pass1" placeholder="Repetir Contraseña">
                </div>
                <div id="tx">
                    <!-- <label for="estatura">Estatura En Cm:</label> -->
                    <input type="number" id="estatura" name="estatura" min="100" max="220" placeholder="Altura En Cm">
                </div>
                <div id="tx">
                    <!-- <label for="peso">Peso En Kg:</label> -->
                    <input type="number" id="peso" name="peso" min="40" max="240" placeholder="Peso En kG">
                </div>
                <div id="tx">
                    <!-- <label for="fecha">Fecha Nacimiento:</label> -->
                    <input type="date" id="fecha" name="fecha" placeholder="Fecha De Nacimiento">
                </div>
                <div id="tx">
                    <select id="activ">
                        <option value="otras">Otras</option>
                        <option value="senderismo">Senderismo</option>
                        <option value="bicicleta">Bicicleta</option>
                        <option value="correr">Correr</option>
                        <option value="andar">Andar</option>
                    </select>
                </div>
                <button id="crear">CREAR CUENTA</button><br>
                <button id="salir" formaction="../PAGINA1/pagian_inicio.php">VOLVER</button>
            </form>
        </div>
    </div>
    <script>
    let funciona = document.getElementById('sesion')
    if(localStorage.getItem('token')){
        funciona.innerHTML = ''
        window.location.href = ('http://localhost/dwes/PROYECTO_2TRI/PAGINA1/pagian_inicio.php')
    }
</script>
    <script src="js/index.js"></script>
</body>

</html>