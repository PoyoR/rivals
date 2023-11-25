$("#btn-inscripcion").on('click', function(){

	Swal.fire({
  		width: '85%',
  		background: '#FFF',
  		html:
    		`
    		<h1 style="font-family: 'Ow', sans-serif;" >Solicitud de inscripción</h1>
    		<p>Asegúrate de leer el reglamento antes de inscribir a tu equipo*</p>

    		<img style="width: 150px; height: 150px;" src="img/logo-rivals.png" class="img-fluid rounded-circle m-1">

    		<div class="form-group">
    			<label>Nombre del equipo *</label>
    			<input type="text" class="form-control" id="nom_equipo" placeholder="Nombre del equipo">

    			<label>Plataforma *</label>
    			<select class="form-control" id="plataforma">
      				<option value="PC">PC</option>
      				<option value="XBOX">XBOX</option>
      				<option value="PS4">PS4</option>
    			</select>

    			<h3 class="m-3" style="color: #1c657b; font-family: 'Ow', sans-serif;" >Ingresa el BT, GT o ID de los jugadores, recuerda escribirlos con Mayúsculas y minúsculas</h3>

    			<label>Capitán *</label>
    			<input type="text" class="form-control" id="capitan" placeholder="Identificador de jugador 1">

    			<div class="row mt-3">
	    			<div class="col-sm-12 col-md-4">
		    			<label>Jugador 2 *</label>
		    			<input type="text" class="form-control" id="jugador2" placeholder="Identificador de jugador 2">
	    			</div>

	    			<div class="col-sm-12 col-md-4">
		    			<label>Jugador 3 *</label>
		    			<input type="text" class="form-control" id="jugador3" placeholder="Identificador de jugador 3">
	    			</div>

	    			<div class="col-sm-12 col-md-4">
		    			<label>Jugador 4 *</label>
		    			<input type="text" class="form-control" id="jugador4" placeholder="Identificador de jugador 4">
	    			</div>

	    		</div>

	    		<div class="row mt-3">

	    			<div class="col-sm-12 col-md-4">
		    			<label>Jugador 5 *</label>
		    			<input type="text" class="form-control" id="jugador5" placeholder="Identificador de jugador 5">
	    			</div>

	    			<div class="col-sm-12 col-md-4">
		    			<label>Jugador 6 *</label>
		    			<input type="text" class="form-control" id="jugador6" placeholder="Identificador de jugador 6">
	    			</div>

	    			<div class="col-sm-12 col-md-4">
		    			<label>Jugador 7</label>
		    			<input type="text" class="form-control" id="jugador7" placeholder="Identificador de jugador 7">
	    			</div>

	    		</div>

	    		<div class="row mt-3">

	    			<div class="col-sm-12 col-md-4">
		    			<label>Jugador 8</label>
		    			<input type="text" class="form-control" id="jugador8" placeholder="Identificador de jugador 8">
	    			</div>

	    			<div class="col-sm-12 col-md-4">
		    			<label>Jugador 9</label>
		    			<input type="text" class="form-control" id="jugador9" placeholder="Identificador de jugador 9">
	    			</div>

	    			<div class="col-sm-12 col-md-4">
		    			<label>Jugador 10</label>
		    			<input type="text" class="form-control" id="jugador10" placeholder="Identificador de jugador 10">
	    			</div>

	    		</div>

	    		<div class="row mt-3">

	    			<div class="col-sm-12 col-md-4">
		    			<label>Jugador 11</label>
		    			<input type="text" class="form-control" id="jugador11" placeholder="Identificador de jugador 11">
	    			</div>

	    			<div class="col-sm-12 col-md-4">
		    			<label>Jugador 12</label>
		    			<input type="text" class="form-control" id="jugador12" placeholder="Identificador de jugador 12">
	    			</div>

	    		</div>

	    		<label class="mt-3">Rango promedio *</label>
    			<select class="form-control" id="rango">
      				<option>Bronce</option>
      				<option>Plata</option>
      				<option>Oro</option>
      				<option>Platino</option>
      				<option>Diamante</option>
      				<option>Maestro</option>
      				<option>Gran maestro</option>
    			</select>

    			<div class="row mt-3">
	    			<div class="col-sm-12 col-md-6">
		    			<label>Link del canal de youtube del equipo</label>
		    			<input type="text" class="form-control" id="youtube_equipo" placeholder="Link opcional">
	    			</div>

	    			<div class="col-sm-12 col-md-6">
		    			<label>Link del canal de facebook del equipo</label>
		    			<input type="text" class="form-control" id="facebook_equipo" placeholder="Link opcional">
	    			</div>

	    		</div>

	    		<div class="custom-file mt-5">
    				<input type="file" class="custom-file-input" id="logo_equipo">
    				<label class="custom-file-label" for="logo_equipo">Selecciona el logo de tu equipo</label>
  				</div>

  			</div>

    		

    		`,
    	showCancelButton: true,
    	cancelButtonText: 'Cancelar',
    	confirmButtonText: 'Resgistrarse'
	}).then((result) => {
  		if (result.value) {
	    	
	    	var nom_equipo = $('#nom_equipo').val();
	    	var plataforma = $('#plataforma').val();
	    	var jugador1 = $('#capitan').val();
	    	var jugador2 = $('#jugador2').val();
	    	var jugador3 = $('#jugador3').val();
	    	var jugador4 = $('#jugador4').val();
	    	var jugador5 = $('#jugador5').val();
	    	var jugador6 = $('#jugador6').val();
	    	var jugador7 = $('#jugador7').val();
	    	var jugador8 = $('#jugador8').val();
	    	var jugador9 = $('#jugador9').val();
	    	var jugador10 = $('#jugador10').val();
	    	var jugador11 = $('#jugador9').val();
	    	var jugador12 = $('#jugador10').val();
	    	var rango = $('#rango').val();
	    	var youtube = $('#youtube_equipo').val();
	    	var facebook = $('#facebook_equipo').val();
	    	var logo = $('#logo_equipo')[0].files[0];

	    	if (nom_equipo != "" && jugador1 != "" && jugador2 != "" && jugador3 != "" && jugador4 != "" && jugador5 != "" && jugador6 != "") {
	    		showCargandoDialog();

				$.ajax({
					url: `https://owrivals.pythonanywhere.com/api/solicitud_registro/`,
					type: 'POST',
					dataType: 'json',
					data: JSON.stringify({
						"nombre_equipo": nom_equipo,
					    "plataforma": plataforma,
					    "youtube": youtube,
					    "facebook": facebook,
					    "jugador1": jugador1,
					    "jugador2": jugador2,
					    "jugador3": jugador3,
					    "jugador4": jugador4,
					    "jugador5": jugador5,
					    "jugador6": jugador6,
					    "jugador7": jugador7,
					    "jugador8": jugador8,
					    "jugador9": jugador9,
					    "jugador10": jugador10,
					    "jugador11": jugador11,
					    "jugador12": jugador12,
					    "rango": rango,
					    "logo": imagenB64
					}),
					contentType: "application/json",
					success: function(resp) {
						Swal.fire({
						    title: "Registro enviado, no olvides unirte al servidor de Discord",
						    html: `
						    	<p>Datos bancarios y paypal para pago de inscripción</p>
						    	<p>Desde México:</p>
						    	<p>CLABE: 012 650 01585799686 8</p>
						    	<p>Depósito OXXO: 4152 3134 4468 4687</p>
						    	<p>Fuera de México: (Recuerda incluir la comisión que cobra paypal) <a class="nav-link" href="https://www.paypal.com/mx/webapps/mpp/paypal-fees">Más información</a></p>
						    	<p><a class="nav-link" href="https://www.paypal.me/poyor9">Pagar con Paypal</a> </p>
						    	<img src="img/registrado.gif" class="img-responsive m-2" width="250" height="200">
						    	<p>Envía tu comprobante de pago al administrador, discord: Poyo#9679 indicando el nombre de tu equipo</p>

						    `,
						    footer: '<a href="https://discord.gg/9DZDaEM">Únete al servidor</a>',
						    showConfirmButton: false,
						    allowOutsideClick: false
  						});						
					},
					error: function(xhr, ajaxOptions, thrownError) {
						Swal.fire("Ocurrió un error, por favor intenta de nuevo, si el problema persiste, también puedes registrarte enviando mensaje a discord: Poyo#9679");
				    }
				});

	    	}else{
	    		Swal.fire('El equipo debe tener un nombre y contar con al menos 6 jugadores');
	    	}
  		}
	});
});

