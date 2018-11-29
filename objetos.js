function cBoton(id,container,etiqueta,estilo,habilitado,accion) {
	this.id = id;
	this.container = container;
	this.etiqueta = etiqueta;
	this.estilo = estilo;
	this.habilitado = habilitado;
	this.accion = accion;
	btn = document.createElement("button");
	btn.id = this.id;
	btn.innerHTML = this.etiqueta;
	btn.addEventListener('click', this.accion, false);
	document.getElementById(this.container).appendChild(btn);
}

function cCampo(id,container,etiqueta,tipo,longitud,valor,editable) {
	this.id = id;
	this.container = container;
	this.etiqueta = etiqueta;
	this.tipo = tipo;
	this.longitud = longitud;
	this.valor = valor;
	this.editable = editable;

	lbl = document.createElement('span');
	lbl.innerHTML = this.etiqueta;
	lbl.style.width = '20vw';
	// lbl.style.display = 'inline';

	cmp = document.createElement('input');
	cmp.type = this.tipo;
	cmp.id = this.id;
	cmp.size = this.longitud;
	cmp.maxLength = this.longitud;
	// cmp.style.width = '30vw';
	// cmp.style.display = 'inline';
	cmp.value = this.valor;

	cnt = document.createElement('div');
	cnt.style.display = 'flex';
	cnt.style.paddingTop = '0.5em';
	console.log(cnt.style);
	cnt.style.paddingBottom = '0.5em';


	cnt.appendChild(lbl);
	cnt.appendChild(cmp);
	document.getElementById(this.container).appendChild(cnt);
}
