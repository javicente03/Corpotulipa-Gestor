<?php

require 'Router.php';
require 'controllers/controller.php';
require 'controllers/controlleruser.php';
require 'controllers/controllercaja.php';
require 'controllers/controllermuebles.php';
require 'controllers/controllerrecursos.php';

$router = new Router();
$controlsuper = new ControllersSuperuser();
$controluser = new ControllersUser();
$controlcaja = new ControllersCaja();
$controlmueble = new ControllersMueble();
$controlrecursos = new ControllersRecursos();

session_start();

switch ($router->getController()) {

    case 'Home':
        header("Location: login");
        break;

        /* ************ LOGIN, LOGOUT Y PASSWORD ************ */
    case 'login': //Login si viene por GET muestra formulario, si viene por POST loguea
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            if (isset($_SESSION['id'])) //Valida que la haya no una sesión activa, de lo contrario manda al dahsboard
                header("Location: sesion");
            else
                $controluser->login($router); //Llamo al controlador de login
        } else if ($_SERVER['REQUEST_METHOD'] == 'POST')
            include("backend/login_back.php"); //Ejecuto el logueado en el backend
        break;

    case 'logout': //Login si viene por GET muestra formulario, si viene por POST loguea
        if ($_SERVER['REQUEST_METHOD'] == 'GET')
            include("backend/logout_back.php"); //Ejecuto el logueado en el backend
        break;

    case 'olvido_password': //Login si viene por GET muestra formulario, si viene por POST loguea
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            if (isset($_SESSION['id'])) //Valida que la haya no una sesión activa, de lo contrario manda al dahsboard
                header("Location: sesion");
            else
                $controluser->olvidoPassword($router); //Llamo al controlador de login
        } else if ($_SERVER['REQUEST_METHOD'] == 'POST')
            include("backend/olvido_password_back.php"); //Ejecuto el logueado en el backend
        break;

    case 'resetear_password': //Login si viene por GET muestra formulario, si viene por POST loguea
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            if (isset($_SESSION['id'])) //Valida que la haya no una sesión activa, de lo contrario manda al dahsboard
                header("Location: sesion");
            else
                $controluser->resetearPassword($router); //Llamo al controlador de login
        } else if ($_SERVER['REQUEST_METHOD'] == 'POST')
            include("backend/resetear_password_back.php"); //Ejecuto el logueado en el backend
        break;


        /* ************ SUPER USUARIO ************ */
    case 'generar_usuario': //Valida que haya una sesión activa, de lo contrario redirige a Login
        if (isset($_SESSION['id'])) {
            if ($_SESSION['permisos'] == "super") { //Requiere permisos de superusuario
                if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                    $controlsuper->generarUser($router);
                } else if ($_SERVER['REQUEST_METHOD'] == 'POST')
                    include("backend/crear_usuario_back.php");
            } else
                header("Location: 404");
        } else
            header("Location: login");
        break;

    case 'editar_usuario': //Valida que haya una sesión activa, de lo contrario redirige a Login
        if (isset($_SESSION['id'])) {
            if ($_SESSION['permisos'] == "super") { //Requiere permisos de superusuario
                if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                    if (!empty($router->getParam())) //Revisa que haya algun parametro
                        $controlsuper->editarUser($router); //llama la funcion del controlador
                    else
                        header("Location: 404");
                } else if ($_SERVER['REQUEST_METHOD'] == 'POST') //Por post invoca al backend
                    include("backend/editar_usuario_back.php");
            } else
                header("Location: ../404");
        } else
            header("Location: ../login");
        break;

    case 'suspender_usuario': //Valida que haya una sesión activa, de lo contrario redirige a Login
        if (isset($_SESSION['id'])) {
            if ($_SESSION['permisos'] == "super") { //Requiere permisos de superusuario
                if ($_SERVER['REQUEST_METHOD'] == 'POST')
                    include("backend/suspender_usuario_back.php");
                else
                    header("Location: 404");
            } else
                header("Location: 404");
        } else
            header("Location: login");
        break;

    case 'departamentos': //Valida que haya una sesión activa, de lo contrario redirige a Login
        if (isset($_SESSION['id'])) {
            if ($_SESSION['permisos'] == "super") { //Requiere permisos de superusuario
                if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                    $controlsuper->departamentos($router); //llama la funcion del controlador
                } else if ($_SERVER['REQUEST_METHOD'] == 'POST')
                    include("backend/crear_departamento_back.php");
            } else
                header("Location: 404");
        } else
            header("Location: login");
        break;

    case 'editar_departamento': //Valida que haya una sesión activa, de lo contrario redirige a Login
        if (isset($_SESSION['id'])) {
            if ($_SESSION['permisos'] == "super") { //Requiere permisos de superusuario
                if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                    if (!empty($router->getParam())) //Revisa que haya algun parametro
                        $controlsuper->editarDepartamento($router); //llama la funcion del controlador
                    else
                        header("Location: 404");
                } else if ($_SERVER['REQUEST_METHOD'] == 'POST')
                    include("backend/editar_departamento_back.php");
            } else
                header("Location: ../404");
        } else
            header("Location: ../login");
        break;

    case 'eliminar_departamento': //Valida que haya una sesión activa, de lo contrario redirige a Login
        if (isset($_SESSION['id'])) {
            if ($_SESSION['permisos'] == "super") { //Requiere permisos de superusuario
                if ($_SERVER['REQUEST_METHOD'] == 'POST')
                    include("backend/eliminar_departamento_back.php");
            } else
                header("Location: 404");
        } else
            header("Location: login");
        break;

    case 'cargos': //Valida que haya una sesión activa, de lo contrario redirige a Login
        if (isset($_SESSION['id'])) {
            if ($_SESSION['permisos'] == "super") { //Requiere permisos de superusuario
                if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                    $controlsuper->cargos($router); //llama la funcion del controlador
                } else if ($_SERVER['REQUEST_METHOD'] == 'POST')
                    include("backend/crear_cargos_back.php");
            } else
                header("Location: 404");
        } else
            header("Location: login");
        break;

    case 'editar_cargo': //Valida que haya una sesión activa, de lo contrario redirige a Login
        if (isset($_SESSION['id'])) {
            if ($_SESSION['permisos'] == "super") { //Requiere permisos de superusuario
                if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                    if (!empty($router->getParam())) //Revisa que haya algun parametro
                        $controlsuper->editarCargo($router); //llama la funcion del controlador
                    else
                        header("Location: 404");
                } else if ($_SERVER['REQUEST_METHOD'] == 'POST')
                    include("backend/editar_cargos_back.php");
            } else
                header("Location: ../404");
        } else
            header("Location: ../login");
        break;

    case 'eliminar_cargo': //Valida que haya una sesión activa, de lo contrario redirige a Login
        if (isset($_SESSION['id'])) {
            if ($_SESSION['permisos'] == "super") { //Requiere permisos de superusuario
                if ($_SERVER['REQUEST_METHOD'] == 'POST')
                    include("backend/eliminar_cargos_back.php");
            } else
                header("Location: 404");
        } else
            header("Location: login");
        break;

    case 'permisos': //Valida que haya una sesión activa, de lo contrario redirige a Login
        if (isset($_SESSION['id'])) {
            if ($_SESSION['permisos'] == "super") { //Requiere permisos de superusuario
                if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                    $controlsuper->permisos($router); //llama la funcion del controlador
                } else if ($_SERVER['REQUEST_METHOD'] == 'POST')
                    include("backend/crear_permiso_back.php");
            } else
                header("Location: 404");
        } else
            header("Location: login");
        break;

    case 'eliminar_permiso': //Valida que haya una sesión activa, de lo contrario redirige a Login
        if (isset($_SESSION['id'])) {
            if ($_SESSION['permisos'] == "super") { //Requiere permisos de superusuario
                if ($_SERVER['REQUEST_METHOD'] == 'POST')
                    include("backend/eliminar_permiso_back.php");
            } else
                header("Location: 404");
        } else
            header("Location: login");
        break;


        /* ************ USUARIO Y PERFIL ************ */

    case 'sesion':
        if (isset($_SESSION['id'])) //Valida que haya una sesión activa, de lo contrario redirige a Login
            include("frontend/sesion.php");
        else
            header("Location: login");
        break;

    case 'editar_perfil': //Valida que haya una sesión activa, de lo contrario redirige a Login
        if (isset($_SESSION['id'])) {
            if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                $controluser->editarPerfil($router); //llama la funcion del controlador
            } else if ($_SERVER['REQUEST_METHOD'] == 'POST')
                include("backend/editar_perfil_back.php");
        } else
            header("Location: login");
        break;

    case 'password': //Valida que haya una sesión activa, de lo contrario redirige a Login
        if (isset($_SESSION['id'])) {
            if ($_SERVER['REQUEST_METHOD'] == 'POST')
                include("backend/password_back.php");
        } else
            header("Location: login");
        break;


        /* ************ CAJA CHICA ************ */
    case 'editar_ut':
        if (isset($_SESSION['id'])) {
            include('backend/bd.php');
            $sql = "SELECT * FROM permisos WHERE accion = 'Editar_UT_Caja_Chica' AND cargo_id =" . $_SESSION['cargo_id'];
            $query = $bd->query($sql); //Revisa si tiene los permisos correspondientes en la tabla permisos
            if ($query->num_rows > 0) { //Si hay al menos un resultado el permiso esta dado a este cargo en referencia a esta acción
                if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                    $controlcaja->editarUt($router); //llama la funcion del controlador
                } else if ($_SERVER['REQUEST_METHOD'] == 'POST')
                    include("backend/editar_ut_back.php");
            } else {
                header("Location: 404");
            }
        } else
            header("Location: login");
        break;

    case 'vale_chica':
        if (isset($_SESSION['id'])) {
            if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                $controlcaja->vale($router); //llama la funcion del controlador
            } else if ($_SERVER['REQUEST_METHOD'] == 'POST')
                include("backend/vale_caja_chica_back.php");
        } else
            header("Location: login");
        break;

    case 'solicitudes_cc':
        if (isset($_SESSION['id'])) {
            include("backend/bd.php");
            $sql = "SELECT * FROM permisos WHERE accion = 'Aceptar_Sol_CC' AND cargo_id =" . $_SESSION['cargo_id'];
            $query = $bd->query($sql); //Revisa si tiene los permisos correspondientes en la tabla permisos
            if ($query->num_rows > 0) { //Si hay al menos un resultado el permiso esta dado a este cargo en referencia a esta acción
                if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                    $controlcaja->aceptarSolCc($router); //llama la funcion del controlador
                } else if ($_SERVER['REQUEST_METHOD'] == 'POST')
                    include("backend/aceptar_sol_cc_back.php");
            } else {
                header("Location: 404");
            }
        } else
            header("Location: login");
        break;

    case 'subir_factura_cc': //Valida que haya una sesión activa, de lo contrario redirige a Login
        if (isset($_SESSION['id'])) {
            if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                if (!empty($router->getParam())) //Revisa que haya algun parametro
                    $controlcaja->subirFacturaCC($router); //llama la funcion del controlador
                else
                    header("Location: 404");
            } else if ($_SERVER['REQUEST_METHOD'] == 'POST')
                include("backend/subir_factura_cc_back.php");
        } else
            header("Location: ../login");
        break;

    case 'validar_sol_cc':
        if (isset($_SESSION['id'])) {
            include("backend/bd.php");
            $sql = "SELECT * FROM permisos WHERE accion = 'Aceptar_Sol_CC' AND cargo_id =" . $_SESSION['cargo_id'];
            $query = $bd->query($sql); //Revisa si tiene los permisos correspondientes en la tabla permisos
            if ($query->num_rows > 0) { //Si hay al menos un resultado el permiso esta dado a este cargo en referencia a esta acción
                if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                    $controlcaja->validarSolCc($router); //llama la funcion del controlador
                } else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    if (isset($_POST['factura']))
                        include("backend/facturas_cc_back.php");
                    else
                        include("backend/validar_sol_cc_back.php");
                }
            } else {
                header("Location: 404");
            }
        } else
            header("Location: login");
        break;

    case 'solicitud_repo_cc':
        if (isset($_SESSION['id'])) {
            include("backend/bd.php");
            $sql = "SELECT * FROM permisos WHERE accion = 'Aceptar_Sol_CC' AND cargo_id =" . $_SESSION['cargo_id'];
            $query = $bd->query($sql); //Revisa si tiene los permisos correspondientes en la tabla permisos
            if ($query->num_rows > 0) { //Si hay al menos un resultado el permiso esta dado a este cargo en referencia a esta acción
                if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                    $controlcaja->solicitudRepoCc($router); //llama la funcion del controlador
                } else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    include("backend/solicitud_repo_cc_back.php");
                }
            } else {
                header("Location: 404");
            }
        } else
            header("Location: login");
        break;

    case 'recepcion_repo_cc':
        if (isset($_SESSION['id'])) {
            include("backend/bd.php");
            $sql = "SELECT * FROM permisos WHERE accion = 'Recepcion_Repo_CC' AND cargo_id =" . $_SESSION['cargo_id'];
            $query = $bd->query($sql); //Revisa si tiene los permisos correspondientes en la tabla permisos
            if ($query->num_rows > 0) { //Si hay al menos un resultado el permiso esta dado a este cargo en referencia a esta acción
                if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                    $controlcaja->recepcionRepoCc($router); //llama la funcion del controlador
                } else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    if (isset($_POST['factura']))
                        include("backend/facturas_cc_back.php");
                    else if (isset($_POST['motivo'])) {
                        include("backend/rechazo_repo_cc_back.php");
                    } else {
                        $pass = "cuentadante";
                        include("backend/recepcion_repo_cc_back.php");
                    }
                }
            } else {
                header("Location: ../404");
            }
        } else
            header("Location: ../login");
        break;

    case 'coordinacion_repo_cc':
        if (isset($_SESSION['id'])) {
            include("backend/bd.php");
            $sql = "SELECT * FROM permisos WHERE accion = 'Coordinacion_Repo_CC' AND cargo_id =" . $_SESSION['cargo_id'];
            $query = $bd->query($sql); //Revisa si tiene los permisos correspondientes en la tabla permisos
            if ($query->num_rows > 0) { //Si hay al menos un resultado el permiso esta dado a este cargo en referencia a esta acción
                if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                    $controlcaja->coordinacionRepoCc($router); //llama la funcion del controlador
                } else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    if (isset($_POST['factura']))
                        include("backend/facturas_cc_back.php");
                    else if (isset($_POST['motivo'])) {
                        include("backend/rechazo_repo_cc_back.php");
                    } else {
                        $pass = "coordinador";
                        include("backend/recepcion_repo_cc_back.php");
                    }
                }
            } else {
                header("Location: ../404");
            }
        } else
            header("Location: ../login");
        break;

    case 'analisis_repo_cc':
        if (isset($_SESSION['id'])) {
            include("backend/bd.php");
            $sql = "SELECT * FROM permisos WHERE accion = 'Analisis_Repo_CC' AND cargo_id =" . $_SESSION['cargo_id'];
            $query = $bd->query($sql); //Revisa si tiene los permisos correspondientes en la tabla permisos
            if ($query->num_rows > 0) { //Si hay al menos un resultado el permiso esta dado a este cargo en referencia a esta acción
                if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                    $controlcaja->analisisRepoCc($router); //llama la funcion del controlador
                } else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    if (isset($_POST['factura']))
                        include("backend/facturas_cc_back.php");
                    else if (isset($_POST['motivo'])) {
                        include("backend/rechazo_repo_cc_back.php");
                    } else {
                        $pass = "analista";
                        include("backend/recepcion_repo_cc_back.php");
                    }
                }
            } else {
                header("Location: ../404");
            }
        } else
            header("Location: ../login");
        break;

    case 'contador_repo_cc':
        if (isset($_SESSION['id'])) {
            include("backend/bd.php");
            $sql = "SELECT * FROM permisos WHERE accion = 'Contador_Repo_CC' AND cargo_id =" . $_SESSION['cargo_id'];
            $query = $bd->query($sql); //Revisa si tiene los permisos correspondientes en la tabla permisos
            if ($query->num_rows > 0) { //Si hay al menos un resultado el permiso esta dado a este cargo en referencia a esta acción
                if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                    $controlcaja->contadorRepoCc($router); //llama la funcion del controlador
                } else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    if (isset($_POST['factura']))
                        include("backend/facturas_cc_back.php");
                    else if (isset($_POST['motivo'])) {
                        include("backend/rechazo_repo_cc_back.php");
                    } else {
                        $pass = "contador";
                        include("backend/recepcion_repo_cc_back.php");
                    }
                }
            } else {
                header("Location: ../404");
            }
        } else
            header("Location: ../login");
        break;

    case 'gerencia_repo_cc':
        if (isset($_SESSION['id'])) {
            include("backend/bd.php");
            $sql = "SELECT * FROM permisos WHERE accion = 'Gerencia_Repo_CC' AND cargo_id =" . $_SESSION['cargo_id'];
            $query = $bd->query($sql); //Revisa si tiene los permisos correspondientes en la tabla permisos
            if ($query->num_rows > 0) { //Si hay al menos un resultado el permiso esta dado a este cargo en referencia a esta acción
                if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                    $controlcaja->gerenciaRepoCc($router); //llama la funcion del controlador
                } else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    if (isset($_POST['factura']))
                        include("backend/facturas_cc_back.php");
                    else if (isset($_POST['motivo'])) {
                        include("backend/rechazo_repo_cc_back.php");
                    } else {
                        $pass = "gerente";
                        include("backend/recepcion_repo_cc_back.php");
                    }
                }
            } else {
                header("Location: ../404");
            }
        } else
            header("Location: ../login");
        break;

        /***************************** BIENES PUBLICOS MUEBLES E INMUEBLES **********************************/
        /********************* INCORPORACION *************************/
    case 'incorporar_bien':
        if (isset($_SESSION['id'])) {
            include("backend/bd.php");
            $sql = "SELECT * FROM permisos WHERE accion = 'Incorporacion_Muebles' AND cargo_id =" . $_SESSION['cargo_id'];
            $query = $bd->query($sql); //Revisa si tiene los permisos correspondientes en la tabla permisos
            if ($query->num_rows > 0) { //Si hay al menos un resultado el permiso esta dado a este cargo en referencia a esta acción
                if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                    $controlmueble->incorporarMueble($router); //llama la funcion del controlador
                } else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    include("backend/incorporar_bien_back.php");
                }
            } else {
                header("Location: ../404");
            }
        } else
            header("Location: ../login");
        break;

    case 'generar_nota_entrega':
        if (isset($_SESSION['id'])) {
            include("backend/bd.php");
            $sql = "SELECT * FROM permisos WHERE accion = 'Generar_Nota' AND cargo_id =" . $_SESSION['cargo_id'];
            $query = $bd->query($sql); //Revisa si tiene los permisos correspondientes en la tabla permisos
            if ($query->num_rows > 0) { //Si hay al menos un resultado el permiso esta dado a este cargo en referencia a esta acción
                if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                    if (!empty($router->getParam())) //Revisa que haya algun parametro
                        $controlmueble->generarNota($router); //llama la funcion del controlador
                    else
                        header("Location: ../404");
                } else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    include("backend/generar_nota_entrega_back.php");
                }
            } else {
                header("Location: ../404");
            }
        } else
            header("Location: ../login");
        break;

    case 'verificar_bien':
        if (isset($_SESSION['id'])) {
            include("backend/bd.php");
            if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                if (!empty($router->getParam())) //Revisa que haya algun parametro
                    $controlmueble->verificarBien($router); //llama la funcion del controlador
                else
                    header("Location: ../404");
            } else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                include("backend/verificar_bien_back.php");
            }
        } else
            header("Location: ../login");
        break;

    case 'mis_bienes':
        if (isset($_SESSION['id'])) {
            include("backend/bd.php");
            if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                $controlmueble->misBienes($router); //llama la funcion del controlador 
            } else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                include("backend/reportar_bien_back.php");
            }
        } else
            header("Location: ../login");
        break;

        /******************** PRESTAMO ********************/
    case 'buscar_bien':
        if (isset($_SESSION['id'])) {
            include("backend/bd.php");
            if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                $controlmueble->buscarBien($router); //llama la funcion del controlador
            } else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                include("backend/busqueda_bien_back.php");
            }
        } else
            header("Location: login");
        break;

    case 'prestamo_bien':
        if (isset($_SESSION['id'])) {
            include("backend/bd.php");
            $sql = "SELECT * FROM permisos WHERE accion = 'Prestar_Bien_Publico' AND cargo_id =" . $_SESSION['cargo_id'];
            $query = $bd->query($sql); //Revisa si tiene los permisos correspondientes en la tabla permisos
            if ($query->num_rows > 0) { //Si hay al menos un resultado el permiso esta dado a este cargo en referencia a esta acción
                if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                    if (!empty($router->getParam())) //Revisa que haya algun parametro
                        $controlmueble->prestarBien($router); //llama la funcion del controlador
                    else
                        header("Location: ../404");
                } else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    include("backend/prestamo_bien_back.php");
                }
            } else {
                header("Location: ../404");
            }
        } else
            header("Location: ../login");
        break;

    case 'revisar_prestamo_bien':
        if (isset($_SESSION['id'])) {
            if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                if (!empty($router->getParam())) //Revisa que haya algun parametro
                    $controlmueble->revisarPrestamoBien($router); //llama la funcion del controlador
                else
                    header("Location: ../404");
            } else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                include("backend/revisar_prestamo_back.php");
            }
        } else
            header("Location: ../login");
        break;

    case 'movimiento_bienes':
        if (isset($_SESSION['id'])) {
            if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                $controlmueble->movimientosBienes($router); //llama la funcion del controlador
            } else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                if (isset($_POST['analista']))
                    include("backend/movimiento_bien_back.php");
                else {
                    include("backend/tramite_bien_back.php");
                }
            }
        } else
            header("Location: login");
        break;

        /************************* PRORROGA **********************/
    case 'bienes_prestados':
        if (isset($_SESSION['id'])) {
            if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                $controlmueble->bienesPrestados($router); //llama la funcion del controlador
            } else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                include("backend/prorroga_bien_back.php");
            }
        } else
            header("Location: login");
        break;

        /************************* Reportes Bienes Faltantes **********************/
    case 'bienes_faltantes':
        if (isset($_SESSION['id'])) {
            include("backend/bd.php");
            $sql = "SELECT * FROM permisos WHERE accion = 'Reporte_Bien' AND cargo_id =" . $_SESSION['cargo_id'];
            $query = $bd->query($sql); //Revisa si tiene los permisos correspondientes en la tabla permisos
            if ($query->num_rows > 0) {
                if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                    $controlmueble->bienesFaltantes($router); //llama la funcion del controlador
                } else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    include("frontend/bienes_publicos/reporte_bienes_pdf.php");
                }
            } else
                header("Location: 404");
        } else
            header("Location: login");
        break;

    case 'desincorporacion_bien':
        if (isset($_SESSION['id'])) {
            include("backend/bd.php");
            $sql = "SELECT * FROM permisos WHERE accion = 'Desincorporar_Bien' AND cargo_id =" . $_SESSION['cargo_id'];
            $query = $bd->query($sql); //Revisa si tiene los permisos correspondientes en la tabla permisos
            if ($query->num_rows > 0) {
                if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                    $controlmueble->desincorporarBien($router); //llama la funcion del controlador
                } else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    include("backend/desincorporar_bien_back.php");
                }
            } else
                header("Location: 404");
        } else
            header("Location: login");
        break;

        /******************** LEVANTAMIENTO DE INVENTARIO ***********************/
    case 'programar_inventario':
        if (isset($_SESSION['id'])) {
            include("backend/bd.php");
            $sql = "SELECT * FROM permisos WHERE accion = 'Programar_Inventario' AND cargo_id =" . $_SESSION['cargo_id'];
            $query = $bd->query($sql); //Revisa si tiene los permisos correspondientes en la tabla permisos
            if ($query->num_rows > 0) {
                if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                    $controlmueble->programarInventario($router); //llama la funcion del controlador
                } else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    include("backend/programar_inventario_back.php");
                }
            } else
                header("Location: 404");
        } else
            header("Location: login");
        break;

    case 'aprobar_inventario':
        if (isset($_SESSION['id'])) {
            include("backend/bd.php");
            $sql = "SELECT * FROM permisos WHERE accion = 'Aprobar_Inventario' AND cargo_id =" . $_SESSION['cargo_id'];
            $query = $bd->query($sql); //Revisa si tiene los permisos correspondientes en la tabla permisos
            if ($query->num_rows > 0) {
                if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                    $controlmueble->aprobarInventario($router); //llama la funcion del controlador
                } else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    include("backend/aprobar_inventario_back.php");
                }
            } else
                header("Location: 404");
        } else
            header("Location: login");
        break;

    case 'levantar_inventario':
        if (isset($_SESSION['id'])) {
            include("backend/bd.php");
            $sql = "SELECT * FROM permisos WHERE accion = 'Levantar_Inventario' AND cargo_id =" . $_SESSION['cargo_id'];
            $query = $bd->query($sql); //Revisa si tiene los permisos correspondientes en la tabla permisos
            if ($query->num_rows > 0) {
                if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                    $controlmueble->levantarInventario($router); //llama la funcion del controlador
                } else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    include("backend/levantar_inventario_back.php");
                }
            } else
                header("Location: 404");
        } else
            header("Location: login");
        break;

    case 'inventario_data':
        if (isset($_SESSION['id'])) {
            include("backend/bd.php");
            $sql = "SELECT * FROM permisos WHERE accion = 'Programar_Inventario' AND cargo_id =" . $_SESSION['cargo_id'];
            $query = $bd->query($sql); //Revisa si tiene los permisos correspondientes en la tabla permisos
            if ($query->num_rows > 0) {
                if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                    $controlmueble->dataInventario($router); //llama la funcion del controlador
                } else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    include("backend/inventario_data_back.php");
                }
            } else
                header("Location: 404");
        } else
            header("Location: login");
        break;

    case 'inventario_data_pdf':
        if (isset($_SESSION['id'])) {
            include("backend/bd.php");
            if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                $controlmueble->dataInventarioPDF($router); //llama la funcion del controlador
            }
        } else
            header("Location: login");
        break;

    case 'desincorporar_bienes':
        if (isset($_SESSION['id'])) {
            include("backend/bd.php");
            $sql = "SELECT * FROM permisos WHERE accion = 'Desincorporar_Bien' AND cargo_id =" . $_SESSION['cargo_id'];
            $query = $bd->query($sql); //Revisa si tiene los permisos correspondientes en la tabla permisos
            if ($query->num_rows > 0) {
                if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                    $controlmueble->desincorporarBienes($router); //llama la funcion del controlador
                } else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    include("backend/desincorporar_bien_existente_back.php");
                }
            } else
                header("Location: 404");
        } else
            header("Location: login");
        break;


        /*********************************************************
         *********************************************************
         ************************* ORH ***************************
         *********************************************************
         *********************************************************/

    case 'charla_induccion':
        if (isset($_SESSION['id'])) {
            include("backend/bd.php");
            $sql = "SELECT * FROM permisos WHERE accion = 'RECURSOS_HUMANOS' AND cargo_id =" . $_SESSION['cargo_id'];
            $query = $bd->query($sql); //Revisa si tiene los permisos correspondientes en la tabla permisos
            if ($query->num_rows > 0) {
                if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                    $controlrecursos->crearInduccion($router); //llama la funcion del controlador
                } else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    include("backend/crear_induccion_back.php");
                }
            } else {
                if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                    $controlrecursos->asistirInduccion($router); //llama la funcion del controlador
                } else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    include("backend/induccion_back.php");
                }
            }
        } else
            header("Location: login");
        break;

    case 'solicitud_permiso':
        if (isset($_SESSION['id'])) {
            if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                $controlrecursos->solicitarPermiso($router); //llama la funcion del controlador
            } else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                if(isset($_POST["permiso"]))
                    include("backend/aprobar_permiso_back.php");
                else
                    include("backend/solicitar_permiso_back.php");
            }
        } else
            header("Location: login");
        break;

    case 'solicitar_adiestramiento':
        if (isset($_SESSION['id'])) {
            if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                $controlrecursos->solicitudAdiestramiento($router); //llama la funcion del controlador
            } else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                include("backend/solicitar_adiestramiento_back.php");
            }
        } else
            header("Location: login");
        break;

    case 'solicitudes_adiestramiento':
        if (isset($_SESSION['id'])) {
            if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                $controlrecursos->solicitudesAdiestramiento($router); //llama la funcion del controlador
            } else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                include("backend/pautar_adiestramiento_back.php");
            }
        } else
            header("Location: login");
        break;

    case 'aprobar_adiestramiento':
        if (isset($_SESSION['id'])) {
            if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                $controlrecursos->aprobarAdiestramiento($router); //llama la funcion del controlador
            } else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                include("backend/aprobar_adiestramiento_back.php");
            }
        } else
            header("Location: login");
        break;

    case 'ver_adiestramiento':
        if (isset($_SESSION['id'])) {
            if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                $controlrecursos->verAdiestramiento($router); //llama la funcion del controlador
            } else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                include("backend/ver_adiestramiento_back.php");
            }
        } else
            header("Location: login");
        break;

    /*********************** NOTIFICACIONES ***************************/
    case 'notificaciones':
        if(isset($_SESSION['id'])) {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                include("backend/notificaciones.php");
            }
        } else
            header("Location: login");
        break;


    default:
        include("frontend/404.php"); //Pagina de error 404 Page Not Found
        break;
}
