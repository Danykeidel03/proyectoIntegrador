let btn = document.getElementById('crear')
btn.addEventListener('click', inicio)


function inicio(event) {
    event.preventDefault();

    let imputUsu = document.querySelector('#usu');
    let usu = imputUsu.value;

    let contraseña = document.querySelector('#pass');
    let pass = contraseña.value;
    console.log(pass);

    let persona = {
        username: usu,
        pass: pass,
    }

    console.log(persona);

    let usuario = JSON.stringify(persona);

    console.log(usuario);

    // fetch(`http://localhost:5000/api/checkuser?username=${usu}`, {
    //     method: 'GET',
    //     headers: {
    //         'Content-Type': 'application/json'
    //     },
    //     // body: usuario
    // })

    //     .then(response => {
    //         switch (response.status) {
    //             case 200:
    //                 console.log("USUARIO EXISTENTE");
    //                 break;
    //             case 400:
    //                 console.log("ERROR");
    //         }
    //         return response.json();
    //     })

    //     .then(data => {
    //         console.log(data);
    //     })


    // fetch(`http://localhost:5000/api/login`, {
    //     method: 'POST',
    //     headers: {
    //         'Content-Type': 'application/json'
    //     },
    //     body: usuario
    // })

    //     .then(response => {
    //         switch (response.status) {
    //             case 201:
    //                 console.log("SESION INICIADA");
    //                 break;
    //             case 401:
    //                 console.log("NO PUEDES INICIAR SESION");
    //         }
    //         return response.json();
    //     })

    //     .then(data => {
    //         let token = data.token;
    //         let id = data.id;
    //         console.log(token);
    //         console.log(id);
    //         localStorage.setItem('token', token);
    //         localStorage.setItem('id', id);
    //         window.location.href = ('http://localhost/dwes/PROYECTO_2TRI/PAGINA1/pagian_inicio.php')
    //     })


        fetch(`http://localhost/dwes/PROYECTO_2TRI/APIS/INICIO.PHP`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json;charser=utf-8'
        },
        body: usuario
    })

        .then(response => {
            switch (response.status) {
                case 201:
                    console.log("SESION INICIADA");
                    return response.json();
                    break;
                    case 401:
                        console.log("NO EXISTE EL USUARIO");
                        break;
                case 404:
                    console.log("NO PUEDES INICIAR SESION");
            }
            
        })

        .then(data => {
            if(data.id[0] != undefined ){
                console.log(data);
                // console.log(data.id[0].id);
                // console.log(data.token);
                let username = (data.username);
                let token = data.token;
                let id = data.id[0].id;
                // console.log(token);
                localStorage.setItem('username', username);
                localStorage.setItem('token', token);
                localStorage.setItem('id', id);
                window.location.href = ('http://localhost/dwes/PROYECTO_2TRI/PAGINA1/pagian_inicio.php')
            }else{
                alert('uusario no existe')
            }
            
        })
}





