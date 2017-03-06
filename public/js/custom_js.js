





function getSiteUrl()
{
    return jQuery('#rrp_ri_site_url').val();
}


function updatePartnerAlertToNotRelatedByAgent(alert_id, loader)
{

    jQuery(loader).css('display', 'block');
    jQuery.get( getSiteUrl() + "/wp-content/plugins/reputation-radar-partner/includes/ajax/rate_agent_non_related.php", { alert_id: alert_id } )
    .done(function( data ) {
        if(data.status  == 'success' ) {
            console.log("successfully rated to related");
        } else {
            console.log("ophs, something wrong!");
        }
        jQuery("#rrp-alert-" + alert_id).css('display', 'none');
    });
}

function updatePartnerAlertToRelatedByAgent(alert_id, loader)
{



    jQuery(loader).css('display', 'block');

    jQuery.get( getSiteUrl() + "/wp-content/plugins/reputation-radar-partner/includes/ajax/rate_agent_related.php", { alert_id: alert_id } )
    .done(function( data ) {
        if(data.status  == 'success' ) {
            console.log("successfully rated to related");
        } else {
            console.log("ophs, something wrong!");
        }
        jQuery(loader).css('display', 'none');
        jQuery("#rrp-alert-" + alert_id).css('display', 'none');
    });
}


function updatePartnerAlertToRelated(alert_id, loader)
{

    jQuery(loader).css('display', 'block');
    jQuery.get( getSiteUrl() + "/wp-content/plugins/reputation-radar-partner/includes/ajax/rate_related_non_related.php", { alert_id: alert_id, type:'related' } )
    .done(function( data ) {
        if(data.status  == 'success' ) {
            console.log("successfully rated to related");
        } else {
            console.log("ophs, something wrong!");
        }
        jQuery(loader).css('display', 'none');
        jQuery("#rrp-alert-" + alert_id).css('display', 'none');
    });
}

function updatePartnerAlertNotToRelated(alert_id, loader)
{
    jQuery(loader).css('display', 'block');
    jQuery.get( getSiteUrl() + "/wp-content/plugins/reputation-radar-partner/includes/ajax/rate_related_non_related.php", { 'alert_id': alert_id, type:'not related' } )
    .done(function( data ) {
        if(data.status  == 'success' ) {
            console.log("successfully rated to not related");
        } else {
            console.log("ophs, something wrong!");
        }
        jQuery(loader).css('display', 'none');
        jQuery("#rrp-alert-" + alert_id).css('display', 'none');
    });
}


function deleteAlert(alert_id, loader)
{
    jQuery(loader).css('display', 'block');
    if(confirm("Are you sure you want to delete this alert?")) {
        jQuery.get( getSiteUrl() + "/wp-content/plugins/reputation-radar-partner/includes/ajax/alert-delete.php", { 'alert_id': alert_id } )
        .done(function( data ) {
            console.log("done delet ");
            jQuery(loader).css('display', 'none');
            jQuery("#rrp-alert-" + alert_id).css('display', 'none');
        });

    }
}
