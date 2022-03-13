<?php
// Creo il navigatore.
$html->addCrumb(__("Home", true), "/");
?>

<div id="userView" style="">
    <div class="userImg" style="">
        <?php if ($user['User']['image']) { ?>
           <img src="<?= $this->webroot ?>img/user/<?= $user['User']['image'] ?>" alt="">
        <?php } else { ?>
           <img src="<?= $this->webroot ?>img/user/usericon.jpg" alt="">
        <?php } ?>
    </div>
    <div class="userInfo" style="">
        <h1 style="">Profil <BR><?php echo $user['User']['name'] . " " . $user['User']['pastname']; ?></h1><BR>
        <table class="userData" style="">
            <tr>
                <td>E-Mail:</td>
                <td>
				   <?php
				   if ($user['User']['showhide'] === 1) {
					  echo substr($user['User']['e-mail'], 0, 10) . "....";
				   }
				   else {
					  echo $user['User']['e-mail'];
				   }

				   ?>
                </td>
            </tr>
            <?php if (strpos($user['User']['e-mail'], "yahoo") !== false) { ?>
               <tr>
                   <td>YM contact:</td>
                   <td>
					  <?php
					  $YmTmp = explode("@", $user['User']['e-mail']);
					  $sYM   = $YmTmp[0];
					  ?>
                       <A HREF="ymsgr:sendim?<?= $sYM ?>"><?= $sYM ?></A>
                       <img src="http://opi.yahoo.com/online/?u=<?= $sYM ?>&m=g&t=0" alt="">
                   </td>
               </tr>
            <?php } ?>
            <tr>
                <td>Nickname:</td>
                <td><?php echo $user['User']['nickname']; ?></td>
            </tr>
            <tr>
                <td>Interes:</td>
                <td><?php echo $user['User']['interests']; ?></td>
            </tr>
            <tr>
                <td>Anunturi adaugate de :</td>
                <td>
                    <A HREF="<?= $this->webroot ?>articles/articlesbyuser/<?php echo $user['User']['id']; ?>">
					   <?php echo $this->requestAction("users/getusernamebyid/" . $user['User']['id']); ?>
                    </A>
                </td>
            </tr>
            <?php if ($session->read("User.id") !== $user['User']['id']) { ?>
               <tr>
                   <td>Adauga la Prieteni</td>
                   <td>
                       <A HREF="javascript:void(0)" onclick="AddToFriends(<?= $user['User']['id'] ?>)">
                           <img src="<?= $this->webroot ?>img/addto20.gif" width="20" height="20" alt="">
                       </A>
                   </td>
               </tr>
               <tr>
                   <td>Trimite mesaj la</td>
                   <td>
                       <A HREF="<?= $this->webroot ?>messages/newmsg/<?= $user['User']['id'] ?>">
						  <?php echo $user['User']['nickname']; ?>
                       </A>
                   </td>
               </tr>
            <?php } ?>

        </table>
    </div>
    <div style="clear: both"></div>
</div>