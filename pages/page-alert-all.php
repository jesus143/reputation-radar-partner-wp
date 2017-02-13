<script>
    $(document).ready(function() {
        $('#rrp-alert-all').DataTable();
    } );
</script>


<?php

$partnersAlertAll        = $alert->getPartnersAlertAll($partner_id);

?>

<table id="rrp-alert-all" class="display" cellspacing="0" width="100%">
    <thead>
    <tr>
        <th>Name</th>
        <th>Title</th>
        <th>Description</th>
        <th>Url</th>
        <th>Relevant</th>
        <th>Not Relevant</th>
    </tr>
    </thead>
    <tfoot>
    <tr>
        <th>Name</th>
        <th>Title</th>
        <th>Description</th>
        <th>Url</th>
        <th>Relevant</th>
        <th>Not Relevant</th>
    </tr>
    </tfoot>
    <tbody>
    <?php foreach($partnersAlertAll as $alert): ?>
    <tr id="rrp-alert-<?php print $alert['id']; ?>">
        <td> <?php print $alert['person_name']; ?> </td>
        <td> <?php print $alert['title']; ?> </td>
        <td> <?php print $alert['description']; ?> </td>
        <td> <?php print $alert['url']; ?> </td>
        <td> <input type="button" class="alert alert-info" value="Relevant" onClick="updatePartnerAlertToRelated(<?php print $alert['id']; ?>)" />  </td>
        <td> <input type="button" class="alert alert-info" value="Not Relevant" onClick="updatePartnerAlertNotToRelated(<?php print $alert['id']; ?>)" />  </td>
    </tr>
    <?php endforeach; ?>
    </tbody>
</table>