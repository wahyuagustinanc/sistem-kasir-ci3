<section class="content-header">
  <h1>
    Pemasok
  </h1>
</section>

<section class="content">
    <div class="box">
        <div class="box-header">
           <h3 class="box-title"><?=ucfirst($page)?> Pemasok</h3>
            <div class="pull-right">
                <a href="<?=site_url('suplayer')?>" class="btn btn-warning btn-flat">
                   <i class="fa fa-undo"></i> Kembali
                </a>
            </div>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <?php?>
                    <form action="<?=site_url('suplayer/proses')?>" method="post">
                        <div class="form-group">
                            <label>Nama Pemasok*</label>
                            <input type="hidden" name="id" value="<?=$row->suplayer_id?>">
                            <input type="text" name="suplayer_nama" value="<?=$row->nama?>" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Phone*</label>
                            <input type="number" name="phone" value="<?=$row->phone?>" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Alamat*</label>
                            <input type="text" name="alamat" value="<?=$row->alamat?>" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Keterangan</label>
                            <textarea name="keterangan" class="form-control"><?=$row->keterangan?></textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" name="<?=$page?>" class="btn btn-success btn-flat">Simpan</button>
                            <button type="Reset" class="btn btn-flat">Ulangi</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>