<div id="formulario"> <!-- início da div de formulário -->
	<form> <!-- início do formulário -->
		Nome: <input type="text" name="nome" class="intexto"/><br/><br/>
		Responsável: <select name="responsavel" class="intexto"/>
						<option value="resp1" select="selected">r1</option>
						<option value="resp2">r2</option>
						<option value="resp2">r3</option>
					  </select><br/><br/>
		Funcionários: <input type="text" name="funcionarios" class="intexto"/><br/><br/>
		Terreno: <input type="text" name="terreno" class="intexto"/><br/><br/>
		Projeto: <input type="text" name="projeto" class="intexto"/><br/><br/>
		Materiais: <input type="text" name="materiais" class="intexto"/><br/><br/>
		Equipamentos: <input type="text" name="equipamentos" class="intexto"/><br/><br/>
		Custo: <input type="text" name="custo" class="intexto"/><br/><br/>
		Data de Início: <input type="text" name="dtinicio" class="intexto" maxlength="10" size="10"/><br/><br/>
		Data de Término: <input type="text" name="dtfim" class="intexto" maxlength="10" size="10"/><br/><br/>
		Status: <select name="status" class="intexto"/>
						<option value="iniciar" select="selected">A Iniciar</option>
						<option value="andamento">Em Andamento</option>
						<option value="parada">Parada</option>
			  </select><br/><br/>
		Tipo: <select name="tipo" class="intexto"/>
						<option value="residencial" select="selected">Residencial</option>
						<option value="comercial">Comercial</option>
						<option value="industrial">Industrial</option>
			  </select><br/><br/>
		Descrição: <input type="text" name="descricao" class="intexto"/><br/><br/>
		<input type="submit" value="Cadastrar"/>
	</form> <!-- fim do formulário -->
</div> <!-- início da div de formulário -->