/*var doc=document.getElementsByClassName("space");
	for(var i=0;i<doc.length;i++){
        doc[i].style
		.height =$('.head').height()+"px";
	}*/
var isresise=true;
window.onload = function() {

	var h=$(window).height();
	alert(h);
	document.getElementsByClassName("DivForm2")[0]
		.style
		.height =(h*0.8)+"px";
	document.getElementsByClassName("consult")[0]
		.style
		.height =(h*0.8)+"px";
	document.getElementsByClassName("space")[0]
	    .style
		.height =$('.head').height()+"px";
	document.getElementsByClassName("space")[1]
	    .style
		.height =($('.buscador').height())+"px";
		

};
window.addEventListener('resize',
	function(){
	var h=$(window).height();
	document.getElementsByClassName("space")[0]
	    .style
		.height =$('.head').height()+"px";
	document.getElementsByClassName("space")[1]
	    .style
		.height =($('.buscador').height())+"px";
		
	document.getElementsByClassName("DivForm2")[0]
		.style
		.height =(h*0.8)+"px";
	document.getElementsByClassName("consult")[0]
		.style
		.height =(h*0.8)+"px";
	

		if ( $(window).width() > 790) {  
			isresise=true;
    
			var formulario = document.getElementsByClassName("DivForm2");
			var tabbla = document.getElementsByClassName("consult");

			tabbla[0].style.display = "flex"
			formulario[0].style.display = "inherit";
		} else {

			if(isresise==true){
				var formulario = document.getElementsByClassName("DivForm2");
				var tabbla = document.getElementsByClassName("consult");

				tabbla[0].style.display = "flex"
				formulario[0].style.display = "none";
			}
			
			isresise=false;

		}
	}
);

function hola(){
    console.log("consola");

}

function colapse(){
	if ( $(window).width() <= 782) {      
		document.documentElement.classList.toggle("active");
		var formulario = document.getElementsByClassName("DivForm2");
		var tabbla = document.getElementsByClassName("consult");

		if (formulario[0].style.display === "inherit") {
			tabbla[0].style.display = "inherit"
			formulario[0].style.display = "none";

		} else {
			tabbla[0].style.display = "none";
			formulario[0].style.display = "inherit";

		}
	} 

    console.log("consola");
	


}