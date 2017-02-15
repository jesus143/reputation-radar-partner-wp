<?php


function rrp_settings_func() {
 ?> 
 <br><br> 
       <div class="container" style="border: 1px solid #d6d6d6;background-color: #f3f3f3;">  
      <div class="row">
        <div class="col-md-12"> 
          <br/><br/> 
          <div class="list-group"> 
            <a href="#" class="list-group-item active"> 
              <h4 class="list-group-item-heading">Copmany Name</h4> 
              <p class="list-group-item-text"> <small>This is the company name</small>  </p> 
            </a> 
            <a href="#" class="list-group-item"> 
              <h4 class="list-group-item-heading">UK Company</h4>  
            </a>  
          </div> 
          <br/><br/> 
          <div class="list-group"> 
            <a href="#" class="list-group-item active"> 
              <h4 class="list-group-item-heading">Copmany Url</h4> 
              <p class="list-group-item-text"> <small>This is the company name</small>  </p> 
            </a> 
            <a href="#" class="list-group-item"> 
              <h4 class="list-group-item-heading">uk-company.com</h4>  
            </a>  

          </div> 
           <br/><br/> 
               <div class="list-group"> 
            <a href="#" class="list-group-item active"> 
              <h4 class="list-group-item-heading">Company Keyword For Internet Search</h4> 
              <p class="list-group-item-text"> <small>This is the company keyword for internet search...............</small>  </p> 
            </a> 
            <div class="list-group-item">  

                <form action="<?php print rrp_get_current_site_url_full(); ?>" method="post" >
                <br><br>
                <div class="form-group">

                    <?php print " user_id " . rrp_get_authenticated_user_id(); ?>
                  <input type="text" class="form-control" value="<?php print rrp_settings_get_current_user_keyword(); ?>" name="company_search_keyword" />
                  <input type="text" class="form-control" value="<?php print rrp_settings_get_current_user_url(); ?>" name="company_url" />
                  <br/>
                  <input type="submit" value="Update" class="alert alert-info" name="rrp_post_settings"  /> 

                  </form>
                </div> 
            </div>  
          </div>
 
        </div>
        
         
      </div>
  </div> 
<?php 
}

function rrp_alert_partner_func() {

    $partner_id              = 1486755452;
    $alert                   = new App\WP_Reputation_Radar_Alert();
    $partnersAlertAll        = $alert->getPartnersAlertAll($partner_id);
    $partnersAlertRelated    = $alert->getPartnersAlertRelated($partner_id);
    $partnersAlertNotRelated = $alert->getPartnersAlertNotRelated($partner_id);
    $totalAllAlert           = $alert->countTotalAllAlert($partner_id);
    $totalRelevantAlert      = $alert->countTotalRelevantAlert($partner_id);
    $totalNotRelevantAlert   = $alert->countTotalNotRelevantAlert($partner_id);


//    dd($partnersAlertAll);

  ?>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css" >
    <script src="//code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>

  <br><br><br>
   <div class="container" style="border: 1px solid #d6d6d6;background-color: #f3f3f3;">  
    <br> 

      <h3> Display Alerts </h3>

      <div class="row">
        <div class="col-md-12"> 
          
          <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#home">All Alert ( <?php print $totalAllAlert ; ?> )</a></li>
            <li><a data-toggle="tab" href="#menu1">Relevant Alert (<?php print $totalRelevantAlert; ?>)</a></li>
            <li><a data-toggle="tab" href="#menu2">Not Relevant alert ( <?php print $totalNotRelevantAlert ; ?> )</a></li>
          </ul>

          <div class="tab-content">
            <div id="home" class="tab-pane fade in active"> 
                <div class="list-group">
                    <?php $alert->uiAlertAll($partnersAlertAll); ?>
                </div> 
            </div>
            <div id="menu1" class="tab-pane fade">
                <?php $alert->uiAlertRelated($partnersAlertRelated);   ?>
             </div>
            <div id="menu2" class="tab-pane fade">
                <?php $alert->uiAlertNotRelated($partnersAlertNotRelated);   ?>
            </div>
          </div>
          
        </div>   
      </div>
  </div>
  <?php
}

function rrp_alert_agent_func()
 {
    $partner_id              = 1486755452;
    $alert                   = new App\WP_Reputation_Radar_Alert();
    $partnersAlertInit        = $alert->getPartnersAlertInit($partner_id);


    //    dd($partnersAlertAll);

  ?>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css" >
    <script src="//code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>

  <br><br><br>
   <div class="container" style="border: 1px solid #d6d6d6;background-color: #f3f3f3;">
    <br>

      <h3> Display Alerts </h3>

      <div class="row">
        <div class="col-md-12">
            <?php $alert->uiAlertInit($partnersAlertInit); ?>
        </div>
      </div>
    </div>
    <?php
    }