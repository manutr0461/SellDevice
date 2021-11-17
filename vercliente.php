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
    <link rel="stylesheet" href="DataTables-1.11.3/css/dataTables.dataTables.min.css">
    <title>Control Cliente</title>
</head>
<body>
<?php
        if($_SESSION){
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
                    <nav class="nav col-2 bg-light">
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
                        <form action="vercliente.php" method="post">
                                    <input class="a btn btn-danger text-start ms-5" name="sesiondetroy" type="submit" value="Cerrar Sesión">
                                    </form>
                        </div>
                    </nav>
                    <section class="section col-10 bg-dark">
                    <p class=" text-light mt-5 mb-3 text-center">Bienvenido <span></span>a Cliente</p>
                    <button type="button" class="btn btn-success text-light mb-2" data-bs-toggle="modal" data-bs-target="#botonagregar">
                    <i class="fas fa-folder-plus pe-2"></i>Agregar Cliente
                    </button>

                        <div class="bg-light p-2">
                        <table class="table text-dark table-secondary my-3" id="tablita">
                            <thead class="table-dark">
                                <tr class="text-center">
                                <th scope="col" >Id</th>
                                <th scope="col" >Nombre</th>
                                <th scope="col" >Distrito</th>
                                <th scope="col" >Correo</th>
                                <th scope="col" >Operador</th>
                                <?php
                                        if($_SESSION['loadrol']==1){
                                            ?>
                                        <th width="250px" class="text-center">...</th>
                                        <?php
                                        }else{
                                            ?>
                                            <th class="text-center"></th>
                                            <?php
                                        }
                                    ?>
                                </tr>
                            </thead>
                                <?php
                                include("conexion.php");
                                $consulta = "SELECT * FROM cliente";
                                $query=$conexion->query($consulta);
                                ?>
                                <?php if($query->num_rows>0):?>
                            <tbody>
                                <?php while ($r=$query->fetch_array()):?>
                                <tr class="border border-dark">
                                <td class="text-center"><?php echo $r['idcliente'];?></td>
                                <td class="text-center"><?php echo $r['nombre'];?></td>
                                <td class="text-center"><?php echo $r['distrito'];?></td>
                                <td class="text-center"><?php echo $r['correo'];?></td>
                                <td class="text-center"><?php echo $r['idusuario'];?></td>
                                <td class="text-center">
                                    <?php
                                        if($_SESSION['loadrol']==1){
                                            ?>
                                            <button type="button" class="btn btn-warning text-light" data-bs-toggle="modal" data-bs-target="#btneditcli<?php echo $r['idcliente'];?>">
                                            <i class="fas fa-book-medical pe-2"></i>Editar
                                            </button>
                                            <button type="button" class="btn btn-danger text-light" data-bs-toggle="modal" data-bs-target="#btdeletecli<?php echo $r['idcliente'];?>">
                                            <i class="fas fa-trash pe-2"></i>Eliminar
                                            </button>
                                            <?php
                                        }else{
                                            echo "";
                                        }
                                    ?>
                                </td>
                            <div class="modal fade" id="btneditcli<?php echo $r['idcliente'];?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content bg-dark">
                            <form action="vercliente.php" method="POST" class="col col-12">
                                <div class="modal-header">
                                    <h5 class="modal-title text-warning" id="exampleModalLabel"><i class="fas fa-book-medical pe-2"></i>Editar Cliente</h5>
                                    <button type="button" class="btn-close bg-danger" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body d-flex justify-content-center flex-wrap">
                                        <div class="mb-3 col-8">
                                        <label  class="form-label text-light"><i class="fas fa-id-badge pe-2"></i>Id</label>
                                        <input type="text" readonly class="form-control" name="clienteeditid" value="<?php echo $r['idcliente'];?>">
                                        </div>
                                        <div class="mb-4 col-8">
                                        <label for="cne" class="form-label text-light"><i class="fas fa-user-shield pe-2"></i>Nombre</label>
                                        <input type="text" class="form-control" id="cne"name="clienteeditnombre" placeholder="Nombre" value="<?php echo $r['nombre'];?>">
                                        </div>
                                        <div class="mb-4 col-8">
                                        <label for="cde" class="form-label text-light"><i class="fas fa-map-marker-alt pe-2"></i>Distrito</label>
                                        <input type="text" class="form-control" id="cde"name="clienteeditdistrito" placeholder="Distrito" value="<?php echo $r['distrito'];?>">
                                        </div>
                                        <div class="mb-4 col-8">
                                        <label for="cce" class="form-label text-light"><i class="fas fa-key pe-2"></i>Correo Electronico</label>
                                        <input type="email" readonly class="form-control" id="cce"name="clienteeditcorreo" placeholder="Correo Electronico" value="<?php echo $r['correo'];?>">
                                        </div>
                                        <div class="col-8  mb-5">
                                        <div class="col-12">
                                            <label for="cre" class="form-label text-light"><i class="fas fa-lock-open pe-2"></i>Operador Id</label>
                                        </div>
                                        <div class="col-12">
                                            <select class="form-select" id="cre" name="clienteeditoperador" aria-label="Default select example">
                                                <option><?php echo $r['idusuario'];?></option>
                                                </select>
                                        </div>
                                </div>
                                    
                                <div class="modal-footer col-12">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                        <input type="submit" name="updatecliente" class="btn btn-warning text-light" Value="Editar Cliente">
                                </div>
                            </form>
                            </div>

                                </tr>
                                    <!-- Modal -->
                                <div class="modal fade" id="btdeletecli<?php echo $r['idcliente'];?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content bg-dark">
                                    <form action="vercliente.php" method="post">
                                    <div class="modal-header text-dark">
                                        <h5 class="modal-title text-danger" id="staticBackdropLabel"><i class="fas fa-trash pe-2"></i>Eliminar Cliente</h5>
                                        <button type="button" class="btn-close bg-danger" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        
                                            <p class="text-light">Deseas eliminar al Cliente: <span class="text-danger px-3"><?php echo $r['nombre'];?></span></p>
                                            <input type="hidden" name="borrarcliente" value="<?php echo $r['idcliente'];?>">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                        <input type="submit" name="deletecliente" class="btn btn-danger" Value="Eliminar">
                                    </div>
                                    </div>
                                    </form>
                                </div>
                                </div>
                                <?php endwhile;?>
                                <?php else:?>
                                <?php endif;?>
                            </tbody>
                        </table>
                        </div>
                    </section>
                </main>

                <!-- Modal -->
                <div class="modal fade" id="botonagregar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content bg-dark">
                        <form action="vercliente.php" method="post">
                            <div class="modal-header text-success">
                                <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-folder-plus pe-2"></i>Nuevo Cliente</h5>
                                <button type="button" class="btn-close bg-danger" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body d-flex justify-content-center flex-wrap">
                                        <div class="mb-4 col-8">
                                        <label for="cn" class="form-label text-light"><i class="fas fa-user-shield pe-2"></i>Nombre</label>
                                        <input type="text" class="form-control" id="cn"name="clientenombre" placeholder="Nombre">
                                        </div>
                                        <div class="mb-4 col-8">
                                        <label for="cd" class="form-label text-light"><i class="fas fa-map-marker-alt pe-2"></i>Distrito</label>
                                        <input type="text" class="form-control" id="cd"name="clientedistrito" placeholder="Distrito">
                                        </div>
                                        <div class="mb-4 col-8">
                                        <label for="cc" class="form-label text-light"><i class="fas fa-key pe-2"></i>Correo Electronico</label>
                                        <input type="email" class="form-control" id="cc"name="clientecorreo" placeholder="Correo Electronico">
                                        </div>
                                        <div class="col-8  mb-5">
                                        <div class="col-12">
                                            <label for="cr" class="form-label text-light"><i class="fas fa-lock-open pe-2"></i>Operador Id</label>
                                        </div>
                                        <div class="col-12">
                                            <select class="form-select" id="cr" name="clienteoperador" aria-label="Default select example">
                                                <option><?php echo $_SESSION['loadid']?></option>
                                                </select>
                                        </div>
                                </div>
                            <div class="modal-footer col-12">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                <input type="submit" name="addcliente" class="btn btn-success" value="Agregar Cliente">
                            </div>
                        </form>
                    </div>
                </div>
                </div>
            </div>
        <?php
            }else{
                ?>
                    <script>
                        window.location="login.php"
                    </script>
                <?php
            }
        ?>
    <script src="DataTables-1.11.3/js/jquery-3.6.0.min.js"></script>
    <script src="DataTables-1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="DataTables-1.11.3/js/dataTables.dataTables.min.js"></script>
    <script src="idioma.js"></script>
