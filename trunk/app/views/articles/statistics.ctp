<div class="infoBox">

    <?php

    // Set graph colors
    /*$color = array(
        "#A91F0B",
        "#C0872D",
        "#6E1207",
        "#000000",
        "#FDC726",
        "#FF0000",
        "#FF0033",
        "#FF3333",
        "#FF6633",
        "#FF9933",
        "#FFCC33",
        "#FFFF33"
    );

    // Set graph colors
    $color = array(
        "#900000",
        "#980000",
        "#A00000",
        "#A80000",
        "#B00000",
        "#B80000",
        "#C00000",
        "#C80000",
        "#D00000",
        "#D80000",
        "#E00000",
        "#E80000",
        "#F00000"
    );*/

    $color = array(
        '#555555',
        '#FF0000',
        '#EA0D07',
        '#FFFF48',
        '#872D2D',
        '#EBBE4A',
        '#6E1207',
        '#FFFF48',
        '#000000'
    );

    ?>

    <span>Top 10 utilizatori </span><BR><BR>

    <?php

    //print "<pre>"; print_r($statistics); print "</pre>";
    $chart->setChartAttrs(array(
                              'type'  => 'pie3d',
                              'color' => $color,
                              'data'  => $dataByUser,
                              'size'  => array(530, 160)
                          ));
    // Print chart
    echo "<img src=" . $chart->display() . ">";
    ?>

    <BR><BR>

    <span>Statistica anunturi / categorie </span><BR><BR>
    <?php
    /* # Chart 2 # */
    $chart->setChartAttrs(array(
                              'type'  => 'pie3d',
                              'color' => $color,
                              'data'  => $dataByCategory,
                              'size'  => array(530, 160)
                          ));
    // Print chart
    echo "<img src=" . $chart->display() . ">";
    ?>

    <BR><BR>

    <span>Statistica vechime / autovehicule </span><BR><BR>
    <?php
    /* # Chart 2 # */
    $chart->setChartAttrs(array(
                              'type'  => 'pie',
                              'color' => $color,
                              'data'  => $dataCarsByYear,
                              'size'  => array(530, 200)
                          ));
    // Print chart
    echo "<img src=" . $chart->display() . ">";
    ?>

    <BR><BR>

    <span>Statistica tip apartament / imobiliare </span><BR><BR>
    <?php
    /* # Chart 2 # */
    $chart->setChartAttrs(array(
                              'type'  => 'pie',
                              'color' => $color,
                              'data'  => $dataHousesByType,
                              'size'  => array(530, 200)
                          ));
    // Print chart
    echo "<img src=" . $chart->display() . ">";
    ?>

    <BR><BR>

    <span>Statistica anunturi / luna </span><BR><BR>
    <?php
    /* # Chart 2 # */
    //echo '<h2>Vertical Bar</h2>';
    $chart->setChartAttrs(array(
                              'type'     => 'bar-vertical',
                              'title'    => '',
                              'color'    => $color,
                              'data'     => $dataByMonth,
                              'size'     => array(530, 200),
                              'labelsXY' => false,
                          ));
    // Print chart
    echo "<img src=" . $chart->display() . ">";
    ?>

</div>