<div class="registerBox">
    <span>Autentificare</span><BR><BR>

   <?php
   if ($error == "true") {
	  echo "<p>Intormatia trimisa nu este valida. Verificati daca user-ul sau parola corespund contului d-voastra.</p>";
   }
   ?>

    <form method="post" action="<?php echo $html->url('/users/login') ?>">
        <div class="register_group">Email:</div>
        <div class="register_input">
		   <?php echo $form->text('User/username', array('size' => '15', 'class' => 'input_medium')); ?><br/>
        </div>

        <div class="register_group">Parola:</div>
        <div class="register_input">
		   <?php echo $form->password('User/password', array('size' => '15', 'class' => 'input_medium')); ?><br/>
        </div>

        <div class="register_group"></div>
        <div class="register_input">
		   <?php echo $form->submit('Login'); ?>
        </div>
    </form>

   <?php echo $html->link('Ai uitat parola?  ', '/users/forgotpassword') ?>




   <?php //echo $html->link(' Vreau Cont nou ', '/users/register'); ?>
   <?php // echo $html->link('[ Am uitat Parola ]', '/users/forgot_password'); ?>

</div>