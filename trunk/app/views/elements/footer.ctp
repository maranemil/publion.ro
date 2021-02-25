<div class="clearer"></div>
<!-- footer -->

</div>
<!--  ==================  CONT =============================  -->

<!--  ==================  NAVRIGHT =============================  -->
<div id="navright">

   <? if ($session->read("User.username")) { ?>
       <div id="navRtBox4" style="">
           <div id="navRtBox4Ins" style="">
               <h3 style="font: bold 11px arial; color: white; padding: 10px 0 0 25px; margin: 0px">Zona Administrare Date</h3>
               <ul style="margin-left: 30px; padding:0px">
				  <? if ($session->read("User.username")) { ?>
                      <!-- <ul class="sidebarprofile"> -->
                      <li><a href="<?= $this->webroot ?>articles/step1/">+ Adauga Anunt Simplu</a></li>
                      <li><a href="<?= $this->webroot ?>cars/step1/">+ Adauga Anunt Auto</a></li>
                      <li><a href="<?= $this->webroot ?>houses/step1/">+ Adauga Anunt Imobiliare</a></li>
                      <li><a href="<?= $this->webroot ?>users/myentries/<?= $session->read("User.id") ?>">+ Anunturile Mele</a></li>
                      <li><a href="<?= $this->webroot ?>users/myfavs/<?= $session->read("User.id") ?>">+ Anunturile Mele Favorite</a></li>

				  <? } ?>
               </ul>
               <ul>
				  <? if ($session->read("User.username")) { ?>
                      <!-- <ul class="sidebarprofile"> -->
                      <li><a href="<?= $this->webroot ?>users/view/<?= $session->read("User.id") ?>">+ Profilul meu</a></li>
                      <li><a href="<?= $this->webroot ?>users/myfriends/<?= $session->read("User.id") ?>">+ Prietenii mei</a></li>
                      <li><a href="<?= $this->webroot ?>users/myprofile/<?= $session->read("User.id") ?>">+ Modificare Date</a></li>
                      <li><a href="<?= $this->webroot ?>messages/index/<?= $session->read("User.id") ?>">+ Messaje Inbox</a></li>
                      <li><a href="<?= $this->webroot ?>users/changepassword/<?= $session->read("User.id") ?>">+ Schimbare Parola</a></li>
                      <li><a href="<?= $this->webroot ?>users/logout/<?= $session->read("User.id") ?>">+ Logout</a></li>
				  <? } ?>
               </ul>

           </div>
       </div>
   <? } ?>

    <div class="navDefaultRtBox">
        <a href="http://stiri.publion.ro" alt="Stiri Publion" title="Stiri Publion" title="Stiri Publion">Stiri Publion</a>
    </div>

    <div class="navDefaultRtBox">
        <a href="<?= $this->webroot ?>houses/">Anunturi Immo Speciale</a>
    </div>

    <div class="navDefaultRtBox">
        <a href="<?= $this->webroot ?>cars/">Anunturi Auto Speciale</a>
    </div>

    <a href="http://iliesirbu.publion.ro/" target="_blank">
        <img src="<?= $this->webroot ?>img/iliesirbubanner.png"/>
    </a>

    <!-- <div style="margin-left: 30px; margin-top: 10px; padding:0px; font: normal 12px Calibri; color: #fff">
	Din cauza unor probleme tehnice de functionare, am pierdut toate anunturile din ultimele 3 luni precum si toti utilizatorii inregistrati pe site dupa data de 26 Noiembrie 2011.
	Ne cerem scuze pentru acest inconvenient si va multumim pentru intelegere. <br /><br />
	Echipa Publion
	</div> -->

    <div id="navRtBox5" style="">
        <div id="navRtBox5Ins">
		   <?
		   foreach ($this->requestAction("/articles/getrandomarticletags/5") as $sBook) {
			  $arTags = explode(" ", $sBook["articles"]["title"]);
			  //echo ' <A style="font: bold '.$myfont.'px arial; margin-right: 10px;" HREF="'.$this->webroot.'videos/search?searchq='.trim($sVideo["videos"]["tags"]).'">'.ucfirst($sVideo["videos"]["tags"]).'</A> ';
			  foreach ($arTags as $sSnTag) {
				 if (strlen($sSnTag) > 3) {
					$myfont = rand(8, 18);
					//$sSnTag = preg_replace("/[^\w\-]+/",' ' ,$sSnTag);
					$sSnTag = preg_replace("/[^\w\.]+/", ' ', $sSnTag);
					echo ' <a style="font: bold ' . $myfont . 'px Calibri, Arial; margin-right: 5px;" HREF="' . $this->webroot . 'articles/searcharticle/?searchq=' . trim($sSnTag) . '">' . ucfirst($sSnTag) . '</A> ';
				 }
			  }
		   }
		   ?>
        </div>
    </div>

    <div id="navRtBox1" style="">
        <div id="navRtBox1Ins" style="">

            <ul style="margin-left: 30px; padding:0px">
                <li><a href="<?= $this->webroot ?>firms/">+ Firme</a></li>
                <li><a href="<?= $this->webroot ?>recipes/">+ Retete Culinare</a></li>
                <li><a href="<?= $this->webroot ?>zipcodes/">+ Coduri Postale</a></li>
                <li><a href="<?= $this->webroot ?>infos/ambasade">+ Ambasade</a></li>
                <li><a href="<?= $this->webroot ?>infos/consulate">+ Consulate</a></li>
                <li><a href="<?= $this->webroot ?>articles/statistics/20">+ Statistici Anunturi</a></li>
                <li><a href="<?= $this->webroot ?>articles/toparticles">+ Top Anunturi </a></li>
                <li><a href="<?= $this->webroot ?>users/register/">+ Inregistrare</a></li>
            </ul>
            <ul>
                <li><a href="<?= $this->webroot ?>medics/">+ Medici Jud. Timis</a></li>
                <li><a href="<?= $this->webroot ?>drugstores/">+ Farmacii Jud. Timis</a></li>
                <li><a href="<?= $this->webroot ?>infos/telefoaneutile">+ Telefoane Utile</a></li>
                <li><a href="<?= $this->webroot ?>infos/prefixeromania">+ Prefixe Romania</a></li>
                <li><a href="<?= $this->webroot ?>infos/prefixetari">+ Prefixe Internationale</a></li>
                <li><a href="<?= $this->webroot ?>cars/">+ Auto Speciale </a></li>
                <li><a href="<?= $this->webroot ?>houses/">+ Imobiliare Speciale </a></li>
            </ul>

        </div>
    </div>

    <div id="navRtBox2" style="">
        <div id="navRtBox2Ins" style="">

            <ul>
			   <?php foreach ($this->requestAction('users/lastusers/20') as $user): ?>

				  <? if ($user['User']['image']) { ?>
                       <li>
                           <a href="<?= $this->webroot ?>articles/articlesbyuser/<?= $user['User']['id'] ?>">
                               <div style="width:45px; height:45px; overflow: hidden; background: white">
                                   <img src="<?= $this->webroot ?>img/user/<?= $user['User']['image'] ?>" border=0 style="width:58px;">
                               </div>
							  <? if ($user['User']['nickname'] == "anonim" && $user['User']['name']) {
								 $user['User']['nickname'] = strtolower($user['User']['name']);
							  } ?>
							  <?= strtolower(substr($user['User']['nickname'], 0, 10)) ?>
                           </A>
                       </li>

				  <? } else { ?>
                       <li>
                           <a href="<?= $this->webroot ?>articles/articlesbyuser/<?= $user['User']['id'] ?>">
                               <div style="width:45px; height:45px; overflow: hidden; background: white">
                                   <img src="<?= $this->webroot ?>img/user/usericon.jpg" border=0 width="58">
                               </div>
							  <? if ($user['User']['nickname'] == "anonim" && $user['User']['name']) {
								 $user['User']['nickname'] = strtolower($user['User']['name']);
							  } ?>
							  <?= strtolower(substr($user['User']['nickname'], 0, 10)) ?>
                           </A>
                       </li>
				  <? } ?>

			   <?php endforeach; ?>
            </ul>

        </div>
    </div>

    <div id="navRtBox3" style="">
        <div id="navRtBox3Ins" style="">

            <ul>
                <li><a href="http://www.ro-imobiliare.ro" target="_blank"> Anunturi Imobiliare</a></li>
                <li><a href="http://www.anunturi.micportal.ro/" target="_blank"> Anunturi Gratuite</a></li>
                <li><a href="http://egalati.ro" target="_blank"> Anunturi Galati</a></li>
                <li><a href="http://www.e-oferta.ro" target="_blank"> e-oferta.ro</a></li>
                <li><a href="http://www.boing.ro" target="_blank"> boing.ro</a></li>
                <li><a href="http://www.productiefilm.ro" target="_blank"> Productie Film</a></li>
                <li><a href="http://www.whitewedding.ro" target="_blank"> whitewedding.ro</a></li>
                <li><a href="http://www.povesticutalc.ro" target="_blank"> Povesti cu talc</a></li>
                <li><a href="http://www.scubadiver.ro" target="_blank"> Scufundari in Romania</a></li>
                <li><a href="http://www.casa-mea.ro" target="_blank"> Evaluari Imobiliare Timisoara</a></li>
            </ul>
            <ul>
                <li><a href="http://www.lugomet.ro" target="_blank"> lugomet.ro</a></li>
                <li><a href="http://www.episcopiacaransebesului.ro" target="_blank"> Radio Milos</a></li>
                <li><a href="http://www.episcopiacaransebesului.ro" target="_blank"> Episcopia Caransebesului</a></li>
                <li><a href="http://adi-electric.bbros.ro" target="_blank"> Adi-Electric</a></li>
                <li><a href="http://betonalessia.ro" target="_blank"> Beton Alessia</a></li>
                <li><a href="http://portavoce.ro" target="_blank"> portavoce.ro</a></li>
                <li><a href="http://www.agentiadeanunturi.ro" target="_blank"> agentiadeanunturi.ro</a></li>
                <li><a href="http://www.mediana.ro" target="_blank"> Agentia Mediana</a></li>
                <li><a href="http://www.dauanunt.ro" target="_blank"> www.dauanunt.ro</a></li>
                <li><a href="http://www.ploua.ro" target="_blank"> Vremea in Romania</a></li>

            </ul>
        </div>
    </div>

    <div class="clearer"></div>
