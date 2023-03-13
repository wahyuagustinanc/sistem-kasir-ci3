<section class="content-header">
  <h1>
    Data Penjualan
  </h1>
</section>

<section class="content">
<div class="box">
        <div class="box-header">
           <h3 class="box-title">Data Penjualan</h3>
        </div>
        <div class="box-body table-responsive">
            <table class="table table-bordered table-striped" id="table1">
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
                <?php $no = 1;
                    foreach($row->result() as $key => $data) { ?>
                    <tr>
                      <td><?=$no++?>.</td>
                      <td><?=$data->invoice?></td>
                      <td><?=indo_tanggal($data->tanggal)?></td>
                      <td><?=indo_currency($data->total_harga)?></td>
                      <td><?=indo_currency($data->diskon)?></td>
                      <td><?=indo_currency($data->final_harga)?></td>
                      <td class="text-center" width="200px">
                        <button id="detail" data-target="#modal-detail" data-toggle="modal" class="btn btn-success btn-xs"
                         data-invoice="<?=$data->invoice?>"
                         data-tanggal="<?=indo_tanggal($data->tanggal)?>"
                         data-jam="<?=substr($data->jual_created, 11, 5)?>"
                         data-total="<?=indo_currency($data->total_harga)?>"
                         data-potongan="<?=indo_currency($data->diskon)?>"
                         data-final_harga="<?=indo_currency($data->final_harga)?>"
                         data-total_harga="<?=indo_currency($data->total_harga)?>"
                         data-pembayaran="<?=indo_currency($data->pembayaran)?>"
                         data-kembalian="<?=indo_currency($data->kembalian)?>"
                         data-catatan="<?=$data->catatan?>"
                         data-kasir="<?=$data->name?>"
                         data-produkid="<?=$data->penjualan_id?>" 
                        >Detail</button>
                        <a href="<?=site_url('penjualan/cetak/'.$data->penjualan_id)?>" target="_blank" class="btn btn-primary btn-xs">
                          <i class="fa fa-print"></i> Cetak
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
                <h4 class="modal-title">Detail Data Penjualan</h4>
            </div>
            <div class="modal-body table-responsive">
                <table class="table table-bordered no-margin">
                    <tbody>
                        <tr>
                            <th style="width:20%">Invoice</th>
                            <td style="width:30%"><span id="invoice"></span></td>
                            <th style="width:20%">Tanggal</th>
                            <td style="width:30%"><span id="tanggal"></span></td>
                        </tr>
                        <tr>
                            <th>Kasir</th>
                            <td><span id="kasir"></span></td>
                            <th>Jam</th>
                            <td><span id="jam"></span></td>
                        </tr>
                        <tr>
                            <th>Total</th>
                            <td><span id="total"></alspan></td>
                            <th>Pembayaran</th>
                            <td><span id="pembayaran"></span></td>
                        </tr>
                        <tr>
                            <th>Potongan</th>
                            <td><span id="potongan"></span></td>
                            <th>Kembalian</th>
                            <td><span id="kembalian"></span></td>
                        </tr>
                        <tr>
                            <th>Harga Jadi</th>
                            <td><span id="final_harga"></span></td>
                            <th>Catatan</th>
                            <td><span id="catatan"></span></td>
                        </tr>
                        <tr>
                            <th>Produk</th>
                            <td colspan="3"><span id="produk"></span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
  $(document).on('click', '#detail', function() {
    $('#invoice').text($(this).data('invoice'))
    $('#tanggal').text($(this).data('tanggal'))
    $('#kasir').text($(this).data('kasir'))
    $('#jam').text($(this).data('jam'))
    $('#kasir').text($(this).data('kasir'))
    $('#total').text($(this).data('total'))
    $('#pembayaran').text($(this).data('pembayaran'))
    $('#potongan').text($(this).data('potongan'))
    $('#kembalian').text($(this).data('kembalian'))
    $('#final_harga').text($(this).data('final_harga'))
    $('#catatan').text($(this).data('catatan'))

    var produk = '<table class="table on-margin">'
    produk += '<tr><th>Item</th><th>Harga</th><th>Jumlah</th><th>Potongan</th><th>Total</th></tr>'
    $.getJSON('<?=site_url('laporan/penjualan_produk/')?>'+$(this).data('produkid'), function(data) {
      $.each(data, function(key, val) {
        produk += '<tr><td>'+val.nama+'</td><td>'+val.harga+'</td><td>'+val.jumlah+'</td><td>'+val.potongan_item+'</td><td>'+val.total+'</td></tr>'
      })
      produk += '</table>'
      $('#produk').html(produk)
    })

  })
</script>