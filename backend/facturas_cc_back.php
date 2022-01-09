<?php
if(isset($router)){
    if(isset($_POST['id'])){
        $array = array();
        include("bd.php");
        $query = $bd->query("SELECT * FROM facturas_cc WHERE id_sol_cc = ".$_POST['id']);
        while($factura = $query->fetch_assoc()){
            array_push($array, $factura);
        // <!-- <div class="col s12 m4" style="margin:4px 0;">
        // <img class="materialboxed responsive-img" src="" alt="">
        // <img class="materialboxed responsive-img" src="../" alt=""> -->
        // <!-- </div> -->
        }
        echo json_encode($array);
    }
}