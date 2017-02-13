<script>
    $(document).ready(function() {
        $('#rrp-alert-all').DataTable();
    } );
</script>


<table id="rrp-alert-not-related" class="display" cellspacing="0" width="100%">
    <thead>
    <tr>
        <th>Name</th>
        <th>Title</th>
        <th>Description</th>
        <th>Url</th>
    </tr>
    </thead>
    <tfoot>
    <tr>
        <th>Name</th>
        <th>Title</th>
        <th>Description</th>
        <th>Url</th>
    </tr>
    </tfoot>
    <tbody>

    <?php foreach($partnersAlertNotRelated as $alert): ?>
        <tr>
            <td> <?php print $alert['person_name']; ?> </td>
            <td> <?php print $alert['title']; ?> </td>
            <td> <?php print $alert['description']; ?> </td>
            <td> <?php print $alert['url']; ?> </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>