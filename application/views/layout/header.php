<header class="main-header">
  <a href="#" class="logo">
    <span class="logo-mini"><b>CS</b></span>
    <span class="logo-lg"><b>Chintamani Services</b></span>
  </a>
  <nav class="navbar navbar-static-top">
    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
      <span class="sr-only">Toggle navigation</span>
    </a>
    <ul class="nav navbar-nav" style="margin: 12px 100px 0px 100px">
      <li><p class="block" style="color:#FFF;font-size: 18px;"><b>DEMO VERSION</b></p></li>
    </ul>
    <?php 
      $this->db->select('customer_unique_id,customer_name,notification_title,amc_date,amc_reminder_date');
      $this->db->from('notifications_tbl');
      $this->db->where('deleted', 0);
      $ArrNotification = $this->db->get()->result_array(); 
      $count=0;
      if (isset($ArrNotification) && !empty($ArrNotification)) {
        foreach ($ArrNotification as $row) {
          if ($row["amc_reminder_date"] == date('d-m-Y')) {
            $count ++;
          }
        }
      }
    ?>
    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        <li class="dropdown notifications-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <i class="fa fa-bell-o"></i>
            <span class="label label-warning"><?php echo (isset($count) && !empty($count)) ? $count: '0'; ?></span>
          </a>
          <ul class="dropdown-menu">
            <li class="header">You have <?php echo (isset($count) && !empty($count)) ? $count: '0'; ?> notifications</li>
            <li>
              <ul class="menu">
                <?php 
                    if (isset($ArrNotification) && !empty($ArrNotification)) {
                      foreach ($ArrNotification as $row) {
                        if ($row["amc_reminder_date"] == date('d-m-Y')) {
                ?>
                <li>
                  <a href="#">
                    <p><i class="fa fa-users text-aqua"></i> <?php echo $row['notification_title']; ?></p> 
                    <p><?php echo $row['customer_name']; ?></p>
                    <p>AMC Date - 31/01/2019</p> 
                  </a>
                </li>
                <?php }}} ?>
              </ul>
            </li>
            <li class="footer"><a href="#">View all</a></li>
          </ul>
        </li>
        <li class="dropdown user user-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <span class="hidden-xs"><?php echo $this->session->userdata('name'); ?> <i class="fa fa-angle-down"></i></span>
          </a>
          <ul class="dropdown-menu">
            <li class="user-header">
              <p>
                <?php echo $this->session->userdata('name'); ?>
                <small>Master User</small>
              </p>
            </li>
            <li class="user-footer">
              <div class="pull-left">
                <a href="#" class="btn btn-default btn-flat">Profile</a>
              </div>
              <div class="pull-right">
                <a href="<?php echo site_url('logout');?>" class="btn btn-default btn-flat">Sign out</a>
              </div>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </nav>
</header>