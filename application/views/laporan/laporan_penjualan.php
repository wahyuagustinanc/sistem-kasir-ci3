<section class="content-header">
  <h1>
    Laporan Penjualan
  </h1>
</section>

  <section class="content">

  <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Filter Data</h3>
        </div>
        <div class="box-body">
            <form action="" method="post">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-horizontal">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Tanggal</label>
                                <div class="col-sm-9">
                                    <input type="date" name="date1" value="<?=@$post['date1']?>" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-horizontal">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">s/d</label>
                                <div class="col-sm-9">
                                    <input type="date" name="date2" value="<?=@$post['date2']?>" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-horizontal">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Invoice</label>
                                <div class="col-sm-9">
                                    <input type="text" name="invoice" value="<?=@$post['invoice']?>" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="pull-right">
                            <button type="submit" name="reset" class="btn btn-flat">Reset</button>
                            <button type="submit" name="filter" class="btn btn-info btn-flat">
                                <i class="fa fa-search"></i> Filter
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="box">
        <div class="box-header">
           <h3 class="box-title">Data Laporan Penjualan</h3>
        </div>
        <div class="box-body table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                      <th style="width: 6%;">No</th>
                      <th>Invoice</th>
                      <th>Tanggal</th>
                      <th>Harga Total</th>
                      <th>Potongan</th>
                      <th>Harga Jadi</th>
                      <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = $this->uri->segment(3) ? $this->uri->segment(3) + 1 : 1;
                    foreach($row->result() as $key => $data) { ?>
                    <tr>
                      <td><?=$no++?>.</td>
                      <td><?=$data->invoice?></td>
                      <td><?=indo_tanggal($data->tanggal)?></td>
                      <td><?=indo_currency($data->total_harga)?></td>
                      <td><?=indo_currency($data->diskon)?></td>
                      <td><?=indo_currency($data->final_harga)?></td>
                      <td class="text-center" width="200px">
                        <a href="<?=site_url('penjualan/cetak/'.$data->penjualan_id)?>" target="_blank" class="btn btn-primary btn-xs">
                          <i class="fa fa-print"></i> Cetak
                        </a>
                        <a href="<?=site_url('penjualan/hapus/'.$data->penjualan_id)?>" onclick="return confirm('Apakah anda yakin')" class="btn btn-danger btn-xs">
                          <i class="fa fa-trash"></i> Hapus
                        </a>
                      </td>
                    </tr>
                    <?php
                    } ?>
                </tbody>
            </table>
        </div>
        <div class="box-footer clearfix">
          <ul class="pagination pagination-sm no-margin pull-right">
            <?=$pagination?>
          </ul>
        </div>
    </div>
</section>