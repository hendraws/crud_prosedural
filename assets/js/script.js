$(document).ready(function() {

	$('#cari').hide();
	// event ketika kueword ditulis
	$('#keyword').on('keyup', function() {
		$('#ajaxCari').load('ajax/siswa.php?keyword=' + $('#keyword').val());
	});


});