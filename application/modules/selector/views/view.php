<?= form_input(array(
    'name'          => $name,
    'placeholder'   => $selected,
    'value'         => $selected,
    'id'            => $id
))?>
<script>
    <!--
        jQuery('#<?= $id ?>').typeahead({
            'source' : <?= json_encode($list) ?>
        });
    -->
</script>
