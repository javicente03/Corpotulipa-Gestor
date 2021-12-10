<?php
if(isset($router))
    $bd = new mysqli("localhost","root","","corpotulipa_ga");
else 
    header("Location: ../404");