$('body').on('change', '#logo_equipo', function(){
	encodeImgtoBase64(this);
});

var imagenB64;
function encodeImgtoBase64(element) {
 
	var img = element.files[0];

	var reader = new FileReader();

	reader.onloadend = function() {
		imagenB64 = reader.result;
	}
	reader.readAsDataURL(img);
}


$('body').on('click', '.btn_detalles_team', function(){

	var equipo = $(this).data('equipo');
	showCargandoDialog();
	
	$.ajax({
		url: `https://owrivals.pythonanywhere.com/api/participante_detalle/${equipo}/`,
		type: 'GET',
		dataType: 'json',
		success: function(resp) {
			console.log(resp);

			var partidas = ``;

			var roster = ``;

			for (var i = 0; i < resp.roster.length; i++) {
				cargarStatsRoster(resp.roster[i].identificador, resp.roster[i].nombre, resp.plataforma);
			}	

			for (var i = 0; i < resp.partidas.length; i++) {

				var partida = resp.partidas[i];
				var jornada = partida.jornada;

				var mapa = "";
				if (partida.mapa.toLowerCase() == 'anubis')
					mapa = 'anubis.JPG';
				else if (partida.mapa.toLowerCase() == 'blizzard')
					mapa = 'blizzard_world.JPG';
				else if (partida.mapa.toLowerCase() == 'busan')
					mapa = 'busan.JPG';
				else if (partida.mapa.toLowerCase() == 'colonia')
					mapa = 'colonia_lunar.JPG';
				else if (partida.mapa.toLowerCase() == 'dorado')
					mapa = 'dorado.JPG';
				else if (partida.mapa.toLowerCase() == 'eichenwalde')
					mapa = 'eichenwalde.JPG';
				else if (partida.mapa.toLowerCase() == 'gibraltar')
					mapa = 'gibraltar.JPG';
				else if (partida.mapa.toLowerCase() == 'habana')
					mapa = 'habana.JPG';
				else if (partida.mapa.toLowerCase() == 'hanamura')
					mapa = 'hanamura.JPG';
				else if (partida.mapa.toLowerCase() == 'hollywood')
					mapa = 'hollywood.JPG';
				else if (partida.mapa.toLowerCase() == 'ilios')
					mapa = 'ilios.JPG';
				else if (partida.mapa.toLowerCase() == 'junkertown')
					mapa = 'junkertown.JPG';
				else if (partida.mapa.toLowerCase() == 'kings')
					mapa = 'kings_row.JPG';
				else if (partida.mapa.toLowerCase() == 'lijiang')
					mapa = 'lijiang.JPG';
				else if (partida.mapa.toLowerCase() == 'nepal')
					mapa = 'nepal.JPG';
				else if (partida.mapa.toLowerCase() == 'numbani')
					mapa = 'numbani.JPG';
				else if (partida.mapa.toLowerCase() == 'oasis')
					mapa = 'oasis.JPG';
				else if (partida.mapa.toLowerCase() == 'paris')
					mapa = 'paris.JPG';
				else if (partida.mapa.toLowerCase() == 'rialto')
					mapa = 'rialto.JPG';
				else if (partida.mapa.toLowerCase() == 'ruta')
					mapa = 'ruta_66.JPG';
				else if (partida.mapa.toLowerCase() == 'volskaya')
					mapa = 'volskaya.JPG';
				else if (partida.mapa.toLowerCase() == 'gibraltar')
					mapa = 'gibraltar.JPG';
				else
					mapa = "";
				
				console.log("mapa "+partida.mapa);

				var res_partida = ``;

				if (resp.partidas[i].terminada) {
					if (resp.partidas[i].hasOwnProperty("vencedor")) {
					
						if (resp.partidas[i].vencedor == resp.nombre) {
							res_partida = `<p style="font-family: 'Ow', sans-serif;" class="card-text text-success">Victoria</p>`;
						}else
							res_partida = `<p style="font-family: 'Ow', sans-serif;" class="card-text text-danger">Derrota</p>`;

					}else{
						res_partida = `<p style="font-family: 'Ow', sans-serif;" class="card-text">Empate</p>`;
					}

				}/*else{
					res_partida = `<p style="font-family: 'Ow', sans-serif;" class="card-text text-primary">${resp.partidas[i].fecha}</p>`;
				}*/

				if(partida.fecha_partida != null){
					partidas += `
						<div style="background-image: url('img/ow.jpg'); background-repeat: no-repeat; background-size: cover;  background-position: center center;" class="col-sm-12 mt-5 mb-0 p-1">
							<span style="font-size: 25px; font-family: 'Blora', sans-serif;" class="text-light">Jornada ${jornada}</span></br>
							<span style="font-size: 25px; font-family: 'Ow', sans-serif;"class="text-light">${partida.fecha_partida}</span></br>
							<p style="font-size: 18px; text-align:right;" class="text-light">Equipo <span style="font-size: 18px; font-family: 'Ow', sans-serif;">${partida.equipo1}</span> reporta resultado</p>	
						</div>
					`;
				}
				
				if (mapa != "") {
					partidas += `
	    				<div class="col-sm-12 col-md-3 mt-3">
			    			<div class="card">
				  				<img class="card-img-top" src="img/${mapa}" width="80" height="120">
				  				<div class="card-body">
				  					<p style="font-family: 'Ow', sans-serif;" class="card-text">${partida.equipo1} vs ${partida.equipo2}</p>
				    				${res_partida}
				  				</div>
							</div>
						</div>
					`;
				}
			}

			var youtube = "";
			var facebook = "";

			if (resp.youtube != null){
				youtube = `<a href="${resp.youtube}"><img style="width: 100px; height: 100px;" src="img/yt.png" class="img-fluid img_red_social" ></a>`;
			}

			if (resp.facebook != null){
				facebook = `<a href="${resp.facebook}"><img style="width: 100px; height: 100px;" src="img/fb.png" class="img-fluid img_red_social" ></a>`;
			}

			var id = "";
			if (resp.plataforma == 'PS4')
				id = "ID";
			else if (resp.plataforma == 'XBOX')
				id = "GT";
			else
				id = "BT";

			Swal.fire({
		  		width: '85%',
		  		//background: '#3c4656',
		  		html:
		    		`
		    		<h1 style="font-family: 'Ow', sans-serif;" >${resp.nombre}</h1>
		    		
		    		<div class="row">
		    			<div id="div_logo_equipo_info" class="col-sm-12 col-md-6 align-self-center">
		    				<img src="https://owrivals.pythonanywhere.com${resp.logo}" class="img-responsive m-2" width="200" height="200" >
						</div>
						<div class="col-sm-12 col-md-6 align-self-center">
							${youtube}
							${facebook}
						</div>
		    		</div>

		    		<h3>${id} Capitan: ${resp.capitan}</h3>
		    		

		    		<div class="p-5"  style="background-image: url('img/mosaico.jpg'); background-size: cover;">
		    			<div id="partidas_equipo" class="row">
		    				${partidas}
		    			</div>

		    			<h1 class="mt-3" style="font-family: 'Ow', sans-serif;" >Roster</h1>

						<div id="roster_equipo" class="row">
						</div>

						<div id="div_detalles_jugador" class="row p-5 mt-3" style="display:none; background-image: url('img/fondo-jugador.jpg'); background-repeat: no-repeat; background-size: cover; background-position: center center;">
							<div id="jugador_icono" class="col-sm-12 col-md-6 align-self-center">
							</div>

							<div id="jugador_rango" class="col-sm-12 col-md-6 align-self-center">
							</div>

							<div id="jugador_heroes" class="col-sm-12 col-md-12">
				    			
							</div>
						</div>

		    		</div>

		    		`
		 	});

		 	if (resp.youtube == null && resp.facebook == null) {
				$("#div_logo_equipo_info").removeClass("col-md-6");
			}
		},
		error: function() {
	        console.log("No se ha podido obtener la información");
	    }
	});

});

