<?php
// Creo il navigatore.
#$html->addCrumb(__("Home", TRUE), "/");

//print "<pre>"; print_r($user['User']);  print "</pre>"; 

?>
    <div class="registerBox">
        <span>Profil <?php echo $user['User']['name'] . " " . $user['User']['pastname']; ?></span><BR><BR>

        <form method="post" enctype="multipart/form-data"
              action="<?php echo $html->url('/users/savemyprofile/' . $user['User']['id']); ?>">

            <div class="register_group"> Prenume:</div>
            <div class="register_input">
                <?php echo $form->text('User/name', array('size' => '20', 'value' => $user['User']['name'])); ?>
            </div>

            <div class="register_group"> Nume:</div>
            <div class="register_input">
                <?php echo $form->text('User/pastname', array('size' => '20', 'value' => $user['User']['pastname'])); ?>
            </div>

            <div class="register_group">E-Mail:</div>
            <div class="register_input">
                <?php echo $form->text('User/e-mail', array('size' => '20', 'value' => $user['User']['e-mail'], 'readonly' => 'readonly')); ?>
            </div>

            <div class="register_group"> Nickname:</div>
            <div class="register_input">
                <?php echo $form->text('User/nickname', array('size' => '20', 'value' => $user['User']['nickname'])); ?>
            </div>

            <div class="register_group">Interese:</div>
            <div class="register_input">
                <?php echo $form->text('User/interests', array('style' => 'width:200px; height: 150px', 'type' => 'textarea', 'size' => '20', 'class' => 'input_big', 'value' => $user['User']['interests'])); ?>
                <?php echo $form->error('User/interests', 'Email muss angegeben werden'); ?>
            </div>
            <?php
            $checked = 'checked="checked"';
            ?>

            <div class="register_group">Ascunde email:</div>
            <div class="register_input">
                <?php
                //echo $form->checkbox('User/showhide', array($checked1=>$checked2));
                /*
                echo $form->input("User.showhide",
                        array(
                            'label'=>"showhide",
                            'type'=>'checkbox',
                            'checked'=>($user["User"]["showhide"][$id] == 1 ? 'checked' : false)
                            )
                        );
                */
                ?>
                <!-- <input type="hidden" name="data[User][showhide]" value="0" id="UserShowhide_" /> -->
                <input type="checkbox" name="data[User][showhide]" <?php if ($user['User']['showhide'] == 1) {
                    echo $checked;
                } ?> id="data[User][showhide]"/>

            </div>

            <BR><BR>

            <div class="register_group"> Poza (Optional)</div>
            <div class="register_input">
                <?php
                echo $form->create('Image/images', array('action' => 'add', 'type' => 'file'));
                echo $form->file('File');
                ?>
            </div>

            <div class="register_group"></div>
            <div class="register_input">
                <?php echo $form->submit('Salveaza'); ?>
            </div>

        </form>
    </div>

<?php //examples ?>
<?php //echo $form->radio('User/privacy', Configure::read('Site.privacy'), array('legend' => false, 'separator' => '&nbsp;&nbsp;')) ?>
<?php //echo $form->select('User/gender', $application->genders(), null, null, false) ?>
<?php //echo $form->dateTime('User/birthday', 'DMY', 'NONE', time(), array('minYear' => 1910, 'maxYear' => (date('Y') - 16)), false) ?>
<?php //echo $form->text('User/firstname') ?>
<?php //echo $form->password('User/password') ?>