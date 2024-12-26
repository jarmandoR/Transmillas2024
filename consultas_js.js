function ir_menu(destino, div)
{
	MostrarConsulta2(destino, div); 
}

function cambion(valor, destino)
{
	destino=destino+"?ordby="+valor;
	document.location.href=destino;
}

function cambion1(valor, valor2, destino)
{
	destino=destino+"?ordby="+valor+"&ordby1="+valor2;
	document.location.href=destino;
}

function preguntaotra(valor, nombre)
{
	document.getElementById(nombre).disabled=true;
	if(valor=="Otra"){ document.getElementById(nombre).disabled=false; }	
	if(valor=="Otro"){ document.getElementById(nombre).disabled=false; }	
}

function noenter() {   
    return !(window.event && window.event.keyCode == 13); 
}
function valsinoev(valor, nombre)
{
	var elementos = eval(nombre);
	for (x=0;x<elementos.length;x++){
		if(valor=="Si"){ elementos[x].disabled=false; }
		else { elementos[x].disabled=true; } 
	}
}

function aparecepreg(va, id_encuesta, orden, condi, div){
	valor=eval("param"+va).value;
	destino="resultados1.php?cond=42&valor="+valor+"&va="+va+"&id_encuesta="+id_encuesta+"&orden="+orden+"&condi="+condi;
	MostrarConsulta2(destino, div); 
}

function validatext(e)
{
       key = e.keyCode || e.which;
       tecla = String.fromCharCode(key).toLowerCase();
       letras = " ()*/+-";
       especiales = "8-37-39-46";
       tecla_especial = false
       for(var i in especiales){
            if(key == especiales[i]){
                tecla_especial = true;
                break;
            }
        }
        if(letras.indexOf(tecla)==-1 && !tecla_especial){
            return false;
        }
}


function crea_formula(valor)
{	
	val=document.getElementById('param5').value;
	document.getElementById('param5').value=""+val+" "+valor;		
}

function autocomplet(cond, div, valor, nombre, id_param)
{
	if(valor.length>2)
	{
		destino="resultados1.php?cond="+cond+"&valor="+valor+"&div="+div+"&nombre="+nombre+"&id_param="+id_param;
		MostrarConsulta2(destino, div); 
	}
}

function set_item(item, nombre, div, cond, val1, id_param) {
	$('#'+nombre+'').val(item);
	$('#'+div+'').hide();
	destino="resultados1.php?cond="+cond+"&valor="+val1+"&id_param="+id_param+"&div="+div;
	MostrarConsulta2(destino, div); 
}

function autocomplet1(valor, vale)
{
	if(valor.length>2)
	{
		llena_datos(vale);
	}
}

function autocomplet2(valor)
{
	if(valor.length>2)
	{
		llena_datos2();
	}
}

function showCheckboxes(nombre) {
        var checkboxes1 = document.getElementById(nombre);
        if (!expanded) {
            checkboxes1.style.display = "block";
            expanded = true;
        } else {
            checkboxes1.style.display = "none";
            expanded = false;
        }
}

function marcar(source) 
{
	checkboxes=document.getElementsByTagName('input'); //obtenemos todos los controles del tipo Input
	for(i=0;i<checkboxes.length;i++) //recoremos todos los controles
	{
		if(checkboxes[i].type == "checkbox") //solo si es un checkbox entramos
		{
			nombre=checkboxes[i].name;
			if(nombre==source+"[]"){
				if(checkboxes[i].checked==1){ checkboxes[i].checked=0; }
				else { checkboxes[i].checked=1; }
			}
		}
	}
}


function ir_mapa_dentro(id_pozo)
{	
	destino="detalle_operacion.php?id_p="+id_pozo;
	document.location.href=destino;
}

function iras(idzona, destino)
{
	destino=destino+"?idzona="+idzona;
	document.location.href=destino;
}

function cambio_exp(valor, destino, div)
{
	destino="resultados1.php?valor="+valor+"&cond="+destino;
	MostrarConsulta2(destino, div); 
}

function llena_abajo(cond, div, id)
{
	destino="resultados1.php?idproyecto="+id+"&cond="+cond;
	MostrarConsulta2(destino, div); 
}

function cambio_estado(id, div, env)
{
	destino="detalle_encuestas.php?idestado="+id+"&env="+env;
	MostrarConsulta2(destino, div); 
}

function cambio(valor, destino, condecion)
{
	destino=destino+"?param1="+valor+"&condecion="+condecion;
	document.location.href=destino;
}

