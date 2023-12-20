<?php
$title = 'pelanggan';
require'functions.php';

$id = $_GET['id'];
$queryedit = "SELECT * FROM users WHERE id = '$id'";
$edit = ambilsatubaris($conn,$queryedit);

if(isset($_POST['btn-simpan'])){
    // $id = $_POST['id'];
    $first_name    = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email     = $_POST['email']; 
    $password     = $_POST['password']; 
    $query = "UPDATE users SET first_name = '$first_name' ,  last_name = '$last_name', email = '$email', password = '$password' WHERE id ='$id'";
    
    $execute = bisa($conn,$query);
    if($execute == 1){
        $success = 'true';
        $title = 'Berhasil';
        $message = 'Berhasil mengubah pelanggan';
        $type = 'success';
        header('location: pelanggan.php?crud='.$success.'&msg='.$message.'&type='.$type.'&title='.$title);
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
                    <label>first name</label>
                    <input type="text" name="first_name" class="form-control" value="<?= $edit['first_name'] ?>">
                </div>
                <div class="form-group">
                    <label>last name</label>
                    <input type="text" name="last_name" class="form-control" value="<?= $edit['last_name'] ?>">
                </div>
                <div class="form-group">
                    <label>email</label>
                    <input type="text" name="email" class="form-control" value="<?= $edit['email'] ?>">
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="text" name="password" class="form-control">
                    <small class="text-danger">Kosongkan saja jika tidak akan mengubah password</small>
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