<?php 
    
    //la sesion iniciada se valida de otro caso pide que se ingrese
    
    
    session_start();
	if (!$_SESSION['usuario']) {
		header('location:index.php?action=ingresar');
		exit();
	}
?>

<h1>EDITAR USUARIO</h1> 

<form method="post">
	
    <?php 
    
        //objeto controller con el ejecutamos las funciones getUser y actualizaUsuarioController
		$editar = new MvcController();
		$editar->getUser();
		$editar->actualizarUsuarioController();
	?>

</form>

