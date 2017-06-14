<?php

/**
* Display settings of the partner in testing
*/
function rrp_settings_func() {

    rrp_check_login_redirect_login_page();
    rrp_script_and_style();
    $keyword_setting = rrp_setting_get_current_user_keyword_setting();
    print_site_url_hidden_field(); ?>
     
        <style> 

            /* Hide title and pre style  */
            #page-content h2:nth-child(1), pre {
                color:red !important; 
                display:none !important; 
            } 

            /** Make the row fit with the container */
            .row {
                width: 100% !important;
                padding: 0px !important;
                margin: 0px !important;
                max-width: 98%;
            }

        </style> 
  
        <div class="row" >
            <div class="col-md-12"> 
            
                <?php  
                    if(!empty($_SESSION['rrp_settings_update_status'])) {  
                        echo "<br><br>";
                        echo $_SESSION['rrp_settings_update_status'];
                        unset($_SESSION['rrp_settings_update_status']); 
                    } 
                ?> 

                <br/><br/> 
                <div class="list-group">  
                    <div  style="background: #d7090b; padding:10px;">
                        <div style="text-align:center" > 
                            <span style="font-size:20px;color:white;">Company Keyword For Internet Search</span> 
                        </div> 
                    </div>   
                </div>
                <div class="list-group-item">   
                    <form action="<?php print rrp_get_current_site_url_full(); ?>" method="post" >

                        <br><br>
                        <div class="form-group"> 

                            <?php //print " user_id " . rrp_get_authenticated_user_id(); ?>
                            <label class="label" style="color:black"> Company Search Keyword </label><br><br>
                            <input type="text" style="width:98%" class="form-control" value="<?php print rrp_settings_get_current_user_keyword(); ?>" name="company_search_keyword" />

                            <hr>
                            <label class="label" style="color:black"> Company Url</label><br><br>
                            <input type="text"  style="width:98%" class="form-control" value="<?php print rrp_settings_get_current_user_url(); ?>" name="company_url" />

                            <hr>
                            <label class="label" style="color:black">Choose Keyword Settings</label><br><br>
                                <select name="keyword_setting" class="form-control"  style="width:98%" >
                                    <option value="Broad match"             <?php print ($keyword_setting == 'Broad match') ? 'selected' : null; ?>            >Broad match (keywod) - "Broad match is the default match type that all your keywords are assigned"</option>
                                    <option value="Broad match modifier"    <?php print ($keyword_setting == 'Broad match modifier') ? 'selected' : null; ?>   >Broad match modifier (+keywod) - "Ads may show on searches that contain the modified term (or close variations, but not synonyms), in any order."</option>
                                    <option value="Phrase match"            <?php print ($keyword_setting == 'Phrase match') ? 'selected' : null; ?>           >Phrase match ("keywod") - "Ads may show on searches that are a phrase, and close variations of that phrase."</option>
                                    <option value="Exact match"             <?php print ($keyword_setting == 'Exact match') ? 'selected' : null; ?>            >Exact match ([keyword]) - "Ads may show on searches that are an exact term and close variations of that exact term." </option>
                                    <option value="Negative match"          <?php print ($keyword_setting == 'Negative match') ? 'selected' : null; ?>         >Negative match (-keyword) - "Ads may show on searches without the term."</option>
                                </select> 
                            <br/>
                            <input type="submit" value="Update" class="alert alert-info rrp-post-settings" name="rrp_post_settings"  />
                        </div> 
                    </form>
                </div> 
            </div>  
        </div>
   
<?php 
}

