import {mensaje} from './UtilSweetMessage.js';
import {agregarTable, listarSecciones, listarSubSecciones} from './post_agregarFunciones.js';

(async function() {

    //SUMMERNOTE
    let $sumNote = $("#ta-1")
		.summernote({
            placeholder: 'Write your content here',
            height: 250,
			callbacks: { 
                onPaste: function(e,x,d) { 
                    $sumNote.code(($($sumNote.code()).find("font").remove())); 
            
                }
            },
			dialogsInBody: true,
			dialogsFade: true,
			disableDragAndDrop: true,
			tableClassName: function() {
				$(this).addClass("table table-bordered").attr("cellpadding", 0).attr("cellspacing", 0).attr("border", 1).css("borderCollapse", "collapse").css("table-layout", "fixed").css("width", "100%");
				$(this).find("td").css("borderColor", "#ccc").css("padding", "4px");
			}
	}).data("summernote");

    //BOTONES
    let agregar = document.getElementById("agregar");
    let reiniciar = document.getElementById("reiniciar");
   
    //INPUTS    
    let SelectSeccion = document.getElementById('Seccion');
    let SelectSubseccion = document.getElementById('Subseccion');    
    let InputSeccion = document.getElementById('InputSeccion');    
    let InputSubseccion = document.getElementById('InputSubseccion');    
    let frmPost = document.getElementById("frmPost");
    let resultado = document.getElementById("resultado");
   
    listarSecciones(SelectSeccion, '../App/Controllers/ControllerSeccion.php', InputSeccion);
    listarSubSecciones(SelectSubseccion, '../App/Controllers/ControllerSubSeccion.php', InputSubseccion, 'IdSeccion', 1);


    //AGREGAR
    agregar.addEventListener('click', async function(e){
        e.preventDefault();
        agregarTable(frmPost);
        $sumNote.reset();
		$("#content").empty();
    })  
    
    //SELECT
    SelectSeccion.addEventListener('change', function(){
        while (SelectSubseccion.firstChild) {
            SelectSubseccion.removeChild(SelectSubseccion.firstChild);
        }
        listarSubSecciones(SelectSubseccion, '../App/Controllers/ControllerSubSeccion.php', InputSubseccion, 'IdSeccion', SelectSeccion.options[SelectSeccion.selectedIndex].value);        
    })

    //REINICIAR
    reiniciar.addEventListener('click', function(e){
        e.preventDefault();
        $sumNote.reset();
		$("#content").empty();
        var div = document.getElementById('resultado');
        while (div.firstChild) {
            div.removeChild(div.firstChild);
        }
    })    

    //IMAGENES 
    img.addEventListener('change', (e) => {
        let file = e.target.files[0];
        let img = URL.createObjectURL(file);
        let sizeByte = file.size;
        let siezekiloByte = parseInt(sizeByte / 1024);
        
        if (!(/\.(jpg|png|gif)$/i).test(file.name)) {
            mensaje('Tipo de archivo NO Admitido', 'error');        
        }else{
            if(siezekiloByte > 1024){
                mensaje('Tamaño maximo de archivo 1MB', 'error');        
            }else{
                mensaje('Imagen Cargada', 'success');
            }
        }
    });

    //SALIR
    salir.addEventListener('click', function(e){
        e.preventDefault();
        Salir();
    })

    async function Salir(){
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