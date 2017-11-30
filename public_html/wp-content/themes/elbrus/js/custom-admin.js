jQuery(function($){
	// post type toogle
	var postType = $('#post-formats-select').find('input:checked').val();
	if( postType == 0 ){
		$('#post_format .rwmb-meta-box .rwmb-field').hide();
	}
	else{
		$('#post_format .rwmb-meta-box .rwmb-field').hide();
		$( 'label[for*="' + postType + '"]' ).closest('.rwmb-field').siblings('.rwmb-field').hide();
		$( 'label[for*="' + postType + '"]' ).closest('.rwmb-field').fadeIn();
	}
	$('#post-formats-select').find('input').change( function() {
		var postType = $(this).val();

		if ( postType == 0 ) {
			$('#post_format .rwmb-meta-box .rwmb-field').hide();
		}
		else{
			$( 'label[for*="' + postType + '"]' ).closest('.rwmb-field').siblings('.rwmb-field').hide();
			$( 'label[for*="' + postType + '"]' ).closest('.rwmb-field').fadeIn();
		}
	});
	// portfolio type toogle
	var portfolioType = $("#post_types_select :selected").val();
	$('#post_types .rwmb-meta-box .rwmb-field').not(':eq(0)').hide();
	if(portfolioType != "link"){
		$( 'label[for*="' + portfolioType + '"]' ).closest('.rwmb-field').siblings('.rwmb-field').hide();
		$( 'label[for*="' + portfolioType + '"]' ).closest('.rwmb-field').fadeIn();
		$('#post_types .rwmb-meta-box .rwmb-field').eq(0).show();
	}
	$('#post_types_select').change( function() {
		var portfolioType = $(this).val();
		if(portfolioType == "link"){
			$('#post_types .rwmb-meta-box .rwmb-field').not(':eq(0)').hide();
		}
		else{
			$( 'label[for*="' + portfolioType + '"]' ).closest('.rwmb-field').siblings('.rwmb-field').hide();
			$( 'label[for*="' + portfolioType + '"]' ).closest('.rwmb-field').fadeIn();
			$('#post_types .rwmb-meta-box .rwmb-field').eq(0).show();
		}
	});
	// meta box toogle for page
	elem = $('#homepage .rwmb-meta-box .rwmb-field');
	if($('#homepage_slider').find('option:selected').val() != 'slider2')
		elem.eq(1).hide();
	$('#homepage_slider').change(function(){
		var _value = $(this).find('option:selected').val();
		if(_value == 'slider2') {
			elem.eq(1).show();
		} else { elem.eq(1).hide(); }
	});
});
jQuery(document).ready(function($){
	// Instantiates the variable that holds the media library frame.
	var meta_image_frame;
	var img_input;
	// Runs when the image button is clicked.
	$('.pix-image-upload').click(function(e){
		img_input = $('#'+$(this).data('input'));
		// Prevents the default action from occuring.
		e.preventDefault();

		// If the frame already exists, re-open it.
		if ( meta_image_frame ) {
			meta_image_frame.open();
			return;
		}

		// Sets up the media library frame
		meta_image_frame = wp.media.frames.meta_image_frame = wp.media({
			title: meta_image.title,
			button: { text:  meta_image.button },
			library: { type: 'image' }
		});

		// Runs when an image is selected.
		meta_image_frame.on('select', function(){
			// Grabs the attachment selection and creates a JSON representation of the model.
			var media_attachment = meta_image_frame.state().get('selection').first().toJSON();

			// Sends the attachment URL to our custom image input field.
			$(img_input).val(media_attachment.url);
		});

		// Opens the media library frame.
		meta_image_frame.open();
	});

	$('.pix-reset').click(function(e){
		$(this).parent().find('input').val('');
	});
	
});