function cambio1(valor, valor2, destino)
{
	destino=destino+"?param1="+valor+"&param2="+valor2;
	document.location.href=destino;
}

function cambio3(valor, valor2, valor3, destino)
{
	destino=destino+"?param1="+valor+"&param2="+valor2+"&param3="+valor3;
	document.location.href=destino;
}

function irao(id_p, tabla)
{
	destino="resultados6.php?id_encuesta="+id_p+"&tabla="+tabla;
	window.open(destino,"_blank");
}

function irau(id_p, tabla)
{
	destino="carga.php?id_encuesta="+id_p+"&tabla="+tabla;
	window.open(destino,"_blank"); 
}

function irau1(id_p, tabla)
{
	destino="carga1.php?id_encuesta="+id_p+"&tabla="+tabla;
	window.open(destino,"_blank"); 
}

function irau3(id_p)
{
	destino="empresas.php?id_empresa="+id_p;
	window.open(destino,"_self"); 
}

function irau2(id_p)
{
	destino="proyectos.php?id_proyecto="+id_p;
	window.open(destino,"_self"); 
}

function irau4(id_p)
{
	destino="proyectos2.php?id_proyecto="+id_p;
	window.open(destino,"_self"); 
}

function irau5(id_p, tabla)
{
	destino="ieducativas.php?ideducativa="+id_p+"&tabla="+tabla;
	location.href=destino;
}

function llena_grafica(div)
{
	destino="llena_grafica.php";
	MostrarConsulta(destino, div); 
}

function busqueda5(div, fecha1, fecha2)
{
	destino="detalle_cronograma1.php?fecha1="+fecha1+"&fecha2="+fecha2;
	MostrarConsulta(destino, div); 
}


function busqueda2(valor, destino, div, verifica, fecha1, fecha2)
{
	envio=0;
	if(verifica==1){
		if(valor.length<2){ return; }
	}
	else if(verifica==3){
		envio=valor;
	}
	destino="detalle_cronograma.php?valor="+valor+"&cond="+destino+"&envio="+envio+"&fecha1="+fecha1+"&fecha2="+fecha2;
	MostrarConsulta(destino, div); 
}

function busqueda(valor, destino, div, verifica)
{
	envio=0;
	if(verifica==1){
		if(valor.length<2){ return; }
	}
	else if(verifica==3){
		envio=valor;
	}
	destino="resultados2.php?valor="+valor+"&cond="+destino+"&envio="+envio;
	MostrarConsulta(destino, div); 
}

function ir_detalle_pro (id, i)
{
	i=24*i+147;
	if(i>230){i=230;}
    $('#diva').css("top", i);
	MostrarConsulta("detalle_proyectos.php?id_proyectos="+id+"&i="+i, "diva");
}

function ir_detalle_pro4 (id,i,da,opc,va)
{
	i=19*i+100;
	da=60*da+290;
	if(i>230){i=230;}
	$('#divb').css("top", i);
	$('#divb').css("left", da);
	MostrarConsulta("detalle_campo1.php?id_campo="+id+"&i="+i+"&opc="+opc+"&va="+va, "divb");
}


function ir_detalle_pun (lat, lon, rep, fec)
{
	destino="detalle_ubicacion.php?lat="+lat+"&lon="+lon+"&rep="+rep+"&fec="+fec;
	window.open(destino,"ventana1","width=600, height=400, scrollbars=yes, menubar=no, location=no, resizable=no") 
}


function ir_detalle_pro1 (id)
{
	MostrarConsulta("detalle_alarmas.php?id_proyectso="+id, "diva");
}

function ir_detalle_pro2 (id)
{
	MostrarConsulta("detalle_imagenes.php?id_proyectso="+id, "diva");
}



function busqueda1(valor, valor1, valor2, destino, div, verifica)
{
	destino="resultados2.php?param1="+valor+"&param2="+valor1+"&param3="+valor2+"&cond="+destino;
	MostrarConsulta(destino, div); 
}

function llena_trabajo(valor, div, condecion, url)
{
	if(valor!=0){
		destino=url+"?tabla="+valor+"&cond=1&div="+div;
		window.open(destino, "area_trabajo");
	}
}

function llena_trabajopop(valor, div, condecion)
{
	url="resultados6.php";
	if(valor!=0){
		destino=url+"?tabla="+valor+"&cond=1&condecion="+condecion+"&div="+div;
		window.open(destino, target=div);
//		if(condecion==1) { MostrarConsulta(destino, div); }
//		if(condecion==2) { MostrarConsulta2(destino, div); }
//		if(condecion==3) { MostrarConsulta3(destino, div); }
//		if(condecion==4) { MostrarConsulta4(destino, div); }
//		if(condecion==5) { MostrarConsulta5(destino, div); }
	}
}

