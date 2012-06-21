<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="http://maps.google.com/maps/api/js?v=3.1&sensor=false&language=pt-BR"></script> 
    <script>
		$(document).ready(function(){
			mapCampos();
			initialize();
		});
		/* local exemplo que ficara dentro do input*/	
		var exemplo = 'Ex.: General Osório, 000, Pelotas - RS';
		function mapCampos(){			
			$("#campo_input").focus(function(){
				if(($(this).val()).toLowerCase() == exemplo.toLowerCase())
					$(this).val("");
			}).blur(function(){
				if($(this).val() == "")
					$(this).val(exemplo);
			}).val(exemplo);
		}
		
		// GOOGLE MAPS
		var directionDisplay;
		var directionsService = new google.maps.DirectionsService();
		var route = false;
		var map;
		var marker;
		var geocoder;
		function initialize() {	
			directionsDisplay = new google.maps.DirectionsRenderer();
			geocoder = new google.maps.Geocoder();
			var myLatlng = new google.maps.LatLng(-31.756138, -52.354644);
			var myOptions = {
				zoom: 15,
				center: myLatlng,
				mapTypeControl: true,
				mapTypeId: google.maps.MapTypeId.ROADMAP
				//mapTypeId: google.maps.MapTypeId.SATELLITE
		  	}
		  	map = new google.maps.Map(document.getElementById("mapa-local"), myOptions);
			
			var contentString = '<b>Satte Alam</b><br>'+
				'Av. Bento Gonçalves, 5248<br>Porto / Pelotas - RS - Brasil<br>Telefone: (53) 3227-1234';
				
			var infowindow = new google.maps.InfoWindow({
				content: contentString
			});
		
			var marker = new google.maps.Marker({
				position: myLatlng,
				map: map,
				title: 'Satte Alam'
			});
			google.maps.event.addListener(marker, 'click', function() {
			  infowindow.open(map,marker);
			});
			infowindow.open(map,marker);
			
		  	directionsDisplay.setMap(map);
			directionsDisplay.setPanel(document.getElementById("directions"));
		}
		
		function calcRoute() {
			if (marker) marker.setMap(null);
			route = true;
			var start = document.getElementById("campo_input").value;
			var end   = 'Av. Bento Gonçalves, 5248, PELOTAS - RS';
			if(end == exemplo){
				alert("Digite o endereço de Partida para traçarmos a rota até nossa empresa.");
			}
			else{			
				var request = {
				   origin:start, 
				   destination:end,
				   travelMode: google.maps.DirectionsTravelMode.DRIVING
				};
				directionsService.route(request, function(response, status) {
					if (status == google.maps.DirectionsStatus.OK)
					   directionsDisplay.setDirections(response);
				});
			}
		}
    </script>
    <style type="text/css">
    	#mapa-local { width:500px; height:250px; margin-bottom:10px; color:#666; }
		#campo_input { border:1px solid #d1d1d1; width:480px; height:25px; padding:0 10px; color:#666; }
		.adp-substep { color: #999 !important; }
    </style>
</head>
<body>
	<div id="conteudo">
		<div class="endereco">
			<div id="mapa-local"></div> <!-- MAPA DO GOOGLE MAPS -->
				<form name="buscarmapa" onsubmit="calcRoute();return false;">
					<input id="campo_input" type="text" value="" name="endereco" />                   
					<div class="botao esq"><div>
					<a href="javascript:;" onclick="calcRoute();">Traçar rota</a>
				</form>
				 <!-- Percurso do Google Maps -->
				<div id="directions"></div><!-- #directions -->
			</div><!-- #mapa-local -->
		</div><!-- #endereco -->
	</div><!-- #conteudo -->
</body>
</html>