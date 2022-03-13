<?php
// Creo il navigatore.
//$html->addCrumb(__("Home", TRUE), "/");

// &listtype=1

$listtype = $this->params['url']['listtype'];
if (!$listtype) {
    $listtype = 2;
}
if ($listtype === 1) {
    $renderElemSel = "article_list";
}
else if ($listtype === 2) {
    $renderElemSel = "article_thumb";
}
else if ($listtype === 3) {
    $renderElemSel = "article";
}

$arrPromo = array("70", "2920", "70", "70");
$usrPromo = $arrPromo[mt_rand(0, count($arrPromo) - 1)];
$artPromo = $this->requestAction('articles/getlastarticlebyuser/' . $usrPromo);
//print_r($artPromo);

/*
Array ( [0] => Array ( [Article] => Array ( [id] => 101360 [category_id] => 4 [subcategory_id] => 15 [title] => Traduceri Bistrita Nasaud Sangeorz-bai [descr] => Servicii de traducere specializate = calitate ridicata = succes garantat = pretul corect = partenerul preferat. Araba Engleza Greaca Macedoneana Rusa Bulgara Norvegiana Italiana Maghiara Sarba Turca Olandeza Ceha Franceza Finlandeza Polona Slovaca Slovena Bosniaca Croata Lituaniana Portugheza Spaniola Ucraineana Japoneza Ebraica Daneza Suedeza Romana Latina Estona Letona Azera Chineza Persana Germana. Solicitati cotatie de pret instant telefonic 0731010801 sau via e-mail: info@traduceri-romania.ro Roxana Zamolo 14 RON [phone] => 0763195439 [date] => 2009-11-20 [image] => 20091120073250.jpg [price] => 14 [webpage] => http://www.traduceri-romania.ro [views] => 0 [adult] => 0 [ip1] => [ip2] => 188.25.64.163 [user_id] => 153 ) [User] => Array ( [id] => 153 [username] => anuntweb@yahoo.com [password] => cb86acd4b73b817e4b4135f816863958 [nickname] => anonim [e-mail] => anuntweb@yahoo.com [rights] => 0 [active] => true [online] => true [name] => Anunt [pastname] => web [image] => [created] => 2009-10-07 14:59:03
*/

// http://publion.ro/img/upload/201109/20110927085646.jpg
// /img/upload/20100206/20100206054918.jpg
// http://publion.ro/img/upload/201002/20100206054918.jpg

foreach ($this->requestAction('articles/getlastarticlebyuser/' . $usrPromo) as $ArtPubPro) {
    ?>
    <!-- <div class="item_list_thumb" style="">
			<div class="item_content_imgbox">
				<a href='<?php echo $this->webroot; ?>articles/view/<?= $ArtPubPro['Article']['id'] ?>'>
					<img src='<?php echo $this->webroot; ?>img/upload/<?= substr(str_replace("-", "", $ArtPubPro['Article']['date']), 0, 6) ?>/<?= $ArtPubPro['Article']['image'] ?>' width=200 class='item_img' border=0>
				</a>
			</div>
			<div class="item_content">
				<a href='/articles/view/<?= $ArtPubPro['Article']['id'] ?>' >
					<?php echo ucfirst(substr($ArtPubPro['Article']['title'], 0, 35)) ?>
				</a>...<br>
				<p>
					Adaugat  la <?php echo sprintf(__(" la %s", true), AppController::Db2StrDate($ArtPubPro['Article']['date'])); ?>
				</p>

			</div>
			<div class="clearer"></div>
		</div> -->

    <?php
}
?>


<?php foreach ($arTmpArt as $sTmpArt): ?>
    <?php echo $this->renderElement($renderElemSel, $sTmpArt); ?>
<?php endforeach; ?>

<?php echo $this->renderElement('pagination', $paging); ?>
<?php echo $this->renderElement('listtype', ''); ?>


