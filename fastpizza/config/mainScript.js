
function abreMenu(){
	document.getElementById('side-menu').style.width = "200px";
}

function fechaMenu() {
	document.getElementById('side-menu').style.width = "0px";
}

function CarregaEstado($estado){
	switch($estado) {
		case "RJ":
			var option = document.getElementById('uf_rj');
			option.setAttribute("selected","selected");
		break;
		case "SP":
			var option = document.getElementById('uf_sp');
			option.setAttribute("selected","selected");
		break;
		case "MG":
			var option = document.getElementById('uf_mg');
			option.setAttribute("selected","selected");
	}
}