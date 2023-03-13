<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Sistem Kasir</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="<?=base_url()?>aset/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?=base_url()?>aset/bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?=base_url()?>aset/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" href="<?=base_url()?>aset/bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="<?=base_url()?>aset/dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="<?=base_url()?>aset/dist/css/skins/_all-skins.min.css">

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">
    <header class="main-header">
      <a href="<?=base_url('dashboard')?>assets/index2.html" class="logo">
		    <span class="logo-mini">s<b>K</b></span>
		    <span class="logo-lg">Sistem<b>Kasir</b></span>
      </a>
      <nav class="navbar navbar-static-top">
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
			  </a>
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<img src="<?=base_url()?>aset/dist/img/user.png" class="user-image">
								<span class="hidden-xs"><?=$this->fungsi->user_login()->username?></span>
							</a>
              <ul class="dropdown-menu">
                <li class="user-header">
                  <img src="<?=base_url()?>aset/dist/img/user.png" class="img-circle">
									<p><?=$this->fungsi->user_login()->name?>
									<small>Indonesia</small>
                  </p>
                </li>
                <li class="user-footer">
                  <div class="pull-right">
                    <a href="<?=site_url('auth/logout')?>" class="btn btn-flat bg-red">Keluar</a>
                  </div>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </nav>
    </header>

    <aside class="main-sidebar">
      <section class="sidebar">
        <div class="user-panel">
          <div class="pull-left image">
            <img src="<?=base_url()?>aset/dist/img/user.png" class="img-circle">
          </div>
          <div class="pull-left info">
            <p><?=ucfirst($this->fungsi->user_login()->username)?></p>
						<a href="#"><i class="fa fa-circle text-success"></i> Online</a>
          </div>
        </div>

        <ul class="sidebar-menu" data-widget="tree">
          <li class="header">MENU NAVIGASI</li>
          <li <?=$this->uri->segment(1) == 'dashboard' || $this->uri->segment(1) == '' ? 'class="active"' : ''?>>
            <a href="<?=site_url('dashboard')?>"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
          </li>
          <li <?=$this->uri->segment(1) == 'suplayer' ? 'class="active"' : ''?>>
            <a href="<?=site_url('suplayer')?>"><i class="fa fa-truck"></i> <span>Pemasok</span></a>
          </li>
          <li class="treeview <?=$this->uri->segment(1) == 'kategori' || $this->uri->segment(1) == 'unit' || $this->uri->segment(1) == 'item' ? 'active' : ''?>">
            <a href="#">
              <i class="fa fa-archive"></i> <span>Produk</span>
							<span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
            </a>
            <ul class="treeview-menu">
              <li <?=$this->uri->segment(1) == 'kategori' ? 'class="active"' : ''?>><a href="<?=site_url('kategori')?>"><i class="fa fa-circle-o"></i> Kategori</a></li>
							<li <?=$this->uri->segment(1) == 'unit' ? 'class="active"' : ''?>><a href="<?=site_url('unit')?>"><i class="fa fa-circle-o"></i> Unit</a></li>
							<li <?=$this->uri->segment(1) == 'item' ? 'class="active"' : ''?>><a href="<?=site_url('item')?>"><i class="fa fa-circle-o"></i> Item</a></li>
            </ul>
          </li>
          <li class="treeview <?=$this->uri->segment(1) == 'stok' ? 'active' : ''?>">
            <a href="#">
              <i class="fa fa-exchange"></i> <span>Data Barang</span>
							<span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
            </a>
            <ul class="treeview-menu">
							<li <?=$this->uri->segment(1) == 'stok' && $this->uri->segment(2) == 'in' ? 'class="active"' : ''?>><a href="<?=site_url('stok/in')?>"><i class="fa fa-circle-o"></i> Barang Masuk</a></li>
							<li><a href="<?=site_url('stok/out')?>"><i class="fa fa-circle-o"></i> Barang Keluar</a></li>
            </ul>
          </li>
          <li <?=$this->uri->segment(1) == 'penjualan' ? 'class="active"' : ''?>>
            <a href="<?=site_url('penjualan')?>"><i class="fa fa-shopping-cart"></i> <span>Penjualan</span></a>
          </li>
          <li class="treeview <?=$this->uri->segment(1) == 'datpenjualan' || $this->uri->segment(1) == 'laporan' ? 'active' : ''?>">
            <a>
              <i class="fa fa-pie-chart"></i> <span>Data</span>
							<span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
            </a>
            <ul class="treeview-menu">
              <li <?=$this->uri->segment(1) == 'datpenjualan' ? 'class="active"' : ''?>><a href="<?=site_url('datpenjualan')?>"><i class="fa fa-circle-o"></i> Data Penjualan</a></li>
              <?php if($this->fungsi->user_login()->level == 1) { ?>
							<li <?=$this->uri->segment(1) == 'laporan' ? 'class="active"' : ''?>>
              <a href="<?=site_url('laporan/penjualan')?>"><i class="fa fa-circle-o"></i> Laporan Penjualan</a></li>
              <?php } ?>
            </ul>
          </li>
          <?php if($this->fungsi->user_login()->level == 1) { ?>
          <li class="header">SETTINGS</li>
					<li><a href="<?=site_url('user')?>"><i class="fa fa-user"></i> <span>Users</span></a></li>
          <?php } ?>
        </ul>
      </section>
    </aside>

    <script src="<?=base_url()?>aset/bower_components/jquery/dist/jquery.min.js"></script>

    <div class="content-wrapper">
      <?php echo $contents ?>
	</div>
        <footer class="main-footer">
			<div class="pull-right hidden-xs">
				<b>Version</b> 1.0
			</div>
			<strong>UMS Magang &copy; <a href="#">2022</a></strong>
		</footer>
  </div>

  <script src="<?=base_url()?>aset/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="<?=base_url()?>aset/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
  <script src="<?=base_url()?>aset/dist/js/adminlte.min.js"></script>

  <script src="<?=base_url()?>aset/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="<?=base_url()?>aset/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
  <script>
  $(document).ready(function() {
    $('#table1').dataTable()
  })
  </script>

</body>
</html>