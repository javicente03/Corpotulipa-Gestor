<?php
if (isset($router)) {
    $cedula = trim(addslashes($_POST['cedula']));
    $nombre = trim(addslashes($_POST['nombre']));
    $apellido = trim(addslashes($_POST['apellido']));
    $email = trim(addslashes($_POST['email']));
    $departamento = trim(addslashes($_POST['departamento']));
    $cargo = trim(addslashes($_POST['cargo']));
    $nacimiento = trim(addslashes($_POST['nacimiento']));
    if (isset($_POST['genero']))
        $genero = trim(addslashes($_POST['genero']));
    else
        $genero = "";
    if (
        $cedula != "" && $nombre != "" && $apellido != "" && $email != ""
        && $genero != "" && $departamento != ""
        && $cargo != "" && $nacimiento != ""
    ) {
        if (is_numeric($cedula)) {
            include("validaciones.php");
            $email_valido = validar_email($email);
            if ($email_valido) {
                $fecha_valida = validar_fecha($nacimiento);
                if ($fecha_valida) {
                    $hoy = date('d-m-y');
                    $formato_nacimiento = date('d-m-y', strtotime($nacimiento));
                    $diff = calcular_fecha($hoy, $formato_nacimiento);
                    if ($diff->y >= 18) {
                        if ($genero == "Masculino" || $genero == "Femenino" || $genero == "Otro") {
                            if ($genero == "Otro") {
                                $other = trim(addslashes($_POST['other']));
                                if ($other != "") {
                                    $genero = $other;
                                    generarUser($cedula, $nombre, $apellido, $email, $genero, $departamento, $cargo, $nacimiento, $router);
                                } else {
                                    echo "Debe ingresar un género";
                                }
                            } else {
                                generarUser($cedula, $nombre, $apellido, $email, $genero, $departamento, $cargo, $nacimiento, $router);
                            }
                        } else {
                            echo "Género no válido";
                        }
                    } else {
                        echo "La fecha indicada correponde a un menor de edad";
                    }
                } else {
                    echo "Ingrese una fecha válida";
                }
            } else {
                echo "Ingrese un correo Gmail valido";
            }
        } else
            echo "La cédula de identidad debe ser numérica";
    } else {
        echo "Debe completar todos los datos correctamente";
    }
} else {
    header("Location: ../404");
}

function generarUser($cedula, $nombre, $apellido, $email, $genero, $departamento, $cargo, $nacimiento, $router)
{
    $password = bin2hex(random_bytes(5));
    include("bd.php");
    $sql = "SELECT * FROM departamento WHERE departamento_id = " . $departamento;
    $proceso = $bd->query($sql);
    if ($proceso->num_rows > 0) {
        $sql1 = "SELECT * FROM cargo WHERE cargo_id = " . $cargo;
        $proceso1 = $bd->query($sql1);
        if ($proceso1->num_rows > 0) {
            $sql2 = "SELECT * FROM perfil WHERE cedula = '$cedula'";
            $proceso2 = $bd->query($sql2);
            if ($proceso2->num_rows <= 0) {
                $sql3 = "SELECT * FROM usuario WHERE email = '$email'";
                $proceso3 = $bd->query($sql3);
                if ($proceso3->num_rows <= 0) {
                    $opciones = [
                        'cost' => 12,
                    ];
                    $hash = password_hash($password, PASSWORD_BCRYPT, $opciones);
                    $insercion = "INSERT INTO usuario (password,email) VALUES('$hash','$email')";
                    $insertar = $bd->query($insercion);
                    if ($insertar) {
                        $insercion1 = "INSERT INTO perfil (cedula,nombre,apellido,genero,departamento_id,cargo_id,fecha_nacimiento) VALUES('$cedula','$nombre','$apellido','$genero', '$departamento','$cargo','$nacimiento')";
                        $insertar1 = $bd->query($insercion1);
                        if ($insertar1) {
                            $asunto = "Bienvenido a Corpotulipa";
                            include("email/enviar-mail.php");
                            $sendMail = sendMail($email, $asunto, $nombre, $apellido, $password);
                            if ($sendMail)
                                echo "ok";
                        } else {
                            echo "¡Oh no! Ocurrió un error inesperado";
                        }
                    } else {
                        echo "¡Oh no! Ocurrió un error inesperado";
                    }
                } else {
                    echo "Correo electrónico en uso";
                }
            } else {
                echo "Cédula de identidad ya esta registrada";
            }
        } else {
            echo "Cargo no existente";
        }
    } else {
        echo "Departamento no existente";
    }
}
