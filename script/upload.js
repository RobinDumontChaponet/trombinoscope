FileTransfert = function (input, basename, destination, subDestination, callback) {
	var t=this;
	t.input=input;
	t.callback=callback;

	t.input.onchange=function(){
		if(this.parentNode.getElementsByTagName('img')[1]) this.parentNode.getElementsByTagName('img')[1].style.visibility='hidden';
		this.parentNode.className='button loading';

		var fd = new FormData();
		fd.append('upload', this.files[0]);
		fd.append('basename', basename);
		fd.append('destination', destination);
		fd.append('sub', subDestination);

		var xhr = new XMLHttpRequest();
		xhr.open('POST', 'upload.php', true);

		xhr.onload = function() {
			if(this.readyState  == 4)
				if (this.status == 200) {
					var resp = JSON.parse(this.response);

					t.callback(resp);

					t.input.parentNode.className='button';
					console.log('responseText: '+this.responseText);
				}
		};
		xhr.send(fd);
	}
};