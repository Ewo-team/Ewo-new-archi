<?= form_input(array(
    'name'          => $name,
    'placeholder'   => $selected,
    'value'         => $selected,
    'id'            => $id
))?>
<script>
    <!--
        $('#<?= $id ?>').typeahead({
            'source' : <?= json_encode($list) ?>
        });
    -->
</script>
