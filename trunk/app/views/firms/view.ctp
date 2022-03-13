<div id="contentBox" style="">
    <div id="articleImg" style="">
        <?php

        $ArFld = substr(str_replace("-", "", $Car[0]['cars']['date']), 0, 6); // MONTHLY FOLDER PATH
        //if(($Car['image']!=NULL)&&(file_exists($this->webroot."img/upload2/".$ArFld."/".trim($Car['image'])))){
        if ($Car[0]['cars']['image'] !== null) {
            echo "<a href='" . $this->webroot . "cars/view/" . $Car[0]['cars']['id'] . "/" . str_replace(array(',', ' ', '-', '.', '/', ':', '?', ';', '(', ')'), '_', strip_tags(substr($Car[0]['cars']['info'], 0, 70))) . ".htm'>";

            echo "<img src='" . $this->webroot . "img/upload2/" . $ArFld . "/" . trim($Car[0]['cars']['image']) . "' width=200></a>";
        } else {
            echo "<a href='" . $this->webroot . "cars/view/" . $Car[0]['cars']['id'] . "/" . str_replace(array(',', ' ', '-', '.', '/', ':', '?', ';', '(', ')'), '_', strip_tags(substr($Car[0]['cars'][0]['cars']['info'], 0, 70))) . ".htm'>";

            echo "<img src='" . $this->webroot . "img/upload2/noimg.jpg' width=200></a>";
            //echo "<a href='".$this->webroot."articles/view/".$Article['id']."/'><img src='".$this->webrootROOT."img/upload/noimg.jpg' width=150></a>";
        }
        ?>

    </div>
    <div id="articleTitle">
        <B>
            <?php echo $Car[0]['cars']['type']; ?> /
            <?php echo $Car[0]['cars']['price']; ?> /
            <?php echo $Car[0]['cars']['years']; ?><br/>
        </B>
        <p> Cod Anunt:
            <?php echo $html->link('a' . $Car[0]['cars']['id'], "/cars/view/" . $Car[0]['cars']['id'] . "/" . str_replace(array(',', ' ', '-', '.', '/', ':', '?', ';', '(', ')'), '_', strip_tags(substr($Car[0]['cars']['info'], 0, 70))) . ".htm"); ?>
            <BR>

            Views: <?php echo $Car[0]['cars']['views'] . ' '; ?><br/><br/>

            <?php echo sprintf(__("Posted on %s", true), $Car[0]['cars']['date']); ?><br/>
            Telefon: <?php echo $Car[0]['cars']['phone'] . ' '; ?>

        </p>
    </div>
    <div id="articleCnt" style="">
        <br/>
        <?php echo ucwords(substr($Car[0]['cars']['info'], 0, 200)); ?><br/><br/>
        <?php // echo trim(ucwords(substr($Article['descr'],0,200))); ?>
        <hr/>

        Tip: <?php echo trim($Car[0]['cars']['type']); ?><br/>
        Pret: <?php echo trim($Car[0]['cars']['price']); ?><br/>
        An: <?php echo trim($Car[0]['cars']['years']); ?><br/>
        Km: <?php echo trim($Car[0]['cars']['km']); ?><br/>
        PW: <?php echo trim($Car[0]['cars']['power']); ?><br/>
        Cmc: <?php echo trim($Car[0]['cars']['cmc']); ?><br/>
        Viteze: <?php echo trim($Car[0]['cars']['speeds']); ?><br/>
        <hr/>

        Persoana: <?php echo trim($Car[0]['cars']['person']); ?><br/>
        Judet: <?php echo trim($Car[0]['cars']['state']); ?><br/>
        Telefon: <?php echo trim($Car[0]['cars']['phone']); ?><br/>
        Web: <?php echo trim($Car[0]['cars']['web']); ?><br/>

    </div>

    <?php echo $this->renderElement('googlemain1'); ?>

    <div style="clear:both"></div>
</div>