/**
* Display partner scraped status and already validated with agent as relevant
*/
function rrp_alert_partner_func() {

    rrp_check_login_redirect_login_page();

     error_reporting(0);

     $agent_id           = $_GET['agent_id'];
     $sort_time_click    = $_GET['sort_time_click'];
     $action             = $_GET['action'];
 
     $alert                   = new App\WP_Reputation_Radar_Alert();
     $setting                 = new App\WP_Reputation_Radar_Settings();
     $partner_id              = $setting->getCurrentPartnerIdFromSettings();

     $partnersAlertAll        = '';
     $partnersAlertRelated    = '';
     $partnersAlertNotRelated = '';

     $totalAllAlert           = 0;
     $totalRelevantAlert      = 0;
     $totalNotRelevantAlert   = 0;

     $agent_content_class           = '';
     $agent_menu_class             = '';
     $client_content_class         = '';
     $client_menu_class            = '';

    if (!empty($agent_id)) {

         $partnersAlertNotRelated = $alert->getAgentSetRelevantComplainByClient($agent_id);
         $totalNotRelevantAlert =  count($partnersAlertNotRelated);


         if($action == 'view all click') {

             $partnersAlertAll  = $alert->getPartnersAlertAllByAgentClick($agent_id);
             $totalAllAlert     =  count($partnersAlertAll);

             $partnersAlertRelated = $alert->getPartnersAlertRelatedByAgentClick($agent_id);
             $totalRelevantAlert   =  count($partnersAlertRelated);

         }


         $agent_content_class   =  ' in active';
         $agent_menu_class      = 'active';

    } else if(!empty($partner_id)) {

        $partnersAlertAll        = $alert->getPartnersAlertAll($partner_id);
        $partnersAlertRelated    = $alert->getPartnersAlertRelated($partner_id);
        $partnersAlertNotRelated = $alert->getPartnersAlertNotRelated($partner_id);

        $totalAllAlert           = $alert->countTotalAllAlert($partner_id);
        $totalRelevantAlert      = $alert->countTotalRelevantAlert($partner_id);
        $totalNotRelevantAlert   = $alert->countTotalNotRelevantAlert($partner_id);
        $client_content_class    = ' in active';
        $client_menu_class       = ' active';

    } else {

    } 
    rrp_script_and_style();
    print_site_url_hidden_field();
    $dateNow = rrp_get_date_today();

    // dd($partnersAlertAll); 
     
  ?>
  <br><br><br>
   <div> 

    <?php if($sort_time_click == true): ?> 
        <div class="panel panel-default">
          <div class="panel-body">
           Calculate total agent click report for hour, day and week.
          </div>
            <div class="panel-footer">
                 <b> Agent Name: <?php echo rrp_get_user_full_name($agent_id); ?> </b> <br><br>
                <div class="row">
                    <div class="col-md-12">
                        <input type="hidden" name="rrp_agent_id" id="rrp_agent_id"  value="<?php echo $agent_id; ?>" />
                        <div class="btn-group" data-toggle="buttons">
                            <label class="btn btn-primary active">
                                <div onclick="rrp_time_option('day')" style="display:inline; cursor:pointer" >    
                                    <input type="radio" name="rrp_time_option" value="day" checked/><span>Day</span>
                                </div>
                            </label>
                            <label class="btn btn-primary">
                                <div onclick="rrp_time_option('week')" style="display:inline;  cursor:pointer" >  
                                    <input type="radio" name="rrp_time_option" value="week" /><span>Week</span>
                                </div> 
                            </label>
                        </div>
                        <hr>
                            <div id="rrp_sort_agent_click_per_day" style="display:block" >
                                <label for="meeting">Calculate by hour and day</label><br> <br>
                                <select name="time" id="rrp_time_day_hour"  ><?php echo rrp_get_times('Selected..'); ?></select><br><br>
                                <input id="rrp_time_day" type="date" value="<?php echo $dateNow; ?>"/>
                            </div> 
                            <div id="rrp_sort_agent_click_per_week" style=" display:none" > 
                                <label for="meeting">Calculate by week </label>  <br><br><input  id="rrp_time_week" type="week" /> <br><br>
                            </div>
                        <hr> 
                        <input type="button" value="Calculate" onclick="rrp_agent_click()" /> <br><br> 
                            <div style="display: none;" class="rrp-loader" id="rrp_calculate_loader"></div> 
                        <div id="rrp_agent_total_click_response_display">  </div>
                    </div>
                </div>
            </div>
        </div>
    <?php else: ?> 
          <div class="row">
            <div>
              <ul class="nav nav-tabs">
                <li class="<?php echo $client_menu_class; ?>"><a data-toggle="tab" href="#home">All Alert ( <?php print $totalAllAlert ; ?> )</a></li>
                <li><a data-toggle="tab" href="#menu1">Relevant Alert (<?php print $totalRelevantAlert; ?>)</a></li>
                <li class="<?php echo $agent_menu_class; ?>" ><a data-toggle="tab" href="#menu2">Not Relevant alert ( <?php print $totalNotRelevantAlert ; ?> )</a></li>
              </ul>
              <div class="tab-content">
                <div id="home" class="tab-pane  <?php echo $client_content_class; ?>">
                    <div class="list-group">
                        <?php $alert->uiAlertAll($partnersAlertAll); ?>
                    </div>
                </div>
                <div id="menu1" class="tab-pane ">
                    <?php $alert->uiAlertRelated($partnersAlertRelated);   ?>
                 </div>
                <div id="menu2" class="tab-pane  <?php echo $agent_content_class; ?>">
                    <?php $alert->uiAlertNotRelated($partnersAlertNotRelated);   ?>
                </div>
              </div>
            </div>
          </div>
           <br><br><br>
   <?php endif; ?>
  </div>


  <?php
}
/**
* Display all the alert that is being scraped and needs for agent to rate relevant or none relevant in order to display
* scraped data to partners alert
*/
function rrp_alert_agent_func()
 {

    rrp_check_login_redirect_login_page(); 

    $partner_id              = 1486755452;
    $alert                   = new App\WP_Reputation_Radar_Alert();
    $partnersAlertInit        = $alert->getPartnersAlertInit($partner_id);
    //    dd($partnersAlertAll);
    rrp_script_and_style();
    print_site_url_hidden_field();
  ?>
  <br><br><br> 
   <!-- <div class="container" style="border: 1px solid #d6d6d6;background-color: #f3f3f3;"> --> 
   <div class="container-reputation ">
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

/**
* testing only
*/
function rrp_alert_data_tables_test_func()
{

    rrp_script_and_style();
    ?>



<table id="this-is-jus-a-testing-for-data-tables" class="display" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>Position</th>
                <th>Office</th>
                <th>Age</th>
                <th>Start date</th>
                <th>Salary</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Name</th>
                <th>Position</th>
                <th>Office</th>
                <th>Age</th>
                <th>Start date</th>
                <th>Salary</th>
            </tr>
        </tfoot>
        <tbody>
            <tr>
                <td>Tiger Nixon</td>
                <td>System Architect</td>
                <td>Edinburgh</td>
                <td>61</td>
                <td>2011/04/25</td>
                <td>$320,800</td>
            </tr>
            <tr>
                <td>Garrett Winters</td>
                <td>Accountant</td>
                <td>Tokyo</td>
                <td>63</td>
                <td>2011/07/25</td>
                <td>$170,750</td>
            </tr>
            <tr>
                <td>Ashton Cox</td>
                <td>Junior Technical Author</td>
                <td>San Francisco</td>
                <td>66</td>
                <td>2009/01/12</td>
                <td>$86,000</td>
            </tr>
            <tr>
                <td>Cedric Kelly</td>
                <td>Senior Javascript Developer</td>
                <td>Edinburgh</td>
                <td>22</td>
                <td>2012/03/29</td>
                <td>$433,060</td>
            </tr>
            <tr>
                <td>Airi Satou</td>
                <td>Accountant</td>
                <td>Tokyo</td>
                <td>33</td>
                <td>2008/11/28</td>
                <td>$162,700</td>
            </tr>
            <tr>
                <td>Brielle Williamson</td>
                <td>Integration Specialist</td>
                <td>New York</td>
                <td>61</td>
                <td>2012/12/02</td>
                <td>$372,000</td>
            </tr>
            <tr>
                <td>Herrod Chandler</td>
                <td>Sales Assistant</td>
                <td>San Francisco</td>
                <td>59</td>
                <td>2012/08/06</td>
                <td>$137,500</td>
            </tr>
            <tr>
                <td>Rhona Davidson</td>
                <td>Integration Specialist</td>
                <td>Tokyo</td>
                <td>55</td>
                <td>2010/10/14</td>
                <td>$327,900</td>
            </tr>
            <tr>
                <td>Colleen Hurst</td>
                <td>Javascript Developer</td>
                <td>San Francisco</td>
                <td>39</td>
                <td>2009/09/15</td>
                <td>$205,500</td>
            </tr>
            <tr>
                <td>Sonya Frost</td>
                <td>Software Engineer</td>
                <td>Edinburgh</td>
                <td>23</td>
                <td>2008/12/13</td>
                <td>$103,600</td>
            </tr>
            <tr>
                <td>Jena Gaines</td>
                <td>Office Manager</td>
                <td>London</td>
                <td>30</td>
                <td>2008/12/19</td>
                <td>$90,560</td>
            </tr>
            <tr>
                <td>Quinn Flynn</td>
                <td>Support Lead</td>
                <td>Edinburgh</td>
                <td>22</td>
                <td>2013/03/03</td>
                <td>$342,000</td>
            </tr>
            <tr>
                <td>Charde Marshall</td>
                <td>Regional Director</td>
                <td>San Francisco</td>
                <td>36</td>
                <td>2008/10/16</td>
                <td>$470,600</td>
            </tr>
            <tr>
                <td>Haley Kennedy</td>
                <td>Senior Marketing Designer</td>
                <td>London</td>
                <td>43</td>
                <td>2012/12/18</td>
                <td>$313,500</td>
            </tr>
            <tr>
                <td>Tatyana Fitzpatrick</td>
                <td>Regional Director</td>
                <td>London</td>
                <td>19</td>
                <td>2010/03/17</td>
                <td>$385,750</td>
            </tr>
            <tr>
                <td>Michael Silva</td>
                <td>Marketing Designer</td>
                <td>London</td>
                <td>66</td>
                <td>2012/11/27</td>
                <td>$198,500</td>
            </tr>
            <tr>
                <td>Paul Byrd</td>
                <td>Chief Financial Officer (CFO)</td>
                <td>New York</td>
                <td>64</td>
                <td>2010/06/09</td>
                <td>$725,000</td>
            </tr>
            <tr>
                <td>Gloria Little</td>
                <td>Systems Administrator</td>
                <td>New York</td>
                <td>59</td>
                <td>2009/04/10</td>
                <td>$237,500</td>
            </tr>
            <tr>
                <td>Bradley Greer</td>
                <td>Software Engineer</td>
                <td>London</td>
                <td>41</td>
                <td>2012/10/13</td>
                <td>$132,000</td>
            </tr>
            <tr>
                <td>Dai Rios</td>
                <td>Personnel Lead</td>
                <td>Edinburgh</td>
                <td>35</td>
                <td>2012/09/26</td>
                <td>$217,500</td>
            </tr>
            <tr>
                <td>Jenette Caldwell</td>
                <td>Development Lead</td>
                <td>New York</td>
                <td>30</td>
                <td>2011/09/03</td>
                <td>$345,000</td>
            </tr>
            <tr>
                <td>Yuri Berry</td>
                <td>Chief Marketing Officer (CMO)</td>
                <td>New York</td>
                <td>40</td>
                <td>2009/06/25</td>
                <td>$675,000</td>
            </tr>
            <tr>
                <td>Caesar Vance</td>
                <td>Pre-Sales Support</td>
                <td>New York</td>
                <td>21</td>
                <td>2011/12/12</td>
                <td>$106,450</td>
            </tr>
            <tr>
                <td>Doris Wilder</td>
                <td>Sales Assistant</td>
                <td>Sidney</td>
                <td>23</td>
                <td>2010/09/20</td>
                <td>$85,600</td>
            </tr>
            <tr>
                <td>Angelica Ramos</td>
                <td>Chief Executive Officer (CEO)</td>
                <td>London</td>
                <td>47</td>
                <td>2009/10/09</td>
                <td>$1,200,000</td>
            </tr>
            <tr>
                <td>Gavin Joyce</td>
                <td>Developer</td>
                <td>Edinburgh</td>
                <td>42</td>
                <td>2010/12/22</td>
                <td>$92,575</td>
            </tr>
            <tr>
                <td>Jennifer Chang</td>
                <td>Regional Director</td>
                <td>Singapore</td>
                <td>28</td>
                <td>2010/11/14</td>
                <td>$357,650</td>
            </tr>
            <tr>
                <td>Brenden Wagner</td>
                <td>Software Engineer</td>
                <td>San Francisco</td>
                <td>28</td>
                <td>2011/06/07</td>
                <td>$206,850</td>
            </tr>
            <tr>
                <td>Fiona Green</td>
                <td>Chief Operating Officer (COO)</td>
                <td>San Francisco</td>
                <td>48</td>
                <td>2010/03/11</td>
                <td>$850,000</td>
            </tr>
            <tr>
                <td>Shou Itou</td>
                <td>Regional Marketing</td>
                <td>Tokyo</td>
                <td>20</td>
                <td>2011/08/14</td>
                <td>$163,000</td>
            </tr>
            <tr>
                <td>Michelle House</td>
                <td>Integration Specialist</td>
                <td>Sidney</td>
                <td>37</td>
                <td>2011/06/02</td>
                <td>$95,400</td>
            </tr>
            <tr>
                <td>Suki Burks</td>
                <td>Developer</td>
                <td>London</td>
                <td>53</td>
                <td>2009/10/22</td>
                <td>$114,500</td>
            </tr>
            <tr>
                <td>Prescott Bartlett</td>
                <td>Technical Author</td>
                <td>London</td>
                <td>27</td>
                <td>2011/05/07</td>
                <td>$145,000</td>
            </tr>
            <tr>
                <td>Gavin Cortez</td>
                <td>Team Leader</td>
                <td>San Francisco</td>
                <td>22</td>
                <td>2008/10/26</td>
                <td>$235,500</td>
            </tr>
            <tr>
                <td>Martena Mccray</td>
                <td>Post-Sales support</td>
                <td>Edinburgh</td>
                <td>46</td>
                <td>2011/03/09</td>
                <td>$324,050</td>
            </tr>
            <tr>
                <td>Unity Butler</td>
                <td>Marketing Designer</td>
                <td>San Francisco</td>
                <td>47</td>
                <td>2009/12/09</td>
                <td>$85,675</td>
            </tr>
            <tr>
                <td>Howard Hatfield</td>
                <td>Office Manager</td>
                <td>San Francisco</td>
                <td>51</td>
                <td>2008/12/16</td>
                <td>$164,500</td>
            </tr>
            <tr>
                <td>Hope Fuentes</td>
                <td>Secretary</td>
                <td>San Francisco</td>
                <td>41</td>
                <td>2010/02/12</td>
                <td>$109,850</td>
            </tr>
            <tr>
                <td>Vivian Harrell</td>
                <td>Financial Controller</td>
                <td>San Francisco</td>
                <td>62</td>
                <td>2009/02/14</td>
                <td>$452,500</td>
            </tr>
            <tr>
                <td>Timothy Mooney</td>
                <td>Office Manager</td>
                <td>London</td>
                <td>37</td>
                <td>2008/12/11</td>
                <td>$136,200</td>
            </tr>
            <tr>
                <td>Jackson Bradshaw</td>
                <td>Director</td>
                <td>New York</td>
                <td>65</td>
                <td>2008/09/26</td>
                <td>$645,750</td>
            </tr>
            <tr>
                <td>Olivia Liang</td>
                <td>Support Engineer</td>
                <td>Singapore</td>
                <td>64</td>
                <td>2011/02/03</td>
                <td>$234,500</td>
            </tr>
            <tr>
                <td>Bruno Nash</td>
                <td>Software Engineer</td>
                <td>London</td>
                <td>38</td>
                <td>2011/05/03</td>
                <td>$163,500</td>
            </tr>
            <tr>
                <td>Sakura Yamamoto</td>
                <td>Support Engineer</td>
                <td>Tokyo</td>
                <td>37</td>
                <td>2009/08/19</td>
                <td>$139,575</td>
            </tr>
            <tr>
                <td>Thor Walton</td>
                <td>Developer</td>
                <td>New York</td>
                <td>61</td>
                <td>2013/08/11</td>
                <td>$98,540</td>
            </tr>
            <tr>
                <td>Finn Camacho</td>
                <td>Support Engineer</td>
                <td>San Francisco</td>
                <td>47</td>
                <td>2009/07/07</td>
                <td>$87,500</td>
            </tr>
            <tr>
                <td>Serge Baldwin</td>
                <td>Data Coordinator</td>
                <td>Singapore</td>
                <td>64</td>
                <td>2012/04/09</td>
                <td>$138,575</td>
            </tr>
            <tr>
                <td>Zenaida Frank</td>
                <td>Software Engineer</td>
                <td>New York</td>
                <td>63</td>
                <td>2010/01/04</td>
                <td>$125,250</td>
            </tr>
            <tr>
                <td>Zorita Serrano</td>
                <td>Software Engineer</td>
                <td>San Francisco</td>
                <td>56</td>
                <td>2012/06/01</td>
                <td>$115,000</td>
            </tr>
            <tr>
                <td>Jennifer Acosta</td>
                <td>Junior Javascript Developer</td>
                <td>Edinburgh</td>
                <td>43</td>
                <td>2013/02/01</td>
                <td>$75,650</td>
            </tr>
            <tr>
                <td>Cara Stevens</td>
                <td>Sales Assistant</td>
                <td>New York</td>
                <td>46</td>
                <td>2011/12/06</td>
                <td>$145,600</td>
            </tr>
            <tr>
                <td>Hermione Butler</td>
                <td>Regional Director</td>
                <td>London</td>
                <td>47</td>
                <td>2011/03/21</td>
                <td>$356,250</td>
            </tr>
            <tr>
                <td>Lael Greer</td>
                <td>Systems Administrator</td>
                <td>London</td>
                <td>21</td>
                <td>2009/02/27</td>
                <td>$103,500</td>
            </tr>
            <tr>
                <td>Jonas Alexander</td>
                <td>Developer</td>
                <td>San Francisco</td>
                <td>30</td>
                <td>2010/07/14</td>
                <td>$86,500</td>
            </tr>
            <tr>
                <td>Shad Decker</td>
                <td>Regional Director</td>
                <td>Edinburgh</td>
                <td>51</td>
                <td>2008/11/13</td>
                <td>$183,000</td>
            </tr>
            <tr>
                <td>Michael Bruce</td>
                <td>Javascript Developer</td>
                <td>Singapore</td>
                <td>29</td>
                <td>2011/06/27</td>
                <td>$183,000</td>
            </tr>
            <tr>
                <td>Donna Snider</td>
                <td>Customer Support</td>
                <td>New York</td>
                <td>27</td>
                <td>2011/01/25</td>
                <td>$112,000</td>
            </tr>
        </tbody>
    </table>
    <?php
}

/**
* allow agent manage all the partner's rating sites
*/
function rrp_patners_list_agent_func()
{ 
    
    rrp_check_login_redirect_login_page();

    error_reporting(0);

     $ratingSites = [];
     $ratingSite  = [];
     $rating_site = new App\WP_Reputation_Radar_Rating_Site();
     $partnerIds =  getAllPartnerId();
     $partner_id = (!empty($_GET['partner_id'])) ? $_GET['partner_id'] : null;

     print_site_url_hidden_field();
     // Submit create new rating site and trigger save data
     if (isset($_POST['rating_site_add'])) {
        $rating_site->create(['url'=>$_POST['url'], 'partner_id'=>$_POST['partner_id']]);

     } else if(isset($_POST['rating_site_add_fields'])) {
        $rating_site->updateOrCreate(['url'=>$_POST['url'], 'partner_id'=>$_POST['partner_id']]);
     }


     // Click delete link and trigger delete data
     else if($_GET['status'] == 'delete'){
         $rating_site->delete($_GET['id']);
     }

     // Submit edit and post update
     else if(isset($_POST['rating_site_update'])) {

        $rating_site->update($_POST['id'], ['url'=>$_POST['url']]);

        rrp_redirect(rrp_partner_id_list_url . '/?partner_id=' . $_POST['partner_id']);

     }

   if(empty($partner_id))
   {?>
        <br><br><br>
        <div class="container" style="border: 1px solid #d6d6d6;background-color: #f3f3f3;">
        <br>
          <h3> Display partners </h3>
          <div class="row">
            <div class="col-md-12">
                <?php $rating_site->uiPartnersList($partnerIds); ?>
            </div>
          </div>
        </div>
        <?php
    }
    else if($_GET['status'] == 'edit')
    {

        if(!empty($_GET['id'])){
            $ratingSite  = $rating_site->getRating($_GET['id']);
        }

    ?>
        <br><br><br>
        <div class="container" style="border: 1px solid #d6d6d6;background-color: #f3f3f3;">
        <br>
          <h3> Edit partner Info </h3>
          <div class="row">
              <div class="col-md-12">
                <h3>Edit Rating Site for partner id <?php print $partner_id; ?></h3>
                 <?php $rating_site->uiPartnerEditRattingSiteForm($ratingSite); ?>
            </div>
          </div>
        </div>
    <?php
    } else {

         // if manage mode
         if(!empty($partner_id)){
              $ratingSites  = $rating_site->getRatings($partner_id);
         }
        // dd($ratingSites);
        ?>


       <br><br><br>
        <div class="container" style="border: 1px solid #d6d6d6;background-color: #f3f3f3;">

            <!--        <br>-->
            <!--          <h3> Manage partner information </h3>-->
          <div class="row" style="padding:50px">
            <div class="col-md-12" style="display:none">
                <?php $rating_site->uiPartnersRatingSiteList($ratingSites); ?>
            </div>
            <!--            <br>-->
            <!--            <hr>-->
            <!--            <br> -->
              <div class="col-md-12">
                <h3>Add New Rating Site for partner id <?php print $partner_id; ?></h3>
                 <?php $rating_site->fieldTrustPilot($partner_id, $ratingSites); ?>
            </div>
          </div>
        </div> 
           <br><br><br>
            <a href="<?php print rrp_partner_id_list_url;  ?>">
                <button class="alert alert-info">Back To Partner's List</button>
            </a>
    <?php
    }
}

    /**
    * @param $contactmethods
    * Add users alert information about alert complain
    *
    * @return mixed
    */
    function rrp__modify_user_table_alert_sort_time( $column )
    {
        $column['Click Sort Time'] = 'Click Sort Time';
        return $column;
    }
    add_filter( 'manage_users_columns', 'rrp__modify_user_table_alert_sort_time' );
    function rrp_modify_user_table_alert_complain( $column )
    {
        $column['Alert Complain'] = 'Alert Complain';
        return $column;
    }
    add_filter( 'manage_users_columns', 'rrp_modify_user_table_alert_complain' );
    function rrp__modify_user_table_row( $val, $column_name, $user_id )
    {
       $alert = new App\WP_Reputation_Radar_Alert();
        switch ($column_name) {
            case 'Alert Complain'   :
                    // query specific alert were user_id as agent_id and status = 3 as complain in wp_reputation_radar_alert
                    $total = $alert->getAgentTotalSetRelevantComplainByClient($user_id);
                    $url = get_site_url() . '/reputation-radar-alert/?agent_id='.$user_id;
                    return  "<a href='$url'>" . $total  . "</a>";
                break;
            case "Click Sort Time":
                      $url = get_site_url() . '/reputation-radar-alert/?agent_id='.$user_id . '&sort_time_click=1';
                      return  "<a href='$url'> Visit </a>";
                 break;
            default:
        }
        return $val;
    }
    add_filter( 'manage_users_custom_column', 'rrp__modify_user_table_row', 10, 3 );
