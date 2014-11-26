var existingSupprModal;

function supprModal (el) {
	if(existingSupprModal)
		existingSupprModal.parentNode.removeChild(existingSupprModal);
	var modal=document.createElement('div');
	modal.className='modal suppr';
	modal.innerHTML='<a href="'+el.href+'&noconfirm">Supprimer.</a><a href="#" onclick="this.parentNode.parentNode.removeChild(this.parentNode);existingSupprModal=null;return false">Annuler</a>';
	el.parentNode.appendChild(modal);
	existingSupprModal=modal;
}