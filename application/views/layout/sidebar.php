<aside class="main-sidebar">
  <section class="sidebar">
    <div class="user-panel">
      <div class="pull-left image">
        <img src="<?php echo base_url(); ?>assets/images/avatar.png" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p><?php echo $this->session->userdata('name'); ?></p>
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">MAIN NAVIGATION</li>
      <li class="<?php if($active_menu == 'dashboard') { ?> active <?php } ?>">
        <a href="<?php echo site_url('dashboard'); ?>">
          <i class="fa fa-dashboard"></i> <span>Dashboard</span>
        </a>
      </li>
      <li class="treeview <?php if($active_menu == 'products') { ?>active<?php } ?>">
        <a href="#">
          <i class="fa fa-list"></i>
          <span>Catalog</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="<?php echo site_url('sujal_products'); ?>"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Sujal Products</a></li>
        </ul>
      </li>
      <li class="treeview <?php if($active_menu == 'customers') { ?>active<?php } ?>">
        <a href="#">
          <i class="fa fa-users"></i>
          <span>Customers</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="<?php echo site_url('sujal_customers'); ?>"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Sujal Customers</a></li>
          <li><a href="<?php echo site_url('non_sujal_customers'); ?>"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Other (Non Sujal) Customers</a></li>
        </ul>
      </li>
      <li class="treeview <?php if($active_menu == 'products_sold') { ?>active<?php } ?>">
        <a href="#">
          <i class="fa fa-line-chart" aria-hidden="true"></i>
          <span>Sale</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="<?php echo site_url('sale_product'); ?>"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Sujal Products</a></li>
        </ul>
      </li>
      <li class="treeview <?php if($active_menu == 'sinvc') { ?>active<?php } ?>">
        <a href="#">
          <i class="fa fa-file"></i>
          <span>Invoices</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="<?php echo site_url('sujal_invoices'); ?>"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Sujal Invoices</a></li>
          <li><a href="<?php echo site_url('non_sujal_invoices'); ?>"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Other (Non Sujal) Invoices</a></li>
        </ul>
      </li>
      <li class="treeview <?php if($active_menu == 'samc') { ?>active<?php } ?>">
        <a href="#">
          <i class="fa fa-calendar" aria-hidden="true"></i>
          <span>AMC</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="<?php echo site_url('sujals_amcs'); ?>"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Sujal AMC</a></li>
          <li><a href="<?php echo site_url('non_sujals_amcs'); ?>"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Other (Non Sujal) AMC</a></li>
        </ul>
      </li>
      <!-- <li class="treeview <?php if($active_menu == 'settings') { ?>active<?php } ?>">
        <a href="#">
          <i class="fa fa-cogs" aria-hidden="true"></i>
          <span>Settings</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="<?php echo site_url('invoice_prefix'); ?>"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Invoice Prefix</a></li>
        </ul>
      </li> -->
    </ul>
  </section>
</aside>