<?php 
foreach ($equipsel as $m): ?>
	<option value="<?php echo $m['Fornecedor_equipamentos']['equipamento_id']; ?>" SELECTED ><?php echo $m['Equipamento']['equipamento_nome']; ?></option>
<?php endforeach; ?>
<?php 
foreach ($equipnsel as $m): ?>
	<option value="<?php echo $m['Equipamento']['equipamento_id']; ?>"><?php echo $m['Equipamento']['equipamento_nome']; ?></option>
<?php endforeach; ?>