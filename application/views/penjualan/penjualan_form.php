<section class="content-header">
  <h1>
    Penjualan
  </h1>
</section>

<section class="content">
    <div class="row">
        <div class="col-lg-4">
            <div class="box box-widget">
                <div class="box-body">
                    <table width="100%">
                        <tr>
                            <td style="vertical-align:top">
                                <label for="date">Tanggal</label>
                            </td>
                            <td>
                                <div class="form-group">
                                    <input type="date" id="tanggal" value="<?=date('Y-m-d')?>" class="form-control">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align:top; width:30%">
                                <label for="user">Kasir</label>
                            </td>
                            <td>
                                <div class="form-grup">
                                    <input type="text" id="user" value="<?=$this->fungsi->user_login()->name?>" class="form-control" readonly>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <form action="<?=site_url('penjualan/process')?>" method="post">
                <div class="box box-widget">
                    <div class="box-body">
                        <table width="100%">
                            <tr>
                                <td style="vertival-align:top; width:30%">
                                    <label for="kodebarang">Kode Barang</label>
                                </td>
                                <td>
                                    <div class="form-group input-group">
                                        <input type="hidden" id="item_id">
                                        <input type="hidden" id="item_nama">
                                        <input type="hidden" id="harga">
                                        <input type="hidden" id="stok">
                                        <input type="hidden" id="jumlah_jual">
                                        <input type="text" id="kodebarang" class="form-control" autofocus>
                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-info btn-flat" data-toggle="modal" data-target="#modal-item">
                                            <i class="fa fa-search"></i>
                                            </button>
                                        </span>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="vertical-align:top">
                                    <label for="jumlah_bar">Jumlah</label>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input type="number" id="jumlah_bar" value="1" min="1" class="form-control">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <div>
                                        <button type="button" id="add_jual" class="btn btn-primary">
                                            <i class="fa fa-cart-plus"></i> Tambah
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </form>
        </div>

        <div class="col-lg-4">
            <div class="box box-widget">
                <div class="box-body">
                    <div align="right">
                        <h4>Invoice <b><span id="invoice"><?= $invoice ?></span></b></h4>
                        <h1><b><span id="grand_total2" style="font-size:50pt">0</span></b></h1>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="box box-widget">
                <div class="box-body table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kodebarang</th>
                                <th>Produk</th>
                                <th>Harga</th>
                                <th width="15%">Jumlah</th>
                                <th>Potongan Per Item</th>
                                <th>Total</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="jual_table">
                            <?php $this->view('penjualan/jual_data')?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-3">
            <div class="box box-widget">
                <div class="box-body">
                    <table width="100%">
                        <tr>
                            <td style="vertical-align:top; width:30%">
                                <label for="sub_total">Total Harga</label>
                            </td>
                            <td>
                                <div class="form-group">
                                    <input type="number" id="sub_total" value="" class="form-control" readonly>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align:top">
                                <label for="potong_harga">Potongan</label>
                            </td>
                            <td>
                                <div class="form-group">
                                    <input type="number" id="potong_harga" value="0" min="0" class="form-control">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align:top">
                               <label for="grand_total">Harga Jadi</label>
                            </td>
                            <td>
                                <div class="form-group">
                                    <input type="number" id="grand_total" class="form-control" readonly>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-3">
            <div class="box box-widget">
                <div class="box-body">
                    <table width="100%">
                        <tr>
                            <td style="vertical-align:top; width:30%">
                                <label for="bayar">Pembayaran</label>
                            </td>
                            <td>
                                <div class="form-group">
                                    <input type="number" id="bayar" value="0" min="0" class="form-control">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align:top">
                                <label for="kembalian">Kembalian</label>
                            </td>
                            <td>
                                <div>
                                    <input type="number" id="kembalian" value="" class="form-control" readonly>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-3">
           <div class="box box-widget">
               <div class="box-body">
                   <table width="100%">
                       <tr>
                           <td style="vertical-align:top">
                               <label for="catatan">Catatan<label>
                           </td>
                           <td>
                               <div>
                                   <textarea id="catatan" rows="3" class="form-control"></textarea>
                               </div>
                           </td>
                       </tr>
                   </table>
               </div>
           </div>
        </div>

        <div class="col-lg-3">
            <div>
                <button id="cancel_payment" class="btn btn-flat btn-warning">
                    <i class="fa fa-refresh"></i> Batal
                </button><br><br>
                <button id="proses_jual" class="btn btn-flat btn-success">
                    <i class="fa fa-paper-plane-o"></i> Proses
                </button>
            </div>
        </div>
    </div>

