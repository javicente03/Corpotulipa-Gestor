<?php
if (!isset($router))
    header("Location: ../../404");
?>
<div class="navbar-fixed">
<nav>
    <div class="nav-wrapper navcolor">
        <div class="contenedor-nav">
            <a href="../login" class="brand-logo"><img src="../frontend/img/resources/logo.jpg" class="img-logo" alt=""></a>
            <ul class="right hide-on-med-and-down">
                <?php
                if ($_SESSION["permisos"] == "super") {
                ?>
                    <li><a href="../generar_usuario"><i class="material-icons left">supervisor_account</i>Usuarios</a></li>
                    <li><a href="../departamentos"><i class="material-icons left">domain</i>Departamentos</a></li>
                    <li><a href="../cargos"><i class="material-icons left">widgets</i>Cargos</a></li>
                    <li><a href="../permisos"><i class="material-icons left">vpn_key</i>Permisos</a></li>

                <?php
                }
                ?>
                <li><a id="campana" ><i class="material-icons right">notifications</i><span style="font-weight: bold;" id="no-leidas"></span></a></li>
                <li><a class="dropdown-trigger" href="#!" data-target="drop_perfil"><?php echo $_SESSION["nombre"] ?><i class="material-icons right">person_pin</i></a></li>
                <ul id="drop_perfil" class="dropdown-content">
                    <li><a href="../editar_perfil"><i class="material-icons left">edit</i>Perfil</a></li>
                    <li><a href="../logout"><i class="material-icons left">close</i>Salir</a></li>
                </ul>
            </ul>
            <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
        </div>
    </div>
</nav>
</div>

<div style="width: 100%;display: flex;flex-direction: row-reverse;">
    <div id="box-notify" class="box-notify">
        <h6 style="font-weight: bold;text-align: center;color:white;">Notificaciones</h6>
        <div id="scroll-notify" class="scroll-notify">
            <ul class="collection" id="ul-notify" style="width: 100%;">
                <li class="collection-item" id="preloader-notify">
                    <div class="preloader-wrapper big active">
                        <div class="spinner-layer spinner-blue-only">
                        <div class="circle-clipper left">
                            <div class="circle"></div>
                        </div><div class="gap-patch">
                            <div class="circle"></div>
                        </div><div class="circle-clipper right">
                            <div class="circle"></div>
                        </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>

<ul class="sidenav" id="mobile-demo">
    <li style="display: flex;justify-content: center;"><img src="../frontend/img/resources/logo.jpg" class="img-logo" alt=""></li>
    <li><a href="../login"><i class="material-icons left">person</i>Iniciar Sesi??n</a></li>
</ul>