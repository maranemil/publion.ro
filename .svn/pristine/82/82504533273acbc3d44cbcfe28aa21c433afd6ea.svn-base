

<div class="registerBox">

	

	<span>Formular Inregistrare</span><BR><BR>

	<?php 
	if($error == "true") {
		//echo "<p>Intormatia trimisa nu este valida sau userul este deja inscris. </p>";
	}
	?>

	<form method="post" action="<?php echo $html->url('/users/register'); ?>">

	<div class="register_group"> Prenume: </div>
	<div class="register_input">
	<?php echo $form->text('User/name', array('size' => '20')); ?>
	</div>

	<div class="register_group"> Nume: </div>
	<div class="register_input">
	<?php echo $form->text('User/pastname', array('size' => '20')); ?>
	</div>

	<div class="register_group"> Parola: </div>
	<div class="register_input">
	<?php echo $form->password('User/password', array('size' => '15')); ?>
	<?php echo $form->error('User/password', 'Trebuie sa specifici o parola'); ?>
	</div>

	<div class="register_group"> Parola verificare: </div>
	<div class="register_input">
		<?php echo $form->password('User/password_confirm', array('size' => '15')); ?><br />
	</div>

	<div class="register_group"> Adresa E-Mail:  </div>
	<div class="register_input">
	<?php echo $form->text('User/e-mail', array('size' => '50')); ?>
	<?php echo $form->error('User/e-mail', 'Trebuie sa specifici o adresa de Email'); ?>
	</div>

	<div class="register_group"> Adresa E-Mail verificare: </div>
	<div class="register_input">
	<?php echo $form->text('User/username', array('size' => '15', 'class' => 'input_big')); ?>
	<?php echo $form->error('User/username', 'Trebuie sa specifici o adresa de Email identicac cu prima'); ?>
	</div>

	<div class="register_group">  </div>
	<div class="register_input">
	<?php echo $form->submit('Confirma inregistrare'); ?>
	</div>

	</form>
</div>