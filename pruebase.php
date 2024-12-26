<HTML>
<HEAD>
<SCRIPT type="text/javascript">
function crit_busqueda() {
  var input=document.getElementById('texto_busqueda').value.toLowerCase();
  var output=document.getElementById('id_textos').options;
  for(var i=0;i<output.length;i++) {
    if(output[i].value.indexOf(input)==0){
      output[i].selected=true;
      }
    if(document.forms[0].texto_busqueda.value==''){
      output[0].selected=true;
      }
  }
}
</SCRIPT>
</HEAD>
<BODY>
<FORM>
Search <input type="text" id="texto_busqueda" onkeyup="crit_busqueda()">
<SELECT id="id_textos">
<OPTION value="">Selecciona
<OPTION value="tutores">tutores
<OPTION value="google">google
<OPTION value="yahoo">yahoo
<OPTION value="altavista">altavista
<OPTION value="wanadoo">wanadoo
<OPTION value="wanadoo">wonadoo
</SELECT>
</FORM>
</BODY>
</HTML>