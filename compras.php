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
    <title>Control Compras</title>
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
                        <form action="compras.php" method="post">
                                    <input class="a btn btn-danger text-start ms-5" name="sesiondetroy" type="submit" value="Cerrar Sesión">
                                    </form>
                        </div>
                    </nav>
                    <section class="section col-10 bg-dark">
                    <p class=" text-light mt-2 mb-1 text-center">Bienvenido <span></span>a Compras</p>
                    <form method="post" action="compras.php" class="d-flex justify-content-around flex-wrap mb-1">
                        <div class="mb-1 col-3 ">
                            <input type="hidden" id="idpro" name="proid">
                            <label for="" class="form-label text-light">Codigo</label>
                            <input type="text" id="codego" class="form-control" placeholder="Codigo" name="comcodigo">
                        </div>
                        <div class="mb-1 col-2">
                            <label for="prove" class="form-label text-light"><i class="fas fa-map-marker-alt pe-2"></i>Proveedor</label>
                            <select class="form-select" name="idprove"id="verid"aria-label="Default select example">
                            <?php
                            include("conexion.php");
                            $consulta = "SELECT * FROM proveedor";
                            $query=$conexion->query($consulta);
                            while ($idprove=$query->fetch_array()):
                            ?>
                            <option value="<?php echo $idprove['idproveedor']?>"><?php echo $idprove['idproveedor']?></option>
                            <?php
                            endwhile;
                            ?>
                            </select>
                        </div>
                        <div class="mb-1 col-4 ">
                            <label for="" class="form-label text-light">Descripción</label>
                            <input type="text" readonly id="descripcion"class="form-control" placeholder="Descripción" name="comdescripcion">
                        </div>
                        <div class="mb-1 col-5 ">
                            <label for="" class="form-label text-light">Cantidad</label>
                            <input type="number" id="cant" class="form-control" placeholder="Cantidad" name="comcantidad">
                        </div>
                        <div class="mb-1 col-5 ">
                            <label for="" class="form-label text-light">Precio</label>
                            <input type="text" readonly id="precio"class="form-control" placeholder="Precio" name="comprecio">
                        </div>
                        <div class="mb-1 col-5 ">
                            <label for="" class="form-label text-light">Subtotal</label>
                            <input type="text" id="subtotal" readonly class="form-control" placeholder="Subtotal" name="comsubtotal">
                        </div>
                        <div class="col-5">
                            <input type="submit" class="btn btn-primary mt-4 me-2" name="buscarcodigo" value="Buscar Codigo">
                            <button class="btn btn-info mt-4 me-2 text-light" id="calcular">Calcular</button>
                            <input type="submit" class="btn btn-success mt-4" name="agregarcompra" value="Agregar Compra">
                        </div>
                    </form>
                        <div class="bg-light">
                        <table class="table table-secondary my-3" id="tablita">
                            <thead class="table bg-secondary text-light">
                                <tr class="text-center">
                                <th scope="col" >Id</th>
                                <th scope="col" >Proveedor</th>
                                <th scope="col" >Codigo</th>
                                <th scope="col" >Cantidad</th>
                                <th scope="col" >Precio</th>
                                <th scope="col" >Subtotal</th>
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
                                $consulta = "SELECT * FROM detalle";
                                $query=$conexion->query($consulta);
                                ?>
                                <tbody >
                                <?php while ($r=$query->fetch_array()):?>
                                <tr class="border border-dark">
                                <td class="text-center"><?php echo $r['id_detalle'];?></td>
                                <td class="text-center"><?php echo $r['idproveedor'];?></td>
                                <td class="text-center"><?php echo $r['codigo'];?></td>
                                <td class="text-center"><?php echo $r['cantidad'] ?></td>
                                <td class="text-center"><?php echo $r['precio'];?></td>
                                <td class="text-center"><?php echo $r['subtotal'];?></td>
                                <td class="text-center">
                                <button type="button" class="btn btn-danger text-light" data-bs-toggle="modal" data-bs-target="#btndeleteprod<?php echo $r['id_detalle'];?>">
                                <i class="fas fa-trash pe-2"></i>Eliminar
                                </button>

                                </td>
                                </tr>
                                    <!-- Modal -->
                                <div class="modal fade" id="btndeleteprod<?php echo $r['id_detalle'];?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content bg-dark">
                                    <form action="compras.php" method="post">
                                    <div class="modal-header text-dark">
                                        <h5 class="modal-title text-danger" id="staticBackdropLabel"><i class="fas fa-trash pe-2"></i>Eliminar Pre-Compra</h5>
                                        <button type="button" class="btn-close bg-danger" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">

                                            <p class="text-light">Deseas eliminar la pre-compra: <span class="text-danger px-3"><?php echo $r['codigo'];?></span></p>
                                            <input type="hidden" name="borrardetalle" value="<?php echo $r['id_detalle'];?>">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                        <input type="submit" name="deletedetalle" class="btn btn-danger" Value="Eliminar">
                                    </div>
                                    </div>
                                    </form>
                                </div>
                                </div>
                                <?php endwhile;?>
                            </tbody>
                        </table>
                        </div>
                            <?php
                            include("conexion.php");
                            $consulta = "SELECT SUM(subtotal) as total FROM detalle";
                            $resultado=mysqli_query($conexion,$consulta);
                            $arrayDatos = mysqli_fetch_array($resultado);
                            ?> 
                            <div class="my-1 col-12 d-flex flex-row-reverse">
                            <div class="mb-1 col-3 ">
                                <div class="d-flex justify-content-center flex-wrap">
                                    <label for="" class="form-label text-light">Total</label>
                                    <input type="text" id="subtotal" readonly class="form-control" placeholder="Total" name="comtotal" value="<?php echo $arrayDatos['total']; ?>">
                                    <a href="dompdf.php" class="btn btn-primary mt-1"><i class="fas fa-file-powerpoint pe-2"></i>Generar Compra</a>
                                </div>
                            </div>
                            </div>
                    </section>
                </main>
            </div>
    <script src="calcular.js"></script>
