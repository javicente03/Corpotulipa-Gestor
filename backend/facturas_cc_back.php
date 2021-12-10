<?php
if(isset($router)){
    if(isset($_POST['id'])){
        include("bd.php");
        $query = $bd->query("SELECT * FROM facturas_cc WHERE id_sol_cc = ".$_POST['id']);
        while($factura = $query->fetch_assoc()){
        ?>
        <img src="<?php echo $factura['factura'] ?>" alt="">
        <img src="../<?php echo $factura['factura'] ?>" alt="">
        <?php
        }
    }
}