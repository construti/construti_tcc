<?php 
//print_r($funcionario_tipo);
foreach ($funcionario_tipo as $f): ?>
	<option value="<?php echo $f['Area']['area_combo']; ?>"><?php echo $f['Area']['area_descricao']; ?></option>
<?php endforeach; ?>