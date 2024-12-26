$origen = "imgs_defecto/foto_por_defecto.jpg";
 
$destino = 'info_perfil_users/';
 
 
    if (copy($origen, $destino."foto_por_defecto.jpg")) {
 
        echo "Se ha copiado correctamente la imagen";
 
        }
 
        else {
 
        echo "No se copiado la imagen correctamente";
 
        }