<section class="content-header">
  <h1>
    Data Barang
  </h1>
</section>

<!-- Main Content -->
<section class="content">
    <!-- <?php $this->view('pesan')?> -->
    <div class="box">
        <div class="box-header">
           <h3 class="box-title">Data barang Keluar</h3>
            <div class="pull-right">
                <a href="<?=site_url('stok/out/add')?>" class="btn btn-primary btn-flat">
                   <i class="fa fa-plus"></i> Tambah
                </a>
            </div>
        </div>
        <div class="box-body table-responsive">
            <table class="table table-bordered table-striped" id="table1">
                <thead>
                    <tr>
                      <th style="width: 6%;">No</th>
                      <th>Kode Barang</th>
                      <th>Nama Barang</th>
                      <th style="width: 10%;">Jumlah</th>
                      <th>Tanggal</th>
                      <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach($row as $key => $data) { ?>
                    <tr>
                       <td style="width:5%"><?=$no++?>.</td>
                       <td><?=$data->kodebarang?></td>
                       <td><?=$data->item_nama?></td>
                       <td class="text-right"><?=$data->jumlah?></td>
                       <td class="text-center"><?=indo_tanggal($data->tanggal)?></td>
                       <td class="text-center" width="160px">
                       <a id ="set_dtl" class="btn btn-primary btn-xs"
                          data-toggle="modal" data-target="#modal-detail"
                          data-kodebarang="<?=$data->kodebarang?>"
                          data-itemnama="<?=$data->item_nama?>"
                          data-detail="<?=$data->ditail?>"
                          data-jumlah="<?=$data->jumlah?>"
                          data-tanggal="<?=indo_tanggal($data->tanggal)?>">
                          <i class="fa fa-eye"></i> Detail
                        </a>
                        <a href="<?=site_url('stok/out/del/'.$data->stok_id.'/'.$data->item_id)?>" onclick="return confirm('Apakah anda yakin')" class="btn btn-danger btn-xs">
                            <i class="fa fa-trash"></i> Hapus
                        </a>
                      </td>
                    </tr>
                    <?php
                    } ?>
                </tbody>
            </table>
        </div>
    </div>
</section>

<div class="modal fade" id="modal-detail">
    <div class="modal-dialog">
        <div class="modal-content">
           <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
               <h4 class="modal-title">Detail Barang Keluar</h4>
           </div>
           <div class="modal-body table-responsive">
               <table class="table table-bordered no-margin">
                    <tbody>
                        <tr>
                            <th style="">Kode Barang</th>
                            <td><span id="kodebarang"></span></td>
                        </tr>
                        <tr>
                            <th>Nama Barang</th>
                            <td><span id="item_nama"></span></td>
                        </tr>
                        <tr>
                            <th>Detail</th>
                            <td><span id="detail"></span></td>
                        </tr>
                        <tr>
                            <th>Jumlah</th>
                            <td><span id="jumlah"></span></td>
                        </tr>
                        <tr>
                            <th>Tanggal</th>
                            <td><span id="tanggal"></span></td>
                        </tr>
                    </tbody>
               </table>
           </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    $(document).on('click', '#set_dtl', function() {
        var kodebarang = $(this).data('kodebarang');
        var itemnama = $(this).data('itemnama');
        var detail = $(this).data('detail');
        var jumlah = $(this).data('jumlah');
        var tanggal = $(this).data('tanggal');
        $('#kodebarang').text(kodebarang);
        $('#item_nama').text(itemnama);
        $('#detail').text(detail);
        $('#jumlah').text(jumlah);
        $('#tanggal').text(tanggal);
        $('detail').text(detail);
    })
})
</script>