function llena_trabajopop1(valor, div, accion)
{
	url="resultados6.php";
	if(accion==3){url="resultados5.php";}
	destino=url+"?tabla="+valor+"&cond="+accion+"&div="+div;
	MostrarConsulta(destino, div); 
}

function llena_trabajopop2(valor, div, accion, id_param)
{
	url="resultados6.php";
	if(accion==3){url="resultados5.php";}
	destino=url+"?tabla="+valor+"&cond="+accion+"&div="+div+"&id_param="+id_param;
	MostrarConsulta(destino, div); 
}


function llena_trabajo3(valor, div, id_param, id_tabla, param)
{
	destino="resultados5.php?tabla="+valor+"&id_param="+id_param+"&id_tabla="+id_tabla+"&param="+param+"&div="+div;
	window.open(destino, target=div);
}


function busqueda4(div)
{
	p1="";//document.form1.param1.value;
	p2="";//document.form1.param2.value;
	p3=document.form1.param3.options[document.form1.param3.selectedIndex].value;
	p4=document.form1.param4.options[document.form1.param4.selectedIndex].value;
	p5=document.form1.param5.options[document.form1.param5.selectedIndex].value;
	p6=document.form1.param6.options[document.form1.param6.selectedIndex].value;
	destino="detalle_alarmas1.php?&param1="+p1+"&param2="+p2+"&param3="+p3+"&param4="+p4+"&param5="+p5+"&param6="+p6;
	window.open(destino, target=div);
}


function busqueda3(div)
{
	p1=document.form1.param1.value;
	p2=document.form1.param2.value;
	p3=document.form1.param3.options[document.form1.param3.selectedIndex].value;
	p4=document.form1.param4.options[document.form1.param4.selectedIndex].value;
	p5=document.form1.param5.options[document.form1.param5.selectedIndex].value;
	p6=document.form1.param6.options[document.form1.param6.selectedIndex].value;
	p7=document.form1.param7.options[document.form1.param7.selectedIndex].value;
	p8=document.form1.param8.options[document.form1.param8.selectedIndex].value;
	destino="rep_reporte1.php?&param1="+p1+"&param2="+p2+"&param3="+p3+"&param4="+p4+"&param5="+p5+"&param6="+p6+"&param7="+p7+"&param8="+p8;
	document.location.href=destino;
}

function llena_trabajo_dentro(valor, id_tabla, div, condecion)
{
	if(valor!=0){
		destino="resultados6.php?tabla="+id_tabla+"&cond=1&condecion="+condecion+"&div="+div+"&id_acta="+valor;
		window.open(destino, target=div);
	}
}

function llena_trabajo1(valor, div, id_param, id_tabla)
{
	destino="resultados5.php?tabla="+valor+"&id_param="+id_param+"&id_tabla="+id_tabla+"&div="+div;
	window.open(destino, target=div);
}

function valor_total(destino, valor, nombre, div)
{
	destino="resultados1.php?param1="+valor+"&cond="+destino+"&nombre="+nombre;
	MostrarConsulta(destino, div); 
}

function llena_trabajo2(valor, div, id_param)
{
	destino="resultados6.php?tabla="+valor+"&id_param="+id_param+"&cond=2&div="+div;
	window.open(destino, target=div);
}

function nuevo_valor(tabla, div, valor)
{
	destino="resultados5.php?tabla="+tabla+"&id_param="+valor;
	window.open(destino, target=div);
}

function nuevo_valor1(tabla, div, valor)
{
	destino="resultados5.php?tabla="+tabla+"&id_p="+valor;
	window.open(destino, target=div);
}

function nuevo_valor2(tabla, div, valor, cond)
{
	destino="resultados6.php?tabla="+tabla+"&id_p="+valor+"&cond=1";
	window.open(destino, target=div);
}

function edita_valor(tabla, div, valor)
{
	destino="resultados4.php?tabla="+tabla+"&id_param="+valor;
	MostrarConsulta(destino, div); 
}

function elimina_valor(tabla, div, valor)
{
	destino="del_admin.php?tabla="+tabla+"&id_param="+valor;
	MostrarConsulta(destino, div); 
}

