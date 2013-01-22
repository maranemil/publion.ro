<!--
<pre>
<?php  //print_r($Article); ?>
</pre>
-->

<?  //echo "<pre>"; print_r($userw); echo "</pre>"; ?>

<script>
function saveRating(ratingval,articleid){

 $.ajax({
   type: "GET",
   url: "http://<?=$_SERVER['HTTP_HOST']?><?=$this->webroot?>articles/ratingsave/"+ratingval+"/"+articleid+"",
   data: "",
   success: function(msg){
	   $.prompt('Votul a fost salvat cu succes.');
    //alert( "Saved!");
   }
 });
//http://docs.jquery.com/Ajax/jQuery.ajax
//http://docs.jquery.com/Ajax
}
</script>


<div id="contentBox" style="">
		<div id="articleImg">
				
	<?php

		$ArFld = substr(str_replace("-","",$Article[0]['articles']['date']),0,6); // MONTHLY FOLDER PATH
		if(
		(strstr($Article[0]['articles']['image'],"jpg"))&&
		(filesize(ROOT."/app/webroot/img/upload/".$ArFld."/".$Article[0]['articles']['image'])>8000)
		){
			echo "
				
					<img src='".$this->webroot."img/upload/".$ArFld."/".trim($Article[0]['articles']['image'])."' width=200>
				
				"; 
		}
		else{
			echo "
				<a href='".$this->webroot."articles/view/".$Article[0]['articles']['id']."/'>
					<img src='".$this->webroot."img/upload/noimg.jpg' width=200>
				</a>
				"; 
		}
	?>
		
		</div>
		<div id="articleTitle">
			Cod Anunt: s<?php echo $Article[0]['articles']['id']?><br />
			<p>
				<?php echo sprintf(__("Adaugat la %s", TRUE),AppController::Db2StrDate($Article[0]['articles']['date'])); ?><br />
				Telefon: <?php echo $Article[0]['articles']['phone'].''; ?><br />
				Web: 
					<?
					if(!strstr($Article[0]['articles']['webpage'],"http")) $Article[0]['articles']['webpage'] = "http://".$Article[0]['articles']['webpage'];
					?>
				<A style="font-size: 10px" HREF="<?php echo $Article[0]['articles']['webpage']; ?>" target="_blank">
				
					<?php echo $Article[0]['articles']['webpage']; ?>
				</A><br />
				Pret: <?php echo $Article[0]['articles']['price']; ?><br />
				Afisari: <?php echo $Article[0]['articles']['views']; ?><br />
				Adaugat de: 
				<A style="font-size: 10px" HREF="<?=$this->webroot?>users/view/<?=$Article[0]['articles']['user_id']?>">
					<?php echo $this->requestAction("users/getusernamebyid/".$Article[0]['articles']['user_id']); ?>
				</A>
				<br />
				Toate adaugate de: 
					<A style="font-size: 10px" HREF="<?=$this->webroot?>articles/articlesbyuser/<?php echo $Article[0]['articles']['user_id']; ?>">
						<?php echo $this->requestAction("users/getusernamebyid/".$Article[0]['articles']['user_id']); ?>
					</A>
				<br />
				
				<div style="font-size: 10px; width: 75px; float: left; margin-top: 5px">
				<?if($session->read("User.username")){?>
					<a href="javascript:void(0)" onclick="AddArticleToFav('<?=$Article[0]['articles']['id']?>')" class="tipnfo" title="Adauga la Favorite">
						<img src="<?=$this->webroot?>img/favorites.png" height=20 border=0>
					</a>
				<?}?>
					<a href="http://www.twitter.com/home?status=http://<?=$_SERVER["HTTP_HOST"]?><?=$_SERVER["REQUEST_URI"]?>" class="tipnfo" title="Adauga pe Twitter">
						<img src="<?=$this->webroot?>img/twitter.png" height=20 border=0>
					</a>
					<a href="http://www.facebook.com/sharer.php?u=http://<?=$_SERVER["HTTP_HOST"]?><?=$_SERVER["REQUEST_URI"]?>&src=sp" class="tipnfo" title="Adauga pe Facebook">
						<img src="<?=$this->webroot?>img/facebook.png" height=20 border=0>
					</a>
				</div>
				<div style="font-size: 10px; width: 215px; float: left">
					<? echo $this->renderElement('rating',array( 'rating'=>$rating,'votes'=>$votes )); ?>
				</div>
				

			</p>
		</div>
		<div id="articleCnt" ><BR>
			<?if($Article[0]['articles']['title']){?>
				<p><?php echo ucwords(strtolower($Article[0]['articles']['title'])); ?></p>
			<?}?>
		
			<?php echo ucfirst(trim($Article[0]['articles']['descr'])); ?><br /><br /><br /><br />

			<? echo $this->renderElement('googlemain1');?> 
		</div>

		

		<div style="clear:both"></div>
	</div>

