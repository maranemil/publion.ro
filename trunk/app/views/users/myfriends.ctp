<?php
// Creo il navigatore.
#$html->addCrumb(__("Home", TRUE), "/");
?>

<div class="contBoxMid">

    <p>
	   <?php

	   //print "<pre>"; print_r($Friends); die();

	   foreach ($Friends as $Friend):

		  if (filesize(ROOT . "/app/webroot/img/user/" . trim($Friend['User']['image'])) > 8000) {
			 $imgHTML = "<img src='" . $this->webroot . "img/user/" . trim($Friend['User']['image']) . "' width=55  height=55>";
		  }
		  else {
			 $imgHTML = "<img src='" . $this->webroot . "img/user/usericon.jpg' width=55  height=55>";
		  }

		  echo "
		<div class='myentriesFriens'>
			<div style=''>
				" . $imgHTML . "
			</div>
			<div style=''>
				<A HREF='" . $this->webroot . "friends/deletefriend/" . $Friend['User']["id"] . "' class=\"tipnfo\" title=\"Sterge Contact\"> 
					<img src='" . $this->webroot . "img/menu_delete.png' class=\"tipnfo\" title=\"Sterge Contact\" border=0>
				</a>
				<A HREF='" . $this->webroot . "users/view/" . $Friend['User']["id"] . "' class=\"tipnfo\" title=\"Informatii Profil " . $Friend['User']["name"] . "\"> 
					<img src='" . $this->webroot . "img/info_ico.png' border='0'>
				</a><br>
				" . $Friend['User']["name"] . "
				
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