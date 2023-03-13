<section class="content-header">
  <h1>
    Akun
  </h1>
</section>

<!-- Main Content -->
<section class="content">
    <div class="box">
        <div class="box-header">
           <h3 class="box-title">Data Akun</h3>
            <div class="pull-right">
                <a href="<?=site_url('user/add')?>" class="btn btn-primary btn-flat">
                   <i class="fa fa-user-plus"></i> Tambah
                </a>
            </div>
        </div>
        <div class="box-body table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                      <th style="width: 6%;">No</th>
                      <th>Username</th>
                      <th>Nama</th>
                      <th>Password</th>
                      <th>Level</th>
                      <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach($row->result() as $key => $data) { ?>
                    <tr>
                      <td><?=$no++?>.</td>
                      <td><?=$data->username?></td>
                      <td><?=$data->name?></td>
                      <td><?=$data->password?></td>
                      <td><?=$data->level == 1 ? "Admin" : "Kasir"?></td>
                      <td class="text-center" width="160px">
                      <form action="<?=site_url('user/del')?>" method="post">
                        <a href="<?=site_url('user/edit/'.$data->user_id)?>" class="btn btn-primary btn-xs">
                          <i class="fa fa-pencil"></i> Edit
                        </a>
                          <input type="hidden" name="user_id" value="<?=$data->user_id?>">
                          <button onclick="return confirm('Apahah anda yakin?')" class="btn btn-danger btn-xs">
                            <i class="fa fa-trash"></i> Hapus
                          </button>
                      </form>
                      </td>
                    </tr>
                    <?php
                    } ?>
                </tbody>
            </table>
        </div>
    </div>
</section>