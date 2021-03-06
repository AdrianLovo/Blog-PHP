<?php
    session_start();	
	if(!$_SESSION["IdUsuario"]){		
		header("location:../index.php");        
	}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog - Usuarios</title>
    
    <!--Icono | Bootstrap | Sweet-->
    <link rel="shortcut icon" href="/Resources/img/favicon.ico">  
    <link rel="stylesheet" href="/Resources/bootstrap-4.5.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="/Resources/sweet/sweetalert2.min.css">
    <link rel="stylesheet" href="/Resources/css/style.min.css">

    <!--DataTable-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.min.css">
</head>
<body>

    <!--Menu Principal-->
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark sticky-top">
        <a id="user" class="navbar-brand" href="home.php">Inicio</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navb">
            <span class="navbar-toggler-icon"></span>
        </button>
  
        <div class="collapse navbar-collapse" id="navb">
            <ul class="navbar-nav mr-auto">                
                <?php
                    if($_SESSION['Tipo'] == 'A'){
                        include_once('menu/menu_admin.php');
                    }else{
                        include_once('menu/menu_user.php');
                    }                    
                ?>             
            </ul>
        </div>
  
            <!--<form class="form-inline my-2 my-lg-0 text-white">
                LOGO
            </form>-->
        </div>
    </nav>


    <div class="container col-xl-12 col-lg-12 col-sm-12 col-12">
        <ul  class="nav nav-tabs mt-5" id="pills-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="pills-listar-tab" data-toggle="pill" href="#pills-listar" role="tab" aria-controls="pills-listar" aria-selected="true">Listado</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-agregar-tab" data-toggle="pill" href="#pills-agregar" role="tab" aria-controls="pills-agregar" aria-selected="false">Agregar</a>
            </li>
            <li class="nav-item">
                <a class="nav-link disabled" id="pills-modificar-tab" data-toggle="pill" href="#pills-modificar" role="tab" aria-controls="pills-modificar" aria-selected="false">Modificar</a>
            </li>
        </ul>
    
    
        <div class="tab-content" id="pills-tabContent">            
            
            <!--Listar | Eliminar-->
            <div class="tab-pane fade show active pt-3" id="pills-listar" role="tabpanel" aria-labelledby="pills-listar-tab">
                
                <table id="tablaUsuario" class="table table-bordered"  data-page-length='10' style="width:100%">
                    <thead class="thead-dark">
                        <tr>
                            <th style="width:5%">Id</th>
                            <th>Email</th>
                            <th>UltimoInicio</th>
                            <th>Tipo</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                
                    </tbody>        
                </table>   

            </div>
        
            <!--AGREGAR-->
            <div class="tab-pane fade" id="pills-agregar" role="tabpanel" aria-labelledby="pills-agregar-tab">
                <div class="card mt-3 col-md-10  offset-md-1">
                    
                    <form method="post" action="" id="frmUsuario" autocomplete="off">  
                        <input type="text" name="metodo" value="Agregar" style="display:none">                      
                        
                        <div class="form-row pt-4">
                            <div class="form-group col-md-5 offset-md-1">
                                <label for="Email">Email</label>
                                <input type="email" class="form-control" id="Email" name="Email" placeholder="name@example.com" require>                        
                            </div>
                            <div class="form-group col-md-5">
                                <label for="Password">Password</label>
                                <input type="password" class="form-control" id="Password" name="Password" placeholder="*****" require>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-5 offset-md-1">
                                <label for="Tipo">Tipo</label>
                                <select id="Tipo" name="Tipo" class="form-control" require>
                                    <option value="A">Admin</option>
                                    <option value="U">User</option>
                                </select>
                            </div>
                            <div class="form-group col-md-5">
                                <label for="img">Imagen</label>
                                <input type="file" name="imagen" id="img" accept=".jpg,.png,jpeg" class="form-control">                            
                            </div>
                        </div>

                        <div class="text-center">
                            <img src="/Resources/img/default.png" alt="Vista Previa" id="imgPrevia">
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-5 offset-md-1">
                                <button class="btn btn-lg btn-primary mt-1" id="agregar" >Agregar</button>                        
                            </div>
                        </div>
                    </form>

                </div>                
            </div>

            <!--MODIFICAR-->
            <div class="tab-pane fade" id="pills-modificar" role="tabpanel" aria-labelledby="pills-modificar-tab">
                <div class="card mt-3 col-md-10  offset-md-1">
                    
                    <form method="post" action="" id="frmUsuarioE" autocomplete="off">  
                        <input type="text" name="metodo" value="Modificar" style="display:none">       
                        <input type="text" id="IdUsuarioE" name="IdUsuarioE" value="" style="display:none"> 
                        <input type="text" id="ImagenEOld" name="ImagenEOld" value="" style="display:none">                      
                        <input type="text" id="FilaE" name="FilaE" value="" style="display:none">     
                        
                        <div class="form-row pt-4">
                            <div class="form-group col-md-5 offset-md-1">
                                <label for="EmailE">Email</label>
                                <input type="email" class="form-control" id="EmailE" name="EmailE" placeholder="name@example.com">                        
                            </div>      
                            <!--<div class="form-group col-md-5">
                                <label for="PasswordE">Password</label>
                                <input type="password" class="form-control" id="PasswordE" name="PasswordE" placeholder="*****">
                            </div>-->   
                            <div class="form-group col-md-5 offset-md-1">
                                <label for="Tipo">Tipo</label>
                                <select id="TipoE" name="TipoE" class="form-control">
                                    <option value="A">Admin</option>
                                    <option value="U">User</option>
                                </select>
                            </div>                          
                        </div>

                        <div class="form-row">           
                            <div class="form-group col-md-5 offset-md-1">
                                <label for="imgE">Imagen</label>
                                <input type="file" name="imagenE" id="imgE" accept=".jpg,.png,jpeg" class="form-control">                            
                            </div>
                        </div>

                        <div class="text-center">
                            <img src="/Resources/img/default.png" alt="Vista Previa" id="imgPreviaE">
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-5 offset-md-1">
                                <button class="btn btn-lg btn-primary mt-1" id="modificar">Modificar</button>                        
                                <button class="btn btn-lg btn-dark mt-1" id="cancelar">Cancelar</button>    
                            </div>
                        </div>
                    </form>

                </div>       
            </div>

        </div>
    </div>

    

    <!--DataTable-->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.min.js"></script>

    <!--Librerias  Bootstrap | SweetAlert-->
    <script src="/Resources/bootstrap-4.5.3/js/bootstrap.min.js"></script>
    <script src="/Resources/sweet/sweetalert2.min.js"></script>

    <!--Controlador JS -->
    <script type="module" src="/Admin/js/usuarios.js"></script>

</body>
</html>