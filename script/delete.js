function supprModal (el, href) {
	if(!el.parentNode.getElementsByClassName('modal suppr').length) {
		var modal=document.createElement('div');
		modal.className='modal suppr';
		modal.innerHTML='<a href="'+href+'">Supprimer.</a><a href="#" onclick="this.parentNode.parentNode.removeChild(this.parentNode);return false">Annuler</a>';
		el.parentNode.appendChild(modal);
	}
}