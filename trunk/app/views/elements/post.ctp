<h1><?php echo $html->link($Post['title'], "/post/" . $Post['id'] . "/" . $Post['slug']); ?></h1>
<p><?php echo sprintf(__("Posted on %s", true), $Post['created']); ?><br/>
    <?php echo sprintf(__("Filled under %s", true), $html->link($Category['title'], "/cat/" . $Category['id'] . "/" . $Category['slug'])); ?>
    | <?php echo $html->link(sprintf(__("Comments (%d)", true), count($Comment)), "/post/" . $Post['id'] . "/" . $Post['slug'] . "#comment-form"); ?>
</p>

<p style="text-align: left;"><?php echo $Post['body']; ?></p>