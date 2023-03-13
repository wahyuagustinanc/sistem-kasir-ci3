<section class="content-header">
  <h1>
    Akun
  </h1>
</section>

<!-- Main Content -->
<section class="content">
    <div class="box">
        <div class="box-header">
           <h3 class="box-title">Buat Akun</h3>
            <div class="pull-right">
                <a href="<?=site_url('user')?>" class="btn btn-warning btn-flat">
                   <i class="fa fa-undo"></i> Kembali
                </a>
            </div>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <?php?>
                    <form action="" method="post">
                        <div class="form-group <?=form_error('fullname') ? 'has-error' : null?>">
                            <label>Nama *</label>
                            <input type="text" name="fullname" value="<?=set_value('fullname')?>" class="form-control">
                            <?=form_error('fullname') ?>
                        </div>
                        <div class="form-group <?=form_error('username') ? 'has-error' : null?>">
                            <label>Username *</label>
                            <input type="text" name="username" value="<?=set_value('username')?>" class="form-control">
                            <?=form_error('username') ?>
                        </div>
                        <div class="form-group <?=form_error('password') ? 'has-error' : null?>">
                            <label>Password *</label>
                            <input type="password" name="password" value="<?=set_value('password')?>" class="form-control">
                            <?=form_error('password') ?>
                        </div>
                        <div class="form-group <?=form_error('passconf') ? 'has-error' : null?>">
                            <label>Konfirmasi Password *</label>
                            <input type="password" name="passconf" value="<?=set_value('passconf')?>" class="form-control">
                            <?=form_error('passconf') ?>
                        </div>
                        <div class="form-group <?=form_error('level') ? 'has-error' : null?>">
                            <label>Level *</label>
                            <select name="level" class="form-control">
                                <option value="">- Pilih</option>
                                <option value="1" <?=set_value('level') == 1 ? "selected" : null?>>- Admin</option>
                                <option value="2" <?=set_value('level') == 2 ? "selected" : null?>>- Kasir</option>
                            </select>
                            <?=form_error('level') ?>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success btn-flat">Simpan</button>
                            <button type="Reset" class="btn btn-flat">Ulangi</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>