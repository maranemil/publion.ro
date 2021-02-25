<div id='pagination'>
   <?php

   if ($pagination->setPaging($paging)) {
	  $prev = $pagination->prevPage('<', true, ""); // Any text you want 4 link. //Prev
	  $prev = $prev ? $prev : ''; // If no link display something.
	  $next = $pagination->nextPage('>', true, ""); // Any text you want 4 link. // Next
	  $next = $next ? $next : ''; // In no link dislpay something.

	  // If required/desired - define the first and last pages. Not automatic at time of writing.
	  //$first = "";
	  //$last = "";

	  $pages = $pagination->pageNumbers(" | ");
//	echo $pagination->resultsPerPage('Show ', ' | ')." per page. &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
	  echo $pagination->result('Afiseaza ') . "&nbsp;&nbsp;&nbsp; ";
	  echo $prev . " " . $pages . " " . $next . "<br/>";
   }

   ?>
</div>