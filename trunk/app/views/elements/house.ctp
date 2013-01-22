	<?//print_r($Car)?>
	
	<div id="contentBox" style="">
		<div id="articleImg" style="  float: left; ">
			<?php
				
				$ArFld = substr(str_replace("-","",$House['date']),0,6); // MONTHLY FOLDER PATH
				if($House['image']!=NULL){
					
					echo "<a href='".$this->webroot."houses/view/".$House['id']."'>"; 
					//.str_replace(array(',',' ','-','.','/',':','?',';','(',')') ,'_',strip_tags(substr($House['info'],0,70))).".htm
					echo "<img src='".$this->webroot."img/upload2/".$ArFld."/".trim($House['image'])."'></a>"; 
				}
				else{
						echo "<a href='".$this->webroot."houses/view/".$House['id']."'>"; 
						//".str_replace(array(',',' ','-','.','/',':','?',';','(',')') ,'_',strip_tags(substr($House['info'],0,70))).".htm

						echo "<img src='".$this->webroot."img/upload2/noimg.jpg'></a>";  

					//echo "<a href='".$this->webroot."articles/view/".$Article['id']."/'><img src='".$this->webrootROOT."img/upload/noimg.jpg' width=150></a>"; 
				}
			?>
			
		</div>
		<div id="articleTitle" style=" width:410px; float: left; ">
			<div style="float: left; height: 160px; width:200px; font: normal 10px arial">
					Cod Anunt: <?php echo $html->link('i'.$House['id'],"/houses/view/".$House['id'].""); ?>
				
				<p>
					Tip: <?php echo ucwords($House['type']); ?><br />
					Pret: <?php echo ucwords($House['price']); ?><br /><br />
				</p>

				<p>
					<?// echo Sanitize::html(ucwords(substr($Article['descr'],0,200))); ?>
					Adaugat <?php echo sprintf(__("la %s", TRUE),AppController::Db2StrDate($House['date'])); ?><br />
					Telefon: <?php echo $House['phone'].' '; ?><br />
					Afisari: <?php echo $House['views'].' '; ?><br />
				</p>
			</div>
			<div style="float: left; height: 160px; width:200px; font: normal 16px calibri,arial">
				<?php echo ucwords(strtolower(substr($House['info'],0,200))); ?> ...<br /><br />
			</div>
			<div style="clear:both"></div>
		</div>
		<div style="clear:both"></div>
	</div>
	