<?php

/**
* Display settings of the partner in testing
*/
function rrp_settings_func() {

    rrp_script_and_style();


 ?>



 <br><br>
      <div class="row">
        <div class="col-md-12">
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

                    <?php //print " user_id " . rrp_get_authenticated_user_id(); ?>
                  <labl class="label" style="color:black"> Company Search Keyword </labl><br><br>
                  <input type="text" style="width:98%" class="form-control" value="<?php print rrp_settings_get_current_user_keyword(); ?>" name="company_search_keyword" />
                  <hr>
                  <labl class="label" style="color:black"> Company Url</labl><br><br>
                  <input type="text"  style="width:98%" class="form-control" value="<?php print rrp_settings_get_current_user_url(); ?>" name="company_url" />
                  <br/>
                  <input type="submit" value="Update" class="alert alert-info" name="rrp_post_settings"  /> 

                  </form>
                </div> 
            </div>  
          </div>
        </div>
      </div>
<?php 
}

/**
* Display partner scraped status and already validated with agent as relevant
*/
function rrp_alert_partner_func() {



     $alert                   = new App\WP_Reputation_Radar_Alert();
     $setting                 = new App\WP_Reputation_Radar_Settings();
     $partner_id              = $setting->getCurrentPartnerIdFromSettings();

     $partnersAlertAll = '';
     $partnersAlertRelated = '';
     $partnersAlertNotRelated = '';

     $totalAllAlert = 0;
     $totalRelevantAlert = 0;
     $totalNotRelevantAlert = 0;

    if(!empty($partner_id)) {
        $partnersAlertAll        = $alert->getPartnersAlertAll($partner_id);
        $partnersAlertRelated    = $alert->getPartnersAlertRelated($partner_id);

        $partnersAlertNotRelated = $alert->getPartnersAlertNotRelated($partner_id);
        $totalAllAlert           = $alert->countTotalAllAlert($partner_id);
        $totalRelevantAlert      = $alert->countTotalRelevantAlert($partner_id);
        $totalNotRelevantAlert   = $alert->countTotalNotRelevantAlert($partner_id);
    }
    rrp_script_and_style();

    // dd($partnersAlertAll);
  ?>



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

/**
* Display all the alert that is being scraped and needs for agent to rate relevant or none relevant in order to display
* scraped data to partners alert
*/
function rrp_alert_agent_func()
 {
    $partner_id              = 1486755452;
    $alert                   = new App\WP_Reputation_Radar_Alert();
    $partnersAlertInit        = $alert->getPartnersAlertInit($partner_id);
    //    dd($partnersAlertAll);
    rrp_script_and_style();
  ?>
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
     $ratingSites = [];
     $ratingSite  = [];
     $rating_site = new App\WP_Reputation_Radar_Rating_Site();
     $partnerIds = [12345,54321,67890,98761];
     $partner_id = (!empty($_GET['partner_id'])) ? $_GET['partner_id'] : null;


     // Submit create new rating site and trigger save data
     if (isset($_POST['rating_site_add'])) {
        $rating_site->create(['url'=>$_POST['url'], 'partner_id'=>$_POST['partner_id']]);
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

   if(empty($partner_id)) {?>
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
        <br>
          <h3> Manage partner information </h3>
          <div class="row">
            <div class="col-md-12">
                <?php $rating_site->uiPartnersRatingSiteList($ratingSites); ?>
            </div>

           <br>
            <hr>
            <br>


              <div class="col-md-12">
                <h3>Add New Rating Site for partner id <?php print $partner_id; ?></h3>
                 <?php $rating_site->uiPartnerAddRattingSiteForm($partner_id); ?>
            </div>
          </div>
        </div>


           <br><br><br>
    <a href="<?php print rrp_partner_id_list_url;  ?>">
        <button class="alert alert-info">Back To Partner's List</button>
    </a>
    <?php
    }
    ?>

    <?php
}