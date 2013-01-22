		
		<div class="item_list_list" style="">
			<div class="item_content">
					<?if($Article['title']){?>
						<a href="<?=$this->webroot."articles/view/".$Article['id'];?>">
							<?php 
							$arTitle = trim(substr(ucwords(strtolower($Article['title']),0,95))).''; 
							if($arTitle=="") $arTitle = strip_tags(substr(ucwords($Article['descr']),0,95)).''; 
							echo $arTitle;
							?>
						</a> ...
					<?}?> 
			</div>
			<div class="item_content_nfo">
				Adaugat <?php echo sprintf(__(" la %s", TRUE),AppController::Db2StrDate($Article['date'])); ?> 
				Telefon: <?php echo $Article['phone'].' '; ?>
				Afisari: <?php echo $Article['views'].' '; ?> 
				Cod: <?php echo $html->link('s'.$Article['id'],"/articles/view/".$Article['id'].""); ?>  

			</div>
			<div class="clearer"></div>
		</div>
	
	


			<!--  <a href="<?=$this->webroot."articles/showcategory/".$Article['category_id'];?>"> Categorie: 
					<?php echo $this->requestAction('articles/showcategory/'.$Article['category_id'].'/');  ?>
				-	<?php echo $this->requestAction('articles/showsubcategory/'.$Article['subcategory_id'].'/');  ?><br />
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
			<?// echo Sanitize::html(ucwords(substr($Article['descr'],0,200))); ?>
	
