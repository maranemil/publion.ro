<!doctype>
<!--[if lt IE 7]> <html lang="en-us" class="no-js ie6"> <![endif]-->
<!--[if IE 7]>    <html lang="en-us" class="no-js ie7"> <![endif]-->
<!--[if IE 8]>    <html lang="en-us" class="no-js ie8"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="en-us" class="no-js"> <!--<![endif]-->
<head>
  <!-- <meta charset="utf-8"> -->
  <meta http-equiv="X-UA-Compatible" content="IE=Edge;chrome=1" >
  <meta name="viewport" content="width=device-width, initial-scale=1.0">  

<? 
/* IE old versions detection*/

/*if (   (strstr($_SERVER['HTTP_USER_AGENT'],'MSIE 6.'))|| (strstr($_SERVER['HTTP_USER_AGENT'],'MSIE 7.'))||  (strstr($_SERVER['HTTP_USER_AGENT'],'MSIE 5.')) ){
	
	echo "
	<script>
		//location.replace('http://windows.microsoft.com/ro-RO/internet-explorer/products/ie/home');
		//location.replace('http://www.mozilla-europe.org/ro/firefox/');
	</script>";
	die();
}*/

//echo "<!-- ".$_SERVER['HTTP_USER_AGENT']." -->";
?>

<? //print_r($_SERVER)?>

		<?php 
		echo $html->charset(); 


		if($Article[0]['articles']['title']){ 
			$title_for_layout = $Article[0]['articles']['title']."  Publion - Anunturi Gratuite - Timisoara - Vanzari - Cumparari";
		}
		else if(!$Article[0]['articles']['title']){ 
			$title_for_layout = substr($Article[0]['articles']['descr'],0,20)."  Publion - Anunturi Gratuite - Timisoara - Vanzari - Cumparari";
		}

		if(!isset($title_for_layout)){
			$title_for_layout = "Publion - Anunturi Gratuite - Timisoara - Vanzari - Cumparari - Anunturi cu Poza";
		}
		?>
	
		<title><?php echo $title_for_layout; ?></title>

		<!-- 
			This website is powered by CAKEPHP - 
			CakePHP : the rapid development php framework 
			CakePHP enables PHP users at all levels to rapidly develop robust web applications.

			CAKEPHP is a free open source Framework licensed under GNU/GPL.
			Information and contribution at http://cakephp.org/
		-->

		<meta name="description" content=" Publion - Anunturi Gratuite - Anunturi on-line,  Imobiliare, Locuri de munca, Prestari servicii, Auto-Moto-Velo,  Uz casniz, Mobilier, Tv-Audio-Vodeo, Telefoane, Calculatoare, Carti-Reviste, Obiecte de arta, Animale de casa, Agricole, Utilaje, Pierderi-Gasiri, Matrimoniale, Sport-Foto, Diverse, Afaceri, Medicale, Hobby.">
		<meta name="keywords" content="ro, romania, romanesc, romanesti, gratuit, gratuite, anunturi, mica publicitate, vanzari, cumparari, imobiliare, bucuresti,timisoara, afaceri" >

		<META NAME="Robots" CONTENT="All">
		<meta name="resource-type" content="document">
		<meta name="revisit-after" content="5 days" >

		<meta name="distribution" content="Global" >
		<meta name="language" content="Romanian">
		<meta name="generator" content="Crimson Editor - www.crimsoneditor.com" >
		<meta name="rating" content="General" >
		<META name="Copyright" content="Copyright  2009 maran emil">
		<meta http-equiv="Cache-Control" content="no-cache" /> 
		<meta http-equiv="Expires" content="0" />
		<!-- <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" /> -->
		


		<?
			if(strstr($_SERVER['HTTP_USER_AGENT'],'MSIE 7.')){
				//echo '<meta http-equiv="X-UA-Compatible" content="IE=7" />';
				//<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
			}
		?>

		<?php echo $html->meta('icon'); ?>
		<?php echo $html->css('default'); ?>
		<?php // echo $html->css('media_queries'); ?>

		

		<?php echo $html->css('jquery-impromptu.3.1'); ?>	
		<?php echo $html->css('tipTip'); ?>
	
		<?php  echo $javascript->link('jquery'); ?>
		<?php  echo $javascript->link('customweb'); ?>
		<!-- jquery.tipTip -->
		<?php  echo $javascript->link('jquery.tipTip.minified'); ?>
		<!-- jquery-impromptu -->
		<?php  echo $javascript->link('jquery-impromptu.3.1'); ?>
		<?php  echo $javascript->link('jquery_cookie'); ?>

		<?php //echo $head->registered() ?>
	
		<?php if ($session->check('Message.flash')): ?>
			<?php echo $javascript->link('flash_message'); ?>
			<?php echo $html->css('flash_message'); ?>
		<?php endif; ?>
	
		<?php
		if(isset($scripts_for_layout)) echo $scripts_for_layout; 
		?>

		<script type="text/javascript">
		// tiptip tooltip jquery
		$(function(){
			$(".tipnfo").tipTip({ maxWidth: "200px", edgeOffset: 10}); // 
		});
		
		</script>
		
		<!-- 
		<?php // print_r($_SERVER); ?>
		<?php //echo $_SERVER["REQUEST_URI"]; ?> 
		<?php //echo $this->params['controller'];?> 
		-->

		<!--[if IE ]>
			<?php echo $html->css('default_ie'); ?>
			
		<![endif]-->


		<? if(    strstr($_SERVER["REQUEST_URI"],"matrimoniale") || $Article[0]['articles']['category_id']==8  ){ ?>
		<script type="text/javascript">

			$(function(){

					// http://trentrichardson.com/Impromptu/index.php
					 $.Promtnow = function(){

						//$.cookie('adultcheck','1', { domain: '.'+location.host , path: '/' });

						$.prompt(
							'Pagina pe care doriti sa o accesati poate sa contina elemente care nu sunt recomandate minorilor! Va rugam sa confirmati ca aveti peste 18 ani!',
							{
								buttons:[
									{title: 'Am peste 18 ani', value: true},
									{title: 'Nu am implinit 18 ani', value: false}
								], 
								submit: function(e,v,m,f){
									//alert(v);
									if(v==false){

										//$.cookie('adultcheck','1', { domain: '.'+location.host , path: '/' });
										
										//window.location = "http://publion.ro";
										//setCoockiePublion();
										$.cookie('adultcheck','0', { domain: '.'+location.host , path: '/' });

										setTimeout(
											function(){
												location.href = "http://publion.ro";
												location.replace("http://publion.ro");
											},100
										)

	

									}
									else{

										$.cookie('adultcheck','1', { domain: '.'+location.host , path: '/' });
										
										setTimeout(
											function(){
												//location.href = "http://publion.ro";
												//location.replace("http://publion.ro");
											},900
										)
									}
								}
								,opacity: 0.9
							}
						);
					}


					function setCoockiePublion(){
						
					}
					
					/*setTimeout(
						function(){*/
							if( !$.cookie('adultcheck') || $.cookie('adultcheck')==0 ){
								$.Promtnow();
							}
						/*},100
					)*/

				});
			</script>
		<?}?>




	</head>

