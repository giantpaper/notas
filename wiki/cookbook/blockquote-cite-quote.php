<?php

## Add blockquotes	
## ""quote""
Markup("\"\"","inline","/\"\"(\\S.*?\\S)\"\"/",'<q>$1</q>');

## ["blockquote"]
Markup("bq",">[=","/(\n[^\\S\n]*)?\\[([\"])(.*?)\\2\\]/s","$1<blockquote>$3</blockquote>");

## > blockquote (email type)
Markup('>','>> ','/^&gt;$/',"<:block,1><blockquote class=\"email qlv0\"></blockquote>");
Markup('> ','block','/^((&gt;)+) (.*)$/',"EmailBlockquote");
function EmailBlockquote ($m) {
	$cnt = strlen($m[1])/4; if ($cnt>3) $cnt = 3;
	return "<:block,1><blockquote class=\"email qlv".$cnt."\">".$m[3]."</blockquote>";
}

## {"cite"}
Markup("{\"","<'''''","/\{\"(.*?)\"\}/",'<cite>$1</cite>');
Markup("^{\"","<{\"","/^\{\"(.*?)\"\}/",'<cite class="citeblock">$1</cite>');
