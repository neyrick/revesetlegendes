<?php

// must be run from within DokuWiki
if (!defined('DOKU_INC')) die();

// 1 - Read data file

$conf_file = DOKU_CONF.'dynskin.conf';
$data = unserialize(io_readFile($conf_file, false));

// 2 - Get current namespace

$firstns = "";
$nsarray = explode(":", $INFO['namespace']);
if (count($nsarray) > 0) $firstns = $nsarray[0];
if ($firstns == "") $firstns = "wiki";

// 3 - Get colors for current namespace
$nscolors = $data[$firstns];

if (is_array($nscolors)) {
   $color1 = $nscolors['color1'];
   $color2 = $nscolors['color2'];


?>

<!-- ********** CUSTOM STYLES ********** -->
<style>
a:link,
a:visited {
    color: #<?php echo $color1 ?>;
}
#mediamanager__page .namespaces h2 {
    background-color: #<?php echo $color1 ?>;
}
.dokuwiki a.wikilink1 {
    color: #<?php echo $color2 ?>;
}
.dokuwiki ul.tabs li a {
    background-color: #<?php echo $color1 ?>;
}
.dokuwiki ul.tabs li strong,
.dokuwiki ul.tabs li a:focus,
.dokuwiki ul.tabs li a:hover
 {
    background-color: #<?php echo $color2 ?>;
}
#dokuwiki__header  .relMenu {
      background: none repeat scroll 0% 0% #<?php echo $color1 ?>; 
}    
#dokuwiki__header .relMenuItemSelected {
      background-color: #<?php echo $color2 ?>; 
}
#dokuwiki__header .wikiTitle {
      color: #<?php echo $color1 ?>; 
}
#dokuwiki__usertools {
  background: #<?php echo $color1 ?>; 
}
.dokuwiki div.breadcrumbs {
    background: #<?php echo $color1 ?>; 
}
#dokuwiki__aside a:visited {
        color: #<?php echo $color2 ?>; 
}
.relHeaderSpacer {
  background: #<?php echo $color1 ?>; 
}
.wrap_relinfoboxtitle {
  background: #<?php echo $color1 ?>; 
}
#dokuwiki__header .tools {
  background: #<?php echo $color1 ?>;
}
div.inlinetoc2 ul li {
    color: #<?php echo $color2 ?>; !important;
}
.mode_admin #dokuwiki__usertools .admin,
.mode_login #dokuwiki__usertools .login,
.mode_register #dokuwiki__usertools .register,
.mode_profile #dokuwiki__usertools .profile,
.mode_recent #dokuwiki__usertools .recent,
.mode_index #dokuwiki__usertools .index,
.mode_media #dokuwiki__usertools .media,
.mode_revisions #dokuwiki__usertools .revs,
.mode_backlink #dokuwiki__usertools .backlink,
.mode_subscribe #dokuwiki__usertools .subscribe {
    background-color: #<?php echo $color2 ?>;
}
</style>
<!-- /styles -->

<?php } else { ?>

<!-- ********** NO CUSTOM STYLES  ********** -->

<?php } ?>