function cambio_ajax1(valor, destino, div, nombre, profundidad)
{
	destino="resultados1.php?param1="+valor+"&cond="+destino+"&nombre="+nombre;
	if(profundidad==1){ MostrarConsulta(destino, div); }
	else if(profundidad==2){ MostrarConsulta2(destino, div); }
	else if(profundidad==3){ MostrarConsulta3(destino, div); }
	else if(profundidad==4){ MostrarConsulta4(destino, div); }
	else if(profundidad==5){ MostrarConsulta5(destino, div); }
}

function cambio_ajax4(valor, valor2, ira, div, param, nombre, profundidad)
{
	destino="resultados1.php?param1="+valor+"&param2="+valor2+"&cond="+ira+"&para="+param+"&nombre="+nombre;
	if(profundidad==1){ MostrarConsulta(destino, div); }
	else if(profundidad==2){ MostrarConsulta2(destino, div); }
	else if(profundidad==3){ MostrarConsulta3(destino, div); }
	else if(profundidad==4){ MostrarConsulta4(destino, div); }
	else if(profundidad==5){ MostrarConsulta5(destino, div); }
}

function cambio_ajax2(valor, destino, div, nombre, profundidad, para)
{
	destino="resultados1.php?param1="+valor+"&cond="+destino+"&nombre="+nombre+"&para="+para;
	if(profundidad==1){ MostrarConsulta(destino, div); }
	else if(profundidad==2){ MostrarConsulta2(destino, div); }
	else if(profundidad==3){ MostrarConsulta3(destino, div); }
	else if(profundidad==4){ MostrarConsulta4(destino, div); }
	else if(profundidad==5){ MostrarConsulta5(destino, div); }
}

function cambio_ajax21(valor, destino, div, nombre, profundidad, para)
{
	var valor2='0';
	if(valor=='Sede Origen'){
		valor2=document.getElementById(param1).value;

	}else if(valor=='Sede Destino'){
		valor2=document.getElementById(param2).value;
	} else {
		alert("Seleccione donde va a pagar");
	}
	if(valor2!=0){

		destino="resultados1.php?param1="+valor2+"&cond="+destino+"&nombre="+nombre+"&para="+para;
		if(profundidad==1){ MostrarConsulta(destino, div); }
		else if(profundidad==2){ MostrarConsulta2(destino, div); }
		else if(profundidad==3){ MostrarConsulta3(destino, div); }
		else if(profundidad==4){ MostrarConsulta4(destino, div); }
		else if(profundidad==5){ MostrarConsulta5(destino, div); }
	}

}

function cambioss(div, mod, alto, bajo, calto, cbajo, poz, vari, activo, critica)
{
	destino="resultados1.php?param1="+mod+"&cond=7&param2="+alto+"&param3="+bajo+"&param4="+calto+"&param5="+cbajo+"&poz="+poz+"&vari="+vari+"&activo="+activo+"&critica="+critica;
	MostrarConsulta(destino, div);
	
}
function ir(valor, pagina)
{
	destino=pagina+"?param1="+valor;
	document.location.href=destino;
}

function elimina_registro(nom, div, id_p)
{
    if(!confirm("Esta seguro de eliminar este registro?")) { 
		return;
	}
	destino="resultados6.php?tabla="+nom+"&id_param="+id_p+"&cond=2&div="+div;
	MostrarConsulta4(destino, div);
}


function cambio_ajax11(valor, destino, div)
{
	destino="resultados1.php?param1="+valor+"&cond="+destino;
	MostrarConsulta4(destino, div);
}

function cambio_ajax71(valor, destino, div,param)
{
	destino="resultados1.php?param1="+valor+"&cond="+destino+"&para="+param;
	MostrarConsulta(destino, div);
}

function cambio_ajax133(valor, destino, div,param)
{
	destino="resultados1.php?param1="+valor+"&cond="+destino+"&para="+param;
	MostrarConsulta2(destino, div);
}

function cambio_ajax13(valor, destino, div)
{
	destino="resultados1.php?param1="+valor+"&cond="+destino;
	MostrarConsulta2(destino, div);
}

function cambio_ajax12(valor, destino, div)
{
	destino="resultados1.php?param1="+valor+"&cond="+destino;
	MostrarConsulta3(destino, div);
}

function cambio_ajax15(valor, destino, div, param)
{
	destino="resultados1.php?param1="+valor+"&cond="+destino+"&para="+param;
	MostrarConsulta5(destino, div);
}

function cambio_ajax31(valor, destino, div)
{
	destino="resultados1.php?param1="+valor+"&cond="+destino;
	MostrarConsulta3(destino, div);
}

