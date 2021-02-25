<div id="contentBox" style="">
    <div id="articleImg" style="">
	   <?php

	   $ArFld = substr(str_replace("-", "", $Getnew['date']), 0, 6); // MONTHLY FOLDER PATH
	   if ($Getnew['image'] != null) {
		  echo "<a href='" . $this->webroot . "articles/view/" . $Getnew['id'] . "/" . str_replace(array(',', ' ', '-', '.', '/', ':', '?', ';', '(', ')'), '_', strip_tags(substr($Getnew['descr'], 0, 70))) . ".htm'>";

		  echo "<img src='" . $this->webroot . "img/stiri/" . trim($Getnew['image']) . "'></a>";
	   }
	   else {
		  echo "<a href='" . $this->webroot . "articles/view/" . $Getnew['id'] . "/" . str_replace(array(',', ' ', '-', '.', '/', ':', '?', ';', '(', ')'), '_', strip_tags(substr($Getnew['descr'], 0, 70))) . ".htm'>";

		  echo "<img src='" . $this->webroot . "img/upload2/noimg.jpg'></a>";
		  //echo "<a href='".$this->webroot."articles/view/".$Article['id']."/'><img src='".$this->webrootROOT."img/upload/noimg.jpg' width=150></a>";
	   }
	   ?>

    </div>
    <div id="articleTitle" style="">

	   <?php echo $html->link($Getnew['title'], "/getnews/view/" . $Getnew['id'] . "/" . str_replace(array(',', ' ', '-', '.', '/', ':', '?', ';', '(', ')'), '_', strip_tags(substr($Getnew['descr'], 0, 70))) . ".htm"); ?>
        <p>
		   <?php echo sprintf(__("Posted on %s", true), $Getnew['date']); ?><br/>
        </p>

    </div>
    <div id="articleCnt" style="">
	   <?php echo ucwords(substr($Getnew['descr'], 0, 200)); ?><br/><br/>
	   <? // echo Sanitize::html(ucwords(substr($Article['descr'],0,200))); ?>
    </div>
    <div style="clear:both"></div>
</div>

