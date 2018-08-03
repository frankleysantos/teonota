function adicionarLinha(){
	var local=document.getElementById('Tabpremiacao');
	var tblBody = local.tBodies[0];
	var newRow = tblBody.insertRow(-1);  
	var total  = document.getElementById('familiatotal').value;
	var newCell0 = newRow.insertCell(0);
	newCell0.innerHTML = '<td><input type="text" name="FamiliarNome'+total+'"  value="" class="form-control" placeholder="Nome"></td>'; 
	var newCell1 = newRow.insertCell(2);
	newCell1.innerHTML = '<td><input type="text" name="FamiliarDataNasc'+total+'"  value="" class="form-control" maxlength="10" placeholder="Data de Nascimento" onkeyup=dataConta(this)></td>';
	var newCell5 = newRow.insertCell(3);
	newCell5.innerHTML = '<td><input type="text" name="FamiliarRemuneracao'+total+'" onkeyup=moeda(this)  value="" class="form-control" placeholder="Remuneração"></td>';
	var newCell6 = newRow.insertCell(4);
	newCell6.innerHTML = '<td><button class="btn btn-large btn-danger fa fa-trash" onclick="deleteRow(this.parentNode.parentNode.rowIndex)"></button></td>';
	var total=document.getElementById('familiatotal').value++;

}

function deleteRow(i){
	document.getElementById('Tabpremiacao').deleteRow(i);
}