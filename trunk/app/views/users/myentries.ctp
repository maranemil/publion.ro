<?php
// Creo il navigatore.
#$html->addCrumb(__("Home", TRUE), "/");
?>

<div class="infoBox">
    <span>Anunturile mele</span><BR><BR>

    <p>
	   <?php
	   //print_r($Houses);
	   foreach ($Houses as $House):

		  $ArFld = substr(str_replace("-", "", $House['House']['date']), 0, 6); // MONTHLY FOLDER PATH
		  if (($House['House']['image'] != null) && (filesize(ROOT . "/app/webroot/img/upload2/" . $ArFld . "/" . $House['House']['image']) > 8000)) {
			 $imgHTML = "<img src='" . $this->webroot . "img/upload2/" . $ArFld . "/" . trim($House['House']['image']) . "' width=25>";
		  }

		  echo "
		<div class='myentries'>
			<div style='float: left'>
				" . $imgHTML . "
			</div>
			<div style='float: left'>
				<img src='" . $this->webroot . "img/menu_pt.png'>
				<A HREF='" . $this->webroot . "houses/view/" . $House['House']["id"] . "' target='_new' class=\"tipnfo\" title=\"Vizualizeaza anunt intro noua fereastra\">
					Cod " . $House['House']["id"] . " - Data " . $House['House']["date"] . "</a> |
				<img src='" . $this->webroot . "img/div.gif' width='100' height=0>
				<img src='" . $this->webroot . "img/menu_delete.png' class=\"tipnfo\" title=\"Sterge anunt\">
				<A HREF='" . $this->webroot . "houses/deletehouse/" . $House['House']["id"] . "' class=\"tipnfo\" title=\"Sterge anunt\">
					Sterge anunt 
				</a>
				<br>
			</div>
			<div style='clear: both'></div>
		</div>
		";
	   endforeach;
	   ?>
    </p>

    <p>
	   <?php
	   //print_r($Houses);
	   foreach ($Cars as $Car):

		  $ArFld = substr(str_replace("-", "", $Car['Car']['date']), 0, 6); // MONTHLY FOLDER PATH
		  if (($Car['Car']['image'] != null) && (filesize(ROOT . "/app/webroot/img/upload2/" . $ArFld . "/" . $Car['Car']['image']) > 8000)) {
			 $imgHTML = "<img src='" . $this->webroot . "img/upload2/" . $ArFld . "/" . trim($Car['Car']['image']) . "' width=25>";
		  }

		  echo "
		<div class='myentries'>
			<div style='float: left'>
				" . $imgHTML . "
			</div>
			<div style='float: left'>
				<img src='" . $this->webroot . "img/menu_pt.png'>
				<A HREF='" . $this->webroot . "cars/view/" . $Car['Car']["id"] . "' target='_new' class=\"tipnfo\" title=\"Vizualizeaza anunt intro noua fereastra\"> 
				Cod " . $Car['Car']["id"] . " - Data " . $House['Car']["date"] . "
				</a> |
				<img src='" . $this->webroot . "img/div.gif' width='100' height=0>
				<img src='" . $this->webroot . "img/menu_delete.png' class=\"tipnfo\" title=\"Sterge anunt\">
				<A HREF='" . $this->webroot . "cars/deletecar/" . $Car['Car']["id"] . "' class=\"tipnfo\" title=\"Sterge anunt\"> 
					Sterge anunt 
				</a>
				<br>
			</div>
			<div style='clear: both'></div>
		</div>
		";
	   endforeach;
	   ?>
    </p>

    <p>
	   <?php
	   //print_r($Houses);
	   foreach ($Articles as $Article):

		  $ArFld = substr(str_replace("-", "", $Article['Article']['date']), 0, 6); // MONTHLY FOLDER PATH
		  if (($Article['Article']['image'] != null) && (filesize(ROOT . "/app/webroot/img/upload/" . $ArFld . "/" . $Article['Article']['image']) > 8000)) {
			 $imgHTML = "<img src='" . $this->webroot . "img/upload/" . $ArFld . "/" . trim($Article['Article']['image']) . "' width=25>";
		  }
		  echo "
		<div class='myentries'>
			<div style='float: left'>
				" . $imgHTML . "
			</div>
			<div style='float: left'>
				<img src='" . $this->webroot . "img/menu_pt.png'>
				<A HREF='" . $this->webroot . "articles/view/" . $Article['Article']["id"] . "' target='_new' class=\"tipnfo\" title=\"Vizualizeaza anunt intro noua fereastra\"> 
					Cod " . $Article['Article']["id"] . " - Data " . $Article['Article']["date"] . "
				</a> |
				<img src='" . $this->webroot . "img/div.gif' width='100' height=0>
				<img src='" . $this->webroot . "img/menu_delete.png' class=\"tipnfo\" title=\"Sterge anunt\">
				<A HREF='" . $this->webroot . "articles/deletearticle/" . $Article['Article']["id"] . "' class=\"tipnfo\" title=\"Sterge anunt\"> 
					Sterge anunt
				</a>
				<br>
			</div>
			<div style='clear: both'></div>
		</div>
		";
	   endforeach;
	   ?>
    </p>

    <div style='clear: both'></div>
</div>
<? #echo $this->renderElement('pagination', $paging);?> 