<body id="top">

<div id="page">

	<!-- HEADER -->
	<div id="header">
		<div id="header_middle">

			<div id="header_middleBox">
			<!--  HEADER_LOGO -->
			<div id="header_logo">
				<a href="<?=$this->webroot?>">
					<img src="<?=$this->webroot?>img/po_logo.png" width="200" height="38" border="0" alt="">
				</a>
			</div>
			<!--  HEADER_LOGO -->
				<!--  SEARCH -->
				<div id="searchBox">
								<?php 
								
								$selectedController = $this->params['controller']; // read current controller
								$selectedAction = $this->params['action']; // read selected action

								if($selectedController=="cars"){
									echo $form->create('Search',array('id'=>"searchform",'type'=>"get",'url'=>"/cars/searcharticle/"));
								}
								else if($selectedController=="houses"){
									echo $form->create('Search',array('id'=>"searchform",'type'=>"get",'url'=>"/houses/searcharticle/"));
								}
								else if($selectedController=="firms"){
									echo $form->create('Search',array('id'=>"searchform",'type'=>"get",'url'=>"/firms/searchfirma/"));
								}
								else if($selectedController=="recipes"){
									echo $form->create('Search',array('id'=>"searchform",'type'=>"get",'url'=>"/recipes/searchrecipename/"));
								}
								else{
									echo $form->create('Search',array('id'=>"searchform",'type'=>"get",'url'=>"/articles/searcharticle/"));
								}

								
								?>
								<label id="cautare"> Cauta </label>
								<input type="text" name="searchq" id="searchq" value=""  onfocus = 'this.value=""' />
								<input type="submit" name="submitpub" id="submitpub" value=">" />
								</form>
				</div>
				<!--  SEARCH -->
				<div class="clearer"></div>
			</div>

		</div>
		<div id="header_bottom">
			<ul>
				<li><a href="<?=$this->webroot?>articles/imobiliare/" class="li_title">Imobiliare</a></li>
				<li><a href="<?=$this->webroot?>houses/" class="li_title">+ Speciale</a></li>
				<li><a href="<?=$this->webroot?>articles/imobiliare/vanzari/">+ Vanzari</a></li>
				<li><a href="<?=$this->webroot?>articles/imobiliare/cumparari/">+ Cumparari</a></li>
				<li><a href="<?=$this->webroot?>articles/imobiliare/inchirieri/">+ Inchirieri</a></li>
				<li><a href="<?=$this->webroot?>articles/imobiliare/schimburi/">+ Schimburi</a></li>
			</ul>
			<ul>
				<li><a href="<?=$this->webroot?>articles/automoto/" class="li_title">AutoMotto</a></li>
				<li><a href="<?=$this->webroot?>cars/" class="li_title">+ Speciale</a></li>
				<li><a href="<?=$this->webroot?>articles/automoto/vanzare/">+ Vanzare</a></li>
				<li><a href="<?=$this->webroot?>articles/automoto/cumparare/">+ Cumparare</a></li>
				<li><a href="<?=$this->webroot?>articles/locuridemunca/" class="li_title">Locuri de munca</a></li>
				<li><a href="<?=$this->webroot?>articles/locuridemunca/cereri/">+ Cereri</a></li>
				<li><a href="<?=$this->webroot?>articles/locuridemunca/oferte/">+ Oferte</a></li>
			</ul>
			<ul>
				<li><a href="<?=$this->webroot?>articles/calculatoare/" class="li_title">Calculatoare</a></li>
				<li><a href="<?=$this->webroot?>articles/calculatoare/componente/">+ Componente</a></li>
				<li><a href="<?=$this->webroot?>articles/calculatoare/servicii/">+ Servicii</a></li>
				<li><a href="<?=$this->webroot?>articles/calculatoare/sisteme/">+ Sisteme</a></li>
				<li><a href="<?=$this->webroot?>articles/calculatoare/software/">+ Software</a></li>
				<li><a href="<?=$this->webroot?>articles/produse/" class="li_title">Vestimentatie</a></li>
				<li><a href="<?=$this->webroot?>articles/produse/imbracaminte/">+ Imbracaminte</a></li>
				<li><a href="<?=$this->webroot?>articles/produse/incaltaminte/">+ Incaltaminte</a></li>
				<li><a href="<?=$this->webroot?>articles/produse/cosmetice/">+ Cosmetice</a></li>
			</ul>
			<ul>
				<li><a href="<?=$this->webroot?>articles/constructii/" class="li_title">Constructii</a></li>
				<li><a href="<?=$this->webroot?>articles/constructii/materiale/">+ Materiale</a></li>
				<li><a href="<?=$this->webroot?>articles/constructii/utilaje/">+ Utilaje</a></li>
				<li><a href="<?=$this->webroot?>articles/electronice/" class="li_title">Electronice</a></li>
				<li><a href="<?=$this->webroot?>articles/electronice/audio_video/">+ Audio Video</a></li>
				<li><a href="<?=$this->webroot?>articles/electronice/telefoane/">+ Telefoane</a></li>
				<li><a href="<?=$this->webroot?>articles/electronice/uz_casnic/">+ Uz casnic</a></li>
			</ul>
			<ul>
				<li><a href="<?=$this->webroot?>articles/diverse/" class="li_title">Diverse</a></li>
				<li><a href="<?=$this->webroot?>articles/diverse/agricultura/">+ Agricultura</a></li>
				<li><a href="<?=$this->webroot?>articles/diverse/antichitati/">+ Antichitati</a></li>
				<li><a href="<?=$this->webroot?>articles/diverse/carti/">+ Carti</a></li>
				<li><a href="<?=$this->webroot?>articles/diverse/diverse/">+ Diverse</a></li>
				<li><a href="<?=$this->webroot?>articles/diverse/hobby/">+ Hobby</a></li>
				<li><a href="<?=$this->webroot?>articles/diverse/servicii/">+ Servicii</a></li>
			</ul>
			<ul>
				<li><a href="<?=$this->webroot?>articles/diverse/animale/">+ Animale</a></li>
				<li><a href="<?=$this->webroot?>articles/matrimoniale/" class="li_title">Matrimoniale</a></li>
				<li><a href="<?=$this->webroot?>articles/matrimoniale/barbati/">+ Barbati</a></li>
				<li><a href="<?=$this->webroot?>articles/matrimoniale/femei/">+ Femei</a></li>
				<li><a href="<?=$this->webroot?>articles/funerare/" class="li_title">Funerare</a></li>
				<li><a href="<?=$this->webroot?>articles/funerare/decese/">+ Comemorari</a></li>
				<li><a href="<?=$this->webroot?>articles/funerare/servicii/">+ Servicii</a></li>
			</ul>

			<div id="login_head">
				<?if($session->read("User.username")){?>
					<a href="<?=$this->webroot?>users/logout/">
						Iesire <!-- <img src="<?=$this->webroot?>img/po_hd_bt_logout.png" border=0> -->
					</a>
				<?}else{?>
					<a href="<?=$this->webroot?>users/login/">
						Contul meu<!-- <img src="<?=$this->webroot?>img/po_hd_bt_login.png" border=0> -->
					</a>
				<?}?>
				<?if(!$session->read("User.username")){?>
					<a href="<?=$this->webroot?>users/register/">
						Inregistrare
					</a>
				<?}?>
					<a href="<?=$this->webroot?>articles/step1/">
						Adauga anunt
					</a>
			</div>
		</div>
		
	</div>


	<!-- HEADER -->

	<div id="contBoxMid">
			<!--  ==================  CONT =============================  -->
			<div id="cont" style="">
