$(function(){

	var dropbox = $('#dropbox'),
		message = $('.message', dropbox)
		maxsize = 3,
		maxfile = 1000;
		
	$(document).bind('dragstart drag', function(event) { dropbox.addClass('dragging'); }).bind('dragend', function(event) { dropbox.removeClass('dragging'); });
	
	dropbox.filedrop({
	
		paramname: 'userfile',
    	maxfilesize: maxsize,
		maxfiles: maxfile,
		allowedfiletypes: [],
		url: BASE_URL + 'admin/firesale/products/upload/' + $('#id').val(),
		data: { csrf_hash_name: $.cookie(pyro.csrf_cookie_name) },
	
		uploadFinished:function(i,file,response){
			if( response.status ) { $.data(file).addClass('done'); }
			else { $.data(file).addClass('error'); alert(response.message.replace('<p>', '').replace('</p>', '')); }
		},
		
    	error: function(err, file) {
			switch(err) {
				case 'BrowserNotSupported':
					showMessage('Your browser does not support HTML5 file uploads!');
					break;
				case 'TooManyFiles':
					alert('Too many files! Please select ' + maxfile + ' at most.');
					break;
				case 'FileTooLarge':
					alert(file.name + ' is too large! Please upload files up to ' + maxsize + 'MB');
					break;
				default:
					break;
			}
		},
	
		beforeEach: function(file){
			if(!file.type.match(/^image\//)){
				alert('Only images are allowed!');
				return false;
			}
		},
		
		uploadStarted:function(i, file, len){
			createImage(file);
		},
		
		progressUpdated: function(i, file, progress) {
			$.data(file).find('.progress').width(progress);
		},
		
		docEnter: function() {
			dropbox.addClass('dragging');
		},

		docLeave: function() {
			dropbox.removeClass('dragging');
		},
		
		drop: function() {
			dropbox.removeClass('dragging');
		}
    	 
	});
	
	var template = '<div class="preview">'+
						'<span class="imageHolder">'+
							'<img />'+
							'<span class="uploaded"></span>'+
						'</span>'+
						'<div class="progressHolder">'+
							'<div class="progress"></div>'+
						'</div>'+
					'</div>' +
					'<br class="clear" />'; 
	
	
	function createImage(file){

		var preview = $(template), 
			image = $('img', preview);
			
		var reader = new FileReader();
		
		image.width = 100;
		image.height = 100;
		
		reader.onload = function(e){
			image.attr('src',e.target.result);
		};

		reader.readAsDataURL(file);
		
		message.hide();
		dropbox.find('.clear').remove();
		preview.appendTo(dropbox);
		
		$.data(file,preview);
	}

	function showMessage(msg){
		message.html(msg);
	}

});
