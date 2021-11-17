<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/programador.ico">
    <link rel="stylesheet" href="principal.css">
    <script src="https://kit.fontawesome.com/8f3359630e.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <title>Control Reporte Compras</title>
</head>
<body>
<?php
        if($_SESSION){
        
        }else{
                ?>
                    <script>
                        window.location="login.php"
                    </script>
                <?php
            }
        ?>
        <div class="contenedor-fluid">
                <main class="main row">
                    <header class=" header col-12 bg-primary d-flex justify-content-around">
                        <div class="d-flex align-items-center"><i class="fas fa-map-marked-alt pe-2"></i>Dirección : Av. Bolivar n° 100 Villa El Salvador</div>
                        <div class="redes d-flex align-items-center">
                        <p class="pe-3"><i class="fab fa-facebook-square pe-2"></i>Facebook</p>
                        <p class="pe-3"><i class="fab fa-instagram pe-2"></i>Instagram</p>
                        <p class="pe-3"><i class="fab fa-twitter pe-2"></i>Twitter</p>
                        </div>
                        <div class="d-flex align-items-center"><i class="fas fa-phone-square-alt pe-2"></i>Teléfono: 933484261</div>
                    </header>
                    <nav class="nav col-2 bg-light ">
                    <div class="datospersonales mt-1">
                                <a href="principal.php"><img src="img/programador.png" class="imgdato ms-5 mb-2" alt=""></a>
                                <p><i class="fas fa-user-shield ms-4 pe-1"></i>Usuario:<span><?php echo $_SESSION['loaduser']?></span></p>
                                <p><i class="fas fa-arrow-circle-up ms-4 pe-1"></i> Rol:<span><?php echo $_SESSION['loadrol']?></span></p>
                            </div>
                            <div class="menu mb-1">
                                <a class="a btn btn-secondary mb-1 text-start" href="vercliente.php"><i class="fas fa-house-user px-2"></i>Clientes</a>
                                <a class="a btn btn-secondary mb-1 text-start" href="productos.php"><i class="fas fa-box-open px-2"></i>Productos</a>
                                <a class="a btn btn-secondary mb-1 text-start" href="#"><i class="fas fa-dolly px-2"></i>Ventas</a>
                                <a class="a btn btn-secondary mb-1 text-start" href="compras.php"><i class="fas fa-cart-arrow-down px-2"></i>Compras</a>
                                <a class="a btn btn-secondary mb-1 text-start" href="reportecompras.php"><i class="fas fa-file-alt px-2"></i>Reporte Compras</a>
                                <a class="a btn btn-secondary mb-1 text-start" href="#"><i class="fas fa-file-alt px-2"></i>Reporte Ventas</a>
                                <?php
                                    if($_SESSION['loadrol']==1){
                                        ?>
                                            <a class="a btn btn-secondary mb-1 text-start" href="verusuario.php"><i class="fas fa-user-cog px-2"></i>Usuarios</a>
                                            <a class="a btn btn-secondary mb-1 text-start" href="proveedor.php"><i class="fas fa-file-medical px-2"></i>Proveedor</a>
                                        <?php
                                    }
                                ?>
                            </div>
                        <div class="cerrar">
                        <form action="reportecompras.php" method="post">
                                    <input class="a btn btn-danger text-start ms-5" name="sesiondetroy" type="submit" value="Cerrar Sesión">
                                    </form>
                        </div>
                    </nav>
                    <section class="section col-10 bg-dark">
                    <p class=" text-light my-4 mb-1 text-center">Bienvenido <span></span>a Reporte Compras</p>
                    <form method="post" action="reportecompras.php" enctype="multipart/form-data" class="mt-5 d-flex justify-content-center">
                        <div class="card col-6 text-light">
                            <div class="card-header bg-secondary text-center">
                                Agregar Archivo de Compra
                            </div>
                            <div class="card-body bg-primary">
                                <div class="custom-file">
                                <input id="my-input" class="custom-file-input" type="file" name="archivocompra">
                                </div>
                            </div>
                            <div class="card-footer text-center">
                            <input type="submit" name="guardararchivo" class="btn btn-danger" value="Guardar PDF Compra">
                            </div>
                        </div>
                    </form>
                    </section>
                </main>
            </div>
</body>
</html>

<?php
    if(isset($_POST['guardararchivo'])){
        $file= $_FILES['archivocompra']['name'];
        $usuario=$_SESSION['loadid'];
        if(!empty($file)){
            if($_FILES['archivocompra']){
                $nombrearch = basename($_FILES['archivocompra']['name']);
                $nombreguardar = date('m-d-y')."--".date('h-i-s')."--".$nombrearch;
                $ruta = "compraspdf/".$nombreguardar;
                $moverarchivo = move_uploaded_file($_FILES['archivocompra']['tmp_name'],$ruta);
                if($moverarchivo){
                    include("conexion.php");
                    $consulta="INSERT INTO compra (idusuario, archivo_compra) values ('$usuario','$ruta')";
                    $resultado= mysqli_query($conexion,$consulta);
                    if($resultado==1){
                        ?>
                            <script>
                                window.location="reportecompras.php";
                            </script>
                        <?php
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
                            icon: 'error',
                            title: 'Fallo en Compra!'
                            })
                            </script>
                    <?php
                    }
                }
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
                title: 'Falta agregar pdf de Compra'
                })
                </script>
                    <?php
        }
    }
    if(isset($_POST['sesiondetroy'])){
        session_start();
        session_destroy();
        ?>
            <script>
                Swal.fire({
                position:'top',
                title: "Cerraste Sesión",
                allowOutsideClick: false,
                allowEscapeKey: false,
                confirmButtonText: 'Login',
                }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    window.location="login.php"
                } 
                });
            </script>
        <?php
    }
?>