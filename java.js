// JavaScript Document
function regresar(){
location.href="Calendario.php?m="+mes+"&a="+ano+"";
}
function aclarar(ide){$("#"+ide).css("opacity","1");}
function opacar(ide){$("#"+ide).css("opacity",".5");}

function mostrar_detalles(n_fila){
	var estado=$(".pantalla").css("display");
	if(estado=="none"){
		form(n_fila)
		$(".pantalla").fadeIn(600);
        $('.loading').css("display","block");
		setTimeout(function(){
			if($('.loading').css("display")=="block"){
			$('.loading').css("display","none");
			$(".formulario").slideDown(1000);}
   		}, 5000);
	}
	
	$("body").bind("keyup",function(ev) {
		if(ev.which==27){
			$('.loading').css("display","none");
			$(".pantalla").fadeOut(500);
			$(".formulario").slideUp(500);
		}
	});
	$("#cerrar").bind("click",function(ev) {
		$('.loading').css("display","none");
		$(".pantalla").fadeOut(500);
		$(".formulario").slideUp(500);
	});
}
function form(fila){
	nc="",nom="",fecha="",hora="", tema="",can="",seg="",res="";
	aux=0;
	for(var x=1;x<arre.length;x++,aux+=8){
		if(x==fila){
			nc=arre[aux];
			nom=arre[aux+1];
			fecha=arre[aux+2];
			hora=arre[aux+3];
			tema=arre[aux+4];
			can=arre[aux+5];
			seg=arre[aux+6];
			res=arre[aux+7];
			break;
		}
	}
	$("#img").attr("src","fotos/"+arre[aux]+".jpg");
	$("#nomm").html(nom+"<br>"+nc+"<br><br>"+fecha+"&nbsp;&nbsp;&nbsp;"+hora+"<br>");
	$("#select option:contains("+can+")").attr("selected",true);
	$("#text0").html(tema);
	$("#text1").html(seg);
	$("#text2").html(res);	
}

function mostrar_seguimiento_alumno(){
	var estado=$(".pantalla").css("display");
	if(estado=="none"){
		$(".pantalla").fadeIn(600);
        $('.loading').css("display","block");
		setTimeout(function(){
			if($('.loading').css("display")=="block"){
			$('.loading').css("display","none");
			$(".formulario2").slideDown(1000);}
   		}, 3000);
	}
	
	$("body").bind("keyup",function(ev) {
		if(ev.which==27){
			$('.loading').css("display","none");
			$(".pantalla").fadeOut(500);
			$(".formulario2").slideUp(500);
		}
	});
	$("#cerrar").bind("click",function(ev) {
		$('.loading').css("display","none");
		$(".pantalla").fadeOut(500);
		$(".formulario2").slideUp(500);
	});
	$("#btn_salir").bind("click",function(ev) {
		$('.loading').css("display","none");
		$(".pantalla").fadeOut(500);
		$(".formulario2").slideUp(500);
	});
}
