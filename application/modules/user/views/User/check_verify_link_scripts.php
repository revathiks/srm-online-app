<script type="text/javascript">
	function check_verify_link() {
		$.ajax({
			url: '<?php echo base_url(); ?>check_verifylink',
			method: "POST",
			data: {'verify_text':'<?php echo $verify_text; ?>','user_id':'<?php echo $user_id; ?>'},
			dataType: 'json',
			cache: false,
			success: function(returndata) {
				if(typeof returndata != 'undefined') {
					var class_name = '';
					if(returndata.status == '1') {
						class_name = 'success';
						$('#success_text').show('slow');
					} else if(returndata.status == '0') {
						class_name = 'danger';
						$('#success_text').hide();
					}
					$('#msgs').html("<div class='alert alert-"+class_name+"'>"+returndata.message+"<button type='button' class='close' data-dismiss='alert'>&times;</button></div>");
					setTimeout(function() { window.location.href = '<?php echo base_url(); ?>'+returndata.redirect; }, 5000);
				}
			}
		});
	}
	check_verify_link();
</script>