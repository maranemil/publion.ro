	<?//print_r($Car)?>
	
	<div id="contentBox" style="">
		<div id="articleTitle" style="width: 450px">
					
			<?php echo ucwords(strtolower($Firm['company'])); ?>
			<p>
				<?if($Firm['category']){?>	Categorie: <?php echo $Firm['category'].' '; ?><br /> <?}?>
			</p>
		
		</div>
		<div id="articleCnt" >
			<?if($Firm['email']){?> Email: <?php echo $Firm['email'].' '; ?><br /> <?}?>
				<?if($Firm['state']){?>Judet: <?php echo $Firm['state'].' '; ?><br /> <?}?>
				<?if($Firm['town']){?>Oras: <?php echo $Firm['town'].' '; ?><br /> <?}?>
				<?if($Firm['address']){?>Adresa: <?php echo $Firm['address'].' '; ?><br /> <?}?>
				<?if($Firm['phone']){?>Telefon: <?php echo $Firm['phone'].' '; ?><br /> <?}?>
				<?if($Firm['mobile']){?>Mobil: <?php echo $Firm['mobile'].' '; ?><br /> <?}?>
				<?if($Firm['fax']){?>Fax: <?php echo $Firm['fax'].' '; ?><br /> <?}?>
				<?if($Firm['person']){?>Persoana contact: <?php echo $Firm['person'].' '; ?><br /> <?}?>
				<?if($Firm['web']){?> 
					Web: <a href="<? echo str_replace("http //","http://",$Firm['web']);?>" target="_blank">
						<?php echo $Firm['web'].' '; ?>
						</a>
						<br /><br />
				<?}?>

				<?if($Firm['activity']){?>Activitate: <?php echo $Firm['activity'].' '; ?><br /> <?}?>

		
			<?// echo Sanitize::html(ucwords(substr($Article['descr'],0,200))); ?>
	
<!-- 		
<?php echo Sanitize::html($Car['power']); ?><br />
<?php echo Sanitize::html($Car['cmc']); ?><br />
<?php echo Sanitize::html($Car['speeds']); ?><br />
 -->


			
		</div>
		<div style="clear:both"></div>
	</div>