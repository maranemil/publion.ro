<?php

$ArFld = substr(str_replace("-", "", $Article['date']), 0, 6); // MONTHLY FOLDER PATH
if (($Article['image'] != null) && (filesize(ROOT . "/app/webroot/img/upload/" . $ArFld . "/" . $Article['image']) > 8000)) {
   $sImgAr = "<a href='" . $this->webroot . "articles/view/" . $Article['id'] . "'>";
   // ".str_replace(array(',',' ','-','.','/',':','?',';','(',')') ,'_',strip_tags(substr($Article['descr'],0,70))).".htm

   $sImgAr .= "<img src='" . $this->webroot . "img/upload/" . $ArFld . "/" . trim($Article['image']) . "' width=200 class='item_img' border=0></a>";
}
else {
   $sImgAr = "<a href='" . $this->webroot . "articles/view/" . $Article['id'] . "'>";
   //".str_replace(array(',',' ','-','.','/',':','?',';','(',')') ,'_',strip_tags(substr($Article['descr'],0,70))).".htm

   $sImgAr .= "<img src='" . $this->webroot . "img/upload/noimg.jpg' width=200 class='item_img' border=0></a>";
   //echo "<a href='".$this->webroot."articles/view/".$Article['id']."/'><img src='".$this->webrootROOT."img/upload/noimg.jpg' width=150></a>";
}
?>

<div class="item_list" style="">
    <div class="item_content_imgbox">
	   <?= $sImgAr ?>
    </div>
    <div class="item_content">
        <h3>
		   <? if ($Article['title']) { ?>
               <a href="<?= $this->webroot . "articles/view/" . $Article['id']; ?>">
				  <?php
				  $arTitle = trim(substr(ucwords($Article['title']), 0, 35)) . '';
				  if ($arTitle == "") $arTitle = strip_tags(substr(ucwords($Article['descr']), 0, 35)) . '';
				  echo $arTitle;
				  ?> ...
               </a>
		   <? } ?>
        </h3>
        Adaugat <?php echo sprintf(__(" la %s", true), AppController::Db2StrDate($Article['date'])); ?> <br/>
        Telefon: <?php echo $Article['phone'] . ' '; ?><br/>
        Afisari: <?php echo $Article['views'] . ' '; ?> <br/>
        Cod: <?php echo $html->link('s' . $Article['id'], "/articles/view/" . $Article['id'] . "/" . str_replace(array(" ", "+", "-"), "_", $Article['title'])); ?> <br/><br/>
        <img src="<?= $this->webroot ?>img/list_item_vote.png" border="0" alt="">
    </div>
    <div class="clearer"></div>
</div>

<!--  <a href="<?= $this->webroot . "articles/showcategory/" . $Article['category_id']; ?>"> Categorie:
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
<? // echo Sanitize::html(ucwords(substr($Article['descr'],0,200))); ?>
	
