<div class="col l3 hide-on-med-and-down menu-lateral">
    <ul>
        <li><a style="text-align: center;">TUS OPCIONES</a></li>
        
        <?php if(isset($_SESSION["Editar_UT_Caja_Chica"])){ ?>
        <li><a href="../editar_ut">Modificar Unidades Tributarias</a></li>
        <?php } ?>

        <li><a href="../vale_chica">Solicitar Vale de caja chica</a></li>

        <?php if(isset($_SESSION["Aceptar_Sol_CC"])){ ?>
        <li><a href="../solicitudes_cc">Solicitudes de caja chica</a></li>
        <?php } ?>

        <?php if(isset($_SESSION["Aceptar_Sol_CC"])){ ?>
        <li><a href="../validar_sol_cc">Validar Solicitudes</a></li>
        <?php } ?>

        <?php if(isset($_SESSION["Aceptar_Sol_CC"])){ ?>
        <li><a href="../solicitud_repo_cc">Solicitar Reposición</a></li>
        <?php } ?>

        <?php if(isset($_SESSION["Recepcion_Repo_CC"])){ ?>
        <li><a href="../recepcion_repo_cc">Solicitudes de Reposición</a></li>
        <?php } ?>

        <?php if(isset($_SESSION["Coordinacion_Repo_CC"])){ ?>
        <li><a href="../coordinacion_repo_cc">Coordinación de Reposición CC</a></li>
        <?php } ?>

        <?php if(isset($_SESSION["Analisis_Repo_CC"])){ ?>
        <li><a href="../analisis_repo_cc">Análisis de Reposición CC</a></li>
        <?php } ?>

        <?php if(isset($_SESSION["Contador_Repo_CC"])){ ?>
        <li><a href="../contador_repo_cc">Contador de Reposición CC</a></li>
        <?php } ?>

        <?php if(isset($_SESSION["Gerencia_Repo_CC"])){ ?>        
        <li><a href="../gerencia_repo_cc">Gerenciar Reposición de CC</a></li>
        <?php } ?>

        <div class="divider"></div>

        <li><a href="../buscar_bien"><i class="material-icons">search</i>Bienes Públicos</a></li>

        <?php if(isset($_SESSION["Incorporacion_Muebles"])){ ?>
        <li><a href="../incorporar_bien">Incorporar Bienes</a></li>
        <?php } ?>

        <?php if(isset($_SESSION["Generar_Nota"])){ ?>
        <li><a href="../generar_nota_entrega">Generar Nota de Entrega Bienes</a></li>
        <?php } ?>

        <?php if(isset($_SESSION["Movimiento_Bienes"])){ ?>
        <li><a href="../movimiento_bienes">Movimiento de bienes públicos</a></li>
        <?php } ?>
        
        <li><a href="../mis_bienes">Bienes a tu cargo</a></li>

        <li><a href="../bienes_prestados">Bienes Prestados</a></li>

        <?php if(isset($_SESSION["Reporte_Bien"])){ ?>
        <li><a href="../bienes_faltantes">Bienes Faltantes</a></li>
        <?php } ?>
        
        <?php if(isset($_SESSION["Programar_Inventario"])){ ?>
        <li><a href="../programar_inventario">Programar Inventario</a></li>
        <?php } ?>

        <?php if(isset($_SESSION["Aprobar_Inventario"])){ ?>
        <li><a href="../aprobar_inventario">Aprobar Inventario</a></li>
        <?php } ?>

        <?php if(isset($_SESSION["Levantar_Inventario"])){ ?>
        <li><a href="../levantar_inventario">Levantar Inventario</a></li>
        <?php } ?>

        <?php if(isset($_SESSION["Desincorporar_Bien"])){ ?>
        <li><a href="../desincorporacion_bien">Bienes Reportados</a></li> 
        <?php } ?>

        <div class="divider"></div>


        <?php if(isset($_SESSION["Recursos_Humanos"])){ ?>
        <li><a href="../charla_induccion">Programar Charla de Inducción</a></li>
        <?php } ?>

        <li><a href="../solicitud_permiso">Solicitar Permiso Laboral</a></li>

        <?php if(isset($_SESSION["Solicitud_Adiestramiento"])){ ?>
        <li><a href="../solicitar_adiestramiento">Solicitar Taller de Adiestramiento</a></li>
        <?php } ?>

        <?php if(isset($_SESSION["Revisar_Solicitud_Adiestramiento"])){ ?>
        <li><a href="../solicitudes_adiestramiento">Adiestramientos Pendientes</a></li>
        <?php } ?>

        <?php if(isset($_SESSION["Aprobar_Adiestramiento"])){ ?>
        <li><a href="../aprobar_adiestramiento">Aprobar Adiestramiento</a></li>
        <?php } ?>
    </ul>
</div>