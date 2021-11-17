<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/programador.ico">
    <script src="https://kit.fontawesome.com/8f3359630e.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <title>Login</title>
    <style>
        body{
            background-color: black;
        }
    </style>
</head>
<body>
    
    <?php
        if($_SESSION){
            header("location:principal.php");
        }else {
        ?>

            <div class="container-fluid d-flex mt-5 justify-content-center">
            <form action="login.php" method="POST" class="col col-4 bg-danger d-flex justify-content-around flex-wrap">
                <div class="my-5 col-lg-10">
                    <h2 class="text-center text-light ">Iniciar Sesión</h2>
                </div>
                <div class="mb-3 col-8">
                    <label for="verusuario" class="form-label text-light"><i class="fas fa-user-shield pe-2"></i>Usuario</label>
                    <input type="text" class="form-control" name="loaduser"id="verusuario" placeholder="Usuario">
                </div>
                <div class="mb-4 col-8">
                    <label for="verclave" class="form-label text-light"><i class="fas fa-key pe-2"></i>Contraseña</label>
                    <input type="password" class="form-control" name="loadpass" id="verclave" placeholder="Contraseña">
                </div>
                <div class="col-12  mb-5 d-flex justify-content-center">
                    <div class="col-2">
                        <label for="verrol" class="form-label text-light"><i class="fas fa-lock-open pe-2"></i>Rol</label>
                    </div>
                    <div class="col-6">
                        <select class="form-select" name="loadrol"id="verrol"aria-label="Default select example">
                            <option >1</option>
                            <option >2</option>
                            </select>
                    </div>
                </div>
                <div class="col-4 mb-4">
                    <input type="submit" class="btn btn-dark" name="iniciarsesion" value="Iniciar Sesión">
                </div>
            </form>
            </div>
        <?php
        }
    ?>
</body>
</html>
<?php
    if(isset($_POST['iniciarsesion'])){
        $user=$_POST['loaduser'];
        $pasw=$_POST['loadpass'];
        $r=$_POST['loadrol'];
        include("conexion.php");
        if(!$user=="" && !$pasw==""){
            $consulta = "SELECT * FROM todousuario where usuario='$user'and contraseña='$pasw' and id_rol='$r'";
            $resultado=mysqli_query($conexion,$consulta);
            $filas=mysqli_num_rows($resultado);
            if($filas==1){
                $consulta = "SELECT * FROM todousuario where usuario='$user'";
                $query=$conexion->query($consulta);
                while ($re=$query->fetch_array()):
                    $_SESSION['loaduser'] = $user;
                    $_SESSION['loadrol'] = $r;
                    $_SESSION['loadid']=$re['idusuario'];
                endwhile;
                ?>
                    <script>
                        window.location="principal.php";
                    </script>
                <?php
            }
            else{
                $user="";
                $pass="";
                ?>
                  <script> 
                  const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                    })
                    Toast.fire({
                    icon: 'error',
                    title: 'Datos Erroneos!'
                    })
                  </script>
              <?php
            }
        }else{
            ?>
                 <script> 
                  const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                    })
                    Toast.fire({
                    icon: 'warning',
                    title: 'Todos los campos son obligatorios!'
                    })
                  </script>
            <?php
        }
        mysqli_free_result($resultado);
        mysqli_close($conexion);
    }
    
?>