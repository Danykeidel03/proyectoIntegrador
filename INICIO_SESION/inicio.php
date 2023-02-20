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
        background-image: url("imgs/fondo2.png");
        background-size: cover;
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-position: center bottom;
        background-color: greenyellow;
    }

    #sesion {
        width: 600px;
        height: 400px;
        border: 1px black solid;
        /* centrar vertical y horizontalmente */
        margin-top: 13%;
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

    #pass,
    #usu {
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

    input.crear {
        background-color: greenyellow;
        padding: 10px;
        border-radius: 20px;
        width: 400px;
        margin-bottom: 10px;
        margin-top: 10px;
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
    <div id="funciona">
        <div id="sesion">
            <div id="titulo">
                <h1>INICIAR SESION</h1>
                <hr>
            </div>
            <div id="form">
                <form>
                    <div id="tx">
                        <input type="text" id="usu" name="usu" placeholder="Usuario">
                    </div>
                    <div id="tx">
                        <input type="password" id="pass" name="pass" placeholder="Contraseña">
                    </div>
                    <button id="crear">INICIAR SESION</button><br>
                    <button id="salir" formaction="../PAGINA1/pagian_inicio.php">VOLVER</button>
                </form>
            </div>
        </div>
    </div>

    <script>
    let funciona = document.getElementById('sesion')
    if(localStorage.getItem('token')){
        funciona.innerHTML = ''
        window.location.href = ('http://localhost/dwes/PROYECTO_2TRI/PAGINA1/pagian_inicio.php')
    }
</script>
    <script src="js/inicio.js"></script>
</body>

</html>