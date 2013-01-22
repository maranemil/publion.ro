	<?//print_r($Car)?>
	
	<div id="contentBox" style="">
		<div id="articleImg" style="  float: left; ">
			<?php
				
				$ArFld = substr(str_replace("-","",$Car['date']),0,6); // MONTHLY FOLDER PATH
				//if(($Car['image']!=NULL)&&(file_exists($this->webroot."img/upload2/".$ArFld."/".trim($Car['image'])))){
				if($Car['image']!=NULL){
					echo "<a href='".$this->webroot."cars/view/".$Car['id']."'>"; 
					echo "<img src='".$this->webroot."img/upload2/".$ArFld."/".trim($Car['image'])."'></a>"; 
				}
				else {
						echo "<a href='".$this->webroot."cars/view/".$Car['id']."'>"; 
						echo "<img src='".$this->webroot."img/upload2/noimg.jpg'></a>";  
					//echo "<a href='".$this->webroot."articles/view/".$Article['id']."/'><img src='".$this->webrootROOT."img/upload/noimg.jpg'></a>"; 
				}
			?>
			
		</div>
		<div id="articleTitle" style=" width:410px; float: left; ">
			<div style="float: left; height: 160px; width:200px; font: normal 10px arial">
			<span>
				<? echo "<a style='font: normal 13px arial' href='".$this->webroot."cars/view/".$Car['id']."'>";  ?>
				<?php echo Sanitize::html($Car['type']); ?> /
				<?php echo Sanitize::html($Car['price']); ?> <br>
				<?php echo Sanitize::html($Car['years']); ?>
				<? echo "</a>"; ?>
			</span>
			<br />
			
			Cod Anunt: 
			
			<?php 
			// ".str_replace(array(',',' ','-','.','/',':','?',';','(',')') ,'_',strip_tags(substr($Car['info'],0,70))).".htm
			echo $html->link('a'.$Car['id'],"/cars/view/".$Car['id'].""); 
			?> <br />
			
				<p>
					Adaugat <?php echo sprintf(__("la %s", TRUE),AppController::Db2StrDate($Car['date'])); ?><br />
					Telefon: <?php echo $Car['phone'].' '; ?><br />
					Afisari: <?php echo $Car['views'].' '; ?><br />
				</p>
			</div>
			<div style="float: left; height: 160px; width:200px; font: normal 16px calibri,arial">
				<?php echo ucwords(strtolower(substr($Car['info'],0,200))); ?> ...<br /><br />
			</div>
			<div style="clear:both"></div>
		</div>
		<div style="clear:both"></div>
	</div>