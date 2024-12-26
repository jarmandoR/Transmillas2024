
function mostrarToast(mensaje) {
    var toast = document.getElementById("mitoast");
	 document.getElementById("toats").innerHTML = "Tiene "+mensaje+ " Revise";
    toast.className = "mostrar";
    setTimeout(function(){ toast.className = toast.className.replace("mostrar", ""); }, 10000);
}

function cerrarToast() {
    var toast = document.getElementById("mitoast");
    toast.className = "cerrar";
    toast.className = toast.className.replace("cerrar", "");
}