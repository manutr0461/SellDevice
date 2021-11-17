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
    <title>Control Proveedor</title>
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
                        <form action="proveedor.php" method="post">
                            <input class="a btn btn-danger text-start ms-5" name="sesiondetroy" type="submit" value="Cerrar Sesión">
                            </form>
                        </div>
                    </nav>
                    <section class="section col-10 bg-dark">
                    <p class=" text-light mt-5 mb-3 text-center">Bienvenido <span></span>a Proveedor</p>
                    <button type="button" class="btn btn-success text-light mb-2" data-bs-toggle="modal" data-bs-target="#botonagregarproveedor">
                    <i class="fas fa-folder-plus pe-2"></i>Agregar Proveedor
                    </button>

                        <div class="bg-light p-2">
                        <table class="table text-dark table-secondary my-3"id="tablita">
                            <thead class="table-dark">
                                <tr>
                                <th scope="col" class="text-center">Id</th>
                                <th scope="col" class="text-center">Nombre</th>
                                <th scope="col" class="text-center">Correo</th>
                                <th scope="col" class="text-center">Teléfono</th>
                                <th scope="col" class="text-center">Administrador</th>
                                <th width="250px" class="text-center">...</th>
                                </tr>
                            </thead>
                                <?php
                                include("conexion.php");
                                $consulta = "SELECT * FROM proveedor";
                                $query=$conexion->query($consulta);
                                ?>
                                <?php if($query->num_rows>0):?>
                            
                            <tbody>
                                <?php while ($r=$query->fetch_array()):?>
                                <tr class="border border-dark">
                                <td class="text-center"><?php echo $r['idproveedor'];?></td>
                                <td class="text-center"><?php echo $r['nombre'];?></td>
                                <td class="text-center"><?php echo $r['correo'];?></td>
                                <td class="text-center"><?php echo $r['telefono'];?></td>
                                <td class="text-center"><?php echo $r['idusuario'];?></td>
                                <td class="text-center">
                                 <button type="button" class="btn btn-warning text-light" data-bs-toggle="modal" data-bs-target="#btneditprove<?php echo $r['idproveedor'];?>">
                                 <i class="fas fa-book-medical pe-2"></i>Editar
                                 </button>
                                 <button type="button" class="btn btn-danger text-light" data-bs-toggle="modal" data-bs-target="#btndeleteprove<?php echo $r['idproveedor'];?>">
                                 <i class="fas fa-trash pe-2"></i>Eliminar
                                 </button>
                                </td>
                            <div class="modal fade" id="btneditprove<?php echo $r['idproveedor'];?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content bg-dark">
                            <form action="proveedor.php" method="POST" class="col col-12">
                                <div class="modal-header">
                                    <h5 class="modal-title text-warning" id="exampleModalLabel"><i class="fas fa-book-medical pe-2"></i>Editar Proveedor</h5>
                                    <button type="button" class="btn-close bg-danger" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body d-flex justify-content-center flex-wrap">
                                        <div class="mb-3 col-8">
                                        <label  class="form-label text-light"><i class="fas fa-id-badge pe-2"></i>Id</label>
                                        <input type="text" readonly class="form-control" name="editidpro" value="<?php echo $r['idproveedor'];?>">
                                        </div>
                                        <div class="mb-3 col-8">
                                        <label  class="form-label text-light"><i class="fas fa-user-shield pe-2"></i>Nombre</label>
                                        <input type="text" class="form-control" name="editnombrepro"placeholder="Nombre" value="<?php echo $r['nombre'];?>">
                                        </div>
                                        <div class="mb-4 col-8">
                                        <label class="form-label text-light"><i class="fas fa-key pe-2"></i>Correo Electronico</label>
                                        <input type="email" readonly class="form-control" name="editcorreo"  placeholder="Correo Electronico" value="<?php echo $r['correo'];?>">
                                        </div>
                                        <div class="mb-4 col-8">
                                        <label class="form-label text-light"><i class="fas fa-key pe-2"></i>Telefono</label>
                                        <input type="text" readonly class="form-control" name="editcel"  placeholder="Telefono" value="<?php echo $r['telefono'];?>">
                                        </div>
                                        <div class="col-8  mb-5">
                                        <div class="col-8">
                                            <label class="form-label text-light"><i class="fas fa-lock-open pe-2"></i>Administrador</label>
                                        </div>
                                        <div class="col-12">
                                            <select class="form-select" name="editiduser" aria-label="Default select example">
                                                <option ><?php echo $r['idusuario'];?></option>
                                                </select>
                                        </div>
                                </div>
                                    
                                <div class="modal-footer col-12">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                        <input type="submit" name="updateusuario" class="btn btn-warning text-light" Value="Editar Usuario">
                                </div>
                            </form>
                            </div>

                                </tr>
                                    <!-- Modal -->
                                <div class="modal fade" id="btndeleteprove<?php echo $r['idproveedor'];?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content bg-dark">
                                    <form action="proveedor.php" method="post">
                                    <div class="modal-header text-dark">
                                        <h5 class="modal-title text-danger" id="staticBackdropLabel"><i class="fas fa-trash pe-2"></i>Eliminar Proveedor</h5>
                                        <button type="button" class="btn-close bg-danger" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        
                                            <p class="text-light">Deseas eliminar al Proveedor: <span class="text-danger px-3"><?php echo $r['nombre'];?></span></p>
                                            <input type="hidden" name="borraruser" value="<?php echo $r['idproveedor'];?>">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                        <input type="submit" name="deleteproveedor" class="btn btn-danger" Value="Eliminar">
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
                <div class="modal fade" id="botonagregarproveedor" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content bg-dark">
                        <form action="proveedor.php" method="post">
                            <div class="modal-header text-success">
                                <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-folder-plus pe-2"></i>Nuevo Proveedor</h5>
                                <button type="button" class="btn-close bg-danger" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body d-flex justify-content-center flex-wrap">
                                        <div class="mb-3 col-8">
                                            <label for="np" class="form-label text-light"><i class="fas fa-user-shield pe-2"></i>Nombre</label>
                                            <input type="text" class="form-control" id="np"name="nomprove" placeholder="Nombre">
                                            </div>
                                            <div class="mb-4 col-8">
                                            <label for="co" class="form-label text-light"><i class="fas fa-key pe-2"></i>Correo</label>
                                            <input type="email" class="form-control" id="co"name="correprove" placeholder="Correo Electronico">
                                            </div>
                                            <div class="mb-4 col-8">
                                            <label for="te" class="form-label text-light"><i class="fas fa-key pe-2"></i>Teléfono</label>
                                            <input type="text" class="form-control" id="te"name="teleprove" placeholder="Teléfonno">
                                            </div>
                                            <div class="col-8  mb-5">
                                            <div class="col-8">
                                                <label for="id" class="form-label text-light"><i class="fas fa-lock-open pe-2"></i>Administrador</label>
                                            </div>
                                            <div class="col-12">
                                                <select class="form-select" id="id" name="idadmin" aria-label="Default select example">
                                                    <option><?php echo $_SESSION['loadid']?></option>
                                                    </select>
                                            </div>
                                        </div>
                            <div class="modal-footer col-12">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                <input type="submit" name="addproveedor" class="btn btn-success" value="Agregar Proveedor">
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
    if(isset($_POST['addproveedor'])){
        $npro = $_POST['nomprove'];
        $cpro = $_POST['correprove'];
        $tpro = $_POST['teleprove'];
        $admid =$_POST['idadmin'];
        include("conexion.php");
        if(!empty($npro) && !empty($cpro) && !empty($tpro)){
            if(strlen($tpro)==9){
                $consulta = "SELECT * FROM proveedor where correo='$cpro'";
                $resultado=mysqli_query($conexion,$consulta);
                $filas=mysqli_num_rows($resultado);
                if($filas==0){
                    $consulta="INSERT INTO proveedor (nombre, correo, telefono, idusuario) values ('$npro','$cpro','$tpro','$admid')";
                    $resultado=mysqli_query($conexion,$consulta);
                    if($resultado==1){
                        ?>
                            <script>
                                window.location="proveedor.php";
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
                        title: 'Fallo en Agregar Proveedor!'
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
                title: 'Proveedor ya existente'
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
                title: 'Demasiados Caracteres / El telefono permite solo 8 digitos'
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
    if(isset($_POST['updateproveedor'])){
        $editidpro=$_POST['editidpro'];
        $editnompro = $_POST['editnombrepro'];
        $editco = $_POST['editcorreo'];
        $tlf=$_POST['editcel'];
        $editidu = $_POST['editiduser'];
        include("conexion.php");
        if(!empty($edinompro) && !empty($tlf)){
            if(strlen($tlf)==8){
                $consulta="UPDATE proveedor SET nombre='$editnompro', correo='$editco', telefono='$tlf', idusuario='$editidu' where idproveedor='$editidpro'";
                $resultado=mysqli_query($conexion,$consulta);
                if($resultado==1){
                    ?>
                        <script>
                            window.location="proveedor.php";
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
                    title: 'Fallo en Actualizar Proveedor!'
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
                title: 'Demasiados Caracteres / El telefono permite solo 8 digitos'
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
    if(isset($_POST['deleteproveedor'])){
        $editid=$_POST['borraruser'];
        include("conexion.php");
        $consulta="DELETE FROM proveedor where idproveedor='$editid'";
        $resultado=mysqli_query($conexion,$consulta);
        if($resultado==1){
            ?>
                <script>
                    window.location="proveedor.php";
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
            title: 'Fallo en Eliminar Proveedor!'
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