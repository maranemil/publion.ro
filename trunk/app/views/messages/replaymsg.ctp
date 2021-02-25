<div id="userView" style="">

   <?
   //print "<pre>"; print_r($arMsg);
   ?>

    <form method="post" action="<?php echo $html->url('/messages/replaymsg/'); ?>" enctype="multipart/form-data">

        <div class="register_group"> Subiect:</div>
        <div class="register_input">
		   <?php echo $form->text('Message/subject', array('size' => '20', 'value' => $arMsg['Message']['subject'])); ?>
        </div>

        <div class="register_group"> Mesaj:</div>
        <div class="register_input">
            <textarea name="data[Message][body]" style="width:300px; height: 150px"><?= $post[0]['Message']['body']; ?></textarea>
        </div>

        <div class="register_group"></div>
        <div class="register_input">
		   <?php echo $form->submit('Trimite'); ?>
        </div>

	   <?php echo $form->text('Message/from_user_id', array('type' => 'hidden', 'value' => $arMsg['Message']['user_id'])) . "\n"; ?>
	   <?php echo $form->text('Message/user_id', array('type' => 'hidden', 'value' => $arMsg['Message']['from_user_id'])); ?>
	   <?php echo $form->text('Message/unread', array('type' => 'hidden', 'value' => '1')); ?>
	   <?php echo $form->text('Message/approved', array('type' => 'hidden', 'value' => '1')); ?>
	   <?php echo $form->text('Message/date', array('type' => 'hidden', 'value' => date("Y-m-d"))); ?>

    </form>

</div>