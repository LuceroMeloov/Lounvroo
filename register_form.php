<?php

@include 'config.php';

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = md5($_POST['password']);
   $cpass = md5($_POST['cpassword']);
   $user_type = $_POST['user_type'];

   $select = " SELECT * FROM user_form WHERE email = '$email' && password = '$pass' ";

   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){

      $error[] = 'Ya existe este usuario!';

   }else{

      if($pass != $cpass){
         $error[] = 'La contraseña no coincide!';
      }else{
         $insert = "INSERT INTO user_form(name, email, password, user_type) VALUES('$name','$email','$pass','$user_type')";
         mysqli_query($conn, $insert);
         header('location:login_form.php');
      }
   }

};


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>register form</title>
     <!--Google Font-->
     <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
   <!-- custom css file link  -->
   <link rel="stylesheet" href="style.css">

</head>
<body>
<div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>

<div class="form-container">

   <form action="" method="post">
   <h3><center>Registrate</center>
            <span>Crea una cuenta nueva.</span>
        </h3>
      <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>

      
        <label for="name">Nombre de usuario:</label>
      <input type="text" name="name" required placeholder="Ej. Lucero Abogado" id="name">

      <label for="email">Correo:</label>
      <input type="email" name="email" required placeholder="Ingresa tu correo" id="email">

      <label for="email">Contraseña:</label>
      <input type="password" name="password" required placeholder="Ingresa tu contraseña" id="password">

      <label for="email">Confirma tu contraseña:</label>
      <input type="password" name="cpassword" required placeholder="Escribe de nuevo tu contraseña" id="cpassword">
      <select name="user_type" class="op">

         <option class="op1" value="user">Usuario</option>
         <option class="op2" value="admin">Administrador</option>
      </select>
      <input type="submit" name="submit" value="Registrate" class="form-btn">
      <p>Ya tienes cuenta? <a href="login_form.php">Iniciar</a></p>
   </form>

</div>

</body>
</html>