function cargarStatsRoster(id, nombre, plataforma){


	if (plataforma == 'PC'){
		var jugador = id.replace("#", "-");
		var plat = "pc";
	}
	else if (plataforma == 'XBOX'){
		var jugador = id.replace(" ", "%20");
		var plat = "xbl"
	}else{
		var jugador = id;
		var plat = "psn";
	}

	$.ajax({
		url: `https://ovrstat.com/stats/${plat}/${jugador}`,
		type: 'GET',
		dataType: 'json',
		success: function(resp) {
			console.log("JUGADOR "+ jugador);
			console.log(resp);
			
			var heroes = resp.competitiveStats.topHeroes;
			console.log(heroes);
			var tiempos = [];

			if (heroes != null) {
				console.log("SI");

				if(typeof heroes.ana !== "undefined"){
					var tiempo_ana = heroes.ana.timePlayed.split(":");
					if (tiempo_ana.length == 3)
						tiempo_ana= (+tiempo_ana[0]) * 60 + (+tiempo_ana[1]);
					else if (tiempo_ana.length == 2)
						tiempo_ana = (+tiempo_ana[0]);
					var ana = {
						"heroe": "ana",
						"foto": "img/ana.JPG",
						"tiempo": tiempo_ana
					};
					tiempos.push(ana);
				}

				if(typeof heroes.ashe !== "undefined"){
					var tiempo_ashe= heroes.ashe.timePlayed.split(":");
					if (tiempo_ashe.length == 3)
						tiempo_ashe = (+tiempo_ashe[0]) * 60 + (+tiempo_ashe[1]);
					else if (tiempo_ashe.length == 2)
						tiempo_ashe = (+tiempo_ashe[0]);
					var ashe = {
						"heroe": "ashe",
						"foto": "img/ashe.JPG",
						"tiempo": tiempo_ashe
					};
					tiempos.push(ashe);
				}

				if(typeof heroes.baptiste !== "undefined"){
					var tiempo_baptiste = heroes.baptiste.timePlayed.split(":");
					if (tiempo_baptiste.length == 3)
						tiempo_baptiste = (+tiempo_baptiste[0]) * 60 + (+tiempo_baptiste[1]);
					else if (tiempo_baptiste.length == 2)
						tiempo_baptiste = (+tiempo_baptiste[0]);
					var baptiste = {
						"heroe": "baptiste",
						"foto": "img/baptiste.JPG",
						"tiempo": tiempo_baptiste
					};
					tiempos.push(baptiste);
				}

				if(typeof heroes.bastion !== "undefined"){
					var tiempo_bastion = heroes.bastion.timePlayed.split(":");
					if (tiempo_bastion.length == 3)
						tiempo_bastion = (+tiempo_bastion[0]) * 60 + (+tiempo_bastion[1]);
					else if (tiempo_bastion.length == 2)
						tiempo_bastion = (+tiempo_bastion[0]);
					var bastion = {
						"heroe": "bastion",
						"foto": "img/bastion.JPG",
						"tiempo": tiempo_bastion
					};
					tiempos.push(bastion);
				}

				if(typeof heroes.brigitte !== "undefined"){
					var tiempo_brigitte = heroes.brigitte.timePlayed.split(":");
					if (tiempo_brigitte.length == 3)
						tiempo_brigitte = (+tiempo_brigitte[0]) * 60 + (+tiempo_brigitte[1]);
					else if (tiempo_brigitte.length == 2)
						tiempo_brigitte = (+tiempo_brigitte[0]);
					var brigitte = {
						"heroe": "brigitte",
						"foto": "img/brigitte.JPG",
						"tiempo": tiempo_brigitte
					};
					tiempos.push(brigitte);
				}

				if(typeof heroes.dVa !== "undefined"){
					var tiempo_dVa = heroes.dVa.timePlayed.split(":");
					if (tiempo_dVa.length == 3)
						tiempo_dVa = (+tiempo_dVa[0]) * 60 + (+tiempo_dVa[1]);
					else if (tiempo_dVa.length == 2)
						tiempo_dVa = (+tiempo_dVa[0]);
					var dva = {
						"heroe": "dva",
						"foto": "img/dva.JPG",
						"tiempo": tiempo_dVa
					};
					tiempos.push(dva);
				}

				if(typeof heroes.doomfist !== "undefined"){
					var tiempo_doomfist = heroes.doomfist.timePlayed.split(":");
					if (tiempo_doomfist.length == 3)
						tiempo_doomfist = (+tiempo_doomfist[0]) * 60 + (+tiempo_doomfist[1]);
					else if (tiempo_doomfist.length == 2)
						tiempo_doomfist = (+tiempo_doomfist[0]);
					var doomfist = {
						"heroe": "doomfist",
						"foto": "img/doomfist.JPG",
						"tiempo": tiempo_doomfist
					};
					tiempos.push(doomfist);
				}

				//var tiempo_echo = heroes.echo.timePlayed;

				if(typeof heroes.genji !== "undefined"){
					var tiempo_genji = heroes.genji.timePlayed.split(":");
					if (tiempo_genji.length == 3)
						tiempo_genji = (+tiempo_genji[0]) * 60 + (+tiempo_genji[1]);
					else if (tiempo_genji.length == 2)
						tiempo_genji = (+tiempo_genji[0]);
					var genji = {
						"heroe": "genji",
						"foto": "img/genji.JPG",
						"tiempo": tiempo_genji
					};
					tiempos.push(genji);
				}

				if(typeof heroes.hanzo !== "undefined"){
					var tiempo_hanzo = heroes.hanzo.timePlayed.split(":");
					if (tiempo_hanzo.length == 3)
						tiempo_hanzo = (+tiempo_hanzo[0]) * 60 + (+tiempo_hanzo[1]);
					else if (tiempo_hanzo.length == 2)
						tiempo_hanzo = (+tiempo_hanzo[0]);
					var hanzo = {
						"heroe": "hanzo",
						"foto": "img/hanzo.JPG",
						"tiempo": tiempo_hanzo
					};
					tiempos.push(hanzo);
				}

				if(typeof heroes.junkrat !== "undefined"){
					var tiempo_junkrat = heroes.junkrat.timePlayed.split(":");
					if (tiempo_junkrat.length == 3)
						tiempo_junkrat = (+tiempo_junkrat[0]) * 60 + (+tiempo_junkrat[1]);
					else if (tiempo_junkrat.length == 2)
						tiempo_junkrat = (+tiempo_junkrat[0]);
					var junkrat = {
						"heroe": "junkrat",
						"foto": "img/junkrat.JPG",
						"tiempo": tiempo_junkrat
					};
					tiempos.push(junkrat);
				}

				if(typeof heroes.lucio !== "undefined"){
					var tiempo_lucio = heroes.lucio.timePlayed.split(":");
					if (tiempo_lucio.length == 3)
						tiempo_lucio = (+tiempo_lucio[0]) * 60 + (+tiempo_lucio[1]);
					else if (tiempo_lucio.length == 2)
						tiempo_lucio = (+tiempo_lucio[0]);
					var lucio = {
						"heroe": "lucio",
						"foto": "img/lucio.JPG",
						"tiempo": tiempo_lucio
					};
					tiempos.push(lucio);
				}

				if(typeof heroes.mccree !== "undefined"){
					var tiempo_mccree = heroes.mccree.timePlayed.split(":");
					if (tiempo_mccree.length == 3)
						tiempo_mccree = (+tiempo_mccree[0]) * 60 + (+tiempo_mccree[1]);
					else if (tiempo_mccree.length == 2)
						tiempo_mccree = (+tiempo_mccree[0]);
					var mccree = {
						"heroe": "mccree",
						"foto": "img/mccree.JPG",
						"tiempo": tiempo_mccree
					};
					tiempos.push(mccree);
				}

				if(typeof heroes.mei !== "undefined"){
					var tiempo_mei = heroes.mei.timePlayed.split(":");
					if (tiempo_mei.length == 3)
						tiempo_mei = (+tiempo_mei[0]) * 60 + (+tiempo_mei[1]);
					else if (tiempo_mei.length == 2)
						tiempo_mei = (+tiempo_mei[0]);
					var mei = {
						"heroe": "mei",
						"foto": "img/mei.JPG",
						"tiempo": tiempo_mei
					};
					tiempos.push(mei);
				}

				if(typeof heroes.mercy !== "undefined"){
					var tiempo_mercy = heroes.mercy.timePlayed.split(":");
					if (tiempo_mercy.length == 3)
						tiempo_mercy = (+tiempo_mercy[0]) * 60 + (+tiempo_mercy[1]);
					else if (tiempo_mercy.length == 2)
						tiempo_mercy = (+tiempo_mercy[0]);
					var mercy = {
						"heroe": "mercy",
						"foto": "img/mercy.JPG",
						"tiempo": tiempo_mercy
					};
					tiempos.push(mercy);
				}

				if(typeof heroes.moira !== "undefined"){
					var tiempo_moira = heroes.moira.timePlayed.split(":");
					if (tiempo_moira.length == 3)
						tiempo_moira = (+tiempo_moira[0]) * 60 + (+tiempo_moira[1]);
					else if (tiempo_moira.length == 2)
						tiempo_moira = (+tiempo_moira[0]);
					var moira = {
						"heroe": "moira",
						"foto": "img/moira.JPG",
						"tiempo": tiempo_moira
					};
					tiempos.push(moira);
				}

				if(typeof heroes.orisa !== "undefined"){
					var tiempo_orisa = heroes.orisa.timePlayed.split(":");
					if (tiempo_orisa.length == 3)
						tiempo_orisa = (+tiempo_orisa[0]) * 60 + (+tiempo_orisa[1]);
					else if (tiempo_orisa.length == 2)
						tiempo_orisa = (+tiempo_orisa[0]);
					var orisa = {
						"heroe": "orisa",
						"foto": "img/orisa.JPG",
						"tiempo": tiempo_orisa
					};
					tiempos.push(orisa);
				}

				if(typeof heroes.pharah !== "undefined"){
					var tiempo_pharah = heroes.pharah.timePlayed.split(":");
					if (tiempo_pharah.length == 3)
						tiempo_pharah = (+tiempo_pharah[0]) * 60 + (+tiempo_pharah[1]);
					else if (tiempo_pharah.length == 2)
						tiempo_pharah = (+tiempo_pharah[0]);
					var pharah = {
						"heroe": "pharah",
						"foto": "img/phara.JPG",
						"tiempo": tiempo_pharah
					};
					tiempos.push(pharah);
				}

				if(typeof heroes.reaper !== "undefined"){
					var tiempo_reaper = heroes.reaper.timePlayed.split(":");
					if (tiempo_reaper.length == 3)
						tiempo_reaper = (+tiempo_reaper[0]) * 60 + (+tiempo_reaper[1]);
					else if (tiempo_reaper.length == 2)
						tiempo_reaper = (+tiempo_reaper[0]);
					var reaper = {
						"heroe": "reaper",
						"foto": "img/reaper.JPG",
						"tiempo": tiempo_reaper
					};
					tiempos.push(reaper);
				}

				if(typeof heroes.reinhardt !== "undefined"){
					var tiempo_reinhardt = heroes.reinhardt.timePlayed.split(":");
					if (tiempo_reinhardt.length == 3)
						tiempo_reinhardt = (+tiempo_reinhardt[0]) * 60 + (+tiempo_reinhardt[1]);
					else if (tiempo_reinhardt.length == 2)
						tiempo_reinhardt = (+tiempo_reinhardt[0]);
					var reinhardt = {
						"heroe": "reinhardt",
						"foto": "img/reinhardt.JPG",
						"tiempo": tiempo_reinhardt
					};
					tiempos.push(reinhardt);
				}

				if(typeof heroes.roadhog !== "undefined"){
					var tiempo_roadhog = heroes.roadhog.timePlayed.split(":");
					if (tiempo_roadhog.length == 3)
						tiempo_roadhog = (+tiempo_roadhog[0]) * 60 + (+tiempo_roadhog[1]);
					else if (tiempo_roadhog.length == 2)
						tiempo_roadhog = (+tiempo_roadhog[0]);
					var roadhog = {
						"heroe": "roadhog",
						"foto": "img/roadhog.JPG",
						"tiempo": tiempo_roadhog
					};
					tiempos.push(roadhog);
				}

				if(typeof heroes.sigma !== "undefined"){
					var tiempo_sigma = heroes.sigma.timePlayed.split(":");
					if (tiempo_sigma.length == 3)
						tiempo_sigma = (+tiempo_sigma[0]) * 60 + (+tiempo_sigma[1]);
					else if (tiempo_sigma.length == 2)
						tiempo_sigma = (+tiempo_sigma[0]);
					var sigma = {
						"heroe": "sigma",
						"foto": "img/sigma.JPG",
						"tiempo": tiempo_sigma
					};
					tiempos.push(sigma);
				}

				if(typeof heroes.soldier76 !== "undefined"){
					var tiempo_soldier76 = heroes.soldier76.timePlayed.split(":");
					if (tiempo_soldier76.length == 3)
						tiempo_soldier76 = (+tiempo_soldier76[0]) * 60 + (+tiempo_soldier76[1]);
					else if (tiempo_soldier76.length == 2)
						tiempo_soldier76 = (+tiempo_soldier76[0]);
					var soldier76 = {
						"heroe": "soldado",
						"foto": "img/soldado.JPG",
						"tiempo": tiempo_soldier76
					};
					tiempos.push(soldier76);
				}

				if(typeof heroes.sombra !== "undefined"){
					var tiempo_sombra = heroes.sombra.timePlayed.split(":");
					if (tiempo_sombra.length == 3)
						tiempo_sombra = (+tiempo_sombra[0]) * 60 + (+tiempo_sombra[1]);
					else if (tiempo_sombra.length == 2)
						tiempo_sombra = (+tiempo_sombra[0]);
					var sombra = {
						"heroe": "sombra",
						"foto": "img/sombra.JPG",
						"tiempo": tiempo_sombra
					};
					tiempos.push(sombra);
				}

				if(typeof heroes.symmetra !== "undefined"){
					var tiempo_symmetra = heroes.symmetra.timePlayed.split(":");
					if (tiempo_symmetra.length == 3)
						tiempo_symmetra = (+tiempo_symmetra[0]) * 60 + (+tiempo_symmetra[1]);
					else if (tiempo_symmetra.length == 2)
						tiempo_symmetra = (+tiempo_symmetra[0]);
					var symmetra = {
						"heroe": "symmetra",
						"foto": "img/symmetra.JPG",
						"tiempo": tiempo_symmetra
					};
					tiempos.push(symmetra);
				}

				if(typeof heroes.torbjorn !== "undefined"){
					var tiempo_torbjorn = heroes.torbjorn.timePlayed.split(":");
					if (tiempo_torbjorn.length == 3)
						tiempo_torbjorn = (+tiempo_torbjorn[0]) * 60 + (+tiempo_torbjorn[1]);
					else if (tiempo_torbjorn.length == 2)
						tiempo_torbjorn = (+tiempo_torbjorn[0]);
					var torbjorn = {
						"heroe": "torbjorn",
						"foto": "img/torbjorn.JPG",
						"tiempo": tiempo_torbjorn
					};
					tiempos.push(torbjorn);
				}

				if(typeof heroes.tracer !== "undefined"){
					var tiempo_tracer = heroes.tracer.timePlayed.split(":");
					if (tiempo_tracer.length == 3)
						tiempo_tracer = (+tiempo_tracer[0]) * 60 + (+tiempo_tracer[1]);
					else if (tiempo_tracer.length == 2)
						tiempo_tracer = (+tiempo_tracer[0]);
					var tracer = {
						"heroe": "tracer",
						"foto": "img/tracer.JPG",
						"tiempo": tiempo_tracer
					};
					tiempos.push(tracer);
				}

				if(typeof heroes.widowmaker !== "undefined"){
					var tiempo_widowmaker = heroes.widowmaker.timePlayed.split(":");
					if (tiempo_widowmaker.length == 3)
						tiempo_widowmaker = (+tiempo_widowmaker[0]) * 60 + (+tiempo_widowmaker[1]);
					else if (tiempo_widowmaker.length == 2)
						tiempo_widowmaker = (+tiempo_widowmaker[0]);
					var widowmaker = {
						"heroe": "widowmaker",
						"foto": "img/widowmaker.JPG",
						"tiempo": tiempo_widowmaker
					};
					tiempos.push(widowmaker);
				}

				if(typeof heroes.winston !== "undefined"){
					var tiempo_winston = heroes.winston.timePlayed.split(":");
					if (tiempo_winston.length == 3)
						tiempo_winston = (+tiempo_winston[0]) * 60 + (+tiempo_winston[1]);
					else if (tiempo_winston.length == 2)
						tiempo_winston = (+tiempo_winston[0]);
					var winston = {
						"heroe": "winston",
						"foto": "img/winston.JPG",
						"tiempo": tiempo_winston
					};
					tiempos.push(winston);
				}

				if(typeof heroes.wreckingBall !== "undefined"){
					var tiempo_wreckingBall = heroes.wreckingBall.timePlayed.split(":");
					if (tiempo_wreckingBall.length == 3)
						tiempo_wreckingBall = (+tiempo_wreckingBall[0]) * 60 + (+tiempo_wreckingBall[1]);
					else if (tiempo_wreckingBall.length == 2)
						tiempo_wreckingBall = (+tiempo_wreckingBall[0]);
					var wreckingBall = {
						"heroe": "wreckingBall",
						"foto": "img/hammond.JPG",
						"tiempo": tiempo_wreckingBall
					};
					tiempos.push(wreckingBall);
				}

				if(typeof heroes.zarya !== "undefined"){
					var tiempo_zarya = heroes.zarya.timePlayed.split(":");
					if (tiempo_zarya.length == 3)
						tiempo_zarya = (+tiempo_zarya[0]) * 60 + (+tiempo_zarya[1]);
					else if (tiempo_zarya.length == 2)
						tiempo_zarya = (+tiempo_zarya[0]);
					var zarya = {
						"heroe": "zarya",
						"foto": "img/zarya.JPG",
						"tiempo": tiempo_zarya
					};
					tiempos.push(zarya);
				}

				if(typeof heroes.zenyatta !== "undefined"){
					var tiempo_zenyatta = heroes.zenyatta.timePlayed.split(":");
					if (tiempo_zenyatta.length == 3)
						tiempo_zenyatta = (+tiempo_zenyatta[0]) * 60 + (+tiempo_zenyatta[1]);
					else if (tiempo_zenyatta.length == 2)
						tiempo_zenyatta = (+tiempo_zenyatta[0]);
					var zenyatta = {
						"heroe": "zenyatta",
						"foto": "img/zenyatta.JPG",
						"tiempo": tiempo_zenyatta
					};
					tiempos.push(zenyatta);
				}

				tiempos.sort((a, b) => parseFloat(b.tiempo) - parseFloat(a.tiempo));

				console.log("TIEMPOS");
				console.log(tiempos);
				var icono_jugador = resp.icon;
				var nom_jugador = resp.name;

				var icono_tanque = "";
				var tanque_logo = "";
				var rango_tanque = "";

				var icono_dps = "";
				var dps_logo = "";
				var rango_dps = "";

				var icono_healer = "";
				var healer_logo = "";
				var rango_healer = "";

				var heroe1 = "";
				var heroe2 = "";
				var heroe3 = "";

				if (tiempos.length == 1) {
					heroe1 = tiempos[0].foto;
				}else if (tiempos.length == 2) {
					heroe2 = tiempos[1].foto;
					
				}else if (tiempos.length >= 3) {
					heroe1 = tiempos[0].foto;
					heroe2 = tiempos[1].foto;
					heroe3 = tiempos[2].foto;
				}

				if (resp.ratings != null) {
					
					for (var i = 0; i < resp.ratings.length; i++) {
						
						if (i == 0) {
							icono_tanque = resp.ratings[i].rankIcon;
							tanque_logo = resp.ratings[i].roleIcon;
							rango_tanque = resp.ratings[i].level;
						}else if (i == 1) {
							icono_dps = resp.ratings[i].rankIcon;
							dps_logo = resp.ratings[i].roleIcon;
							rango_dps = resp.ratings[i].level;
						}else if (i == 2){
							icono_healer = resp.ratings[i].rankIcon;
							healer_logo = resp.ratings[i].roleIcon;
							rango_healer = resp.ratings[i].level;
						}

					}
				}

				var txt = `
					<div class="col-sm-12 col-md-4 col-lg-3">
						<div class="card m-1">
							<img class="card-img-top" src="${resp.icon}" width="100" height="100">
			  				<div class="card-body">
			    				<p style="font-family: 'Ow', sans-serif; font-size: 20px;" class="card-text ">${nombre}</p>
			  				</div>
			  				<div class="card-body">
			    				<button data-icono-jugador="${resp.icon}" data-jugador="${resp.name}"
			    				data-icono-tanque="${icono_tanque}" data-rol-tanque="${tanque_logo}" data-rango-tanque="${rango_tanque}"
			    				data-icono-dps="${icono_dps}" data-rol-dps="${dps_logo}" data-rango-dps="${rango_dps}"
			    				data-icono-healer="${icono_healer}" data-rol-healer="${healer_logo}" data-rango-healer="${rango_healer}"
			    				data-heroe1="${heroe1}" data-heroe2="${heroe2}" data-heroe3="${heroe3}"

			    				type="button" class="btn btn-outline-info btn_detalles_jugador">Ver más</button>
			  				</div>
		
						</div>
					</div>
				`;
				$('#roster_equipo').append(txt);
	
			}else{
				console.log("NO");
				var txt = `
					<div class="col-sm-12 col-md-4 col-lg-3">
						<div class="card m-1">
							<img class="card-img-top" src="img/logo-rivals.jpg" width="100" height="100">
			  				<div class="card-body">
			    				<p style="font-family: 'Ow', sans-serif; font-size: 20px;" class="card-text ">${nombre}</p>
			  				</div>
			  				<div class="card-body">
			    				<p style="font-family: 'Ow', sans-serif; font-size: 20px;" class="card-text"></p>
			  				</div>
		
						</div>
					</div>
				`;
				$('#roster_equipo').append(txt);
			}
		},
		error: function() {
	        console.log("No se ha podido obtener la información");

	        var txt = `
				<div class="col-sm-12 col-md-4 col-lg-3">
					<div class="card m-1">
						<img class="card-img-top" src="img/logo-rivals.jpg" width="100" height="100">
		  				<div class="card-body">
		    				<p style="font-family: 'Ow', sans-serif; font-size: 20px;" class="card-text ">${nombre}</p>
		  				</div>
		  				<div class="card-body">
		    				<p style="font-family: 'Ow', sans-serif; font-size: 20px;" class="card-text"></p>
		  				</div>
	
					</div>
				</div>
			`;
			$('#roster_equipo').append(txt);
	    }
	});

}

