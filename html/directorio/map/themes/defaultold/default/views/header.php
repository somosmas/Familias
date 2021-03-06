<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
	<title><?php echo html::specialchars($page_title.$site_name); ?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="../../../images/favicon.ico"/>
	<?php echo $header_block; ?>
	<?php
	// Action::header_scripts - Additional Inline Scripts from Plugins
	Event::run('ushahidi_action.header_scripts');
	?>
<script type="text/javascript" src="../../../js/javascript.js"></script>
<link rel="stylesheet" type="text/css" href="../../../css/altstyle.css" />

<style type="text/css">
A.texto:hover { color:#FF7900; 
text-decoration:overline;
font-weight:bold;
background:#368C00;
</style>



</head>

<?php
  // Add a class to the body tag according to the page URI

  // we're on the home page
  if (count($uri_segments) == 0)
  {
  	$body_class = "page-main";
  }
  // 1st tier pages
  elseif (count($uri_segments) == 1)
  {
    $body_class = "page-".$uri_segments[0];
  }
  // 2nd tier pages... ie "/reports/submit"
  elseif (count($uri_segments) >= 2)
  {
    $body_class = "page-".$uri_segments[0]."-".$uri_segments[1];
  }
?>

<body id="page" class="<?php echo $body_class; ?>">

	<?php echo $header_nav; ?>

	<!-- wrapper -->
	<div class="wrapper floatholder rapidxwpr">


        <!-- / header item for plugins -->
        <?php
            // Action::header_item - Additional items to be added by plugins
	        Event::run('ushahidi_action.header_item');
        ?>

		<!-- main body -->
		<div id="middle">
			<div class="background layoutleft">

				<!-- mainmenu -->
				<div id="mainmenu" class="clearingfix">
					<ul>

<li><a href="http://familiasycomunidadesenred.co/directorio/">
<img alt="" title="Directorio" src="../../../images/int/boton-interna-4.png" height="59" style="border-width: 0;" width="59" id="img18" onmouseout="FP_swapImgRestore()" onmouseover="FP_swapImg(1,1,/*id*/'img18',/*url*/'../../../images/int/boton-interna-4-roll.png')"/></a>
</li>
<li><a href="http://familiasycomunidadesenred.co/streaming/">
<img alt="" title="Seguimiento a Colaboraciones" src="../../../images/int/boton-interna-2.png" height="59" style="border-width: 0;" width="59" id="img17" onmouseout="FP_swapImgRestore()" onmouseover="FP_swapImg(1,1,/*id*/'img17',/*url*/'../../../images/int/boton-interna-2-roll.png')"/></a>
</li>
<li><a href="http://familiasycomunidadesenred.co/ideas/">
<img alt="" title="Transmisiones Virtuales" src="../../../images/int/boton-interna-1.png" height="59" style="border-width: 0;" width="59" id="img16" onmouseout="FP_swapImgRestore()" onmouseover="FP_swapImg(1,1,/*id*/'img16',/*url*/'http://familiasycomunidadesenred.co/images/int/boton-interna-1-roll.png')"/></a>
</li>						
<li><a href="http://familiasycomunidadesenred.co/">
<img alt="Inicio" title="Inicio" src="../../../images/int/boton-interna-home.png" height="59" style="border-width: 0;" width="59" id="img15" onmouseout="FP_swapImgRestore()" onmouseover="FP_swapImg(1,1,/*id*/'img15',/*url*/'http://familiasycomunidadesenred.co/images/int/boton-interna-home-roll.png')"/></a>
</li>
<img style="-webkit-user-select: none" src="http://familiasycomunidadesenred.co/images/int/titulo-3.png">

					</ul>



					<?php if ($allow_feed == 1) { ?>
					<div class="feedicon"><a href="<?php echo url::site(); ?>feed/"><img alt="<?php echo html::escape(Kohana::lang('ui_main.rss')); ?>" src="<?php echo url::file_loc('img'); ?>media/img/icon-feed.png" style="vertical-align: middle;" border="0" /></a></div>
					<?php } ?>

<div id="texto" style="float:left;width:210px;display:inline;position:relative;height:13px;text-decoration:none;padding-bottom:12px;font-size:12pt">
<div id="2" style="float:left;width:80px;text-align:center"><a class="texto" href="http://familiasycomunidadesenred.co/mapa/">Inicio</a></div>
<div id="1" style="float:right;width:130px;text-align:center"><a class="texto" href="http://familiasycomunidadesenred.co/mapa/reports/">Colaboraciones</a></div>
</div>




				</div>

				<!-- / mainmenu -->
