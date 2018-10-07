<?php

    require_once("conexion.php");// requerimos la conexion para trabajr con las funciones


    class Datos extends Conexion{// clase datos con extend conexion
        /*
       --- FUNCION PARA REGISTRAR USURIOS 
        */
        public function registroUsuarioModel($datosModel,$tabla){
            // Sentencia preparada con a conexion 
            $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (username,email,pass) VALUES (:usuario,:email,:password)");   
            // parametros de la sentencia para el insert
            $stmt->bindParam(":usuario",$datosModel['usuario'], PDO::PARAM_STR);
            $stmt->bindParam(":email",$datosModel['email'], PDO::PARAM_STR);
            $stmt->bindParam(":password",$datosModel['password'], PDO::PARAM_STR);
            // condicion si se ejecuta 
            if($stmt->execute()){
                return "success";//regresa success
            }else{//de otro modo
                return "error";// regresa error
            }
    
            $stmt->close();//se cierra la conexion
        }   

        // Funcion de ingresar usuarios que recibe dos parametros con los cuales trabaja ,los parametros viene del script controller.php
        //la funcion contiene una sentencia sql mediante PDO para trabajr con la tabla 
        public  function ingresarUsuarioModel($UsuarioModel, $tabla){
            $stmt = Conexion::conectar()->prepare("SELECT username, pass FROM $tabla WHERE username = :usuario AND pass = :password");	//
            $stmt->bindParam(":usuario", $UsuarioModel["usuario"], PDO::PARAM_STR);//
            $stmt->bindParam(":password", $UsuarioModel["password"], PDO::PARAM_STR);//
            $stmt->execute();
    
            return $stmt->fetch();//se obtienen todas las filas y regresan los datos mediante el fetch
    
            $stmt->close();//se cierra la conexion
        }

        // Funcion para tener una vista de los usuarios que recibe un parametro con los cuales trabaja , los parametros viene del script controller.php
        //la funcion contiene una sentencia sql mediante PDO para trabajr con la tabla 
        public function vistaUsuarioModel($tabla){

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");	
            $stmt->execute();
        
            return $stmt->fetchAll();//se obtienen todas las filas y regresan los datos mediante el fetch
    
    
            $stmt->close();//se cierra la conexion
    
        }
        // Funcion para borrar un usuario que recibe un parametro con los cuales trabaja , los parametros viene del script controller.php
        //la funcion contiene una sentencia sql mediante PDO para trabajr con la tabla 

        public function borrarUsuarioModel($UsuarioModel,$tabla){

            $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_user = :id");//
            $stmt->bindParam(":id", $UsuarioModel, PDO::PARAM_INT);//
            if($stmt->execute()){//se ejecuta
                return "success";//regresa el success
            }else{
                return "error";//regresa error
            }
            $stmt->close();// se cierra la conexion
        }

         // Funcion para actualizar un usuario que recibe un parametro con los cuales trabaja , los parametros viene del script controller.php
        //la funcion contiene una sentencia sql mediante PDO para trabajr con la tabla 

        public  function actualizarUsuarioModel($UsuarioModel,$tabla){

            $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET username = :usuario, email = :email , pass = :password WHERE id_user = :id");//
            $stmt->bindParam(":usuario", $UsuarioModel["usuario"], PDO::PARAM_STR);//
            $stmt->bindParam(":email", $UsuarioModel["email"], PDO::PARAM_STR);//
            $stmt->bindParam(":password", $UsuarioModel["password"], PDO::PARAM_STR);//
            $stmt->bindParam(":id", $UsuarioModel, PDO::PARAM_INT);//
            
            if($stmt->execute()){//se ejecuta
                return "success";//regresa el success

            }else {
                return "error"; //regresa error
            }
            $stmt->close();// se cierra la conexion
        }
          // Funcion para obtener un usuario que recibe dos parametros con los cuales trabaja , los parametros viene del script controller.php
        //la funcion contiene una sentencia sql mediante PDO para trabajr con la tabla 

        public function getUser($id, $tabla){//
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla where id = :id");//
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);//
            $stmt->execute();//se ejecuta
            return $stmt->fetch();//trae el resultado
            $stmt->close();//Se cierra la conexion
        }




    }



?>