$('body').on('click', '.btn_detalles_jugador', function(){
	$("#div_detalles_jugador").show();

	var icono = $(this).data('icono-jugador');
	var nombre = $(this).data('jugador');

	var div_icono = `
		<img style="width:100px; height: 100px;" class="img-fluid" src="${icono}">
		<h1 class="text-light" style="font-family: 'Ow', sans-serif;">${nombre}</h1>
	`;
	$("#jugador_icono").html(div_icono);
	var heal = ``;
	var dps = ``;
	var tank = ``;

	var icono_tanque = $(this).data('icono-tanque');
	var rol_tanque = $(this).data('rol-tanque');
	var sr_tanque = $(this).data('rango-tanque');
	if (icono_tanque != "") {
		tank = `
			<img style="width:20px; height: 20px;" class="img-fluid" src="${rol_tanque}">
			<img style="width:30px; height: 30px;" class="img-fluid" src="${icono_tanque}">
			<span class="text-light align-middle" style="font-family: 'Ow', sans-serif; font-size: 23px;">${sr_tanque}</span>
			</br>
		`;
	}

	var icono_dps = $(this).data('icono-dps');
	var rol_dps = $(this).data('rol-dps');
	var sr_dps = $(this).data('rango-dps');
	if (icono_dps != "") {
		dps = `
			<img style="width:20px; height: 20px;" class="img-fluid" src="${rol_dps}">
			<img style="width:30px; height: 30px;" class="img-fluid" src="${icono_dps}">
			<span class="text-light align-middle" style="font-family: 'Ow', sans-serif; font-size: 23px;">${sr_dps}</span>
			</br>
		`;
	}
	
	var icono_healer = $(this).data('icono-healer');
	var rol_healer = $(this).data('rol-healer');
	var sr_healer = $(this).data('rango-healer');

	if (icono_healer != "") {
		heal = `
			<img style="width:20px; height: 20px;" class="img-fluid" src="${rol_healer}">
			<img style="width:30px; height: 30px;" class="img-fluid" src="${icono_healer}">
			<span class="text-light align-middle" style="font-family: 'Ow', sans-serif; font-size: 23px;">${sr_healer}</span>
		`;
	}
	
	var div_rango =`
		${tank}
		${dps}
		${heal}
	`;
	$("#jugador_rango").html(div_rango);

	var heroe1 = $(this).data('heroe1');
	var heroe2 = $(this).data('heroe2');
	var heroe3 = $(this).data('heroe3');
	var div_heroes = `
		<h1 class="text-light" style="font-family: 'Ow', sans-serif;">Top Heroes</h1>
	`;

	if (heroe1 != "") {
		div_heroes += `<img style="width:100px; height: 120px;" class="img-fluid m-2" src="${heroe1}">`;
	}

	if (heroe2 != "") {
		div_heroes += `<img style="width:100px; height: 120px;" class="img-fluid m-2" src="${heroe2}">`;
	}

	if (heroe3 != "") {
		div_heroes += `<img style="width:100px; height: 120px;" class="img-fluid m-2" src="${heroe3}">`;
	}

	
	$('#jugador_heroes').html(div_heroes);


});

