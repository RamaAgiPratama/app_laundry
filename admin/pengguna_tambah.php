<?php
$title = 'pengguna';
require'functions.php';
$outlet = ambildata($conn,'SELECT * FROM outlet');
if(isset($_POST['btn-simpan'])){
    $nama     = $_POST['nama_user'];
    $username = $_POST['username'];
    $pass     = md5($_POST['password']);
    $role     = $_POST['role'];
    if($role == 'kasir'){
        $outlet_id = $_POST['outlet_id'];
        $query = "INSERT INTO user (nama_user,username,password,role,outlet_id) values ('$nama','$username','$pass','$role','$outlet_id')";
    }else{
        $query = "INSERT INTO user (nama_user,username,password,role) values ('$nama','$username','$pass','$role')";
    
    }
    $execute = bisa($conn,$query);
    if($execute == 1){
        $success = 'true';
        $title = 'Berhasil';
        $message = 'Berhasil menambahkan ' .$role. ' baru';
        $type = 'success';
        header('location: pengguna.php?crud='.$success.'&msg='.$message.'&type='.$type.'&title='.$title);
    }else{
        echo "Gagal Tambah Data";
    }
}


require'layout_header.php';
?> 
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
            <div class="white-box">
                <form method="post" action="">
                <div class="form-group">
                    <label>Nama Pengguna</label>
                    <input autocomplete="off" type="text" name="nama_user" class="form-control">
                </div>
                <div class="form-group">
                    <label>Username</label>
                    <input autocomplete="off" type="text" name="username" class="form-control">
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input autocomplete="off" type="text" name="password" class="form-control">
                </div>
                <div class="form-group">
                    <label>Role</label>
                    <select name="role" class="form-control">
                        <option value="admin">Admin</option>
                        <option value="owner">Owner</option>
                        <option value="kasir">Kasir</option>
                        
                        
                    </select>
                </div>
                <div class="form-group">
                    <label>Jika Role Nya Kasir Maka Pilih Outlet Dimana Dia Akan Ditempatkan</label>
                    <select name="outlet_id" class="form-control">
                        <?php foreach ($outlet as $key): ?>
                            <option value="<?= $key['id_outlet'] ?>"><?= $key['nama_outlet'] ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="text-right">
                    <a href="javascript:void(0)" onclick="window.history.back();" class="btn btn-primary"><i class="fa fa-arrow-left fa-fw"></i> Kembali</a>
                    <button type="reset" class="btn btn-danger"><i class="fa fa-refresh fa-fw"></i> Reset</button>
                    <button type="submit" name="btn-simpan" class="btn btn-success"><i class="fa fa-save fa-fw"></i> Simpan</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
require'layout_footer.php';
?> 