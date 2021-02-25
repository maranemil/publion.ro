<?
//print "<pre>"; print_r($arTmpUsr);
?>

<div id="userView" style="">

    <div class="MessageNav" style="">
        <a href="<?= $this->webroot ?>messages/index/<?= $arTmpUsr["id"] ?>">Mesaje Inbox</a>
    </div>

   <?
   //print "<pre>"; print_r($arNoMsg);
   if ($arNoMsg) {
	  print $arNoMsg;
   }
   ?>

   <?php
   if (is_array($arTmpMsg)) {
	  foreach ($arTmpMsg as $aMsg) {
		 //echo $this->renderElement("message", $aMsg);
		 //	print "<pre>"; print_r($aMsg);
		 ?>
          <div class="Message" style="">

              <div class="MsgStatus" style="">
				 <?php
				 if ($aMsg['Message']['unread']) {
					echo "<img src='" . $this->webroot . "img/emailu.gif'>";
				 }
				 else {
					echo "<img src='" . $this->webroot . "img/emailr.gif'>";
				 }
				 ?>
              </div>

              <div class="MsgFrom" style="">
				 <?php echo $this->requestAction("/users/getusernamebyid/" . $aMsg['Message']['from_user_id']); ?>
              </div>
              <div class="MsgSubj" style="">
                  <A HREF="<?= $this->webroot ?>messages/view/<?= $aMsg['Message']['id'] ?>">
					 <?php echo substr($aMsg['Message']['subject'], 0, 20); ?>
                  </A>
              </div>
              <div class="MsgBody" style="">
				 <?php echo substr($aMsg['Message']['body'], 0, 20); ?> ...
              </div>
              <div class="MsgDate" style="">
				 <?php echo $aMsg['Message']['date']; ?>
                  <A HREF="<?= $this->webroot ?>messages/deletemsgfrom/<?= $aMsg['Message']['id'] ?>">
                      <img src='<?= $this->webroot ?>img/menu_delete.png' border=0>
                  </A>
              </div>
              <div class="clearer"></div>
          </div>

		 <?
	  }
   }

   //print "<pre>"; print_r($aMsg);
   ?>
</div>
