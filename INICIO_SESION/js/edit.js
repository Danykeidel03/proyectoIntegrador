let btn = document.getElementById('crear')
btn.addEventListener('click', inicio)


let username = localStorage.getItem('username')
let id = localStorage.getItem('id')
let token = localStorage.getItem('token')

let inputpeso = document.querySelector('#peso');
let inputEstatura = document.querySelector('#estatura');


fetch(`http://localhost:5000/api/users?username=pepe`, {
    method: 'GET',
    headers: {
        'Authorization': token
    },
})

    .then(response => {
        switch (response.status) {
            case 200:
                console.log('BIEN HECHO');
                break;
            case 400:
                console.log('MAL HECHO');
                break;
            case 404:
                console.log('SIN USUARIO');
                break;
        }
        return response.json();

    })

    .then (data => {
        console.log(data[0]);
        // imputNombre.value = data.username
        
        inputEstatura.value = data[0].height
        console.log(inputEstatura.value);
    })

function inicio(event) {
    event.preventDefault();

    let id = localStorage.getItem('id')
    let token = localStorage.getItem('token')
    let username = localStorage.getItem('username')

    let imputNombre = document.querySelector('#nombre');
    let nombre = imputNombre.value;

    // let imputUsu = document.querySelector('#usu');
    // let usu = imputUsu.value;

    let inputEstatura = document.querySelector('#estatura');
    let estatura = inputEstatura.value;

    let inputpeso = document.querySelector('#peso');
    let peso = inputpeso.value;

    let inputfecha = document.querySelector('#fecha');
    let fecha = inputfecha.value;

    let inputactiv = document.querySelector('#activ');
    let activ = inputactiv.value;

    let persona = {
        id: id,
        username: username,
        token: token,
        fullname: nombre,
        height: estatura,
        weight: peso,
        birthday: fecha,
        activities: activ
    }


    console.log(persona);

    let usuario = JSON.stringify(persona);

    // fetch(`http://localhost:5000/api/user`, {
    //     method: 'PUT',
    //     headers: {
    //         'Content-Type': 'application/json',
    //         'Authorization': token
    //     },
    //     body: usuario
    // })

    //     .then(response => {
    //         switch (response.status) {
    //             case 200:
    //                 console.log("Actualizado");
    //                 break;
    //             case 400:
    //                 console.log("Id error");
    //                 break;
    //             case 401:
    //                 console.log("Token no valido");
    //         }
    //         return response.json();
    //     })

    //     .then(data => {
    //         // let token = data.token;
    //         // let id = data.id;
    //         // console.log(token);
    //         // console.log(id);
    //         // localStorage.setItem('token', token);
    //     })

    fetch(`http://localhost/dwes/PROYECTO_2TRI/APIS/api.php`, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
            'Authorization': token
        },
        body: usuario
    })

        .then(response => {
            switch (response.status) {
                case 200:
                    console.log("Actualizado");
                    break;
                case 400:
                    console.log("Id error");
                    break;
                case 401:
                    console.log("Token no valido");
            }
            return response.json();
        })

        .then(data => {
            // let token = data.token;
            // let id = data.id;
            // console.log(token);
            // console.log(id);
            // localStorage.setItem('token', token);
        })

}



let borrar = document.getElementById('borrar')
borrar.addEventListener('click', borrarCuenta)

function borrarCuenta(event) {

    let id = localStorage.getItem('id')
    let token = localStorage.getItem('token')
    let username = localStorage.getItem('username')

    let imputNombre = document.querySelector('#nombre');
    let nombre = imputNombre.value;

    // let imputUsu = document.querySelector('#usu');
    // let usu = imputUsu.value;

    let inputEstatura = document.querySelector('#estatura');
    let estatura = inputEstatura.value;

    let inputpeso = document.querySelector('#peso');
    let peso = inputpeso.value;

    let inputfecha = document.querySelector('#fecha');
    let fecha = inputfecha.value;

    let inputactiv = document.querySelector('#activ');
    let activ = inputactiv.value;

    let persona = {
        id: id,
        username: username,
        token: token,
        fullname: nombre,
        height: estatura,
        weight: peso,
        birthday: fecha,
        activities: activ
    }


    console.log(persona);

    let usuario = JSON.stringify(persona);

    event.preventDefault();
    fetch(`http://localhost/dwes/PROYECTO_2TRI/APIS/api.php?id=${id}`, {
        method: 'DELETE',
        headers: {
            'Authorization': token,
        },
        body: usuario
    })

        .then(response => {
            switch (response.status) {
                case 200:
                    console.log("Uusario Eliminado");
                    return response.json();
                    break;
                case 400:
                    console.log("ERROR");
                    break;
                case 404:
                    console.log("No indicaste el id");
                    break;
            }
        })

        .then(data => {
            if (data == null) {
                console.log(data);
                localStorage.removeItem('token')
                localStorage.removeItem('id')
                window.location.href = ('http://localhost/dwes/PROYECTO_2TRI/PAGINA1/pagian_inicio.php')
            }
            else {
                console.log(data);
                localStorage.removeItem('token')
                localStorage.removeItem('id')
                window.location.href = ('http://localhost/dwes/PROYECTO_2TRI/PAGINA1/pagian_inicio.php')
            }
        })


}