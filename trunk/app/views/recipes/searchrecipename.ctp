<div id="recipesCats">
    <span> Retete culinare</span><BR><BR>
</div>
<?php
if ((is_array($arTmpRecipe)) && (!empty($arTmpRecipe))) {
    foreach ($arTmpRecipe as $arTmpRec):
        echo $this->renderElement("recipe", $arTmpRec);
    endforeach;
    echo $this->renderElement('pagination', $paging);
}
?>

<?php
if (empty($arTmpRecipe)) {
    echo "<div class='noresults'>" . $message . "</div>";
}
?>
