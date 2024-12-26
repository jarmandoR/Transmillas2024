alert('jose');
console.log('mmmm');
var valida = document.getElementById("estado").value;
var iduser = document.getElementById("user").value;
console.log('mmmm222');
var fecha = document.getElementById("fecha").value;

console.log('mmmm');
console.log(valida);
if(valida=='ingresado'){
	console.log('okissss');
	datos = {"user":iduser,"fecha":fecha};				
		$.ajax({
				url: "buscarpreoperacional.php",
				type: "POST",
				data: datos
			}).done(function(respuesta){
				var obj = JSON.parse(respuesta);
				console.log(obj);
				if (respuesta != null) {				
					var suma=0;
					for (var i in obj) {
						value=obj[i];
						for (i=0;i<document.getElementById(i).length;i++){ 
							if (document.fcolores.colorin[i].value==value){
								document.getElementById(i).checked;
							}								
						}
						
					}
					
				}			
		});
}
