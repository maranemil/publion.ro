<div id="contentBox" style="">
    <div id="articleImg" style="">
	   <?php

	   $ArFld = substr(str_replace("-", "", $House[0]['houses']['date']), 0, 6); // MONTHLY FOLDER PATH
	   if ($House[0]['houses']['image'] != null) {
		  echo "<a href='" . $this->webroot . "houses/view/" . $House[0]['houses']['id'] . "/" . str_replace(array(',', ' ', '-', '.', '/', ':', '?', ';', '(', ')'), '_', strip_tags(substr($House[0]['houses']['descr'], 0, 70))) . ".htm'>";

		  echo "<img src='" . $this->webroot . "img/upload2/" . $ArFld . "/" . trim($House[0]['houses']['image']) . "' width=200></a>";
	   }
	   else {
		  echo "<a href='" . $this->webroot . "houses/view/" . $House[0]['houses']['id'] . "/" . str_replace(array(',', ' ', '-', '.', '/', ':', '?', ';', '(', ')'), '_', strip_tags(substr($House[0]['houses']['descr'], 0, 70))) . ".htm'>";

		  echo "<img src='" . $this->webroot . "img/upload2/noimg.jpg' width=200></a>";
		  //echo "<a href='".PATHWEB."articles/view/".$Article['id']."/'><img src='".PATHWEBROOT."img/upload/noimg.jpg' width=150></a>";
	   }
	   ?>

    </div>
    <div id="articleTitle">
	   <?php echo ucwords($House[0]['houses']['type']); ?> / <?php echo ucwords($House[0]['houses']['price']); ?><br/>

        Cod Anunt:
	   <?php echo $html->link('i' . $House[0]['houses']['id'], "/houses/view/" . $House[0]['houses']['id'] . "/" . str_replace(array(',', ' ', '-', '.', '/', ':', '?', ';', '(', ')'), '_', strip_tags(substr($House[0]['houses']['info'], 0, 70))) . ".htm"); ?>

        <p>
		   <?php echo sprintf(__("Posted on %s", true), AppController::Db2StrDate($House[0]['houses']['date'])); ?><br/>
		   <?php echo $House[0]['houses']['phone'] . ' '; ?><br/>
            Views: <?php echo $House[0]['houses']['views'] . ' '; ?><br/><br/>
        </p>

    </div>
    <div id="articleCnt" style="">

	   <?php echo ucwords(substr($House[0]['houses']['info'], 0, 200)); ?><br/><br/>

	   <? //print_r($this->requestAction("houses/getjudetnamebyid/".$House[0]['houses']['state']))?>
	   <?
	   $judArTmp = $this->requestAction("houses/getjudetnamebyid/" . $House[0]['houses']['state']);
	   $judName  = $judArTmp[0]["Judet"]["judet"];
	   ?>

        ADRESA: <br/>
        JUDET: <?php //echo $House[0]['houses']['state']; ?>  <? echo $judName ?> <br/>
        ORAS: <?php echo $House[0]['houses']['town']; ?><br/>
        STRADA: <?php echo $House[0]['houses']['street']; ?><br/>
        ZONA: <?php echo $House[0]['houses']['position']; ?><br/>
        PERSOANA CONTACT: <?php echo $House[0]['houses']['person']; ?><br/>
        EMAIL: <?php echo $House[0]['houses']['email']; ?><br/>
        WEB: <a href="http://<?php echo str_replace("http://", "", $House[0]['houses']['web']); ?>" target="_new"><?php echo $House[0]['houses']['web']; ?></a><br/>

	   <? // echo Sanitize::html(ucwords(substr($Article['descr'],0,200))); ?>
        <br/><br/>
    </div>
    <div style="clear:both"></div>
   <?
   $gmapQuery = $House[0]['houses']['street'] . '+' . $House[0]['houses']['town'] . '+' . $judName . '+Romania';
   ?>

    <script type="text/javascript"
            src="http://api.maps.yahoo.com/ajaxymap?v=3.8&appid=ImJmgPzV34E1wQKS5ApJlwLmuXWQYfMRotCLmm2iGT.KgX3hov3N1U1G556zIg6pUQ--"></script>

    <div id="map" style='height: 400px; width: 400px; border: 2px solid #333; '></div>

    <script type="text/javascript">
		// Create a map object
		const map = new YMap(document.getElementById('map'));
		// Add map type control
		map.addTypeControl();
		// Add map zoom (long) control
		map.addZoomLong();
		// Add the Pan Control
		map.addPanControl();
		// Set map type to either of: YAHOO_MAP_SAT, YAHOO_MAP_HYB, YAHOO_MAP_REG
		map.setMapType(YAHOO_MAP_REG);
		// Display the map centered on a geocoded location
		map.drawZoomAndCenter("<?=$gmapQuery?>", 4);

    </script>

</div>

<? echo $this->renderElement('googlemain1'); ?>

<div style="clear:both"></div>

