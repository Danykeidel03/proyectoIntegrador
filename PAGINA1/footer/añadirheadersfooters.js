const footer = "http://localhost/dwes/PROYECTO_2TRI/PAGINA1/footer/footer.php"

let header = "";

if (!localStorage.getItem('token')) {
    header = "http://localhost/dwes/PROYECTO_2TRI/PAGINA1/footer/header.php";
} else {
    header = "http://localhost/dwes/PROYECTO_2TRI/PAGINA1/footer/header1.php";
}

añadirFoot(footer);
loadHeader(header);

function añadirFoot(url) {
    fetch(url)
        .then((response) => {
            return response.text()
        })
        .then((data) => {
            document.querySelector('#footer').innerHTML = data;
        })
}

function loadHeader(url) {
    fetch(url)
        .then((response) => {
            return response.text()
        })
        .then((data) => {
            document.querySelector('#encabezado').innerHTML = data;
            let cerrar = document.getElementById('cerrar')
            cerrar.addEventListener('click', cerrarSesion)
            function cerrarSesion(event) {
                event.preventDefault();
                localStorage.removeItem('token')
                localStorage.removeItem('id')
                window.location.href = ('http://localhost/dwes/PROYECTO_2TRI/PAGINA1/pagian_inicio.php')
            }
        })
}

