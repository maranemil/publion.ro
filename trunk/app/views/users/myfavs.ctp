<?php
// Creo il navigatore.
#$html->addCrumb(__("Home", TRUE), "/");
?>

<div class="contBoxMid">

   <?php
   //print_r($Houses);
   foreach ($Articles as $Article):
	  /*
  $ArFld = substr(str_replace("-","",$Article['Article']['date']),0,6); // MONTHLY FOLDER PATH
  if(($Article['Article']['image']!=NULL)&&(filesize(ROOT."/app/webroot/img/upload/".$ArFld."/".$Article['Article']['image'])>8000)){
	  $imgHTML = "<img src='".$this->webroot."img/upload/".$ArFld."/".trim($Article['Article']['image'])."' width=25>";
  }
	  echo "
	  <div class='myentries'>
		  <div style='float: left'>
			  ".$imgHTML."
		  </div>
		  <div style='float: left'>
			  <img src='".$this->webroot."img/menu_pt.png'>
			  <A HREF='".$this->webroot."articles/view/".$Article['Article']["id"]."' target='_new' class=\"tipnfo\" title=\"Vizualizeaza anunt intro noua fereastra\">
				  Cod ".$Article['Article']["id"]." - Data ".$Article['Article']["date"]."
			  </a> |
			  <img src='".$this->webroot."img/div.gif' width='100' height=0>
			  <img src='".$this->webroot."img/menu_delete.png' class=\"tipnfo\" title=\"Sterge Fav\">
			  <A HREF='".$this->webroot."favs/deletearticle/".$Article['Article']["id"]."' class=\"tipnfo\" title=\"Sterge Fav\">
				  Sterge anunt
			  </a>
			  <br>
		  </div>
		  <div style='clear: both'></div>
	  </div>
	  ";
	  */

	  echo $this->renderElement("article_thumb_fav", $Article);

   endforeach;
   ?>
   <? //echo $this->renderElement('pagination', $paging);?>
   <? //echo $this->renderElement('listtype','');?>

    <div style='clear: both'></div>
</div>
