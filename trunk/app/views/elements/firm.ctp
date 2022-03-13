<?php //print_r($Car)?>

<div id="contentBox" style="">
    <div id="articleTitle" style="width: 450px">

	   <?php echo ucwords(strtolower($Firm['company'])); ?>
        <p>
            <?php if ($Firm['category']) { ?>    Categorie: <?php echo $Firm['category'] . ' '; ?><br/> <?php } ?>
        </p>

    </div>
    <div id="articleCnt">
        <?php if ($Firm['email']) { ?> Email: <?php echo $Firm['email'] . ' '; ?><br/> <?php } ?>
        <?php if ($Firm['state']) { ?>Judet: <?php echo $Firm['state'] . ' '; ?><br/> <?php } ?>
        <?php if ($Firm['town']) { ?>Oras: <?php echo $Firm['town'] . ' '; ?><br/> <?php } ?>
        <?php if ($Firm['address']) { ?>Adresa: <?php echo $Firm['address'] . ' '; ?><br/> <?php } ?>
        <?php if ($Firm['phone']) { ?>Telefon: <?php echo $Firm['phone'] . ' '; ?><br/> <?php } ?>
        <?php if ($Firm['mobile']) { ?>Mobil: <?php echo $Firm['mobile'] . ' '; ?><br/> <?php } ?>
        <?php if ($Firm['fax']) { ?>Fax: <?php echo $Firm['fax'] . ' '; ?><br/> <?php } ?>
        <?php if ($Firm['person']) { ?>Persoana contact: <?php echo $Firm['person'] . ' '; ?><br/> <?php } ?>
        <?php if ($Firm['web']) { ?>
           Web: <a href="<?php echo str_replace("http //", "http://", $Firm['web']); ?>" target="_blank">
			 <?php echo $Firm['web'] . ' '; ?>
           </a>
           <br/><br/>
        <?php } ?>

        <?php if ($Firm['activity']) { ?>Activitate: <?php echo $Firm['activity'] . ' '; ?><br/> <?php } ?>


        <?php // echo Sanitize::html(ucwords(substr($Article['descr'],0,200))); ?>

        <!--
<?php echo Sanitize::html($Car['power']); ?><br />
<?php echo Sanitize::html($Car['cmc']); ?><br />
<?php echo Sanitize::html($Car['speeds']); ?><br />
 -->

    </div>
    <div style="clear:both"></div>
</div>