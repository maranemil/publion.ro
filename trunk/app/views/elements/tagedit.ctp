<script>
    <!--
    function tagFill(tag, id) {
        window.document.getElementById('TagTag').value = tag;
        window.document.getElementById('TagId').value = id;
        return false;
    }

    //-->
</script>
<?php echo $html->formTag('/tags/save/');
echo $html->hidden('Tag/id');
?>
<label>Tag</label>
<?php echo $html->input('Tag/tag', array('size' => '10')); ?>
<?php echo $html->submit('Update', array("class" => "comment-button")) ?>
</form>
<br/>
<br/>