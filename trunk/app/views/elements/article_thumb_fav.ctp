<?php

$arTitle = trim(substr(ucwords($Article['title']), 0, 35)) . '';
if ($arTitle == "") $arTitle = strip_tags(substr(ucwords($Article['descr']), 0, 35)) . '';
$hrefTitle = trim(substr(ucwords($Article['descr']), 0, 155)) . '...';

$ArFld = substr(str_replace("-", "", $Article['date']), 0, 6); // MONTHLY FOLDER PATH
if (($Article['image'] != null) && (filesize(ROOT . "/app/webroot/img/upload/" . $ArFld . "/" . $Article['image']) > 8000)) {
   $sImgAr = "<a href='" . $this->webroot . "articles/view/" . $Article['id'] . "' >"; // class='tipnfo' title='".$hrefTitle."'
   // ".str_replace(array(',',' ','-','.','/',':','?',';','(',')') ,'_',strip_tags(substr($Article['descr'],0,70))).".htm

   $sImgAr .= "<img src='" . $this->webroot . "img/upload/" . $ArFld . "/" . trim($Article['image']) . "' width=180 class='item_img' border=0></a>";
}
else {
   $sImgAr = "<a href='" . $this->webroot . "articles/view/" . $Article['id'] . "'>";
   //".str_replace(array(',',' ','-','.','/',':','?',';','(',')') ,'_',strip_tags(substr($Article['descr'],0,70))).".htm

   $sImgAr .= "<img src='" . $this->webroot . "img/upload/noimg.jpg' width=150 class='item_img' border=0></a>";
   //echo "<a href='".$this->webroot."articles/view/".$Article['id']."/'><img src='".$this->webrootROOT."img/upload/noimg.jpg' width=150></a>";
}

?>

<div class="item_list_thumb" style="">
    <div class="item_content_imgbox">
	   <?= $sImgAr ?>
	   <?

	   ?>
    </div>
    <div class="item_content">
        <a href='<?= $this->webroot ?>articles/view/<?= $Article['id'] ?>'>
		   <?php
		   echo $arTitle;
		   ?>
        </a>...<br>
        <p>
            Adaugat <?php echo sprintf(__(" %s", true), AppController::Db2StrDate($Article['date'])); ?>
            <img src="<?= $this->webroot ?>img/info_ico.png" border="0" class="tipnfo" title="<?= $hrefTitle ?>">

            <A HREF='<?= $this->webroot ?>favs/deletefav/<?= $Article["id"] ?>' class="tipnfo" title="Sterge Fav">
                <img src='<?= $this->webroot ?>img/menu_delete.png' class="tipnfo" title="Sterge Fav" border=0>
            </a>

        </p>

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
	
