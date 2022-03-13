<?php

?>

<div id="recipesMedic">
    <span> Lista medicilor de familie in contract cu CAS Timis</span><BR><BR>

    <?php
    foreach ($arTmpMedic as $arTmpMed):
        echo $this->renderElement("medic", $arTmpMed);
    endforeach;
    ?>

</div>

<?php
echo $this->renderElement('pagination', $paging);
?> 


