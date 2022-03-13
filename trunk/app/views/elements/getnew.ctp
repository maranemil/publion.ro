<div id="contentBox">
    <div id="articleImg">
        <?php

        $ArFld = substr(str_replace("-", "", $Getnew['date']), 0, 6); // MONTHLY FOLDER PATH
        echo "<a href='" . $this->webroot . "articles/view/" . $Getnew['id'] . "/" . str_replace(array(',', ' ', '-', '.', '/', ':', '?', ';', '(', ')'), '_', strip_tags(substr($Getnew['descr'], 0, 70))) . ".htm'>";
        if ($Getnew['image'] !== null) {
            echo "<img src='" . $this->webroot . "img/stiri/" . trim($Getnew['image']) . "'></a>";
        } else {
            echo "<img src='" . $this->webroot . "img/upload2/noimg.jpg'></a>";
            //echo "<a href='".$this->webroot."articles/view/".$Article['id']."/'><img src='".$this->webrootROOT."img/upload/noimg.jpg' width=150></a>";
        }
        ?>
    </div>
    <div id="articleTitle">
        <?php echo $html->link($Getnew['title'], "/getnews/view/" . $Getnew['id'] . "/" . str_replace(array(',', ' ', '-', '.', '/', ':', '?', ';', '(', ')'), '_', strip_tags(substr($Getnew['descr'], 0, 70))) . ".htm"); ?>
        <p>
            <?php echo sprintf(__("Posted on %s", true), $Getnew['date']); ?><br/>
        </p>

    </div>
    <div id="articleCnt">
        <?php echo ucwords(substr($Getnew['descr'], 0, 200)); ?><br/><br/>
        <?php // echo Sanitize::html(ucwords(substr($Article['descr'],0,200))); ?>
    </div>
    <div style="clear:both"></div>
</div>