</section>

<div class="modal fade" id="modal-item">
    <div class="modal-dialog">
        <div class="modal-content">
           <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Pencarian Kode Barang</h4>
           </div>
           <div class="modal-body table-responsive">
               <table class="table table-bordered table-striped" id="table1">
                   <thead>
                        <tr>
                           <th>Kode Barang</th>
                           <th>Nama</th>
                           <th>Unit</th>
                           <th>Harga</th>
                           <th>Stok</th>
                           <th>Actions</th>
                        </tr>
                   </thead>
                   <tbody>
                       <?php foreach($item as $i => $data) { ?>
                       <tr>
                           <td><?=$data->kodebarang?></td>
                           <td><?=$data->nama?></td>
                           <td><?=$data->unit_nama?></td>
                           <td class="text-right"><?=indo_currency($data->harga)?></td>
                           <td class="text-right"><?=$data->stok?></td>
                           <td class="text-right">
                               <button class="btn btn-xs btn-info" id="select"
                                   data-id="<?=$data->item_id?>"
                                   data-kodebarang="<?=$data->kodebarang?>"
                                   data-harga="<?=$data->harga?>"
                                   data-stok="<?=$data->stok?>">
                                   <i class="fa fa-check"></i> Pilih
                               </button>
                           </td>
                       </tr>
                       <?php } ?>
                   </tbody>
               </table>
           </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-item-edit">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Ubah Produk Item</h4>
            </div>
            <div class="modal-body">
                <input type="hidden" id="jualid_item">
                <div class="form-group">
                    <label for="produk_item">Produk Item</label>
                    <div class="row">
                        <div class="col-md-5">
                            <input type="text" id="kodebarang_item" class="form-control" readonly>
                        </div>
                        <div class="col-md-7">
                            <input type="text" id="produk_item" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="harga_item">Harga</label>
                        <input type="number" id="harga_item" min="0" class="form-control">
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-7">
                               <label for="jumlah_item">Jumlah</label>
                               <input type="number" id="jumlah_item" min="1" class="form-control">
                            </div>
                            <div class="col-md-5">
                               <label>Stok Item</label>
                               <input type="number" id="stok_item" class="form-control" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="total_harga1">Total Harga</label>
                        <input type="number" id="total_harga1" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label for="potongan_peritem">Potongan Per Item</label>
                        <input type="number" id="potongan_peritem" min="0" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="total_jadi">Total Harga Jadi</label>
                        <input type="number" id="total_jadi" class="form-control" readonly>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="pull-right">
                        <button type="button" id="ubah_jual" class="btn btn-flat btn-success">
                            <i class="fa fa-paper-plane"></i> Simpan
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    $(document).on('click', '#select', function() {
        var item_id = $(this).data('id');
        var kodebarang = $(this).data('kodebarang');
        var harga = $(this).data('harga');
        var stok = $(this).data('stok');
        $('#item_id').val(item_id);
        $('#kodebarang').val(kodebarang);
        $('#harga').val(harga);
        $('#stok').val(stok);
        $('#modal-item').modal('hide');

        get_jual_jumlah($(this).data('kodebarang'))
    })
})

