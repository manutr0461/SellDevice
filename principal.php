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
    <title>Administrador</title>
</head>
<body onload="initClock()">
    <?php
        if($_SESSION){
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
                    title: 'Bienvenido'
                    })
                  </script>
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
                                <form action="principal.php" method="post">
                                <input class="a btn btn-danger text-start ms-5" name="sesiondetroy" type="submit" value="Cerrar Sesión">
                                </form>
                            </div>
                        </nav>
                        <section class="section principal col-10 bg-dark">
                        <div class="row d-flex justify-content-center">
                        <p class="text-light mt-5 text-center">Bienvenido <span><?php echo $_SESSION['loaduser']; ?></span></p>
                            <!--digital clock start-->
                            <img src="img/logo.png" alt="" class="col-6" >
                        <div class="datetime text-light col-8 px-5 text-center">
                            <div class="date w-100">
                                <span id="dayname">Day</span>,
                                <span id="month">Month</span>
                                <span id="daynum">00</span>,
                                <span id="year">Year</span>
                            </div>
                            <div class="time">
                                <span id="hour">00</span>:
                                <span id="minutes">00</span>:
                                <span id="seconds">00</span>
                                <span id="period">AM</span>
                            </div>
                        </div>
                        <!--digital clock end-->

                        <script type="text/javascript">
                        function updateClock(){
                        var now = new Date();
                        var dname = now.getDay(),
                            mo = now.getMonth(),
                            dnum = now.getDate(),
                            yr = now.getFullYear(),
                            hou = now.getHours(),
                            min = now.getMinutes(),
                            sec = now.getSeconds(),
                            pe = "AM";

                            if(hou >= 12){
                                pe = "PM";
                            }
                            if(hou == 0){
                                hou = 12;
                            }
                            if(hou > 12){
                                hou = hou - 12;
                            }

                            Number.prototype.pad = function(digits){
                                for(var n = this.toString(); n.length < digits; n = 0 + n);
                                return n;
                            }

                            var months = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Setiembre", "Octubre", "Noviembre", "Diciembre"];
                            var week = ["Domingo", "Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sabado"];
                            var ids = ["dayname", "month", "daynum", "year", "hour", "minutes", "seconds", "period"];
                            var values = [week[dname], months[mo], dnum.pad(2), yr, hou.pad(2), min.pad(2), sec.pad(2), pe];
                            for(var i = 0; i < ids.length; i++)
                            document.getElementById(ids[i]).firstChild.nodeValue = values[i];
                        }

                        function initClock(){
                        updateClock();
                        window.setInterval("updateClock()", 1);
                        }
                        </script>
                        </div>
                        </section>
                    </main>
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
</body>
</html>
<?php
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