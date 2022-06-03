
function cellStyle(value, row, index) {
			var classes = ['label-aceptada', 'label-occerrada', 'label-retirada', 'label-transito', 'label-enviada','label-occerrada','label-retirada-sinstock','label-retirada-parcial'];
			var aux = 0;
			if(value.indexOf("Solicitud Retiro Aceptada")>=0){
				aux=classes[0];
			}else if(value.indexOf("En Transito")>=0){
				aux=classes[3];
			}else if(value.indexOf("Sin Stock")>=0){
				aux=classes[6];
			}else if(value.indexOf("Parcial")>=0){
				aux=classes[7];
			}else if(value.indexOf("Retirado")>=0){
				aux=classes[2];
			}else if(value.indexOf("OC Cerrada")>=0){
				aux=classes[1];
			}else if(value.indexOf("Recepcionado")>=0){
				aux=classes[5];
			}else if(value.indexOf("OC Abierta")>=0){
				aux=classes[4];
			}else if(value.indexOf("Enviada")>=0){
				aux=classes[4];
			}
			return {
				classes: aux
			};
		}
