document.addEventListener('DOMContentLoaded', function () {
    inicio();
})

let formulario = document.forms[0]

let imputNombre = document.querySelector('#name');
let nombre = formulario.elements.name;
nombre.addEventListener("keyup", inicio)

let imputDist = document.querySelector('#dist');
let dist = formulario.elements.dist;
dist.addEventListener("keyup", inicio)

let imputDist1 = document.querySelector('#dist1');
let dist1 = formulario.elements.dist1;
dist1.addEventListener("keyup", inicio)

function inicio() {


    let imputNombre = document.querySelector('#name');
    let nombre = imputNombre.value;

    let imputDist = document.querySelector('#dist');
    let dist = imputDist.value;

    let imputDist1 = document.querySelector('#dist1');
    let dist1 = imputDist1.value;

    fetch(`http://localhost/dwes/PROYECTO_2TRI/APIS/rutas.php?name=${nombre}&min_dist=${dist}&max_dist=${dist1}`, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json',
        },
    })

        .then(response => {
            switch (response.status) {
                case 200:
                    console.log("SACASTE LAS RUTAS");
                    return response.json();
                    break;
                case 401:
                    console.log("NO PUEDES INICIAR SESION");
            }
        })

        .then(data => {
            console.log(data);
            let divRutas = document.getElementById('rutas')
            let str = "";
            data.forEach(element => {
                let id = element.id
                let nombre = element.route_name;
                let distancia = element.distance
                let max_height = element.max_height;
                let min_height = element.min_height;
                str += `
                <div id='routes'>
                    <div id='map${id}' class='map'></div>
                    <div id='nameRuta'><h4>${nombre}</h4></div>
                    <div id='infoRuta'>
                        <div id='dist'><a>Distancia:  </a><a id='dat'>${distancia}</a></div>
                        <div id='max'><a>Altura Maxima:  </a><a id='dat'>${max_height}</a></div>
                        <div id='min'><a>Altura Minima:  </a><a id='dat'>${min_height}</a></div>
                        <form action='http://localhost/dwes/PROYECTO_2TRI/PAGINA_RUTAS/info.php'>
                            <div id='min'><button>Info Ruta</button></div>
                            <input id="id" name="id" type="hidden" value="${id}">
                        </form>
                    </div>
                </div>
                `
            });
            divRutas.innerHTML = str
            data.forEach(element => { 
                let id = element.id
                let latitud = element.start_lat;
                let longitud = element.start_lon;
                let map = L.map(`map${id}`, { zoomControl: false }).setView([latitud, longitud], 12);
                L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    maxZoom: 19,
                    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
                }).addTo(map);
                var marker = L.marker([latitud, longitud]).addTo(map);
            })
                
            
            
        })


}