function get_jual_jumlah(kodebarang)
{
    $('#jual_table tr').each(function() {
        var jumlah_jual = $("#jual_table td.kodebarang:contains('"+kodebarang+"')").parent().find("td").eq(4).html();
        if(jumlah_jual != null) {
            $('#jumlah_jual').val(jumlah_jual)
        } else {
            $('#jumlah_jual').val(0)
        }
    });
}

    $(document).on('click', '#add_jual', function() {
        var item_id = $('#item_id').val()
        var harga = $('#harga').val()
        var stok = $('#stok').val()
        var jumlah_bar = $('#jumlah_bar').val()
        var jumlah_jual = $('#jumlah_jual').val()
        if(item_id == '') {
            alert('Produk belum dipilih')
            $('#kodebarang').focus()
        } else if(stok < 1 || parseInt(stok) < (parseInt(jumlah_jual) + parseInt(jumlah_bar))) {
            alert('Stok tidak mencukupi')
            $('#item_id').val('')
            $('#kodebarang').val('')
            $('#kodebarang').focus('')
        } else {
            $.ajax({
                type: 'POST',
                url: '<?=site_url('penjualan/process')?>',
                data: {'add_jual' : true, 'item_id' : item_id, 'harga' : harga, 'jumlah_bar' : jumlah_bar},
                dataType: 'json',
                success: function(result) {
                    if(result.success == true) {
                        $('#jual_table').load('<?=site_url('penjualan/jual_data')?>', function() {
                            kalkulasi()
                        })
                        $('#item_id').val('')
                        $('#kodebarang').val('')
                        $('#jumlah_bar').val(1)
                        $('#kodebarang').focus()
                    } else {
                        alert('Data Gagal ditambahkan')
                    }
                }
            })
        }
    })

    $(document).on('click', '#hapus_jual', function() {
        if(confirm('Apakah Anda Yakin?')) {
            var jual_id = $(this).data('jualid')
            $.ajax({
                type: 'POST',
                url: '<?=site_url('penjualan/jual_hps')?>',
                dataType: 'json',
                data: {'jual_id': jual_id},
                success: function(result) {
                    if(result.success == true) {
                        $('#jual_table').load('<?=site_url('penjualan/jual_data')?>', function() {
                            kalkulasi()
                        })
                    } else {
                        alert('Hapus Data Gagal');
                    }
                }
            })
        }
    })

    $(document).on('click', '#update_jual', function() {
        $('#jualid_item').val($(this).data('jualid'))
        $('#kodebarang_item').val($(this).data('kodebarang'))
        $('#produk_item').val($(this).data('produk'))
        $('#stok_item').val($(this).data('stok'))
        $('#harga_item').val($(this).data('harga'))
        $('#jumlah_item').val($(this).data('jumlah_bar'))
        $('#total_harga1').val($(this).data('harga') * $(this).data('jumlah_bar'))
        $('#potongan_peritem').val($(this).data('potongan'))
        $('#total_jadi').val($(this).data('total'))
    })

    function potong_edit_modal() {
        var harga = $('#harga_item').val()
        var jumlah_bar = $('#jumlah_item').val()
        var potongan = $('#potongan_peritem').val()

        total_harga1 = harga * jumlah_bar
        $('#total_harga1').val(total_harga1)

        total = (harga - potongan) * jumlah_bar
        $('#total_jadi').val(total)
    }

    $(document).on('keyup mouseup', '#harga_item, #jumlah_item, #potongan_peritem', function() {
        potong_edit_modal()
    })

    $(document).on('click', '#ubah_jual', function() {
        var jual_id = $('#jualid_item').val()
        var harga = $('#harga_item').val()
        var jumlah_bar = $('#jumlah_item').val()
        var potongan = $('#potongan_peritem').val()
        var total = $('#total_jadi').val()
        var stok = $('#stok_item').val()
        if(harga == '') {
            alert('Harga masih kosong, tolong diisi!')
            $('#harga_item').focus()
        } else if(jumlah_bar == '' || jumlah_bar < 1) {
            alert('Jumlah masih kurang mencukupi!')
            $('#jumlah_item').focus()
        } else if(parseInt(jumlah_bar) > parseInt(stok)) {
            alert('Stok tidak mencukupi')
            $('#jumlah_item').focus()
        } else {
            $.ajax({
                type: 'POST',
                url: '<?=site_url('penjualan/process')?>',
                data: {'ubah_jual' : true, 'jual_id' : jual_id, 'harga' : harga, 'jumlah_bar' : jumlah_bar, 'potongan' : potongan, 'total' : total},
                dataType: 'json',
                success: function(result) {
                    if(result.success == true) {
                        $('#jual_table').load('<?=site_url('penjualan/jual_data')?>', function() {
                            kalkulasi()
                        })
                        $('#modal-item-edit').modal('hide')
                    } else {
                        alert('Ubah data gagal')
                        $('#modal-item-edit').modal('hide')
                    }
                }
            })
        }
    })

    function kalkulasi() {
        var subtotal = 0;
        $('#jual_table tr').each(function() {
            subtotal += parseInt($(this).find('#total').text())
        })
        isNaN(subtotal) ? $('#sub_total').val(0) : $('#sub_total').val(subtotal)

        var diskon = $('#potong_harga').val()
        var grand_total = subtotal - diskon
        if(isNaN(grand_total)) {
            $('#grand_total').val(0)
            $('#grand_total2').text(0)
        } else {
            $('#grand_total').val(grand_total)
            $('#grand_total2').text(grand_total)
        }

        var bayar = $('#bayar').val();
        bayar != 0 ? $('#kembalian').val(bayar - grand_total) : $('#kembalian').val(0)
    }

    $(document).on('keyup mouseup', '#potong_harga, #bayar', function() {
        kalkulasi()
    })

    $(document).ready(function() {
        kalkulasi()
    })

    $(document).on('click', '#proses_jual', function() {
        var subtotal = $('#sub_total').val()
        var diskon = $('#potong_harga').val()
        var grandtotal = $('#grand_total').val()
        var bayar = $('#bayar').val()
        var kembalian = $('#kembalian').val()
        var catatan = $('#catatan').val()
        var tanggal = $('#tanggal').val()
        if(subtotal < 1) {
            alert('Belum ada produk item yang dipilih')
            $('#bayar').focus()
        } else if(bayar < 1) {
            alert('Pembayaran belum diinput, silahkan input pembayaran terlebih dahulu!')
            $('#bayar').fucus()
        } else {
            if(confirm('Yakin anda akan memproses transaksi ini?')) {
                $.ajax({
                    type: 'POST',
                    url: '<?=site_url('penjualan/process')?>',
                    data: {'proses_jual': true, 'subtotal': subtotal, 'diskon': diskon, 'grandtotal': grandtotal, 'bayar' : bayar, 'kembalian' : kembalian, 'catatan' : catatan, 'tanggal' : tanggal},
                    dataType: 'json',
                    success: function(result) {
                        if(result.success) {
                            alert('Transaksi Berhasil');
                            window.open('<?=site_url('penjualan/cetak/')?>' + result.jual_id, '_blank')
                        } else {
                            alert('Transaksi Gagal');
                        }
                        location.href='<?=site_url('penjualan')?>'
                    }
                })
            }
        }
    })

    $(document).on('click', '#cancel_payment', function() {
        if(confirm('Apakah Anda Yakin?')) {
            $.ajax({
                type: 'POST',
                url: '<?=site_url('penjualan/jual_hps')?>',
                dataType: 'json',
                data: {'cancel_payment' : true},
                success: function(result) {
                    if(result.success == true) {
                        $('#jual_table').load('<?=site_url('penjualan/jual_data')?>', function() {
                            kalkulasi()
                        })
                    }
                }
            })
            $('#potong_harga').val(0)
            $('#bayar').val(0)
            $('#potong_harga').val(0)
            $('#kodebarang').val('')
            $('#kodebarang').focus()
        }
    })
</script>