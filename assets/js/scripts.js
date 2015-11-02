jQuery(document).ready(function($) {

	$.fn.gravityFieldTypes = function() {
		var $this = $(this);

		$this.each(function() {
			var $input = $(this).find('>:first-child');
			var $type = $input.prop('type');

			$(this).addClass($type);

		});
	}

});