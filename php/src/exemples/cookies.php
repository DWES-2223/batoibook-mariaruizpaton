<?php
$i = $_COOKIE['visits']??0;
setcookie('visits',$i+1);
echo "He visitado esta pagina " . $i . " veces";
