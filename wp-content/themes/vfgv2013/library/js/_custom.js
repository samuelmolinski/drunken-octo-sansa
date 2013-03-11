// as the page loads, call these scripts
jQuery(document).ready(function($) {

	// add all your scripts here
	init();

});
/* end of as page load scripts */

function formActions() {
	//console.debug('formActions');
	jQuery('#fb_submit').click(function() {
		if(formValid()) {
			submitComment();
		}
	});
	jQuery('textarea#fb_comment').click(function() {
		jQuery('textarea#fb_comment').css('box-shadow', 'none')
	});
	var comment = jQuery('textarea#fb_comment');

	var endDate = jQuery('#endDate').val();
	//console.debug(jQuery('#endDate'));
	//console.debug('endDate');
	var commentLabel = 'Responda até o dia ' + endDate + ', mas fique atento, você só pode responder uma vez. Boa sorte.';

	comment.val(commentLabel);
	comment.css('color', '#B7B7B7');

	comment.focus(function() {
		if((comment.val() == '') || (comment.val() == commentLabel)) {
			comment.val('');
			comment.css('color', '#565656');
		}
	}).blur(function() {
		if(comment.val() == '') {
			comment.val(commentLabel);
			comment.css('color', '#B7B7B7');
		}
	});
}

function init() {
	jQuery('textarea').css('outline', 'none');
	jQuery('.scroll-pane').jScrollPane({
		showArrows : true,
		horizontalGutter : 10
	});

	jQuery('.fb').hover(function() {
		/*
		path = window.location.pathname;
		arr = path.split('/');
		url = window.location.protocol+ '//' + window.location.host + '/' + arr[1]+ '/';*/
		//console.log('fb')
		jQuery('.socialMedia').addClass('fb-hover');
	}, function() {
		jQuery('.socialMedia').removeClass('fb-hover');
	});

	jQuery('.tw').hover(function() {
		jQuery('.socialMedia').addClass('tw-hover');
	}, function() {
		jQuery('.socialMedia').removeClass('tw-hover');
	});

	jQuery('.convida').hover(function() {
		jQuery('.socialMedia').addClass('i-hover');
	}, function() {
		jQuery('.socialMedia').removeClass('i-hover');
	});
	formActions();
	//add tootips

	jQuery('.company[title]').tooltip({
		effect : 'fade'
	});

	jQuery.tools.tooltip.addEffect("fade",

	// opening animation
	function(done) {
		this.getTip().animate({
			opacity : '1'
		}, 500, 'swing', done).show();
	},
	// closing animation
	function(done) {
		this.getTip().animate({
			opacity : '0'
		}, 500, 'swing', function() {
			jQuery(this).hide();
			done.call();
		});
	});

	jQuery('body').fadeIn();

}

function formValid() {
	var val = jQuery('textarea#fb_comment').val();
	var comment = jQuery('textarea#fb_comment');

	var endDate = jQuery('#endDate').val();
	//console.debug(jQuery('#endDate'));
	//console.debug('endDate');
	var commentLabel = 'Responda até o dia ' + endDate + ', mas fique atento, você só pode responder uma vez. Boa sorte.';

	if((val === '') || (val === null) || (val === undefined)|| (val === commentLabel)) {
		//console.debug('f = ' + val);
		return false;
	} else {
		//console.debug('t = ' + val);
		return true;
	}
}

function getUrlVars() {
	var vars = [], hash;
	var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
	for(var i = 0; i < hashes.length; i++) {
		hash = hashes[i].split('=');
		vars.push(hash[0]);
		vars[hash[0]] = hash[1];
	}
	return vars;
}

function submitComment() {
	//console.debug('submitComment');
	setTimeout(function() {// after 1 second, submit the form
	var ready = false;
	 
	jQuery('#msg').val(jQuery('textarea#fb_comment').val());
	jQuery('textarea#fb_comment').css('opacity', '.3');
	jQuery('textarea#fb_comment').val('Enviando sua resposta...');

	if(jQuery("#fb_status").is(":checked")) {
		//console.debug("checked");
		var path = window.location.pathname;
		var arr = path.split('/');
		var l = window.location.protocol + '//' + window.location.host + '/' + arr[1] + '/'

		//updateStatus(jQuery('#msg').val(), jQuery('#pic').val(), jQuery('#l').val(), jQuery('#n').val(), jQuery('#cap').val(), jQuery('#des').val(), '', '', '');

		//console.debug(l + "wp-content/themes/vfgv2013/ajax.php");
		jQuery.ajax({
			type : "POST",
			url : l + "wp-content/themes/vfgv2013/ajax.php",
			fb : jQuery("#fb_holder").val(),
			data : {
				message : jQuery('#msg').val(),
				picture : jQuery('#pic').val(),
				link : jQuery('#l').val(),
				name : jQuery('#n').val(),
				caption : jQuery('#cap').val(),
				description : jQuery('#des').val(),
				post_ID : jQuery('#post_ID').val(),
				source : '',
				place : '',
				tags : ''
			},
			success : function(msg) {
				//console.debug('ajax checking ready: '+ ready);
				if(ready) {
					jQuery('body').fadeOut();
					//console.debug('Successful Processing: Reloading page');
					window.location.replace(window.location.href);
				} else {
					ready = true;
					//console.debug('Successful Processing Share: '+ ready);

				}
			},
			error : function(msg) {
				//console.debug('updateStatus failed')
			}
		});

	} else {
		ready = true;
		//console.debug("not checked");
	}

	jQuery.ajax({
		type : 'POST',
		url : 'wp-content/themes/vfgv2013/fb_comments.php',
		dataType : 'json',
		data : {
			fb_ID : jQuery('#fb_ID').val(),
			fb_name : jQuery('#fb_name').val(),
			fb_comment : jQuery('textarea#fb_comment').val(),
			fb_holder : jQuery('#msg').val(),
			post_ID : jQuery('#post_ID').val()
		},
		success : function(data) {
			//console.debug('Successful Ajax call');
			//console.debug(data);
			if(data.error === true) {
				//console.debug('should reload');
				//console.debug('Error during processing data: ' + data.msg);
				//if (data.msg == 'no Comment'){
				jQuery('textarea#fb_comment').css('box-shadow', '0 0 5px #e1232a inset');
				jQuery('textarea#fb_comment').css('opacity', '1');
				//}
			} else {
				////console.debug('Successful Processing: Reloading page');
				//jQuery('textarea#fb_comment').val('Resposta enviada com sucesso. Caregando todas as respostas...');
				//jQuery('body').fadeOut();+

				//console.debug('submit checking ready: '+ ready);
				if(ready) {
					jQuery('body').fadeOut();
					//console.debug('Successful Processing: Reloading page');
					window.location.replace(window.location.href);
				} else {
					ready = true;
					//console.debug('Successful Processing submit: '+ ready);
				}

			}
		},
		error : function(XMLHttpRequest, textStatus, errorThrown) {
			//console.debug('submit error');
			jQuery('fb_comment').css('box-shadow', '0 0 5px #e1232a inset');
			jQuery('textarea#fb_comment').css('opacity', '1');
		}
	});
	}, 100);
}