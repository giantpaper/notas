<?php

## https://www.pmwiki.org/wiki/Cookbook/EnableTabs
$HTMLFooterFmt['allow-tabs'] = "<script>
	var tarea = document.querySelector('#wikiedit #text');
	if(tarea) tarea.addEventListener('keydown', function(e){
		if(e.key!='Tab' || e.ctrlKey || e.shiftKey || e.altKey) return;
		e.preventDefault();
		var s1 = this.selectionStart, s2 = this.selectionEnd;
		this.value = this.value.substring(0, s1) + '\t' + this.value.substring(s1);
		this.selectionStart = s1+1 ; this.selectionEnd = s2+1;
	});
	</script>";