function showCargandoDialog(){
	Swal.fire({
	    title: "Cargando",
	    html: '<img src="img/cargando.gif" class="img-responsive m-2" width="200" height="200" >',
	    showConfirmButton: false,
	    allowOutsideClick: false
  	});
}

function obtenerTorneosPlataforma(plataforma){

	showCargandoDialog();

	var plat = plataforma.toLowerCase();

	$.ajax({
		url: `https://owrivals.pythonanywhere.com/api/torneos/${plat}/`,
		type: 'GET',
		dataType: 'json',
		success: function(resp) {
			console.log(resp);

			Swal.fire({
		  		width: '85%',
		  		//background: '#3c4656',
		  		html:
		    		`
		    		<h1 style="font-family: 'Ow', sans-serif;" >Selecciona una temporada</h1>
		    		<img src="img/ana_pc.png" class="img-responsive m-2" width="200" height="200" > </br>

		    		<div class="p-5"  style="background-image: url('img/mosaico.jpg'); background-repeat: no-repeat; background-size: cover;">

		    			<div id="temporadas" class="row">
						</div>

		    		</div>

		    		`
		 	});

			var torneos = "";
			for (var i = 0; i < resp.length; i++) {

				torneos += `
					<div class="col-sm-12 col-md-6 col-lg-3" style="max-width: 250px;">
		    			<div id="select_temporada" data-temporada="${resp[i].id}" class="card m-1">
			  				<img class="card-img-top" src="img/logo-rivals.jpg" width="80" height="120">
			  				<div class="card-body">
			    				<p style="font-family: 'Ow', sans-serif;" class="card-text">${resp[i].temporada}</p>
			  				</div>
						</div>
					</div>
				`
			}

			$('#temporadas').html(torneos);
		},
		error: function() {
	        console.log("No se ha podido obtener la información");
	    }
	});

}

