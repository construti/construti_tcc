<?php 
foreach ($matsel as $m): ?>
	<option value="<?php echo $m['Fornecedor_materiais']['material_id']; ?>" SELECTED ><?php echo $m['Material']['material_nome']." (".$m['Material']['Embalagem']['embalagem_tipo']." - ".$m['Material']['material_qtd_base']." - ".$m['Material']['Medida']['medida_tipo'].")"; ?></option>
<?php endforeach; ?>
<?php 
foreach ($matnsel as $m): ?>
	<option value="<?php echo $m['Material']['material_id']; ?>"><?php echo $m['Material']['material_nome']." (".$m['Embalagem']['embalagem_tipo']." - ".$m['Material']['material_qtd_base']." - ".$m['Medida']['medida_tipo'].")"; ?></option>
<?php endforeach; ?>