</body>
</html>

<?php
    if(isset($_POST['buscarcodigo'])){
        $bcodigo = $_POST['comcodigo'];
        $bprove = $_POST['idprove'];
        if(!empty($bcodigo) && !empty($bprove)){
            include("conexion.php");
            $consulta = "SELECT * FROM producto where codigo='$bcodigo' and idproveedor='$bprove'";
            $resultado=mysqli_query($conexion,$consulta);
            $filas=mysqli_num_rows($resultado);
            if($filas==1){
                $query=$conexion->query($consulta);
                while ($code=$query->fetch_array()):
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
                        icon: 'success',
                        title: 'Producto encontrado'
                        })
                        document.getElementById("codego").value="<?php echo $bcodigo;?>"
                        document.getElementById("verid").value="<?php echo $code['idproveedor'];?>"
                        document.getElementById("descripcion").value="<?php echo $code['descripcion'];?>"
                        document.getElementById("precio").value="<?php echo $code['precio_compra'];?>"
                        document.getElementById("idpro").value="<?php echo $code['idproducto'];?>"
                    </script>
                    <?php
                endwhile;
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
                    title: 'Datos no existentes-Datos Confusos'
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
                    title: 'Campo codigo y proveedor obligatorios'
                    })
                  </script>
            <?php
            mysqli_close($conexion);
        }
    }
    if(isset($_POST['agregarcompra'])){
        $user=$_SESSION['loadid'];
        $idp=$_POST['idprove'];
        $idproduc=$_POST['proid'];
        $cod=$_POST['comcodigo'];
        $cant=$_POST['comcantidad'];
        $prec=$_POST['comprecio'];
        $sub=$_POST['comsubtotal'];
        if(!empty($cod)&& !empty($cant) && !empty($prec) && !empty($sub)){
            include("conexion.php");
            $consulta = "SELECT * FROM detalle where codigo='$cod' and idproveedor='$idp'";
            $resultado=mysqli_query($conexion,$consulta);
            $filas=mysqli_num_rows($resultado);
            if($filas==1){
                $arrayDatos = mysqli_fetch_array($resultado);
                $nuevacantidad= $cant + $arrayDatos['cantidad'];
                $nuevosubtotal= $sub + $arrayDatos['subtotal'];
                $consulta = "UPDATE detalle SET cantidad='$nuevacantidad', subtotal='$nuevosubtotal' where codigo='$cod' and idproveedor='$idp'";
                $resultado=mysqli_query($conexion,$consulta);
                if($resultado==1){
                    $consulcant = "SELECT stock FROM producto where codigo='$cod' and idproveedor='$idp'";
                    $resultadobusqueda=mysqli_query($conexion,$consulcant);
                    if ($resultadobusqueda==1) {
                        $arraycant = mysqli_fetch_array($resultadobusqueda);
                        $updatecantidadproductos=$arraycant['stock']+ $cant;
                        $consultaupdate = "UPDATE producto SET stock='$updatecantidadproductos' where codigo='$cod' and idproveedor='$idp'";
                        $resultupdate=mysqli_query($conexion,$consultaupdate);
                        if ($resultupdate==1) {
                            ?>
                            <script>
                                window.location="compras.php";
                            </script>
                        <?php
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
                    title: 'Fallo en Añadir más productos a la compra!'
                    })
                    </script>
                <?php
                }
                
            }else{
                $consulta = "INSERT INTO detalle (idusuario,idproveedor,idproducto,codigo,cantidad,precio,subtotal) values('$user','$idp','$idproduc','$cod','$cant','$prec','$sub')";
                $resultado=mysqli_query($conexion,$consulta);
                if($resultado==1){
                    $consulcant = "SELECT stock FROM producto where codigo='$cod' and idproveedor='$idp'";
                    $resultadobusqueda=mysqli_query($conexion,$consulcant);
                    if ($resultadobusqueda==1) {
                        $arraycant = mysqli_fetch_array($resultadobusqueda);
                        $updatecantidadproductos=$arraycant['stock']+ $cant;
                        $consultaupdate = "UPDATE producto SET stock='$updatecantidadproductos' where codigo='$cod' and idproveedor='$idp'";
                        $resultupdate=mysqli_query($conexion,$consultaupdate);
                        if ($resultupdate==1) {
                            ?>
                            <script>
                                window.location="compras.php";
                            </script>
                        <?php
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
                    title: 'Fallo en Agregar Compra de Producto!'
                    })
                    </script>
                <?php
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
                    title: 'Todos los campos son obligatorios, Inicie la busqueda y calcule'
                    })
                  </script>
            <?php
        }
        
    }
    if(isset($_POST['deletedetalle'])){
        $editid=$_POST['borrardetalle'];
        include("conexion.php");
        $consultdetalle="SELECT cantidad, codigo, idproveedor FROM detalle where id_detalle='$editid'";
        $resultadoconsulta=mysqli_query($conexion,$consultdetalle);
        $arraycantidad=mysqli_fetch_array($resultadoconsulta);
        
        $codigoproducto=$arraycantidad['codigo'];
        $idproveproducto=$arraycantidad['idproveedor'];
        //................
        $consultproduct="SELECT stock FROM producto where codigo='$codigoproducto' and idproveedor='$idproveproducto'";
        $resultadoconsultapro=mysqli_query($conexion,$consultproduct);
        $arraycantidadpro=mysqli_fetch_array($resultadoconsultapro);
        $stockrestado=$arraycantidadpro['stock']-$arraycantidad['cantidad'];
        //................
        $consultarestarstock="UPDATE producto SET stock='$stockrestado' where codigo='$codigoproducto' and idproveedor='$idproveproducto'";
        $resultadodestock=mysqli_query($conexion,$consultarestarstock);
        if($resultadodestock==1){
            $consulta="DELETE FROM detalle where id_detalle='$editid'";
            $resultado=mysqli_query($conexion,$consulta);
            if($resultado==1){
                ?>
                    <script>
                        window.location="compras.php";
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
                title: 'Fallo en Eliminar la Pre-Compra!'
                })
                </script>
            <?php
            }
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
                if (result.isConfirmed) {
                    window.location="login.php"
                } 
                });
            </script>
        <?php
    }
?>