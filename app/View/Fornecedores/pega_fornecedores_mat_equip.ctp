<?php 
foreach ($fornecedores as $f): ?>
	<option value="<?php echo $f['Fornecedor']['fornecedor_id']; ?>"><?php echo $f['Fornecedor']['fornecedor_nome']; ?></option>
<?php endforeach; ?>