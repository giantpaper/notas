(function($){
	$(document).ready(function(){
		
		
		$('form[name="authform"]').each(function(){
			let html = $(this).html();
			html = html.replace(/Password:/, '<label>Password:</label>');
			$(this).html(html);
		});
		$('#wikiedit').each(function(){
			let html = $(this).html();
			html = html.replace(/(Summary|Author):/g, '<label for="$1">$1:</label>');
			
			html = html.replace(/(<input [^>]+> ?This is a minor edit)/g, '<label class="minor_edit">$1</label>');
			
			$(this).html(html);
		});
		
		$('hr').wrap('<div class="hr">');
	
	
		$('table.evenly-spaced').each(function(){
			//$(this).
		});
		
		$('.wikitrail').closest('div').addClass('mininav');
		
		
	});
})(jQuery);