<section class="content-header">
  <h1>
    Dashboard
  </h1>
</section>

<section class="content">
      <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-shopping-cart"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Item</span>
              <span class="info-box-number"><?=$this->fungsi->count_item()?></span>
            </div>
          </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-truck"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Pemasok</span>
              <span class="info-box-number"><?=$this->fungsi->count_pemasok()?></span>
            </div>
          </div>
        </div>

        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Terjual</span>
              <span class="info-box-number"><?=$this->fungsi->count_penjualan()?></span>
            </div>
          </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-user-plus"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Pengguna</span>
              <span class="info-box-number"><?=$this->fungsi->count_user()?></span>
            </div>
          </div>
        </div>
      </div>

      <div class="box box-solid">
        <div class="box-header">
          <i class="fa fa-th"></i>
          <h3 class="box-title">Produk Terlaris Bulan Ini</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-sm" data-widget="collapse">
              <i class="fa fa-minus"></i>
            </button>
          </div>
        </div>
        <div class="box-body">
          <div id="penjualan_bar" class="graph"></div>
        </div>
      </div>
</section>

<link rel="stylesheet" href="<?=base_url()?>aset/bower_components/morris.js/morris.css">
<script src="<?=base_url()?>aset/bower_components/morris.js/morris.min.js"></script>
<script src="<?=base_url()?>aset/bower_components/raphael/raphael.min.js"></script>
<script>
      Morris.Bar({
      element: 'penjualan_bar',
      resize: true,
      data: [
        <?php foreach($row as $key => $data) {
          echo "{item: '".$data->nama."', terjual: ".$data->terjual."},";
        } ?>
      ],
      barColors: ['#3c8dbc'],
      xkey: 'item',
      ykeys: ['terjual'],
      labels: ['terjual'],
      hideHover: 'auto'
    });
</script>