function borrarRegistro(NumID){
	var opcion = confirm("¿Esta seguro que desea borrar este registro?");
	if (opcion == true){
		document.getElementById('hiddenID').value = NumID;
		//var X = document.getElementById('hiddenID').value;
		document.getElementById('hiddenform').submit();
		document.getElementById('hiddenID').value = '';
		alert ("El registro " + NumID + " ha sido borrado.");
	}
}

function borrarCliente(NumID){
	var opcion = confirm("Si borra el cliente se borraran los pacientes asociados. ¿Desea continuar?");
	if (opcion == true){
		document.getElementById('hiddenID').value = NumID;
		document.getElementById('hiddenform').submit();
		document.getElementById('hiddenID').value = '';
		alert ("El cliente " + NumID + " ha sido borrado.");
	}
}












