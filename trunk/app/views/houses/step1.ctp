<?php
foreach ($arTmpState as $itemSel) {
    $JudeteAll .= "<option value='" . $itemSel["judets"]["id"] . "'> " . $itemSel["judets"]["judet"] . "</option >";
}
?>

<div class="registerBox">

    <span> Adauga anunt nou </span><BR><BR>

    <form method="post" action="<?php echo $html->url('/houses/step2/'); ?>" enctype="multipart/form-data">

        <div class="register_group">JUDET</div>
        <div class="register_input">
            <select name="data[House][state]" id="data[House][state]">
                <?= $JudeteAll ?>
            </select>
        </div>

        <div class="register_group"> Tip:</div>
        <div class="register_input">
            <select name="data[House][type]" id="data[House][type]">
                <option value='Garsoniera'>Garsoniera</option>
                <option value='2 Camere'>2 Camere</option>
                <option value='3 Camere'>3 Camere</option>
                <option value='4 Camere'>4 Camere</option>
                <option value='5+ Camere'>5+ Camere</option>
                <option value='Casa Vila'>Casa Vila</option>
                <option value='Spatiu comercial'>Spatiu comercial</option>
                <option value='Spatiu birouri'>Spatiu birouri</option>
                <option value='Spatiu ind.hala'>Spatiu ind.hala</option>
                <option value='Teren'>Teren</option>
            </select>
        </div>

        <div class="register_group"> Pret:</div>
        <div class="register_input">
            <?php echo $form->text('House/price', array('size' => '20', 'value' => $post[0]['House']['price'])); ?>
        </div>

        <div class="register_group"> Oras:</div>
        <div class="register_input">
            <?php echo $form->text('House/town', array('size' => '20', 'value' => $post[0]['House']['town'])); ?>
        </div>

        <div class="register_group"> Strada:</div>
        <div class="register_input">
            <?php echo $form->text('House/street', array('size' => '20', 'value' => $post[0]['House']['street'])); ?>
        </div>

        <div class="register_group"> Pozitionare:</div>
        <div class="register_input">
            <select name="data[House][position]">
                <option value='ULTRACENTRAL'>ULTRACENTRAL</option>
                <option value='REZIDENTIAL'>REZIDENTIAL</option>
                <option value='CENTRAL'>CENTRAL</option>
                <option value='SEMICENTRAL'>SEMICENTRAL</option>
                <option value='CARTIERE'>CARTIERE</option>
            </select>
        </div>

        <div class="register_group">Descriere</div>
        <div class="register_input">
            <textarea name="data[House][info]"
                      style="width:300px; height: 150px"><?= $post[0]['House']['info']; ?></textarea>
        </div>

        <div class="register_group"> Persoana contant:</div>
        <div class="register_input">
            <?php echo $form->text('House/person', array('size' => '20', 'value' => $post[0]['House']['person'])); ?>
        </div>

        <div class="register_group"> Email:</div>
        <div class="register_input">
            <?php echo $form->text('House/email', array('size' => '20', 'value' => $post[0]['House']['email'])); ?>
        </div>

        <div class="register_group"> Telefon:</div>
        <div class="register_input">
            <?php echo $form->text('House/phone', array('size' => '20', 'value' => $post[0]['House']['phone'])); ?>
        </div>

        <div class="register_group">Webpage:</div>
        <div class="register_input">
            <?php echo $form->text('House/web', array('size' => '20', 'value' => $post[0]['House']['web'])); ?>
        </div>

        <BR><BR>
        <?php
        echo $form->create('Image/images', array('action' => 'add', 'type' => 'file'));
        echo $form->file('File');
        ?>

        <?php echo $html->file('File'); ?>

        <BR><BR>
        <?php echo $form->submit('Adauga'); ?>
    </form>

</div>

