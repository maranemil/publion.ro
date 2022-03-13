<?php
#Creo il navigatore.
#$html->addCrumb(__("Home", TRUE), "/");

//print_r($arTmpCategs);
?>

<div id="recipesMedic">
    <span> Farmacii din Judetul Timis in contract cu Casa de Asigurari. </span><BR><BR>

    <?php
    foreach ($arTmpDrog as $arTmpD):
        echo $this->renderElement("drog", $arTmpD);
    endforeach;
    ?>

</div>

<?php
echo $this->renderElement('pagination', $paging);
?> 


