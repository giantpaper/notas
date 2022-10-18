<?php if (!defined('PmWiki')) exit();
$config = file("$FarmD/.config");
foreach ($config as $line) {
	$line = trim($line);
	if (preg_match("/^#/", $line) || $line == null)
		continue;
	
	$line = preg_replace("#\t\t+#", "\t", $line);
	list($key, $value) = explode(":\t", $line);
	
	$cfg[trim(strtolower($key))] = trim($value);
}

$cfg['path'] = dirname(__DIR__);

$BodyClass = 'home';

preg_match_all("#\?[^\?]*action=([a-z_-]+)#", strip_tags(htmlentities($_SERVER['REQUEST_URI'])), $m);

if( count($m[1]) >= 1 ) {
	$BodyClass = $m[1][0];
}

$BodyClass = sprintf(' class="%s"', $BodyClass);

$UPDATED_CSS = get_modified_date('dist/styles.css');
$UPDATED_CSS_PRINT = get_modified_date('../print/print.css');
$UPDATED_JS = get_modified_date('dist/scripts.js');
$UPDATED_TYPEKIT = strtotime('2020/12/14 11:00pm');

## Author
$Author = $cfg['author'];

// https://notas.giantpaper.org/pub/skins/2021/dist/logo.svg
//$PageLogoUrl = "http://notas.test/wiki/pub/skins/2021/logo.svg?v=" . $VERSION;
$PageLogo = file_get_contents($cfg['path'] . '/pub/skins/' . $cfg['skin'] . '/dist/logo.svg');

## Passwords
$DefaultPasswords['edit'] = pmcrypt($cfg['edit']);
$DefaultPasswords['admin'] = pmcrypt($cfg['admin']);
$DefaultPasswords['upload'] = pmcrypt($cfg['upload']);
$EnableUpload = 1;

# Uncomment and change these if your server is not in your timezone
date_default_timezone_set($cfg['timezone']); # if you run PHP 5.1 or newer
# putenv("TZ=EST5EDT"); # if you run PHP 5.0 or older

$TimeFmt = '%B %d, %Y, at %I:%M %p %Z';



# Uncomment and correct these if PmWiki fails to detect the browser-reachable URLs
$ScriptUrl = $cfg['home'];
$PubDirUrl = $cfg['home']. '/pub';

## If you want to have a custom skin, then set $Skin to the name
## of the directory (in pub/skins/) that contains your skin files.
## See PmWiki.Skins and Cookbook.Skins.
$Skin = $cfg['skin'];

##  If you want to use URLs of the form .../pmwiki.php/Group/PageName
##  instead of .../pmwiki.php?p=Group.PageName, try setting
##  $EnablePathInfo below.  Note that this doesn't work in all environments,
##  it depends on your webserver and PHP configuration.  You might also 
##  want to check http://www.pmwiki.org/wiki/Cookbook/CleanUrls more
##  details about this setting and other ways to create nicer-looking urls.
$EnablePathInfo = 1;

## Set home info
$VERSION = $cfg['version'];
$HOME = $cfg['home'];
$WikiTitle = $cfg['name'];

## Unicode (UTF-8) allows the display of all languages and all alphabets.
## Highly recommended for new wikis.
include_once("scripts/xlpage-utf-8.php");




// UNSET
unset($cfg);


/*
 ******************
 * Cookbook Recipes
 ******************
 */
 
## Activate the RenamePage recipe.
if ($action == 'rename' || $action == 'postrename' || $action == 'links' ) {
	include_once("$FarmD/cookbook/renamehelper.php");
	include_once("$FarmD/cookbook/rename.php");
}

include_once("$FarmD/cookbook/blockquote-cite-quote.php");

if ($action == 'edit' ) {
	include_once("$FarmD/cookbook/enabletabs.php");
}
 
/*
 ******************
 * Functions
 ******************
 */
function get_modified_date($filename) {
	global $cfg;
	$mtime = filemtime($cfg['path'] . '/pub/skins/' . $cfg['skin'] . '/' .$filename);
	return date('Y-m-d_g-i-a', $mtime);
}