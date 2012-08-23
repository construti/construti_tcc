<?php
// Recebo $tipos
echo '<option value="">Selecione...</option>\n';      
foreach($tipos as $id => $tipo)
    echo "<option value='$id'>$tipo</option>\n";      
?> 