</div>
<!--  ==================  NAVRIGHT =============================  -->

<div class="clearer"></div>

</div>

<!-- FOOTER -->

<div id="footer">

    <a href="http://cakephp.org/" target="_blank">
        <img src="<?= $this->webroot ?>img/cake.power.gif" width="98" height="13" border=0 alt="CakePHP: the rapid development php framework"/>
    </a>

    <p>
        <B>2004-2010 (c) CASIL SRL Timisoara. <br>
            Versiune beta 1. Toate drepturile rezervate.<br>
            Pagina electronica realizata de <a href="http://maran-emil.de" target="_blank"> Maran Emil Cristian</a></B><br>
        CakePHP: the rapid development php framework
        <br><br>

        <a href="<?= $this->webroot ?>infos/terms">Termeni</a> |
        <a href="<?= $this->webroot ?>infos/contact">Contact</a> |
        <a href="<?= $this->webroot ?>infos/faq">Faq</a>
    </p>

    <p> &nbsp; </p>

   <?
   if (!strstr($_SERVER["HTTP_HOST"], "localhost")) {
	  ?>
       <p> &nbsp; </p>

       <!-- BEGIN trafic.ro code v2.0 -->
       <script>
		   t_rid = "publionro";
		   t_domain = "publion.ro";
       </script>
       <script src="http://storage.trafic.ro/js/trafic.js"></script>
       <noscript><a href="http://www.trafic.ro/top/?rid=publionro"
                    target=_blank><img border=0 alt="trafic ranking"
                                       src="http://log.trafic.ro/cgi-bin/pl.dll?rid=publionro"></a>
       </noscript>

       <!-- <script type="text/javascript">t_rid="publionro";</script>
	   <script type="text/javascript" src="http://storage.trafic.ro/js/trafic.js"></script> -->

       <!-- END trafic.ro code v2.0 -->
       <!-- Start Linkuri.ro -->
       <a href="http://www.linkuri.ro/script/linkuri.php?id=2406834" target="_blank">
           <img src="http://www.linkuri.ro/im/linkuri1.gif" border=0></a>
       <!-- Este important ca parametrul href sa ramana intact, pentru a inregistra corect hiturile. -->
       <!-- End Linkuri.ro -->

       <a href="http://www.roportal.ro/jocuri/" target="_blank">
           <img src="http://www.roportal.ro/roportal.gif" alt="Jocuri online - Roportal" border="0" width="90" height="30">
       </a>
       <CENTER>
           <a href="http://www.kataremata.ksd.ro" id="R0" target="_blank">Kataremata</a> |
           <a href="http://www.director-web.net" target="_blank">Director-Web.net</a> |
           <a href='http://www.portalroman.com' target='blank'>Jocuri felicitari filmulete</a> |
           <a href="http://www.adresa.ro/" target="_blank">Portal</a> <BR>
           <a href="http://www.hei.ro/" target="_blank">Cautare</a> |
           <a href="http://www.ldmstudio.com" target="_blank">www.ldmstudio.com</a> |
           <a href="http://www.totaltop.ro/" title="Total Top - Director Web" target="_blank">Total Top Director web</a> |
       </CENTER>

       <p> &nbsp; </p>

	  <?
   }
   ?>

</div>

<!-- FOOTER -->

<?php
//	echo $cakeDebug;
?>

</div>

<a id="uservoice-feedback-tab" href="<?= $this->webroot ?>infos/contact"></a>

</body>
</html>




