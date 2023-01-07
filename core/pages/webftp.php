<?php 
if (is_login() == false) {
	sMSG('Morate se ulogovati.', 'error');
	redirect_to('home');
	die();
}

$Server_ID = txt($_GET['id']);

if (is_valid_server($Server_ID) == false) {
	sMSG('Ovaj server ne postoji ili za njega nemate pristup.', 'error');
	redirect_to('servers');
	die();
}

if (ban_ftp($_SESSION['user_login']) == 1) {
	sMSG('Vas nalog, je na nasoj ban listi za ovu stranicu. Ukoliko mislite da je ovo neka greska obratite se nasem support timu!', 'info');
	redirect_to('home');
	die();
}


?>

		<div class="container">
			<div class="rows">
				<div class="contect">
				<?php include_once($_SERVER['DOCUMENT_ROOT'].'/core/pages/partial/nav.php'); ?>
					<div class="col-md-12" style="min-height:300px">
						<div id="elfinder"></div>
					</div>
				</div>
			</div>


<script src="/core/inc/libs/FTP/js/elfinder.min.js" defer></script>
<script src="/core/inc/libs/FTP/js/i18n/elfinder.en.js" defer></script>
<link rel="stylesheet" type="text/css" href="/core/inc/libs/FTP/css/elfinder.full.css">
<link rel="stylesheet" type="text/css" href="/core/inc/libs/FTP/css/elfinderT/Material/css/theme.css">

<script type="text/javascript" defer>
window.onload = function(){ 
	$(function () { 
		var myCommands = elFinder.prototype._options.commands; 
		var disabled = ['resize', 'help', 'select']; 
		$.each(disabled, function (i, cmd) {
			(idx = $.inArray(cmd, myCommands)) !== -1 && myCommands.splice(idx, 1); }); 
			var selectedFile = null; 
			var options = { 
				url: '/process.php?a=ftp&server_id=<?php echo $Server_ID;  ?>', 
				rememberLastDir: false, 
				commands: myCommands, 
				lang: 'en', 
				uiOptions: { 
					toolbar: [ ['back', 'forward'], ['reload'], ['home', 'up'], ['mkdir', 'mkfile', 'upload'], ['open', 'download'], ['info'], ['quicklook'], ['copy', 'cut', 'paste'], ['rm'], ['duplicate', 'rename', 'edit','extract', 'archive'], ['view', 'sort'] ] 
				}, 
				handlers: { 
					select: function (event, elfinderInstance) { 
						if (event.data.selected.length == 1) { 
							var item = $('#' + event.data.selected[0]); 
							if (!item.hasClass('directory')) { 
								selectedFile = event.data.selected[0];
								$('#elfinder-selectFile').show(); return;
							} 
						} 
						$('#elfinder-selectFile').hide(); selectedFile = null; 
					}					
				} 
			};
			$('#elfinder').elfinder(options).elfinder('instance');
			$('.elfinder-toolbar:first').append('<div class="ui-widget-content ui-corner-all elfinder-buttonset" id="elfinder-selectFile" style="display:none; float:right;">'+ '<div class="ui-state-default elfinder-button" title="Select" style="width: 100px;"></div>');
			$('#elfinder-selectFile').click(function () { 
				if (selectedFile != null)
				$.post('', { 
					target: selectedFile 
				}, 
				function (response) { 
				alert(response); 
			}); 
		});
	}); 
}
</script>
