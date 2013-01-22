<?php
#Creo il navigatore.
#$html->addCrumb(__("Home", TRUE), "/");

?>

	<div id="searchformZipcodes">
		<span> Coduri postale</span><BR><BR>
		<!-- Search Box -->
			<?php 
			echo $form->create('Search',array('id'=>"searchformZips",'type'=>"get",'url'=>"/zipcodes/searchcode/"));
			?>
				Judet: <input type="text" name="search_state" id="search_state" value=""  onfocus = 'this.value=""' />
				Oras: <input type="text" name="search_town" id="search_town" value=""  onfocus = 'this.value=""' />
				Adresa: <input type="text" name="search_street" id="search_street" value=""  onfocus = 'this.value=""' />
				<BR><BR>
				<input type="submit" name="submit" id="submit" value="<?php __("Cauta"); ?>"/>
			</form>
		<!-- / Search Box -->
	</div>

	<?php 
	if($arTmpZip){
	foreach ($arTmpZip as $sTmpZip): 
		echo $this->renderElement("zipcode", $sTmpZip); 
	endforeach; 
	echo $this->renderElement('pagination', $paging);
	}
	?>




