<?php $c = 0; 
foreach ($funcsel as $m): ?>
	<option value="<?php echo $m['Lista_funcionario']['funcionario_id']; ?>" SELECTED ><?php echo $m['Funcionario']['funcionario_nome']."(".$m['Funcionario']['funcionario_tipo'].")"; ?></option>
<?php endforeach; ?>
<?php $c = 0; 
foreach ($funcnsel as $m): ?>
	<option value="<?php echo $m['Funcionario']['funcionario_id']; ?>" ><?php echo $m['Funcionario']['funcionario_nome']."(".$m['Funcionario']['funcionario_tipo'].")"; ?></option>
<?php endforeach; ?>