<section class="content-header">
  <h1>
    Pemasok
  </h1>
</section>

<section class="content">
    <div class="box">
        <div class="box-header">
           <h3 class="box-title">Data Pemasok</h3>
            <div class="pull-right">
                <a href="<?=site_url('suplayer/add')?>" class="btn btn-primary btn-flat">
                   <i class="fa fa-plus"></i> Tambah
                </a>
            </div>
        </div>
        <div class="box-body table-responsive">
            <table class="table table-bordered table-striped" id="table1">
                <thead>
                    <tr>
                      <th style="width: 6%;">No</th>
                      <th>Nama</th>
                      <th>Phone</th>
                      <th>Alamat</th>
                      <th>Keterangan</th>
                      <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach($row->result() as $key => $data) { ?>
                    <tr>
                      <td><?=$no++?>.</td>
                      <td><?=$data->nama?></td>
                      <td><?=$data->phone?></td>
                      <td><?=$data->alamat?></td>
                      <td><?=$data->keterangan?></td>
                      <td class="text-center" width="160px">
                        <a href="<?=site_url('suplayer/edit/'.$data->suplayer_id)?>" class="btn btn-primary btn-xs">
                          <i class="fa fa-pencil"></i> Edit
                        </a>
                        <a href="<?=site_url('suplayer/del/'.$data->suplayer_id)?>" onclick="return confirm('Apakah anda yakin')" class="btn btn-danger btn-xs">
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