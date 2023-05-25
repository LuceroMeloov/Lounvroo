<?php

@include 'config.php';

session_start();

if(isset($_POST['submit'])){


   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = md5($_POST['password']);
  


   $select = " SELECT * FROM user_form WHERE email = '$email' && password = '$pass' ";

   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){

      $row = mysqli_fetch_array($result);

      if($row['user_type'] == 'admin'){

         $_SESSION['admin_name'] = $row['name'];
         header('location:admin_page.php');

      }elseif($row['user_type'] == 'user'){

         $_SESSION['user_name'] = $row['name'];
         header('location:user_page.php');

      }
     
   }else{
      $error[] = 'Contraseña o correo incorrecto!';
   }

};
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>login form</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="style2.css">

</head>
<body>
<div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>

<div class="form-container">

   <form action="" method="post">
   <h3><center>Bienvenido</center>
            <span>Inicia con tu cuenta.</span>
        </h3>


      <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>
        <label for="email">Correo:</label>
      <input type="email" name="email" required placeholder="Ingresa tu correo" id="email">

      <label for="email">Contraseña:</label>
      <input type="password" name="password" required placeholder="Ingresa tu contraseña" id="password">
      
      <input type="submit" name="submit" value="Iniciar" class="form-btn">
      <p>No tienes cuenta? <a href="register_form.php">Registrate aqui</a></p>
   </form>

</div>

</body>
</html>