<!-- rating box -->
	<?
		if($rating==1) $ratewidth = 25;
		if($rating==2) $ratewidth = 50;
		if($rating==3) $ratewidth = 75;
		if($rating==4) $ratewidth = 100;
		if($rating==5) $ratewidth = 125;
	?>
	<TABLE>
	<TR>
		<TD>
			<ul class="star-rating">
				<li class="current-rating" style="width: <?=$ratewidth?>px"></li>
				<li><a href="#" onclick="saveRating(1,<?=$Article[0]['articles']['id']?>)" title="1 star out of 5" class="one-star">1</a></li>
				<li><a href="#" onclick="saveRating(2,<?=$Article[0]['articles']['id']?>)" title="2 stars out of 5" class="two-stars">2</a></li>
				<li><a href="#" onclick="saveRating(3,<?=$Article[0]['articles']['id']?>)" title="3 stars out of 5" class="three-stars">3</a></li>
				<li><a href="#" onclick="saveRating(4,<?=$Article[0]['articles']['id']?>)" title="4 stars out of 5" class="four-stars">4</a></li>
				<li><a href="#" onclick="saveRating(5,<?=$Article[0]['articles']['id']?>)" title="5 stars out of 5" class="five-stars">5</a></li>
			</ul> 
		</TD>
		<TD style="/*display: none*/ font: normal 10px arial">
			Votes <?=$votes?> / Rate <?=$rating?>
		</TD>
	</TR>
	</TABLE>	

<!-- rating box -->