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

?>

<!-- ********** CUSTOM STYLES ********** -->
<style>
.claim {
  color : #<?php echo $nscolors['color1'] ?>;
}
</style>
<!-- /styles -->

<?php } else { ?>

<!-- ********** NO CUSTOM STYLES  ********** -->

<?php } ?>
