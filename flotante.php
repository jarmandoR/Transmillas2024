




	<style type="text/css">
		/* .overlay {
			position: fixed;
			top: 0;
			left: 0;
			right: 0;
            transform: translate(170%, 170%);
			bottom: 0;
			background-color: rgba(0, 0, 0, 0);
			z-index: 9999;
            width: 30%;
			height: 40%;
		} */
		.iframe-container {
	 position: fixed;
			top: 50%;
			left: 50%;
			transform: translate(60%, 20%);
			z-index: 10000;
			background-color: white;
			width: 30%;
			height: 43%;
            scroll-padding-bottom: 50px;  



    /* position: fixed;
    top: 10px;
    right: 10px;
    width: 300px;
    height: 200px;
    clear: both; */

		}




#my-div {
  /*position: relative;
  width: 400px;
  height: 200px;*/
    
    height:25px;
    left:50%;
    top :95%;
} 

#my-div .toolbar {
  position: absolute;
  top: 0;
  right: 0;
  left: 0;
  height: 25px;
  background-color: #202355;
  display: flex;
  justify-content: flex-end;
  align-items: center;
  
}

#my-div .toolbar button {
  border: none;
  background-color: transparent;
  cursor: pointer;
  font-size: 16px;
  margin-right: 5px;
  color: white;
}
#my-div .toolbar button:hover {
  background-color: #ddd;
}

#my-div .content {
  padding: 10px;
}








/* #burbujachat{
  animation: burbujachat 1s infinite;
}

@keyframes burbujachat {
  0% {
    opacity: 1;
  }

  50% {
    opacity: 0.5;
  }

  100% {
    opacity: 1;
  }
} */

#bur {
  text-align:left; 
background-color:#FF0000;
width:25px;
height:25px; 
color:#FFFFFF;
}

/* @keyframes blinker {
  50% {
    opacity: 0;
  }
} */

	</style>





<!-- <div id="my-div">
  
  <div class="content">
    Contenido del div
  </div>
</div> -->





	
    <button id="resize-div" style="display: none;"></button>


	<button id="btn-abrir" style="display: none;">Abrir iframe</button>
	<div class="overlay" style="display: none;"></div>
	<div class="iframe-container" id="my-div" style="display: block; z-index: 9999;">
    <div class="toolbar" id="barrachat">
        <!-- <h4 style='text-align:right;' > -->
    
        <div id="bur" class="burclas" ><i class='img-circle' id="burbu" style='text-align:left; background-color:#FF0000;width:25px;height:25px; color:#FFFFFF;' >   </i></div>
    <!-- <h4> -->
    <button class="maximize-button">▢</button>
    <button class="minimize-button">&#8211;</button>
    <button class="recargar-button">🔃</button>
    <button class="close-button" style="display: none;">&#215;</button>
    </div>
		<iframe src="chatflotante.php" id="iframechat" name="iframechat" style="width: 100%; height: 100%;"></iframe>
	</div>

  <script type="text/javascript">



var div = document.getElementById('bur'); // replace 'myDiv' with the ID of your div
var intervalId = null;

function startBlinking(mensajes){
  if (intervalId) return; // blink already activated, do nothing
  
  intervalId = setInterval(function() {
    div.style.visibility = (div.style.visibility == 'hidden' ? 'visible' : 'hidden');
  }, 500);
 
  }

function stopBlinking(mensajes) {
  clearInterval(intervalId);
  intervalId = null;
  div.style.visibility = 'visible';

  var icon = document.getElementById('burbu');
   icon.innerHTML = mensajes;
}

// function recargaIframe()
// {
//   // function recarga()
//   // {
          
//   // }
//   //         var intervalID = setInterval(miFuncion, 1000); // Llama a la función cada segundo

//   //         setTimeout(function() {
//   //           clearInterval(intervalID); // Detiene la ejecución de la función después de 10 segundos
//   //         }, 10000);
   
// }


//   function actualizarValor() {
//   $.ajax({
//     url: 'consultaNch.php',
//     dataType: 'json',
//     success: function(data) {
//       // Actualizar el valor en la página
//       // $('#valor').html(data.valor);

    
      
      
//       var icon = document.getElementById('burbu');
//       icon.innerHTML = data;
//       parpadeo(data);
     
//       }

//   });



// }




//para notificar nueva////

function checkForUpdates() {
  $.ajax({
    url: 'consultaNch.php',
    method: 'GET',
    success: function(data) {
      // handle the response data here
      var icon = document.getElementById('burbu');
      icon.innerHTML = data;
      parpadeo(data);
    },
    complete: function(xhr, status) {
      // set a timeout to check for updates again in 1 second
      // setTimeout(checkForUpdates, 1000);
    }
  });
}

// start the update checking process
// checkForUpdates();





var mensajetem = 0;
function parpadeo(nummensajes)
{
  var notificacion = new Audio('images/tonoMsm.mp3');
  if (nummensajes > 0) {
    if (nummensajes!=mensajetem )
      {
        mensajetem = nummensajes;
      
      notificacion.play();
    //  alert('holi');
      }
    startBlinking(nummensajes);
   
    
  } else {
    stopBlinking(nummensajes);
  }



}

// setInterval(actualizarValor, 500);

// startBlinking();
</script>
<?php
    $sql1 = "SELECT count(*) FROM `noticia` WHERE not_idusuario='$id_usuario' and  not_visto='no' ";
    $DB1->Execute($sql1); 
    $cantMensajes=$DB1->recogedato(0);


      echo '<script type="text/javascript"> parpadeo('.$cantMensajes.'); </script>';


?>

	<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
	<script type="text/javascript">




           

document.getElementById("resize-div").addEventListener("click", function() {
      var divchat1 = document.getElementById("my-div");
      divchat1.style.width = "40%";
      divchat1.style.height = "20%";

});   
        
        

        /* JavaScript */
document.querySelector(".maximize-button").addEventListener("click", function() {
    var iframe = document.getElementById('iframechat');
    iframe.src = iframe.src;

    var  divchat2 = document.getElementById("my-div");
    divchat2.style.height = "43%";
    divchat2.style.left = "50%";
    divchat2.style.top = "50%";
    var  iframescroll = document.getElementById("iframechat");
   


    



    iframescrol.contentWindow.scrollTo(0, iframescrol.contentWindow.document.body.scrollHeight);
    


});
document.querySelector(".minimize-button").addEventListener("click", function() {
    var divchat1 = document.getElementById("my-div");
    divchat1.style.height = "25px";
    divchat1.style.left = "50%";
    divchat1.style.top = "95%";
 
});

document.querySelector(".close-button").addEventListener("click", function() {
  document.getElementById("my-div").style.display = "none";
});




document.querySelector(".recargar-button").addEventListener("click", function() {



    checkForUpdates();  
    var iframe = document.getElementById('iframechat');
    iframe.src = iframe.src;

    // var  divchat2 = document.getElementById("my-div");
    // divchat2.style.height = "43%";
    // divchat2.style.left = "50%";
    // divchat2.style.top = "50%";
    var  iframescroll = document.getElementById("iframechat");
   

    



    iframescrol.contentWindow.scrollTo(0, iframescrol.contentWindow.document.body.scrollHeight);
    


});






	</script>





 












