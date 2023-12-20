<?php
$title = 'pengguna';
require'functions.php';

$role = ['admin'];

$id = $_GET['id'];
$queryedit = "SELECT * FROM admin WHERE id = '$id'";
$edit = ambilsatubaris($conn,$queryedit);

if(isset($_POST['btn-simpan'])){
    $nama     = $_POST['nama'];
    $email = $_POST['email'];
    $role     = $_POST['role'];
    if($_POST['password'] != null || $_POST['password'] == ''){
        $password     = md5($_POST['password']);
        $query = "UPDATE admin SET nama = '$nama' , email = '$email' , role = '$role' , password ='$password' WHERE id = '$id'";    
    }else{
        $query = "UPDATE admin SET nama = '$nama' , email = '$email' , role = '$role' WHERE id = '$id'";
    }
    
    
    $execute = bisa($conn,$query);
    if($execute == 1){
        $success = 'true';
        $title = 'Berhasil';
        $message = 'Berhasil mengubah ' .$role;
        $type = 'success';
        header('location: pengguna.php?crud='.$success.'&msg='.$message.'&type='.$type.'&title='.$title);
    }else{
        echo "Gagal Tambah Data";
    }
}


require'layout_header.php';
?> 
<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Data Master Pengguna</h4> </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="outlet.php">Pengguna</a></li>
                <li><a href="#">Tambah Pengguna</a></li>
            </ol>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
            <div class="white-box">
                <div class="row">
                    <div class="col-md-6">
                          <a href="javascript:void(0)" onclick="window.history.back();" class="btn btn-primary box-title"><i class="fa fa-arrow-left fa-fw"></i> Kembali</a>
                    </div>
                    <div class="col-md-6 text-right">
                        <button id="btn-refresh" class="btn btn-primary box-title text-right" title="Refresh Data"><i class="fa fa-refresh" id="ic-refresh"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
            <div class="white-box">
                <form method="post" action="">
                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" name="nama" class="form-control" value="<?= $edit['nama'] ?>">
                </div>
                <div class="form-group">
                    <label>email</label>
                    <input type="text" name="email" class="form-control" value="<?= $edit['email'] ?>">
                <div class="form-group">
                    <label>Password</label>
                    <input type="text" name="password" class="form-control">
                    <small class="text-danger">Kosongkan saja jika tidak akan mengubah password</small>
                </div>
                <div class="form-group">
                    <label>Role</label>
                    <select name="role" class="form-control">
                        <?php foreach ($role as $key): ?>
                            <?php if ($key == $edit['role']): ?>
                            <option value="<?= $key ?>" selected><?= $key ?></option>    
                            <?php endif ?>
                            <option value="<?= $key ?>"><?= ucfirst($key) ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="text-right">
                    <button type="reset" class="btn btn-danger">Reset</button>
                    <button type="submit" name="btn-simpan" class="btn btn-primary">Simpan</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
require'layout_footer.php';
?> 