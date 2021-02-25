<div id="postBox" style="">
    Judet: <?php echo $Zipcode['judet']; ?> | Localitate: <?php echo $Zipcode['localitate']; ?><br/>
    <p>
        Cod Postal: <?php echo $Zipcode['codpostal'] . ' '; ?><br/>
	   <?php if ($Zipcode['adresa']) {
		  echo "Adresa: " . $Zipcode['adresa'];
	   } ?>
    </p>
</div>