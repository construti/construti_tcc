<?php 
foreach ($matsel as $m): ?>
	<option value="<?php echo $m['Fornecedor_materiais']['material_id']; ?>" SELECTED ><?php echo $m['Material']['material_nome']; ?></option>
<?php endforeach; ?>
<?php 
foreach ($matnsel as $m): ?>
	<option value="<?php echo $m['Material']['material_id']; ?>"><?php echo $m['Material']['material_nome']; ?></option>
<?php endforeach; ?>