import {mensaje} from './UtilSweetMessage.js';

//Funcion anonima auto ejecutable
(async function(){

    //ELEMENTOS DOM
    let secciones = document.getElementById('secciones');
    let salir = document.getElementById('salir');


    //SALIR
    salir.addEventListener('click', function(e){
        console.log("salir");
        e.preventDefault();
        Salir();
    })
    
    async function Salir(){
        console.log("salir");
        const data = new FormData();
        data.append('metodo', 'Salir');
        
        try{
            let response = await fetch('../App/Controllers/Controller.php', {
                method: 'POST',
                body: data
            });
            let respuesta = await response.text();

            if(respuesta == "ok"){
                window.location="/Admin/index.php";                
            }           
        }catch(error){
            mensaje('Error para conectarse al servidor', 'error');  	
        }
    }
   
})();


