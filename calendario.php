                <section class="content">
					<div class="row" style="top:150px; position:absolute;">  
                        <div class="col-md-3">
                        <form id="formanue" name="formanue" action="act_calendario.php" method="post">
                            <div class="box box-primary" style="height:185px;">
                                <div class="box-header"><h4 class="box-title">Arrastre el evento</h4></div>
                                <div class="box-body" style="top:-15px; position:relative" >
                                    <div id='external-events'>
                                    <?php 
									$sql="SELECT idtipoeventos, tie_nombre, tie_color FROM tipoeventos $cond_rol2 WHERE idtipoeventos!='4' ORDER BY tie_nombre ";
									$DB->Execute($sql); 
									while($rw=mysqli_fetch_row($DB->Consulta_ID)){
									?>
									<div class='external-event' style="background-color:<?php echo $rw[2]; ?>; color:#FFF; font-size:10px;"><?php echo $rw[1]; ?></div>
                                    <?php } ?>    
                                    </div>
                                </div>
                            </div> 
                            <div class="box box-primary">
                                <div class="box-header"><h3 class="box-title">Instituci&oacute;n Educativa</h3></div>
                                <div class="box-body" style="height:105px; top:-20px; position:relative; overflow:auto;">
                                <table width="95%">
								<?php 
								$sql="SELECT DISTINCT(idieducativas), ied_nombre FROM gestoresie INNER JOIN gestores ON gestores_idgestores=idgestores INNER JOIN 
								ieducativas ON ieducativas_idieducativas=idieducativas INNER JOIN eventos ON idieducativas=proyectos_idproyectos $cond1 ORDER BY ied_nombre";
								$DB->Execute($sql); $vlos=explode(",",$param1); 
								while($rw=mysqli_fetch_row($DB->Consulta_ID)){ 
									foreach($vlos as $vles){ if($vles==$rw[0]){ $conie="bgcolor='#01A65A'"; $qp=1; break; } else { $conie=""; $qp=0; } } ?>
                                    <tr align="left"><td style="font-size:12px;" <?php echo $conie; ?> ><a href="#" 
                                    onclick="checkChoiceN1('<?php echo $rw[0]; ?>', 'selideduca', '<?php echo $qp; ?>'); llena_cale(1);">
									<font color="#000000"><?php echo $rw[1]; ?></font></a></td></tr>
                                <?php } ?>  
								<input type='hidden' name='selideduca' id='selideduca' value="<?php echo $param1; ?>"></table> 
                                </div>
                            </div>
							<div class="box box-primary" style="top:-10px;">
                                <div class="box-header"><h3 class="box-title">L&iacute;neas estrat&eacute;gicas</h3></div>
                                <div class="box-body" style="height:80px; top:-20px; position:relative; overflow:auto;">
                                <table width="95%">
								<?php 
								$sql="SELECT DISTINCT(idproyectos), pro_alias FROM proyectos INNER JOIN eventosproyectos a ON idproyectos=proyectos_idproyectos INNER JOIN
								eventosroles b ON a.tipoeventos_idtipoeventos=b.tipoeventos_idtipoeventos AND roles_idroles='$nivel_acceso' ORDER BY pro_alias ";
								$DB->Execute($sql); $vlos=explode(",",$param2); 
								while($rw=mysqli_fetch_row($DB->Consulta_ID)){ 
									foreach($vlos as $vles){ if($vles==$rw[0]){ $conie="bgcolor='#01A65A'"; $qp=1; break; } else { $conie=""; $qp=0; } } ?>
                                    <tr align="left"><td style="font-size:12px;" <?php echo $conie;  ?> ><a href="#" 
                                    onclick="checkChoiceN1('<?php echo $rw[0]; ?>', 'selproyectos', '<?php echo $qp; ?>'); llena_cale(1);">
									<font color="#000000"><?php echo $rw[1]; ?></font></a></td></tr>
                                <?php } ?>  
								<input type='hidden' name='selproyectos' id='selproyectos' value="<?php echo $param2; ?>"></table> 
                                </div>
                            </div>
							<div class="box box-primary" style="top:-20px;">
                                <div class="box-header"><h3 class="box-title">Tipos de eventos</h3></div>
                                <div class="box-body" style="height:80px; top:-20px; position:relative; overflow:auto;">
                                    <table width="95%">
									<?php 
									$sql="SELECT DISTINCT(idtipoeventos), tie_nombre FROM tipoeventos INNER JOIN eventosproyectos ON idtipoeventos=tipoeventos_idtipoeventos 
									$cond_rol2 AND idtipoeventos!='4' ORDER BY tie_nombre ";
									$DB->Execute($sql); $vlos=explode(",",$param4); 
									while($rw=mysqli_fetch_row($DB->Consulta_ID)){ 
										foreach($vlos as $vles){ if($vles==$rw[0]){ $conie="bgcolor='#01A65A'"; $qp=1; break; } else { $conie=""; $qp=0; } } ?>
                                        <tr align="left"><td style="font-size:12px;" <?php echo $conie; ?> ><a href="#" onclick="checkChoiceN1('<?php echo $rw[0]; ?>', 
                                        'seltiposp', '<?php echo $qp; ?>'); llena_cale(1);"><font color="#000000"><?php echo $rw[1]; ?></font></a></td></tr>
                                    <?php } ?>  
									<input type='hidden' name='seltiposp' id='seltiposp' value="<?php echo $param4; ?>"></table> 
                                </div>
                            </div>
                            </form>
                        </div>
                       <div class="col-md-9" style="left:-10px;">
                            <div class="box box-primary"><div class="box-body no-padding"><div id="calendar"></div></div></div>
                       </div>
                    </div>
                </section>
            </aside>
        </div>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <script src="js/jquery-ui-1.10.3.min.js" type="text/javascript"></script>
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <script src="js/AdminLTE/app.js" type="text/javascript"></script>
        <script src="js/AdminLTE/demo.js" type="text/javascript"></script>        
        <script src="js/plugins/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
        <script type="text/javascript">