$('body').on('click', '#select_temporada', function(){
	var torneo = $(this).data('temporada');

	if ( $.fn.dataTable.isDataTable( '#tabla_posiciones' ) ) {
		var tabla = $('#tabla_posiciones').DataTable(); 
	}else{
		var tabla = $('#tabla_posiciones').DataTable({
			paging: false,
			searching: false,
			"order": [[ 6, "desc" ]],
			responsive: true
		});
	}

	showCargandoDialog();
	
	$.ajax({
		url: `https://owrivals.pythonanywhere.com/api/torneo_detalle/${torneo}/`,
		type: 'GET',
		dataType: 'json',
		success: function(resp) {
			console.log(resp);
			tabla.clear();
			resp.equipos.sort((a, b) => parseFloat(b.puntos) - parseFloat(a.puntos));

			$('#logo_campeon_temporada').attr("src", "https://owrivals.pythonanywhere.com"+resp.campeon_logo);
			$('#nombre_campeon_temporada').html(resp.campeon);
			$('#txt_mvp_temporada').html(resp.mvp);

			if (resp.campeon)
				$('#ganadores_torneo').show();
			else
				$('#ganadores_torneo').hide();

			if (resp.en_curso)
				$('#torneo_en_curso').html(`Temporada ${resp.temporada} | En curso`);
			else
				$('#torneo_en_curso').html(`Temporada ${resp.temporada} | Finalizada`);

			$('#fecha_inicio_torneo').html(`Fecha Inicio: ${resp.fecha_inicio}`);

			$('#cuadro_temporada').show();

			$('#cuadro_tabla_torneo').show();

			$('html, body').animate({
				scrollTop: $("#cuadro_tabla_torneo").offset().top
			}, 1500);

			$('#resumen_temporada').html(resp.resumen);
			
			for (var i = 0; i < resp.equipos.length; i++) {
				var equipo = resp.equipos[i];

				tabla.row.add([
					`<strong>${i+1}</strong>`,
					`<img style="width: 60px; height: 60px;" src="https://owrivals.pythonanywhere.com/${equipo.logo}" class="img-fluid rounded-circle">`,
					equipo.nombre,
					equipo.victorias,
					equipo.empates,
					equipo.derrotas,
					equipo.puntos,
					`<button data-equipo="${equipo.id}" type="button" class="btn btn-outline-secondary btn_detalles_team">Detalles</button>`
				]);

			}

			if (resp.patrocinadores.length > 0) {
				$('#div_patrocinadores').show();

				var cards = "";
				for (var i = 0; i < resp.patrocinadores.length; i++) {
					cards += `
						<div class="card mx-auto" style="width: 18rem; display: inline-block">
 							<img class="card-img-top" src="https://owrivals.pythonanywhere.com/${resp.patrocinadores[i].logo}">
	  						<div class="card-body">
	    						<h5 class="card-title">${resp.patrocinadores[i].nombre}</h5>
	    						<p class="card-text">${resp.patrocinadores[i].descripcion}</p>
	    						<a href="${resp.patrocinadores[i].link_producto}" class="btn btn-primary">Visitar</a>
	  						</div>
	  					</div>
					`
					 ;
				}	

				$('#patrocinadores').html(cards);

			}else{
				$('#div_patrocinadores').hide();
			}
			
			
			tabla.draw();
			Swal.close();
		},
		error: function() {
	        console.log("No se ha podido obtener la información");
	    }
	});
});

$('#btn-torneos-pc').on('click', function(){
	obtenerTorneosPlataforma("PC");
});

$('#btn-torneos-ps4').on('click', function(){
	obtenerTorneosPlataforma("PS4");
});

$('#btn-torneos-xbox').on('click', function(){
	obtenerTorneosPlataforma("XBOX");
});