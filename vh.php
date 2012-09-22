<?php
/* vh - version header
 * usage: include this file in every script
 * that uses vd.
 * Usage Example: <?php include('vd/vh.php'); ?> url('<?=$ldr?>images/1.jpg');
 */
$cv = 'vd/1.0/'; // cv - current version
$dt = 'New/'; // dt - default theme
$ldr = $cv.$dt; // ldr = loader
?>
<!-- Add CSS library -->
<link rel="stylesheet" type="text/css" href="<?=base_url()?>scripts/style1.css" />
<script src="http://code.jquery.com/jquery-latest.js"></script>
<script src="http://code.jquery.com/ui/jquery-ui-git.js"></script>
<link href="<?=base_url().$ldr?>images/favicon.ico" rel="icon" type="image/x-icon" />

<!-- Add fancyBox main JS and CSS files -->
<script type="text/javascript" src="<?=base_url()?><?=$ldr?>scripts/source/jquery.fancybox.js"></script>
<link rel="stylesheet" type="text/css" href="<?=base_url()?><?=$ldr?>scripts/source/jquery.fancybox.css" media="screen" />