<section class="content-header">
  <h1>
    Item
  </h1>
</section>

<!-- Main Content -->
<section class="content">
    <!-- <?php $this->view('pesan')?> -->
    <div class="box">
        <div class="box-header">
          <h3 class="box-title">Data Produk Item</h3>
            <div class="pull-right">
                <a href="<?=site_url('item/add')?>" class="btn btn-primary btn-flat">
                  <i class="fa fa-plus"></i> Tambah
                </a>
            </div>
        </div>
        <div class="box-body table-responsive">
            <table class="table table-bordered table-striped" id="table1">
                <thead>
                    <tr>
                      <th style="width: 6%;">No</th>
                      <!-- <th>Barcode</th> -->
                      <th>Kode Barang</th>
                      <th>Nama</th>
                      <th>Kategori</th>
                      <th>Satuan</th>
                      <th>Harga</th>
                      <th>Stok</th>
                      <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <!-- <?php $no = 1;
                    foreach($row->result() as $key => $data) { ?>
                      <tr>
                        <td><?=$no++?>.</td>
                        <td>
                          <?=$data->barcode?><br>
                          <a href="<?=site_url('item/barcode_qrcode/'.$data->item_id)?>" class="btn btn-default btn-xs">
                            Generate <i class="fa fa-barcode"></i>
                          </a>
                        </td>
                        <td><?=$data->kodebarang?></td>
                        <td><?=$data->nama?></td>
                        <td><?=$data->kategori_nama?></td>
                        <td><?=$data->unit_nama?></td>
                        <td><?=indo_currency($data->harga)?></td>
                        <td><?=$data->stok?></td>
                        <td class="text-center" width="160px">
                          <a href="<?=site_url('item/edit/'.$data->item_id)?>" class="btn btn-primary btn-xs">
                            <i class="fa fa-trash"></i> Edit
                          </a>
                          <a href="<?=site_url('item/del/'.$data->item_id)?>" onclick="return confirm('Apakah anda yakin')" class="btn btn-danger btn-xs">
                            <i class="fa fa-trash"></i> Hapus
                          </a>
                        </td>
                      </tr>
                      <?php
                      } ?> -->
                </tbody>
            </table>
        </div>
    </div>
</section>

<script>
  $(document).ready(function() {
    $('#table1').dataTable({
      "processing": true,
      "serverSide": true,
      "ajax": {
        "url": "<?=site_url('item/get_ajax')?>",
        "type": "POST"
      },
      "columnDefs": [
        {
          "targets": [5, 6],
          "className": 'text-right'
        }
      ],
      "order": []
    })
  })
</script>