<?php
if(isset($router))
    $bd = new mysqli("localhost","root","","corpotulipa_ga_respaldo");
else 
    header("Location: ../404");