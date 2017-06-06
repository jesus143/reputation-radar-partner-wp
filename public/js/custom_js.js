





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
    } else {
        jQuery(loader).css('display', 'none');
    }
}





function rrp_agent_click()
{ 



    type = document.querySelector('input[name="rrp_time_option"]:checked').value;

    agent_id = document.getElementById('rrp_agent_id').value;

    var day = '', hour = '', week = '';

    if(type == 'hour') {

        //hour = document.getElementById('rrp_time').value;

    } else if (type == 'day') {

        hour = document.getElementById('rrp_time_day_hour').value;
        day = document.getElementById('rrp_time_day').value;

    } else {

        week = document.getElementById('rrp_time_week').value;

        if(week == null || week == "") {
            alert("Please select a week."); 
            return;
        } 

    }

    $("#rrp_calculate_loader").css('display', 'block'); 

    console.log(" week " + week + " hour " + hour + " day "  + day);  
    // console.log(" type " + type + " hour " + hour + " day " + day + " week " + week + " agent_id " + agent_id);

    // send post request
    $.post( getSiteUrl() + "/wp-content/plugins/reputation-radar-partner/includes/ajax/rate_agent_calculate.php", { agent_id: agent_id , type: type, hour:hour, day:day, week:week })
        .done(function( data ) {
            //console.log("test" + data);
            var response = JSON.parse(data);
            $("#rrp_agent_total_click_response_display").html(response.total_click);
            console.log( "Data Loaded: " + data );

            $("#rrp_calculate_loader").css('display', 'none');

        });

    //$.post( getSiteUrl() + "/wp-content/plugins/reputation-radar-partner/includes/ajax/rate_agent_calculate.php", { agent_id: agent_id , type: type, hour:hour, day:day, week:week }, function( data ) {
    //
    //
    //
    //    console.log("Test");
    //
    //    //
    //    //console.log(data.total_click)
    //    //$("#rrp_agent_total_click_response_display").append(data.total_click);
    //}, "json");


}


function rrp_time_option(sortAs)
{
    //$("rrp_sort_agent_click_per_hour").css('display', 'none');
    //$("rrp_sort_agent_click_per_day").css('display', 'none');
    //$("rrp_sort_agent_click_per_week").css('display', 'none');

    //document.getElementById("rrp_sort_agent_click_per_hour").style.display = "none";
    document.getElementById("rrp_sort_agent_click_per_day").style.display = "none";
    document.getElementById("rrp_sort_agent_click_per_week").style.display = "none";

    document.getElementById("rrp_sort_agent_click_per_" + sortAs).style.display = "block";
}
