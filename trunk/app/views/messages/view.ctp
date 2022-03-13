<?php
//print "<pre>"; print_r($arTmpMsg);
/*
Array
(
    [0] => Array
        (
            [Message] => Array
                (
                    [id] => 1
                    [user_id] => 1
                    [from_user_id] => 10
                    [subject] => how are you
                    [body] => fine or ? i go today on 3d 
                    [unread] => 1
                    [date] => 2010-06-13
                    [approved] => 1
                )

*/

?>

<div id="userView" style="">
    <div class="MessageNav" style="">
        <a href="<?= $this->webroot ?>messages/index/<?= $arTmpUsr["id"] ?>">Mesaje Inbox</a>
    </div>

    <div class="MessageDetail">
        <?php echo "<img src='" . $this->webroot . "img/emailr.gif'>"; ?>
        Subiect: <?php echo ucfirst($arTmpMsg[0]['Message']['subject']); ?>
        <hr>
        De la:
        <A HREF="<?= $this->webroot ?>users/view/<?= $arTmpMsg[0]['Message']['from_user_id'] ?>">
            <?php echo $this->requestAction("/users/getusernamebyid/" . $arTmpMsg[0]['Message']['from_user_id']); ?>
        </A>
        |
        Data: <?php echo $arTmpMsg[0]['Message']['date']; ?>
        <hr>

        <?php echo $arTmpMsg[0]['Message']['body']; ?>

        <hr>
        <A HREF="<?= $this->webroot ?>messages/replaymsg/<?= $arTmpMsg[0]['Message']['id'] ?>">Raspunde</A>

    </div>
    <div style="clear: both"></div>
</div>