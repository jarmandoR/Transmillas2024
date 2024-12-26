$(document).ready(function()
{
	table=$('#tabla').val();
	$.validator.addMethod("textOnly", function(value, element) { return !/[0-9]*/.test(value);}, "Alpha Characters Only.");
	switch(table){
		case "Rol":
		$('#form1').validate({
			rules:{ param1:{required:true, number:false}},
			messages:{param1:{required:"Campo requerido", number:"Debe ser numero"}}
		});
		break;
		case "Usuario":
		$('#form1').validate({
			rules:{
				param1:{required:true, number:true},
				param3:{required:true, number:false},
				param4:{required:true, email:true},
				param5:{required:true, number:false}
			},
			messages:{
				param1:{required:"Campo requerido", number:"Debe ser numero"},
				param3:{required:"Campo requerido", number:"Debe ser numero"},
				param4:{required:"Campo requerido", email:"Debe ser un email"},
				param5:{required:"Campo requerido", number:"Debe ser numero"}
			}
		});
		break;
		case "Pais":
		$('#form1').validate({
			rules:{ param1:{required:true, number:false}},
			messages:{param1:{required:"Campo requerido", number:"Debe ser numero"}}
		});
		break;
		
		case "Menu":
		$('#form1').validate({
			rules:{
				param1:{required:true, number:false},
				param2:{required:true, number:false},
				param3:{required:false, number:false},
				param4:{required:true, number:false}
			},
			messages:{
				param1:{required:"Campo requerido", number:"Debe ser numero"},
				param2:{required:"Campo requerido", number:"Debe ser numero"},
				param3:{required:"Campo requerido", number:"Debe ser numero"},
				param4:{required:"Campo requerido", number:"Debe ser numero"}
			}
		});
		break;

		case "Permiso":
		$('#form1').validate({
			rules:{
				param1:{required:true, number:false},
				param2:{required:false, number:false},
				param3:{required:true, number:false}
			},
			messages:{
				param1:{required:"Campo requerido", number:"Debe ser numero"},
				param2:{required:"Campo requerido", number:"Debe ser numero"},
				param3:{required:"Campo requerido", number:"Debe ser numero"}
			}
		});
		break;

		case "Departamento":
		$('#form1').validate({
			rules:{
				param1:{required:true, number:true},
				param2:{required:true, number:false},
				param3:{required:true, number:false},
			},
			messages:{
				param1:{required:"Campo requerido", number:"Debe ser numero"},
				param2:{required:"Campo requerido", number:"Debe ser numero"},
				param3:{required:"Campo requerido", number:"Debe ser un email"}
			}
		});
		break;

		case "Ciudad":
		$('#form1').validate({
			rules:{
				param1:{required:true, number:true},
				param2:{required:true, number:false},
				param3:{required:true, number:false},
				param4:{required:true, number:false},
				param5:{required:true, number:false},
				param6:{required:true, number:false}
			},
			messages:{
				param1:{required:"Campo requerido", number:"Debe ser numero"},
				param2:{required:"Campo requerido", number:"Debe ser numero"},
				param3:{required:"Campo requerido", number:"Debe ser un email"},
				param4:{required:"Campo requerido", number:"Debe ser un email"},
				param5:{required:"Campo requerido", number:"Debe ser un email"},
				param6:{required:"Campo requerido", number:"Debe ser un email"}
			}
		});
		break;
		case "Componente":
		$('#form1').validate({
			rules:{
				param1:{required:true, number:false},
			},
			messages:{
				param1:{required:"Campo requerido", number:"Debe ser numero"},
			}
		});
		break;
		case "Vereda":
		$('#form1').validate({
			rules:{
				param1:{required:true, number:true},
				param2:{required:true, number:false},
				param3:{required:true, number:false},
				param4:{required:true, number:false},
				param5:{required:true, number:false},
				param6:{required:true, number:false},
				param7:{required:true, number:false}
			},
			messages:{
				param1:{required:"Campo requerido", number:"Debe ser numero"},
				param2:{required:"Campo requerido", number:"Debe ser numero"},
				param3:{required:"Campo requerido", number:"Debe ser un email"},
				param4:{required:"Campo requerido", number:"Debe ser un email"},
				param5:{required:"Campo requerido", number:"Debe ser un email"},
				param6:{required:"Campo requerido", number:"Debe ser un email"},
				param7:{required:"Campo requerido", number:"Debe ser un email"}
			}
		});
		break;

		case "Indicador":
		$('#form1').validate({
			rules:{
				param1:{required:true, number:true},
				param2:{required:true, number:false},
				param3:{required:true, number:false},
				param4:{required:false, number:false},
				param5:{required:false, number:false}
			},
			messages:{
				param1:{required:"Campo requerido", number:"Debe ser numero"},
				param2:{required:"Campo requerido", number:"Debe ser numero"},
				param3:{required:"Campo requerido", number:"Debe ser un email"},
				param4:{required:"Campo requerido", number:"Debe ser un email"},
				param5:{required:"Campo requerido", number:"Debe ser un email"}
			}
		});
		break;

		case "Donante":
		$('#form1').validate({
			rules:{
				param1:{required:true, number:true},
				param2:{required:true, number:false},
				param3:{required:true, number:false},
				param4:{required:true, number:false},
				param5:{required:true, number:false},
				param6:{required:true, number:false},
				param7:{required:false, number:false},
				param8:{required:false, email:true},
				param9:{required:false, number:false},
				param10:{required:false, email:true},
				param11:{required:true, email:false}
			},
			messages:{
				param1:{required:"Campo requerido", number:"Debe ser numero"},
				param2:{required:"Campo requerido", number:"Debe ser numero"},
				param3:{required:"Campo requerido", number:"Debe ser un email"},
				param4:{required:"Campo requerido", number:"Debe ser un email"},
				param5:{required:"Campo requerido", number:"Debe ser un email"},
				param6:{required:"Campo requerido", number:"Debe ser un email"},
				param7:{required:"Campo requerido", number:"Debe ser un email"},
				param8:{required:"Campo requerido", email:"Debe ser un email"},
				param9:{required:"Campo requerido", number:"Debe ser un email"},
				param10:{required:"Campo requerido", email:"Debe ser un email"},
				param11:{required:"Campo requerido", email:"Debe ser un email"}
			}
		});
		break;

		case "Partner":
		$('#form1').validate({
			rules:{
				param1:{required:true, number:true},
				param2:{required:true, number:false},
				param3:{required:true, number:false},
				param4:{required:true, number:false},
				param5:{required:true, number:false},
				param6:{required:true, number:false},
				param7:{required:false, number:false},
				param8:{required:false, email:true},
				param9:{required:false, number:false},
				param10:{required:false, email:true},
				param11:{required:true, email:false}
			},
			messages:{
				param1:{required:"Campo requerido", number:"Debe ser numero"},
				param2:{required:"Campo requerido", number:"Debe ser numero"},
				param3:{required:"Campo requerido", number:"Debe ser un email"},
				param4:{required:"Campo requerido", number:"Debe ser un email"},
				param5:{required:"Campo requerido", number:"Debe ser un email"},
				param6:{required:"Campo requerido", number:"Debe ser un email"},
				param7:{required:"Campo requerido", number:"Debe ser un email"},
				param8:{required:"Campo requerido", email:"Debe ser un email"},
				param9:{required:"Campo requerido", number:"Debe ser un email"},
				param10:{required:"Campo requerido", email:"Debe ser un email"},
				param11:{required:"Campo requerido", email:"Debe ser un email"}
			}
		});
		break;

		case "Socio Local":
		$('#form1').validate({
			rules:{
				param1:{required:true, number:true},
				param2:{required:true, number:true},
				param3:{required:true, number:true},
				param4:{required:true, number:false},
				param5:{required:true, number:false},
				param6:{required:true, number:false},
				param7:{required:true, number:false},
				param8:{required:true, email:false},
				param9:{required:false, number:false},
				param10:{required:false, email:true},
				param11:{required:false, email:false},
				param12:{required:false, email:true},
				param13:{required:true, email:false},
			},
			messages:{
				param1:{required:"Campo requerido", number:"Debe ser numero"},
				param2:{required:"Campo requerido", number:"Debe ser numero"},
				param3:{required:"Campo requerido", number:"Debe ser un email"},
				param4:{required:"Campo requerido", number:"Debe ser un email"},
				param5:{required:"Campo requerido", number:"Debe ser un email"},
				param6:{required:"Campo requerido", number:"Debe ser un email"},
				param7:{required:"Campo requerido", number:"Debe ser un email"},
				param8:{required:"Campo requerido", email:"Debe ser un email"},
				param9:{required:"Campo requerido", number:"Debe ser un email"},
				param10:{required:"Campo requerido", email:"Debe ser un email"},
				param11:{required:"Campo requerido", email:"Debe ser un email"},
				param12:{required:"Campo requerido", email:"Debe ser un email"},
				param13:{required:"Campo requerido", email:"Debe ser un email"}
			}
		});
		break;

		case "Programa":
		$('#form1').validate({
			rules:{
				param1:{required:true, number:false},
				param2:{required:true, number:false},
				param3:{required:true, number:false},
				param4:{required:false, number:false},
				param5:{required:false, number:true}
			},
			messages:{
				param1:{required:"Campo requerido", number:"Debe ser numero"},
				param2:{required:"Campo requerido", number:"Debe ser numero"},
				param3:{required:"Campo requerido", number:"Debe ser un email"},
				param4:{required:"Campo requerido", number:"Debe ser un email"},
				param5:{required:"Campo requerido", number:"Debe ser numero"}
			}
		});
		break;

		case "Proyecto":
		$('#form1').validate({
			rules:{
				param1:{required:true, number:true},
				param2:{required:true, number:false},
				param3:{required:true, number:false},
				param4:{required:true, number:false},
				param5:{required:true, number:false},
				param6:{required:true, number:false},
				param7:{required:true, number:true},
				param8:{required:true, email:false},
				param9:{required:true, number:true},
				param10:{required:true, email:false},
				param11:{required:true, email:false},
				param12:{required:true, email:false}
			},
			messages:{
				param1:{required:"Campo requerido", number:"Debe ser numero"},
				param2:{required:"Campo requerido", number:"Debe ser numero"},
				param3:{required:"Campo requerido", number:"Debe ser un email"},
				param4:{required:"Campo requerido", number:"Debe ser un email"},
				param5:{required:"Campo requerido", number:"Debe ser un email"},
				param6:{required:"Campo requerido", number:"Debe ser un email"},
				param7:{required:"Campo requerido", number:"Debe ser un email"},
				param8:{required:"Campo requerido", email:"Debe ser un email"},
				param9:{required:"Campo requerido", number:"Debe ser un email"},
				param10:{required:"Campo requerido", email:"Debe ser un email"},
				param11:{required:"Campo requerido", email:"Debe ser un email"},
				param12:{required:"Campo requerido", email:"Debe ser un email"}
			}
		});
		break;

		case "Objetivo intemedio":
		$('#form1').validate({
			rules:{
				param1:{required:true, number:true},
				param2:{required:true, number:true},
				param3:{required:true, number:true},
				param4:{required:true, number:false},
				param5:{required:false, number:false},
				param6:{required:false, number:false}
			},
			messages:{
				param1:{required:"Campo requerido", number:"Debe ser numero"},
				param2:{required:"Campo requerido", number:"Debe ser numero"},
				param3:{required:"Campo requerido", number:"Debe ser un email"},
				param4:{required:"Campo requerido", number:"Debe ser un email"},
				param5:{required:"Campo requerido", number:"Debe ser numero"},
				param6:{required:"Campo requerido", number:"Debe ser numero"}
			}
		});
		break;

		case "Objetivo final":
		$('#form1').validate({
			rules:{
				param1:{required:true, number:false},
				param2:{required:true, number:false}
			},
			messages:{
				param1:{required:"Campo requerido", number:"Debe ser numero"},
				param2:{required:"Campo requerido", number:"Debe ser numero"}
			}
		});
		break;
		case "Productos":
		$('#form1').validate({
			rules:{
				param1:{required:true, number:false}
			},
			messages:{
				param1:{required:"Campo requerido", number:"Debe ser numero"}
			}
		});
		break;
		case "Actividad":
		$('#form1').validate({
			rules:{
				param1:{required:true, number:false},
				param2:{required:false, number:false},
				param3:{required:true, number:false},
				param4:{required:true, number:false},
				param5:{required:true, number:false}
			},
			messages:{
				param1:{required:"Campo requerido", number:"Debe ser numero"},
				param2:{required:"Campo requerido", number:"Debe ser numero"},
				param3:{required:"Campo requerido", number:"Debe ser numero"},
				param4:{required:"Campo requerido", number:"Debe ser numero"},
				param5:{required:"Campo requerido", number:"Debe ser numero"}
			}
		});
		break;
		
		case "Indicador-Proyectos":
		$('#form1').validate({
			rules:{
				param1:{required:false, number:false},
				param4:{required:true, number:false},
				param7:{required:true, email:false},
				param8:{required:false, number:false},
				param9:{required:false, number:false},
				param10:{required:false, number:false},
				param11:{required:false, number:false}
			},
			messages:{
				param1:{required:"Campo requerido", number:"Debe ser numero"},
				param4:{required:"Campo requerido", number:"Debe ser numero"},
				param7:{required:"Campo requerido", email:"Debe ser un email"},
				param8:{required:"Campo requerido", number:"Debe ser numero"},
				param9:{required:"Campo requerido", number:"Debe ser numero"},
				param10:{required:"Campo requerido", number:"Debe ser numero"},
				param11:{required:"Campo requerido", number:"Debe ser numero"}
			}
		});
		break;
		case "Encuesta":
		$('#form1').validate({
			rules:{
				param1:{required:true, number:false},
				param4:{required:true, number:false}
			},
			messages:{
				param1:{required:"Campo requerido", number:"Debe ser numero"},
				param4:{required:"Campo requerido", number:"Debe ser numero"}
			}
		});
		break;



		case "Nivel":
		$('#form1').validate({
			rules:{
				param1:{required:true, number:true},
				param2:{required:true, number:false},
				param3:{required:true, number:true}
			},
			messages:{
				param1:{required:"Campo requerido", number:"Debe ser numero"},
				param2:{required:"Campo requerido", number:"Debe ser numero"},
				param3:{required:"Campo requerido", number:"Debe ser numero"}
			}
		});
		break;
		case "Nivel 1":
		$('#form1').validate({
			rules:{
				param1:{required:true, number:true},
				param2:{required:true, number:false},
				param3:{required:true, number:false},
				param4:{required:true, number:false},
				param5:{required:false, number:false},
				param6:{required:false, number:false}
			},
			messages:{
				param1:{required:"Campo requerido", number:"Debe ser numero"},
				param2:{required:"Campo requerido", number:"Debe ser numero"},
				param3:{required:"Campo requerido", number:"Debe ser numero"},
				param4:{required:"Campo requerido", number:"Debe ser numero"},
				param5:{required:"Campo requerido", number:"Debe ser numero"},
				param6:{required:"Campo requerido", number:"Debe ser numero"}
			}
		});
		break;
		case "Nivel 2":
		$('#form1').validate({
			rules:{
				param1:{required:true, number:true},
				param3:{required:true, number:false},
				param4:{required:true, number:false},
				param5:{required:false, number:false},
				param6:{required:false, number:false}
			},
			messages:{
				param1:{required:"Campo requerido", number:"Debe ser numero"},
				param3:{required:"Campo requerido", number:"Debe ser numero"},
				param4:{required:"Campo requerido", number:"Debe ser numero"},
				param5:{required:"Campo requerido", number:"Debe ser numero"},
				param6:{required:"Campo requerido", number:"Debe ser numero"}
			}
		});
		break;
		case "Nivel 3":
		$('#form1').validate({
			rules:{
				param1:{required:true, number:true},
				param3:{required:true, number:false},
				param4:{required:true, number:false},
				param5:{required:false, number:false},
				param6:{required:false, number:false}
			},
			messages:{
				param1:{required:"Campo requerido", number:"Debe ser numero"},
				param3:{required:"Campo requerido", number:"Debe ser numero"},
				param4:{required:"Campo requerido", number:"Debe ser numero"},
				param5:{required:"Campo requerido", number:"Debe ser numero"},
				param6:{required:"Campo requerido", number:"Debe ser numero"}
			}
		});
		break;

		case "Nivel 4":
		$('#form1').validate({
			rules:{
				param1:{required:true, number:true},
				param3:{required:true, number:false},
				param4:{required:true, number:false},
				param5:{required:false, number:false},
				param6:{required:false, number:false}
			},
			messages:{
				param1:{required:"Campo requerido", number:"Debe ser numero"},
				param3:{required:"Campo requerido", number:"Debe ser numero"},
				param4:{required:"Campo requerido", number:"Debe ser numero"},
				param5:{required:"Campo requerido", number:"Debe ser numero"},
				param6:{required:"Campo requerido", number:"Debe ser numero"}
			}
		});
		break;

		case "Nivel 5":
		$('#form1').validate({
			rules:{
				param1:{required:true, number:true},
				param3:{required:true, number:false},
				param4:{required:true, number:false},
				param5:{required:false, number:false},
				param6:{required:false, number:false}
			},
			messages:{
				param1:{required:"Campo requerido", number:"Debe ser numero"},
				param3:{required:"Campo requerido", number:"Debe ser numero"},
				param4:{required:"Campo requerido", number:"Debe ser numero"},
				param5:{required:"Campo requerido", number:"Debe ser numero"},
				param6:{required:"Campo requerido", number:"Debe ser numero"}
			}
		});
		break;

		case "Nivel 6":
		$('#form1').validate({
			rules:{
				param1:{required:true, number:true},
				param3:{required:true, number:false},
				param4:{required:true, number:false},
				param5:{required:false, number:false},
				param6:{required:false, number:false}
			},
			messages:{
				param1:{required:"Campo requerido", number:"Debe ser numero"},
				param3:{required:"Campo requerido", number:"Debe ser numero"},
				param4:{required:"Campo requerido", number:"Debe ser numero"},
				param5:{required:"Campo requerido", number:"Debe ser numero"},
				param6:{required:"Campo requerido", number:"Debe ser numero"}
			}
		});
		break;
		
	}
})