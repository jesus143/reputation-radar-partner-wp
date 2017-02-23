

//$url = 'https://testing.umbrellasupport.co.uk/';
$url = $('#rrp_ri_site_url').val();  // 'http://localhost/practice/wordpress/';

function updatePartnerAlertToNotRelatedByAgent(alert_id)
{
    $.get( $url + "/wordpress/wp-content/plugins/reputation-radar-partner/includes/ajax/rate_agent_non_related.php", { alert_id: alert_id } )
    .done(function( data ) {
        if(data.status  == 'success' ) {
            console.log("successfully rated to related");
        } else {
            console.log("ophs, something wrong!");
        }
       $("#rrp-alert-" + alert_id).css('display', 'none');
    });
}

function updatePartnerAlertToRelatedByAgent(alert_id)
{
    $.get( $url + "/wp-content/plugins/reputation-radar-partner/includes/ajax/rate_agent_related.php", { alert_id: alert_id } )
    .done(function( data ) {
        if(data.status  == 'success' ) {
            console.log("successfully rated to related");
        } else {
            console.log("ophs, something wrong!");
        }
       $("#rrp-alert-" + alert_id).css('display', 'none');
    });
}


function updatePartnerAlertToRelated(alert_id)
{
    $.get( $url + "/wp-content/plugins/reputation-radar-partner/includes/ajax/rate_related_non_related.php", { alert_id: alert_id, type:'related' } )
    .done(function( data ) {
        if(data.status  == 'success' ) {
            console.log("successfully rated to related");
        } else {
            console.log("ophs, something wrong!");
        }
       $("#rrp-alert-" + alert_id).css('display', 'none');
    });
}

function updatePartnerAlertNotToRelated(alert_id)
{
    $.get( $url + "/wp-content/plugins/reputation-radar-partner/includes/ajax/rate_related_non_related.php", { 'alert_id': alert_id, type:'not related' } )
    .done(function( data ) {
        if(data.status  == 'success' ) {
            console.log("successfully rated to not related");
        } else {
            console.log("ophs, something wrong!");
        }
        $("#rrp-alert-" + alert_id).css('display', 'none');
    });
}


function deleteAlert(alert_id)
{
    if(confirm("Are you sure you want to delete this alert?")) {
        $.get( $url + "/wp-content/plugins/reputation-radar-partner/includes/ajax/alert-delete.php", { 'alert_id': alert_id } )
        .done(function( data ) {
            console.log("done delet ");
            $("#rrp-alert-" + alert_id).css('display', 'none');
        });

    }
}