function cambio_ajax51(valor, destino, div)
{
	destino="resultados1.php?param1="+valor+"&cond="+destino;
	MostrarConsulta3(destino, div);
}

function cambio_ajax111(valor, destino, div, param)
{
	destino="resultados1.php?param1="+valor+"&cond="+destino+"&para="+param;
	MostrarConsulta4(destino, div);
}

function cambio_ajax122(valor, destino, div, param)
{
	destino="resultados1.php?param1="+valor+"&cond="+destino+"&para="+param;
	MostrarConsulta3(destino, div);
}

function cambio_ajax23(valor, destino, div, param)
{
	destino="resultados1.php?param1="+valor+"&cond="+destino+"&para="+param;
	MostrarConsulta3(destino, div);
}

function cambio_ajax3(valor, destino, div, param)
{
	destino="resultados1.php?param1="+valor+"&cond="+destino+"&para="+param;
	MostrarConsulta2(destino, div);
}

function cambio_ajax5(valor, destino, div, param)
{
	destino="resultados1.php?param1="+valor+"&cond="+destino+"&para="+param;
	MostrarConsulta3(destino, div);
}


function cambio_ajax33(valor, destino, div, param)
{
	destino="resultados1.php?param2="+valor+"&cond="+destino+"&para="+param;
	MostrarConsulta21(destino, div);
}

function checkChoice(nombre, objeto, nomb1) {
    proyec="";
	for (i=0; i<eval(objeto).length; i++)
    {     
		if (eval(objeto)[i].checked)
		{ 
			valor=eval(objeto)[i].value;
			proyec+=valor+"; ";
			valor=valor.trim();
		}
	}
	eval(nombre).value=proyec;
}

function checkChoiceN(nombre, nombre2)
{
    proyec="";
	for (i=0; i<eval(nombre).length; i++)
    {     
		if (eval(nombre)[i].checked)
		{ 
			valor=eval(nombre)[i].value;
			proyec+=valor+", ";
		}
	}
	eval(nombre2).value=proyec;
}

function checkChoiceN1(valor, nombre2, qi)
{
	proyec=eval(nombre2).value;
	if(qi==1){
		valor=valor+",";
		proyec=proyec.replace(valor,"");
	}
	else {
		proyec=proyec+""+valor+",";
	}
	pro=proyec.split(",");
	proy="";
	for(i=0; i<pro.length; i++)
	{
		if(!isNaN(pro[i])){ proy+=parseInt(pro[i])+",";	}
	}
	proy=proy.replace(",NaN","");
	eval(nombre2).value=proy;
}

function checkChoice2(objeto) {
    proyec="";
	for (i=0; i<document.form11.proyectos.length; i++)
    {     
		if (document.form11.proyectos[i].checked)
		{ 
			valor=document.form11.proyectos[i].value;
			proyec+=valor+", ";
		}
	}
	document.form11.selproyectos.value=proyec;
	destino="resultados1.php?param1="+proyec+"&cond=15&para=0";
	MostrarConsulta4a(destino, "mye1");
    myev="";
	document.form11.selmye.value=myev;
	destino="resultados1.php?param1="+proyec+"&cond=16&para=0";
	MostrarConsulta3a(destino, "indicadores1");
}

function checkChoice3(objeto) {
    myev="";
	for (i=0; i<document.form11.mye.length; i++)
    {
		if (document.form11.mye[i].checked)
		{ 
			valor=document.form11.mye[i].value;
			myev+=valor+", ";
		}
	}
	document.form11.selmye.value=myev;
}

function checkChoice4(objeto) {
    indica="";
	for (i=0; i<document.form11.indi.length; i++)
    {     
		if (document.form11.indi[i].checked)
		{ 
			valor=document.form11.indi[i].value;
			indica+=valor+", ";
		}
	}
	document.form11.selindi.value=indica;
}

function checkChoice5(objeto) {
    params="";
	for (i=0; i<document.form11.paras.length; i++)
    {     
		if (document.form11.paras[i].checked)
		{ 
			valor=document.form11.paras[i].value;
			params+=valor+", ";
		}
	}
	document.form11.selpara.value=params;
}

function checkChoice6(objeto) {
    proyec="";
	for (i=0; i<document.form11.proyectos.length; i++)
    {     
		if (document.form11.proyectos[i].checked)
		{ 
			valor=document.form11.proyectos[i].value;
			proyec+=valor+", ";
		}
	}
	document.form11.selproyectos.value=proyec;
	destino="resultados1.php?param1="+proyec+"&cond=20&para=0";
	MostrarConsulta4a(destino, "parame2");
}