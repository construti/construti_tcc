﻿<?php 
foreach ($funcionario_tipo as $f): ?>
	<option value="<?php echo $f['Tipo']['tipo_funcionario']; ?>"><?php echo $f['Tipo']['tipo_funcionario']; ?></option>
<?php endforeach; ?>