//		function get_calendar_height() {
//	      return $(window).height();
//		}
        $(function() {
			$(window).resize(function() {
				$('#calendar').fullCalendar('option', 'height', get_calendar_height());
			});
		
            function ini_events(ele) {
	            ele.each(function() {
    	            var eventObject = {
        	            title: $.trim($(this).text()) // use the element's text as the event title
                    };
                $(this).data('eventObject', eventObject);
                $(this).draggable({
            	    zIndex: 1070,
                    revert: true, // will cause the event to go back to its
                    revertDuration: 0  //  original position after the drag
                });

			});
		}
		ini_events($('#external-events div.external-event'));
        var date = new Date();
        var d = date.getDate(),
        m = date.getMonth(),
		y = date.getFullYear();
		$('#calendar').fullCalendar({
			header: {
				left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
		},
		buttonText: {//This is to add icons to the visible buttons
			prev: "<span class='fa fa-caret-left'></span>",
			next: "<span class='fa fa-caret-right'></span>",
			today: 'Hoy',
			month: 'Mes',
			week: 'Semana',
			day: 'dia'
		},
		events: [
<?php 
$sql="SELECT DISTINCT(ideventos), ciu_nombre, ied_nombre, tie_nombre, tie_color, eve_fechai, eve_horai, eve_fechaf, eve_horaf, eve_titulo, eve_participantes, idieducativas FROM eventos c INNER JOIN ciudades ON idciudades=usu_idsede INNER JOIN tipoeventos ON idtipoeventos=c.tipoeventos_idtipoeventos LEFT JOIN ieducativas ON idieducativas= c.proyectos_idproyectos LEFT JOIN gestoresie ON idieducativas=ieducativas_idieducativas LEFT JOIN gestores ON gestores_idgestores=idgestores INNER JOIN eventosproyectos a ON a.tipoeventos_idtipoeventos=idtipoeventos INNER JOIN proyectos ON idproyectos=a.proyectos_idproyectos AND idtipoeventos!='4' $cond1 $condp1 $condp2 $condp3 $condp4 $cond_rol2";
$DB->Execute($sql); $va=0;
while($rw=mysqli_fetch_row($DB->Consulta_ID)){ 
	$color=$rw[4];
	if($rw[9]=="Visita 1" and $rw[10]=="Dia 1"){ $color="#FFCC00 "; } 
	else if($rw[9]=="Visita 1" and $rw[10]=="Dia 2"){ $color="#F39C12"; } 
	else if($rw[9]=="Visita 2" and $rw[10]=="Dia 1"){ $color="#01A65A"; } 
	else if($rw[9]=="Visita 2" and $rw[10]=="Dia 2"){ $color="#017843"; } 
	else {}
?>		
		{
			id:<?php echo $rw[0]; ?>,
			title: '<?php echo $rw[3]." - ".$rw[9]." - ".$rw[10]." - ".$rw[2]; ?>',
			start: '<?php echo $rw[5]." ".$rw[6]; ?>',
			end: '<?php echo $rw[7]." ".$rw[8]; ?>',
			color: '<?php echo $color; ?>'
		},
<?php }  
/*$sql="SELECT ideventos, ciu_nombre, eve_titulo, tie_nombre, tie_color, eve_fechai, eve_horai, eve_fechaf, eve_horaf, eve_objetivo, eve_participantes FROM eventos INNER JOIN ciudades ON idciudades=usu_idsede INNER JOIN tipoeventos ON idtipoeventos=tipoeventos_idtipoeventos AND proyectos_idproyectos=0 $condp1 $condp3  ORDER BY eve_fechai ASC ";
$DB->Execute($sql); $va=0;
while($rw=mysqli_fetch_row($DB->Consulta_ID)){ 
?>		
		{
			id:<?php echo $rw[0]; ?>,
			title: '<?php echo $rw[2]; ?>',
			start: '<?php echo $rw[5]." ".$rw[6]; ?>',
			end: '<?php echo $rw[7]." ".$rw[8]; ?>',
			color: '<?php echo $rw[4]; ?>'
		},
<?php  }   */ ?>
	],
	editable: false,
    droppable: true, // this allows things to be dropped onto the calendar !!!
	eventClick: function(event) {
	pop_dis3(event.id, "Actividad");
	},
    drop: function(date, allDay) { // this function is called when something is dropped
		var originalEventObject = $(this).data('eventObject');
        var copiedEventObject = $.extend({}, originalEventObject);
        copiedEventObject.start = date;
        copiedEventObject.allDay = allDay;
        copiedEventObject.backgroundColor = $(this).css("background-color");
        copiedEventObject.borderColor = $(this).css("border-color");
        $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);
		var param=date+"-"+copiedEventObject.backgroundColor;
		pop_dis(param, 'Programar Evento');
		if ($('#drop-remove').is(':checked')) {
        	$(this).remove();
        }
        }
	});
                var currColor = "#f56954"; //Red by default
                var colorChooser = $("#color-chooser-btn");
                $("#color-chooser > li > a").click(function(e) {
                     e.preventDefault();
                    currColor = $(this).css("color");
                    colorChooser
                            .css({"background-color": currColor, "border-color": currColor})
                            .html($(this).text()+' <span class="caret"></span>');
                });
                $("#add-new-event").click(function(e) {
                    e.preventDefault();
                    var val = $("#new-event").val();
                    if (val.length == 0) {
                        return;
                    }
                    var event = $("<div />");
                    event.css({"background-color": currColor, "border-color": currColor, "color": "#fff"}).addClass("external-event");
                    event.html(val);
                    $('#external-events').prepend(event);
                    ini_events(event);
                    $("#new-event").val("");
                });
            });
        </script>
    </body>
</html> 