import {mensaje} from './SweetMessage.js';

//Funcion anonima auto ejecutable
(function(){

    //Elementos DOM
    let secciones = document.getElementById('secciones');

    ListarSecciones();

    async function ListarSecciones(){
        const data = new FormData();
        data.append('metodo', 'Listar');
        
        try{
            let response = await fetch('../App/Controllers/ControllerSeccion.php', {
                method: 'POST',
                body: data
            });
            let dataRes = await response.json();
            
            let nodos = [];
            if(dataRes.length > 0){
                dataRes.forEach( element => {
                    nodos.push(crearSeccion(element));                           
                });
                secciones.append(...nodos);
            }else{
                mensaje('No existen secciones agregadas', 'error');  	 	    
            }

        }catch(error){
            mensaje('Error para conectarse al servidor', 'error');  	
        }
    }

    function crearSeccion(element){
        let seccion = document.createElement("li");    
        seccion.className ="list-group-item d-flex justify-content-between align-items-center";
        seccion.innerHTML = element.Nombre;
        return seccion;
    }
    
})();


