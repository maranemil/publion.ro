<?php
// Creo il navigatore.
$html->addCrumb(__("Home", true), "/");
// $_SERVER["DOCUMENT_ROOT"]
?>

<div class="indextitle">Anunturi Diverse</div>

<div id="contentMnArticles">
    <?php foreach ($this->requestAction('articles/lastarticles/35') as $Article): ?>
        <div class="articleBox">
            <div class="imgboxinfo"> <?= $Article['Article']['title'] ?> </div>
            <?php if ($Article['Article']['image']) { ?>
                <?php $ArFld = substr(str_replace("-", "", $Article['Article']['date']), 0, 6); // MONTHLY FOLDER PATH ?>
                <?php if (filesize(ROOT . "/app/webroot/img/upload/" . $ArFld . "/" . $Article['Article']['image']) > 8000) { ?>
                    <A HREF="<?= $this->webroot ?>articles/view/<?= $Article['Article']['id'] ?>">
                        <img src="<?= $this->webroot ?>img/upload/<?= $ArFld . "/" . $Article['Article']['image'] ?>"
                             width="145" alt=""><BR>
                    </A>
                <?php } else { ?>
                    <A HREF="<?= $this->webroot ?>articles/view/<?= $Article['Article']['id'] ?>">
                        <img src="<?= $this->webroot ?>img/upload/noimg.jpg" border=0 width="125" alt=""><BR>
                    </A>
                <?php } ?>
            <?php } else { ?>
                <A HREF="<?= $this->webroot ?>articles/view/<?= $Article['Article']['id'] ?>">
                    <img src="<?= $this->webroot ?>img/upload/noimg.jpg" border=0 width="125" alt=""><BR>
                </A>
            <?php } ?>
        </div>
    <?php endforeach; ?>
    <div style="clear:both"></div>
</div>

<div class="indextitle">Anunturi Imobiliare</div>

<div id="contentMnArticles">
    <?php foreach ($this->requestAction('houses/lasthouses/20') as $House): ?>
        <div class="articleBox">
            <div class="imgboxinfo"> <?= $House['House']['type'] ?> <BR> <?= $House['House']['price'] ?> </div>
            <?php if ($House['House']['image']) { ?>
                <?php $ArFld = substr(str_replace("-", "", $House['House']['date']), 0, 6); // MONTHLY FOLDER PATH ?>
                <A HREF="<?= $this->webroot ?>houses/view/<?= $House['House']['id'] ?>">
                    <img src="<?= $this->webroot ?>img/upload2/<?= $ArFld . "/" . $House['House']['image'] ?>" border=1
                         width="155" alt=""><BR>
                </A>
            <?php } else { ?>
                <A HREF="<?= $this->webroot ?>houses/view/<?= $House['House']['id'] ?>">
                    <img src="<?= $this->webroot ?>img/upload2/noimg.jpg" border=0 width="155" alt=""><BR>
                </A>
            <?php } ?>
        </div>
    <?php endforeach; ?>
    <div style="clear:both"></div>
</div>

<div class="indextitle">Anunturi Auto</div>

<div id="contentMnArticles">
    <?php foreach ($this->requestAction('cars/lastcars/20') as $Car): ?>
        <div class="articleBox">
            <div class="imgboxinfo"> <?= $Car['Car']['type'] ?> <BR> <?= $Car['Car']['years'] ?>
                / <?= $Car['Car']['km'] ?> km
            </div>
            <?php if ($Car['Car']['image']) { ?>
                <?php $ArFld = substr(str_replace("-", "", $Car['Car']['date']), 0, 6); // MONTHLY FOLDER PATH ?>
                <A HREF="<?= $this->webroot ?>cars/view/<?= $Car['Car']['id'] ?>">
                    <img src="<?= $this->webroot ?>img/upload2/<?= $ArFld . "/" . $Car['Car']['image'] ?>" border=1
                         width="155" alt=""><BR>
                </A>
            <?php } else { ?>
                <A HREF="<?= $this->webroot ?>cars/view/<?= $Car['Car']['id'] ?>">
                    <img src="<?= $this->webroot ?>img/upload2/noimg.jpg" border=0 width="155" alt=""><BR>
                </A>
            <?php } ?>
        </div>
    <?php endforeach; ?>
    <div style="clear:both"></div>
</div>

<?php
/*
foreach ($arTmpArt as $sTmpArt):
	 echo $this->renderElement("article", $sTmpArt);
endforeach;
*/
?>

<?php //echo $this->renderElement('pagination', $paging);?>
