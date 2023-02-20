let btn = document.getElementById('crear')
btn.addEventListener('click', validacion)


function validacion(event) {

    event.preventDefault();

    let segura = false;

    let imputNombre = document.querySelector('#nombre');
    let nombre = imputNombre.value;

    let imputUsu = document.querySelector('#usu');
    let usu = imputUsu.value;

    let inputEstatura = document.querySelector('#estatura');
    let estatura = inputEstatura.value;

    let inputpeso = document.querySelector('#peso');
    let peso = inputpeso.value;

    let inputfecha = document.querySelector('#fecha');
    let fecha = inputfecha.value;

    let inputactiv = document.querySelector('#activ');
    let activ = inputactiv.value;

    let contraseña = document.querySelector('#pass');
    let pass = contraseña.value;
    console.log(pass);

    let contraseña1 = document.querySelector('#pass1');
    let pass1 = contraseña1.value;

    let inputMail = document.querySelector('#mail');
    let mail = inputMail.value;

    let letras = pass.split('');

    console.log(letras.length);


    if (pass != pass1) {
        alert("No es la misma contraseña");
    }
    // else if (mail.includes('@') && mail.includes('.')){
    //     if(numero>0 && numLetters == 0 && mayusculas == 0 && simbolos == 0){
    //         if(letras.length < 12){
    //             console.log("inmediatly");
    //         }
    //         else if(letras.length > 12){
    //             console.log("Muy poco segura");
    //         }
    //     }
    else if (letras.length > 8 && mail.includes('@') && mail.includes('.')) {
        segura = true;
    }


    if (segura == true) {
        let persona = {
            fullname: nombre,
            username: usu,
            email: mail,
            pass: pass,
            height: estatura,
            weight: peso,
            birthday: fecha,
            activities: activ
        }

        console.log(persona);

        let usuario = JSON.stringify(persona);

        console.log(usuario);


        // fetch('http://localhost:5000/api/register',{
        //     method : 'POST',
        //     headers: {
        //         'Content-Type' : 'application/json'
        //     },
        //     body: usuario})

        //     .then (response => {
        //             switch (response.status){
        //                 case 200:
        //                     console.log("REGITRADO CON EXITO");
        //                     break;
        //                 case 400:
        //                     console.log("ERROR");
        //             }
        //             return response.json();
        //         })

        //     .then ( data => {
        //         console.log(data);

        //     })

        fetch('http://localhost/dwes/PROYECTO_2TRI/APIS/api.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json;charser=utf-8'
            },
            body: usuario
        })

            .then(response => {
                switch (response.status) {
                    case 201:
                        console.log("REGITRADO CON EXITO");
                        break;
                        case 409:
                        console.log("USUARIO EXISTE");
                        break;
                    case 400:
                        console.log("ERROR");
                }
                return response.json();

            })

            .then(data => {
                console.log(data);

            })

    }
    else {
        alert('cambiar contraseña o el correo');
    }
}