<?php

$arTitle = ucwords(trim(substr($Article['title'], 0, 35)));
if ($arTitle === "") {
    $arTitle = strip_tags(ucwords(substr($Article['descr'], 0, 35)));
}
//$hrefTitle = trim(substr(ucwords($Article['descr']),0,155)).'...';

$hrefTitle = preg_replace('/[^\d\w]/', ' ', $Article['descr']); // allow only int()& num() numbers - EM 23.02.2010
$hrefTitle = substr($hrefTitle, 0, 105);

$sLnkCode = strtolower(str_replace(array(",", ".", " ", "+"), "-", $Article['title']));
$sLnkCode = str_replace(array("--", "---", "----", "-----"), "-", $sLnkCode);

$ArFld = substr(str_replace("-", "", $Article['date']), 0, 6); // MONTHLY FOLDER PATH
if (($Article['image'] !== null) &&
    (filesize(ROOT . "/app/webroot/img/upload/" . $ArFld . "/" . $Article['image']) > 8000)) {
   $sImgAr = "<a href='" . $this->webroot . "articles/view/" . $Article['id'] . "/" . $sLnkCode . ".html' >"; // class='tipnfo' title='".$hrefTitle."'
   // ".str_replace(array(',',' ','-','.','/',':','?',';','(',')') ,'_',strip_tags(substr($Article['descr'],0,70))).".htm

   $sImgAr .= "<img src='" . $this->webroot . "img/upload/" . $ArFld . "/" . trim($Article['image']) . "' width=200 class='item_img' border=0></a>";
}
else {
   $sImgAr = "<a href='" . $this->webroot . "articles/view/" . $Article['id'] . "'>";
   //".str_replace(array(',',' ','-','.','/',':','?',';','(',')') ,'_',strip_tags(substr($Article['descr'],0,70))).".htm

   $sImgAr .= "<img src='" . $this->webroot . "img/upload/noimg.jpg' width=200 class='item_img' ></a>";
   //echo "<a href='".$this->webroot."articles/view/".$Article['id']."/'><img src='".$this->webrootROOT."img/upload/noimg.jpg' width=150></a>";
}

?>

<div class="item_list_thumb" style="">
    <div class="item_content_imgbox">
	   <?= $sImgAr ?>
    </div>
    <div class="item_content">
        <a href='<?= $this->webroot ?>articles/view/<?= $Article['id'] ?>/<?php echo $sLnkCode; ?>.html'>
		   <?php
		   echo ucfirst(strtolower($arTitle));
		   ?>
        </a>...<br>
        <p>
            Adaugat <?php echo sprintf(__(" la %s", true), AppController::Db2StrDate($Article['date'])); ?>
            <!-- <img src="<?= $this->webroot ?>img/info_ico.png" border="0" class="tipnfo" title="<?= ucfirst(strtolower($hrefTitle)) ?>..."> -->
        </p>

    </div>
    <div class="clearer"></div>
</div>

<!--  <a href="<?= $this->webroot . "articles/showcategory/" . $Article['category_id'] ?>"> Categorie:
					<?php echo $this->requestAction('articles/showcategory/' . $Article['category_id'] . '/'); ?>
				-	<?php echo $this->requestAction('articles/showsubcategory/' . $Article['subcategory_id'] . '/'); ?><br />
			</a> -->

<?php
/*
if($this->params['url']['searchq']){
	$Article['descr'] = str_replace(strtolower($this->params['url']['searchq']),"<span>".$this->params['url']['searchq']."</span>",strtolower($Article['descr']));
}*/
?>
<?php
/*
echo utf8_encode(ucwords(substr($Article['descr'],0,200)));
*/
?>
<?php // echo Sanitize::html(ucwords(substr($Article['descr'],0,200))); ?>
	
