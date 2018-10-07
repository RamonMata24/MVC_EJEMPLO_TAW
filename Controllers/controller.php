<?php

	class MvcController {

		//llamar a la plantilla

		public function pagina(){
			//include se utiliza para invocar el archivo que contiene el codigo HTML!
			include('Views/template.php');
		}

		// INTERACCION CON EL USUARIO


		public function enlacesPaginasController(){
			// trabajar con los enlaces de las paginas
			//validamos si la variable "action" viene vacia , es decir , cuando se abre la pagina por primera vez se debe cargar la vista index.php


			if (isset($_GET['action'])) {
				//guardar el valor de la variable action en "Views/modules/navegacion.php en el cual se recibe mediante el metodo GET esa variable "

				$enlacesController = $_GET['action'];

			}else{
				//si viene vacio inicializo con index

				$enlacesController = "index";
			}

			//mostrar los archivos de los enlaces de cada una de las secciones: Inicio , nosotros ,etc.
			//PARA ESTO HAY QUE MANDAR AL MODELO PARA QUE SE HAGA DICHO PROCESO Y MUESTRE LA INFORMACION

			$respuesta = Paginas::enlacesPaginasModel($enlacesController);
			include $respuesta;

		}



		public function registroUsuarioController(){

			if(isset($_POST['usuarioRegistro'])){
				$datosController = array(   "usuario"=>$_POST['usuarioRegistro'],
											"email"=>$_POST['emailRegistro'],
											"password"=>$_POST['passwordRegistro']);

				$respuesta = Datos::registroUsuarioModel($datosController,"users");

				if($respuesta == "success"){
					header("Location: index.php?action=Ok");
				}
				else{
					header("location:index.php");
				}

			}

		}

		public function ingresarUsuarioController(){
		
		if(isset($_POST["acceder"])){
			
			$datosController = array( "usuario"=>$_POST["usuarioIngreso"], 
								      "password"=>$_POST["passwordIngreso"]);

			$respuesta = Datos::ingresarUsuarioModel($datosController, "users");
			
			if($respuesta["username"] == $_POST["usuarioIngreso"] && $respuesta["pass"] == $_POST["passwordIngreso"]){
				session_start();
				$_SESSION["usuario"] = true;
				
				header("Location: index.php?action=usuarios");
			}else{
				header("Location: index.php?action=fallo");
			}
		}	
	}
	

		public function VistaUsuarioController(){

			$respuesta = Datos::vistaUsuarioModel("users");
			echo ' <style>
			table {
				font-family: cursive;
				border-collapse: collapse;
				width: 20%;
			}
			
			td, th {
				border: 7px solid #dddddd;
				text-align: center;
				padding: 8px;
			}
			
			tr:nth-child(even) {
				background-color: #D5F5E3;
			}
			</style>
			
			<table>
					<thead>
						<tr>
							<th>Id</th>
							<th>Username</th>
							<th>E-mail</th>
							<th>Editar</th>
							<th>Eliminar</th>
						</tr>
					</thead>
					<tbody>';
						foreach($respuesta as $usuario){
						echo'<tr>
						<td id="id">'.$usuario["id_user"].'</td>
						<td>'.$usuario["username"].'</td>
						<td>'.($usuario["email"]).'</td>
						<td><a href="index.php?action=editar&id='.$usuario["id_user"].'">Editar</a></td>
						<td><a href="index.php?action=eliminar&id='.$usuario["id_user"].'">Eliminar</a></td>
						</tr>
							';
						}
			echo '</tbody>
				</table>';





		}

		public function borrarUsuarioController(){

			if(isset($_GET["id"])){
				$datosController = $_GET["id"];
				$respuesta = Datos::borrarUsuarioModel($datosController,"users");
				
				if($respuesta == "success"){
					
					header("location:index.php?action=usuarios");
				}
			}
		
		
			
		}



		public function getUser(){
			if (isset($_GET['id'])) {
				$id = $_GET['id'];
				$respuesta = Datos::getUser($id, 'users');
				echo '<input type="hidden" name="id" value="'.$respuesta["id"].'">
					<label>Nombre:</label><br>
					<input type="text" value="'.$respuesta["usuario"].'" name="usuario" required><br>
					<label>Email:</label><br>
					<input type="email" value="'.$respuesta["email"].'" name="email" required><br>
					<label>Password:</label><br>
					<input type="text" value="'.$respuesta["password"].'" name="password" required><br>
					<input type="submit" value="Actualizar">';
			}
			
		}
		public function actualizarUsuarioController(){
			if (isset($_POST['id'])) {
				$datosController = array(
					'id' => $_POST['id'],
					'usuario' => $_POST['usuario'],
					'password' => $_POST['password'],
					'email' => $_POST['email']
				);
				$respuesta = Datos::actualizarUsuarioModel($datosController, 'users');
				if($respuesta == "success"){
					header("location:index.php?action=cambio");
				} else {
					echo 'Error al actualizar';
				}
			}
				
		}












	}
	

?>