</body>
</html>
<?php
    if(isset($_POST['addcliente'])){
        $clinom = $_POST['clientenombre'];
        $clidis = $_POST['clientedistrito'];
        $clico = $_POST['clientecorreo'];
        $oper=$_POST['clienteoperador'];
        include("conexion.php");
        if(!empty($clinom) && !empty($clidis) && !empty($clico)){
                $consulta = "SELECT * FROM cliente where correo='$clico'";
                $resultado=mysqli_query($conexion,$consulta);
                $filas=mysqli_num_rows($resultado);
                if($filas==0){
                    $consulta="INSERT INTO cliente (nombre, distrito, correo, idusuario) values ('$clinom','$clidis','$clico','$oper')";
                    $resultado=mysqli_query($conexion,$consulta);
                    if($resultado==1){
                        ?>
                            <script>
                                window.location="vercliente.php";
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
                        title: 'Fallo en Agregar Cliente!'
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
                icon: 'error',
                title: 'Cliente ya existente'
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
        mysqli_close($conexion);
    }
    if(isset($_POST['updatecliente'])){
        $cliid=$_POST['clienteeditid'];
        $clinom = $_POST['clienteeditnombre'];
        $clidis = $_POST['clienteeditdistrito'];
        $clico = $_POST['clienteeditcorreo'];
        $oper=$_POST['clienteeditoperador'];
        include("conexion.php");
        if(!empty($clinom) && !empty($clidis) && !empty($clico)){
            $consulta="UPDATE cliente SET nombre='$clinom', distrito='$clidis', correo='$clico', idusuario='$oper' where idcliente='$cliid'";
            $resultado=mysqli_query($conexion,$consulta);
            if($resultado==1){
                ?>
                    <script>
                        window.location="vercliente.php";
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
                title: 'Fallo en Actualizar Cliente!'
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
        mysqli_close($conexion);
    }
    if(isset($_POST['deletecliente'])){
        $editid=$_POST['borrarcliente'];
        include("conexion.php");
        $consulta="DELETE FROM cliente where idcliente='$editid'";
        $resultado=mysqli_query($conexion,$consulta);
        if($resultado==1){
            ?>
                <script>
                    window.location="vercliente.php";
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
            title: 'Fallo en Eliminar Cliente!'
            })
            </script>
        <?php
        }
        mysqli_close($conexion);
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