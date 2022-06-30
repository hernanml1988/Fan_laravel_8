
function roles(role){

	if(role == "Enviar Registros"){
		$('#idregistro').removeClass("hidden");
		if( user_id != 761 && user_id != 765 ){$('#idhistorial').removeClass("hidden");}
		if( user_id != 761 && user_id != 765 ){$('#idmapas').removeClass("hidden");}
		if(id_empresa == 11 || id_empresa == 12 || (id_empresa == 5 && user_id != 761 && user_id != 765) ){$('#idinforme').removeClass("hidden");}
		
		if(user_id == 81
			//Camanchaca
			|| user_id == 85  // Centro Islotes por petición de Alfredo Tello Vi 19-11-21
		){
			$('#iddescargas').removeClass("hidden");
		}

	} else if(role == "usuario"){
		$('#idhistorial').removeClass("hidden");
		$('#idmapas').removeClass("hidden");
		if(  user_id == 1 || user_id == 88 || user_id == 275 || user_id == 235 || user_id == 81 || user_id == 313 || user_id == 78 ||
			user_id == 55 || user_id == 80 || user_id == 139
			//Camanchaca
			|| id_empresa == 5
			// || user_id == 583
			// || user_id == 666
			// || user_id == 665
			// || user_id == 643
			// || user_id == 668
			// || user_id == 675
			// || user_id == 339
			// || user_id == 90
			// || user_id == 91
			//Australis
			/*|| userid == 148
			|| userid == 146
			|| userid == 147
			|| userid == 140
			|| userid == 142
			|| userid == 141
			|| userid == 143
			|| userid == 149
			|| userid == 144
			|| userid == 145
			|| userid == 164
			|| userid == 163*/
			//Yadran
			|| (user_id >=345 && user_id <=352)
		){ $('#idinforme').removeClass("hidden"); }


		if(
		//Camanchaca
		user_id == 583
		|| user_id == 666
		|| user_id == 665
		|| user_id == 643
		|| user_id == 668
		){
			//Badge declaración
			$.ajax({
				url: "load_declarar_badge.php",
				type: 'post',
				dataType: 'json',
				data: {
					user_id:		user_id
				},
				success: function(dato)
				{
					$('#badge2_declarar').html(dato);
				}
			});
			$('#iddeclaracion').removeClass("hidden");

		}




		if(  //MOWI
			user_id == 55
			//Camanchaca
			|| user_id == 90
			|| user_id == 583
			|| user_id == 339
			|| user_id == 757
		){
			$('#iddescargas').removeClass("hidden");
		}
	} else if(role == "admin_fan_empresa"){
		$('#idregistro').removeClass("hidden");
		$('#idhistorial').removeClass("hidden");
		$('#iddescargas').removeClass("hidden");
		$('#idmapas').removeClass("hidden");
		$('#idconfig').removeClass("hidden");
		// if(  user_id == 1 || user_id == 88 || user_id == 275 || user_id == 235 || user_id == 81 || user_id == 313 || user_id == 78 ||
		// 	user_id == 55 || user_id == 80 || user_id == 139 || user_id == 261 || user_id == 276
		// 	//Camanchaca
		// 	|| user_id == 266 || user_id == 83 || user_id == 110 || user_id == 82
		// 	//Australis
		// 	|| user_id == 138 || user_id == 409 || user_id == 137 || user_id == 390 || user_id == 562 || user_id == 582
		// 	//Blumar
		// 	|| user_id == 224 || user_id == 321 || user_id == 222
		// 	|| user_id == 333
		// 	//Yadran
		// 	|| (user_id >= 345 && user_id <= 352)
		// 	//Ventisqueros
		// 	|| user_id == 423 || user_id == 425 || user_id == 468 || user_id == 604 || user_id == 605
		// 	//Austral
		// 	|| user_id == 490 || user_id == 491 || user_id == 492
		// 	//Antartica
		// 	|| user_id == 520 || user_id == 543 || user_id == 544
		// ){
			 $('#idinforme').removeClass("hidden");
		 // }

		//if(
		//Admin
		// user_id == 1 || user_id == 88 || user_id == 275 || user_id == 235 || user_id == 81 || user_id == 313 || user_id == 78 ||
		// //Australis
		// user_id == 138 || user_id == 409 || user_id == 137 || user_id == 390 || user_id == 562 || user_id == 582
		// //Camanchaca
		// || user_id == 266 || user_id == 83 || user_id == 583 || user_id == 110 || user_id == 82
		// //Blumar
		// || user_id == 224 || user_id == 321 || user_id == 222
		// || user_id == 333
		// //Yadran
		// || user_id == 345 || user_id == 348 || user_id == 351 || user_id == 352
		// //MOWI
		// || user_id == 80 || user_id == 55
		// //Ventisqueros
		// || user_id == 423 || user_id == 425 || user_id == 468 || user_id == 604 || user_id == 605
		// //Austral
		// || user_id == 490 || user_id == 491 || user_id == 492
		// //Antartica
		// || user_id == 520 || user_id == 543 || user_id == 544
		// ){
			//Badge declaración
			$.ajax({
				url: "load_declarar_badge.php",
				type: 'post',
				dataType: 'json',
				data: {
					user_id:		user_id
				},
				success: function(dato)
				{
					$('#badge2_declarar').html(dato);
				}
			});
			$('#iddeclaracion').removeClass("hidden");

		// }

	} else if(role == "Laboratorio"){
		$('#idregistro').removeClass("hidden");
	}else if(role == "Laboratorio2"){
		$('#idregistro').removeClass("hidden");
		$('#idmapas').removeClass("hidden");
		$('#idmapas_2').addClass("hidden");

	}
}
