<?php
$FB->abre_form("form1","","post");
$FB->titulo_azul1("Eventos pendientes",9,0,4);   
$FB->llena_texto("Buscar", 1, 1, $DB, "", "autocomplet1(this.value); llena_datos1();", "",4,0);
$FB->llena_texto("", 3, 19, $DB, "", "", " ",1,0);
$FB->div_valores("destino_vesr1",4); 
$FB->cierra_tabla(); 
$FB->cierra_form(); 
?>
