function adicionarLinha(){
    var local=document.getElementById('TabPremiacao');
    var tblBody = local.tBodies[0];
    var newRow = tblBody.insertRow(-1);  
    var total  = document.getElementById('premiacaototal').value;
    var newCell1 = newRow.insertCell(0);
    newCell1.innerHTML = '<td><input type="text" name="cupom'+total+'"  value="" class="form-control" placeholder="Cupom" onkeyup="numero(this)"></td>';
    var newCell2 = newRow.insertCell(1);
    newCell2.innerHTML = '<td><button class="btn btn-large btn-danger" onclick="deleteRow(this.parentNode.parentNode.rowIndex)">Excluir</button></td>';
    var total=document.getElementById('premiacaototal').value++;

}
function deleteRow(i){
	document.getElementById('TabPremiacao').deleteRow(i);
}

function verificarCPF(c){
    var i;
    s = c;
    var c = s.substr(0,9);
    var dv = s.substr(9,2);
    var d1 = 0;
    var v = false;
    var cpf = s;

    if ( (cpf == "00000000000") || (cpf == "11111111111") || (cpf == "22222222222") || (cpf == "33333333333") 
        || (cpf == "44444444444") || (cpf == "55555555555") || (cpf == "66666666666")
        || (cpf == "77777777777") || (cpf == "88888888888") || (cpf == "99999999999")){
        alert("CPF Inválido")
        v = true;
        document.getElementById('cpf').value=null;
        return false; 
    }  
    for (i = 0; i < 9; i++){
        d1 += c.charAt(i)*(10-i);
    }

    d1 = 11 - (d1 % 11);
    if (d1 > 9) d1 = 0;
    if (dv.charAt(0) != d1){
        alert("CPF Inválido")
        v = true;
        document.getElementById('cpf').value=null;
        document.getElementById('CPF').value=null;
        return false;   
    }
 
    d1 *= 2;
    for (i = 0; i < 9; i++){
        d1 += c.charAt(i)*(11-i);
    }
    d1 = 11 - (d1 % 11);
    if (d1 > 9) d1 = 0;
    if (dv.charAt(1) != d1){
        alert("CPF Inválido")
        v = true;
        document.getElementById('cpf').value=null;
        document.getElementById('CPF').value=null;
        return false;
        
    }
    if (!v) {
        
    }

}

function dataConta(c){
    if(c.value.length ==2){
        c.value += '/';
    }
    if(c.value.length==5){
        c.value += '/'; 
    }
}

function formatacpf(c){
    if(c.value.length ==3){
        c.value += '.';
    }
    if(c.value.length==7){
        c.value += '.'; 
    }
    if(c.value.length==11){
        c.value += '-'; 
    }
}

function validasenha(s){
    var senha1 = document.getElementById('senha').value;
    var senha2 = document.getElementById('Confirmar').value;
    
    if (senha1 != senha2) {
        alert("Senhas não conferem")
        document.getElementById('senha').value = null;
        document.getElementById('Confirmar').value = null;
    }
}

function maiuscula(z){
        v = z.value.toUpperCase();
        z.value = v;
    }

function moeda(z){
v = z.value;
v=v.replace(/\D/g,"") // permite digitar apenas numero
v=v.replace(/(\d{1})(\d{1,2})$/,"$1.$2") // coloca virgula antes dos ultimos 2 digitos
z.value = v;
}

function codVer(c){
    if(c.value.length ==4){
        c.value += '.';
    }
    if(c.value.length==9){
        c.value += '.'; 
    }
    if(c.value.length==14){
        c.value += '.'; 
    }
}

function numero(z){
v = z.value;
v=v.replace(/\D/g,"") // permite digitar apenas numero
z.value = v;
}