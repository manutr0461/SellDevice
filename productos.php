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
    <title>Control Productos</title>
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
                        <form action="productos.php" method="post">
                                    <input class="a btn btn-danger text-start ms-5" name="sesiondetroy" type="submit" value="Cerrar Sesión">
                                    </form>
                        </div>
                    </nav>
                    <section class="section col-10 bg-dark">
                    <p class=" text-light mt-5 mb-3 text-center">Bienvenido <span></span>a Productos</p>
                    <button type="button" class="btn btn-success text-light mb-2" data-bs-toggle="modal" data-bs-target="#botonagregarproducto">
                    <i class="fas fa-folder-plus pe-2"></i>Agregar Producto
                    </button>

                        <div class="bg-light p-2">
                        <table class="table text-dark table-secondary my-3" id="tablita">
                            <thead class="table-dark">
                                <tr class="text-center">
                                <th scope="col" >Id</th>
                                <th scope="col" >Codigo</th>
                                <th scope="col" >Descripción</th>
                                <th scope="col" >Imagen</th>
                                <th scope="col" >Precio</th>
                                <th scope="col" >Stock</th>
                                <th scope="col" >Proveedor</th>
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
                                $consulta = "SELECT * FROM producto";
                                $query=$conexion->query($consulta);
                                ?>
                                <?php if($query->num_rows>0):?>
                            
                            <tbody>
                                <?php while ($r=$query->fetch_array()):?>
                                <tr class="border border-dark">
                                <td class="text-center"><?php echo $r['idproducto'];?></td>
                                <td class="text-center"><?php echo $r['codigo'];?></td>
                                <td class="text-center"><?php echo $r['descripcion'];?></td>
                                <td class="text-center"><img src="<?php echo $r['foto'];?>" alt="" width="50px" height="50px"></td>
                                <td class="text-center"><?php echo $r['precio_venta'];?></td>
                                <td class="text-center"><?php echo $r['stock'];?></td>
                                <td class="text-center"><?php echo $r['idproveedor'];?></td>
                                <td class="text-center">
                                    <?php
                                        if($_SESSION['loadrol']==1){
                                            ?>
                                            <button type="button" class="btn btn-warning text-light" data-bs-toggle="modal" data-bs-target="#btneditprod<?php echo $r['idproducto'];?>">
                                            <i class="fas fa-book-medical pe-2"></i>Editar
                                            </button>
                                            <button type="button" class="btn btn-danger text-light" data-bs-toggle="modal" data-bs-target="#btndeleteprod<?php echo $r['idproducto'];?>">
                                            <i class="fas fa-trash pe-2"></i>Eliminar
                                            </button>
                                            <?php
                                        }
                                    ?>
                                </td>
                            <div class="modal fade" id="btneditprod<?php echo $r['idproducto'];?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content bg-dark">
                            <form action="productos.php" method="POST" class="col col-12" enctype="multipart/form-data">
                                <div class="modal-header">
                                    <h5 class="modal-title text-warning" id="exampleModalLabel"><i class="fas fa-book-medical pe-2"></i>Editar Producto</h5>
                                    <button type="button" class="btn-close bg-danger" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body d-flex justify-content-center flex-wrap">
                                        <div class="mb-4 col-8">
                                        <label for="ed" class="form-label text-light"><i class="fas fa-user-shield pe-2"></i>Id</label>
                                        <input type="text" readonly class="form-control" id="ed"name="proeditid" placeholder="Id" value="<?php echo $r['idproducto'];?>">
                                        </div>
                                        <div class="mb-4 col-8">
                                        <label for="cnp" class="form-label text-light"><i class="fas fa-user-shield pe-2"></i>Codigo</label>
                                        <input type="text" readonly class="form-control" id="cnp"name="proeditcodigo" placeholder="Codigo" value="<?php echo $r['codigo'];?>">
                                        </div>
                                        <div class="mb-4 col-8">
                                        <label for="cdp" class="form-label text-light"><i class="fas fa-map-marker-alt pe-2"></i>Descripción</label>
                                        <input type="text" class="form-control" id="cdp"name="proeditdes" placeholder="Descripcion" value="<?php echo $r['descripcion'];?>">
                                        </div>
                                        <div class="mb-4 col-8">
                                        <label for="ccp" class="form-label text-light"><i class="fas fa-image pe-3"></i>Imagen</label>
                                        <img src="<?php echo $r['foto'];?>" alt="" width="50px" height="50px" class="mb-1">
                                        <input type="hidden" name="eliminarproducto" value="<?php echo $r['foto'];?>">
                                        <input type="file" class="form-control" id="ccp" name="editarimagen">
                                        </div>
                                        <div class="mb-4 col-8">
                                        <label for="cppp" class="form-label text-light"><i class="fas fa-map-marker-alt pe-2"></i>Precio de Compra</label>
                                        <input type="text" class="form-control" id="cppp"name="proeditpreco" placeholder="Precio de Compra" value="<?php echo $r['precio_compra'];?>">
                                        </div>
                                        <div class="mb-4 col-8">
                                        <label for="ceep" class="form-label text-light"><i class="fas fa-map-marker-alt pe-2"></i>Precio de Venta</label>
                                        <input type="text" class="form-control" id="ceep" name="proeditpreve" placeholder="Precio de Venta" value="<?php echo $r['precio_venta'];?>">
                                        </div>
                                    </div> 
                                <div class="modal-footer col-12">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                        <input type="submit" name="updateproducto" class="btn btn-warning text-light" Value="Editar Producto">
                                </div>
                            </form>
                            </div>
                                    </div>
                                    </div>
                                </tr>
                                    <!-- Modal -->
                                <div class="modal fade" id="btndeleteprod<?php echo $r['idproducto'];?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content bg-dark">
                                    <form action="productos.php" method="post">
                                    <div class="modal-header text-dark">
                                        <h5 class="modal-title text-danger" id="staticBackdropLabel"><i class="fas fa-trash pe-2"></i>Eliminar Producto</h5>
                                        <button type="button" class="btn-close bg-danger" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">

                                            <p class="text-light">Deseas eliminar el Producto: <span class="text-danger px-3"><?php echo $r['descripcion'];?></span></p>
                                            <img src="<?php echo $r['foto'];?>" alt="" width="100px" height="70px">
                                            <input type="hidden" name="fotoproducto" value="<?php echo $r['foto'];?>">
                                            <input type="hidden" name="borrarproducto" value="<?php echo $r['idproducto'];?>">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                        <input type="submit" name="deleteproducto" class="btn btn-danger" Value="Eliminar">
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
                <div class="modal fade" id="botonagregarproducto" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content bg-dark">
                        <form action="productos.php" method="post" enctype="multipart/form-data" >
                            <div class="modal-header text-success">
                                <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-folder-plus pe-2"></i>Nuevo Producto</h5>
                                <button type="button" class="btn-close bg-danger" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body d-flex justify-content-center flex-wrap">
                                        <div class="mb-4 col-8">
                                        <label for="cn" class="form-label text-light"><i class="fas fa-user-shield pe-2"></i>Codigo</label>
                                        <input type="text" class="form-control" id="cn"name="procodigo" placeholder="Codigo">
                                        </div>
                                        <div class="mb-4 col-8">
                                        <label for="cd" class="form-label text-light"><i class="fas fa-map-marker-alt pe-2"></i>Descripción</label>
                                        <input type="text" class="form-control" id="cd"name="prodes" placeholder="Descripcion">
                                        </div>
                                        <div class="mb-4 col-8">
                                        <label for="cc" class="form-label text-light"><i class="fas fa-image pe-2"></i>Imagen</label>
                                        <input type="file" class="form-control" id="cc"name="proimg">
                                        </div>
                                        <div class="mb-4 col-8">
                                        <label for="cpp" class="form-label text-light"><i class="fas fa-map-marker-alt pe-2"></i>Precio de Compra</label>
                                        <input type="text" class="form-control" id="cpp"name="propreco" placeholder="Precio de Compra">
                                        </div>
                                        <div class="mb-4 col-8">
                                        <label for="cee" class="form-label text-light"><i class="fas fa-map-marker-alt pe-2"></i>Precio de Venta</label>
                                        <input type="text" class="form-control" id="cee"name="propreve" placeholder="Precio de Venta">
                                        </div>
                                        <div class="mb-4 col-8">
                                        <label for="prove" class="form-label text-light"><i class="fas fa-map-marker-alt pe-2"></i>Proveedor</label>
                                        <select id="my-select prove" class="form-control" name="ipro">
                                            
                                            <?php
                                            $consulta = "SELECT * FROM proveedor";
                                            $query=$conexion->query($consulta);
                                            while ($idprove=$query->fetch_array()):
                                                ?>
                                                <option><?php echo $idprove['idproveedor']?></option>
                                                <?php
                                            endwhile;
                                            ?>
                                                
                                            </select>
                                        </div>
                            </div>
                            <div class="modal-footer col-12">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                <input type="submit" name="addproducto" class="btn btn-success" value="Agregar Producto">
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
    if(isset($_POST['addproducto'])){
        $proco = $_POST['procodigo'];
        $prodescri = $_POST['prodes'];
        $proimage = $_FILES['proimg']['name'];
        $proprecompra=$_POST['propreco'];
        $propreventa=$_POST['propreve'];
        $prove = $_POST['ipro'];
        include("conexion.php");
        if(!empty($proco) && !empty($prodescri)&& !empty($proimage) && !empty($proprecompra) && !empty($propreventa)){
                $consulta = "SELECT * FROM producto where codigo='$proco' and idproveedor='$prove'";
                $resultado=mysqli_query($conexion,$consulta);
                $filas=mysqli_num_rows($resultado);
                if($filas==0){
                    if($_FILES['proimg']){
                        $nombrearch = basename($_FILES['proimg']['name']);
                        $nombreguardar = date('m-d-y')."--". date('h-i-s') . "--". $nombrearch;
                        $ruta = "imgproductos/". $nombreguardar;
                        $moverarchivo = move_uploaded_file($_FILES['proimg']['tmp_name'], $ruta);
                        if($moverarchivo){
                            $consulta="INSERT INTO producto (codigo,descripcion,foto,precio_compra,precio_venta,idproveedor) values ('$proco','$prodescri','$ruta','$proprecompra','$propreventa','$prove')";
                            $resultado=mysqli_query($conexion,$consulta);
                            if($resultado){
                                ?>
                                    <script>
                                        window.location="productos.php";
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
                                title: 'Fallo en Agregar Producto!'
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
                icon: 'error',
                title: 'Producto ya existente'
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
    if(isset($_POST['updateproducto'])){
        $proeid =$_POST['proeditid'];
        $proeco = $_POST['proeditcodigo'];
        $proedescri = $_POST['proeditdes'];
        $imgnueva = $_FILES['editarimagen']['name'];
        $proeprecompra=$_POST['proeditpreco'];
        $proepreventa=$_POST['proeditpreve'];
        $deletefoto =$_POST['eliminarproducto'];
        include("conexion.php");
        if(!empty($proedescri) && !empty($imgnueva) && !empty($proeprecompra) && !empty($proepreventa)){
                    if($_FILES['editarimagen']){
                        $nombrearchi = basename($_FILES['editarimagen']['name']);
                        $nombreguardarlo = date('m-d-y')."--". date('h-i-s') . "--". $nombrearchi;
                        $rutanueva = "imgproductos/". $nombreguardarlo;
                        $subirarchivo = move_uploaded_file($_FILES['editarimagen']['tmp_name'], $rutanueva);
                        if(file_exists($deletefoto)){
                            unlink($deletefoto);
                        }
                        if($subirarchivo){
                            $consulta="UPDATE producto SET codigo='$proeco', descripcion='$proedescri', foto='$rutanueva', precio_compra='$proeprecompra', precio_venta='$proepreventa' where idproducto='$proeid'";
                            $resultado=mysqli_query($conexion,$consulta);
                            
                            if($resultado==1){
                                ?>
                                    <script>
                                        window.location="productos.php";
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
                                title: 'Fallo en Actualizar Producto!'
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
                title: 'Todos los campos son obligatorios!'
                })
                </script>
            <?php
        }
        mysqli_close($conexion);
    }
    if(isset($_POST['deleteproducto'])){
        $rutaimage = $_POST['fotoproducto'];
        if(file_exists($rutaimage)){
            unlink($rutaimage);
        }
        $editid=$_POST['borrarproducto'];
        include("conexion.php");
        $consulta="DELETE FROM producto where idproducto='$editid'";
        $resultado=mysqli_query($conexion,$consulta);
        if($resultado==1){
            ?>
                <script>
                    window.location="productos.php";
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
            title: 'Fallo en Eliminar Producto!'
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