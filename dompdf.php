<?php
        session_start();
        if($_SESSION){
    
        }else{
        ?>
                <script>
                 window.location="login.php";
            </script>
         <?php
        }
    
    ob_start();
?>
<!doctype html>
<html lang="en">
  <head>
    <title>Compra Pdf</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS v5.0.2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"  integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <style>
            body{
                display: flex;
                justify-content: center;
                flex-wrap: wrap;
                background-color: whitesmoke);
                padding: 15px;
                font-family: Verdana, sans-serif;
            }
            .title{
                text-align: center;
                font-weight: 500;
            }
            table{
                text-align: center;
            }
            thead{
                background-color: rgb(34, 32, 32);
                color: white;
            }
            tbody{
                background-color: rgba(228, 227, 227, 0.659);
            }
            .totales{
                margin-top:20px;
                margin-left: 75%;
            }
            label{
                margin-right: 50px;
            }
        </style>
  </head>
  <body>
        <?php
            include("conexion.php");
            $consulta = "SELECT * FROM detalle";
            $resultado = $conexion->query($consulta);
        ?>
        <div class="contenedor">
            <h1 class="title">Sell Device</h1>
            <hr>
            <h4>Ruc: <span>10000000000</span></h4>
            <h4>Empresa: <span>Sell Device</span></h4>
            <h4>Dirección: <span>Av. Bolivar n° 100 Villa El Salvador</span></h4>
            <h4>Comprador: <span><?php echo $_SESSION['loaduser'];?></span></h4>
            <hr>
            <table class="table text-center mt-4" style="width: 700px">
                <thead class="bg-dark">
                    <tr>
                        <th scope="col" >Id</th>
                        <th scope="col" >Usuario</th>
                        <th scope="col" >Proveedor</th>
                        <th scope="col" >Codigo</th>
                        <th scope="col" >Cantidad</th>
                        <th scope="col" >Precio</th>
                        <th scope="col" >Subtotal</th>
                    </tr>
                </thead>
                <tbody class="table-secondary">
                    <?php
                        foreach ($resultado as $datos) {
                            ?>
                            <tr>
                            <td><?php echo $datos['id_detalle']; ?></td>
                            <td><?php echo $datos['idusuario']; ?></td>
                            <td><?php echo $datos['idproveedor']; ?></td>
                            <td><?php echo $datos['codigo']; ?></td>
                            <td><?php echo $datos['cantidad']; ?></td>
                            <td><?php echo $datos['precio']; ?></td>
                            <td><?php echo $datos['subtotal']; ?></td>
                            </tr>
                            <?php
                        }
                    ?>
                </tbody>
            </table>
            <hr>
            <?php
            $total="SELECT sum(subtotal) as total FROM detalle";
            $exe = mysqli_query($conexion,$total);
            $arraytotal=mysqli_fetch_array($exe);
            ?>
            <div class="contenidototal" width="800px">
                <div class="totales" width="200px">
                        <label for="" class="form-label text-light">Total: </label>
                        <span class="spantotal"><?php echo $arraytotal['total'];?></span>
                </div>
            </div>
        </div>
        
  </body>
</html>

<?php
    $html = ob_get_clean();

    require_once("libreria/dompdf/autoload.inc.php");
    use Dompdf\Dompdf;

    $pdf = new Dompdf();
    $pdf->loadHtml($html);
    $pdf->setPaper('letter');
    $pdf->render();
    $nombre="compra.pdf";
    $pdf->stream($nombre, array("Attachment" =>false));
    $consulta="DELETE FROM detalle";
    $resultado=mysqli_query($conexion,$consulta);
?>