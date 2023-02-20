<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    h1 {
        font-family: 'Cinzel', serif;
    }

    #general {
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

    footer {
        position: fixed;
        bottom: 0;
        width: 100%;
    }

    body {
        margin-top: 0px;
        margin-left: 0px;
        margin-right: 0px;
        margin-bottom: 0px;
    }

    form {
        /* border: 1px solid black; */
        width: 500px;
        height: 350px;
        align-content: center;
        margin-top: 20px;
        margin-left: 50px;
    }

    label {
        width: 150px;
        padding: 10px;

    }

    input,
    select,
    textarea {
        width: 330px;
        /* padding: 10px; */
    }

    #submit {
        margin-top: 20px;
        width: 200px;
        height: 30px;
        align-self: center;
    }

    /* #foto {
        width: 100%;
        height: 355px;
    } */
    body {
        /* background: linear-gradient(97deg, rgba(255,255,255,1) 0%, rgba(255,255,255,1) 14%, rgba(151,193,233,1) 36%);  */
        background-image: url("img/principio1.png");
        background-size: cover;
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-position: center bottom;
        background-color: greenyellow;
    }

    #titulo {
        text-align: center;
        top: 10px;
        position: relative;

    }

    input {
        padding: 10px;
    }

    #salir {
        background-color: #ff4d4d;
        padding: 10px;
        border-radius: 20px;
        width: 400px;
    }

    #submit {
        background-color: greenyellow;
        padding: 10px;
        border-radius: 20px;
        width: 400px;
        margin-bottom: 10px;
        margin-top: 10px;
        height: 40px;
    }

    #f {
        text-align: center;
    }

    input,
    textarea {
        border: black solid 0px;
        border-bottom: 1px black solid;
        width: 400px;
        text-align: left;
    }

    #submit {
        text-align: center;
    }
</style>

<body>
    <div id="funciona">
        <!-- <img src="img/principio1.png" id="foto"> -->
        <div id="general">
            <div id="titulo">
                <h1>AÑADIR RUTA</h1>
                <hr>
            </div>
            <div id="f">
                <form id="form">
                    <div id="name">
                        <input type="text" id="nameInput" placeholder="Nombre Ruta" />
                    </div>

                    <div id="file">
                        <input name="fileInput" type="file" id="fileInput" />
                    </div>

                    <div id="desc">
                        <textarea name="descText" id="descText" placeholder="Descirpcion"></textarea>
                    </div>
                    <input type="submit" id="submit" value="ENVIAR" />
                    <button id="salir">SALIR</button>
                </form>
            </div>

        </div>
    </div>

</body>
<script>
    let funciona = document.getElementById('funciona')
    if (!localStorage.getItem('token')) {
        funciona.innerHTML = ''
        window.location.href = ('http://localhost/dwes/PROYECTO_2TRI/PAGINA1/pagian_inicio.php')
    }

    let btn = document.getElementById('salir')
    btn.addEventListener('click', salir)

    function salir(event) {
        event.preventDefault()
        window.location.href = ('http://localhost/dwes/PROYECTO_2TRI/PAGINA1/pagian_inicio.php')
    }
</script>
<script src="http://localhost/dwes/PROYECTO_2TRI/PAGINA1/footer/añadirheadersfooters.js"></script>
<script src="GPXParser.js"></script>
<script>
    let ficherogpx = document.querySelector('#fileInput');
    document.getElementById('form').addEventListener('submit', function(event) {
        event.preventDefault()
        let fileInput = document.getElementById("fileInput")
        let file = fileInput.files[0];
        let reader = new FileReader();
        reader.onload = function() {
            let gpx = reader.result;
            let parser = new gpxParser();
            parser.parse(gpx)
            let json = parser.tracks[0]
            // console.log(json);

            // Reducimos el número de puntos a aproximadamente 50
            let ratio = Math.round(json.points.length / 50);
            let points = json.points.filter((_, index) => index % ratio == 0);
            let slopes = json.slopes.filter((_, index) => index % ratio == 0);
            let nombreImput = document.getElementById('nameInput')
            let nombre = nombreImput.value;

            let nombredescripcion = document.getElementById('descText')
            let descripcion = nombredescripcion.value;

            let distance = json.distance?.total;
            let max_height = json.elevation?.max;
            let min_height = json.elevation?.min;
            let pos_slope = json.elevation?.pos;
            let neg_slope = json.elevation?.neg;
            let start_lat = json.points[0].lat;
            let start_lon = json.points[0].lon;

            let id = localStorage.getItem('id')

            let puntos = json.points.map(({
                lat,
                lon
            }) => {
                return {
                    lat,
                    lon
                }
            })


            let ruta = {
                id: id,
                nombre: nombre,
                distancia: distance,
                max_height: max_height,
                min_height: min_height,
                pos_slope: pos_slope,
                neg_slope: neg_slope,
                start_lat: start_lat,
                start_lon: start_lon,
                points: JSON.stringify(puntos),
                descripcion: descripcion,
            }

            let rutaJson = JSON.stringify(ruta);
            console.log(rutaJson);

            fetch('http://localhost/dwes/PROYECTO_2TRI/APIS/rutas.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json;charser=utf-8'
                    },
                    body: rutaJson
                })

                .then(response => {
                    switch (response.status) {
                        case 201:
                            alert("RUTA CON EXITO");
                            break;
                        case 409:
                            alert("RUTA EXISTE");
                            break;
                        case 400:
                            alert("ERROR");
                    }
                    return response.json();

                })

                .then(data => {
                    console.log(data);

                })

        }
        reader.readAsText(file);
        let gpx = new gpxParser();
        gpx.parse("<xml><gpx></gpx></xml>");
    })
</script>

</html>