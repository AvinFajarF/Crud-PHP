<?php

$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'crud';

$conn = mysqli_connect($host,$user,$pass,$db);
if (!$conn){
    die('koneksi ke database error');
}

$nama = '';
$alamat = '';
$kelamin = '';
$agama = '';
$asal = '';
$sukses = '';
$error = '';

if (isset($_GET['pilihan'])){
    $pilihan = $_GET['pilihan'];
}else{
    $pilihan = '';
}

if ($pilihan == 'delete'){
    $id    = $_GET['id'];
    $query = "DELETE FROM pendaftaran WHERE id = '$id'";
    $sql   = mysqli_query($conn,$query);
    if ($sql){
        $sukses = 'Data berhasil di delete';
    }else{
        $error  = 'Data gagal di delete';
    }
}

//edit data
if ($pilihan == 'edit'){
    $id          = $_GET['id'];
    $query       = "SELECT * FROM pendaftaran WHERE id = '$id'";
    $q1          = mysqli_query($conn,$query);
    $data        = mysqli_fetch_assoc($q1);
    $nama        = $data['nama'];
    $alamat      = $data['alamat'];
    $kelamin     = $data['kelamin'];
    $agama       = $data['agama'];
    $asal        = $data['asal_sekolah'];
}

if (isset($_POST['simpan'])){
    $nama       = $_POST['nama'];
    $alamat     = $_POST['alamat'];
    $kelamin    = $_POST['kelamin'];
    $agama      = $_POST['agama'];
    $asal       = $_POST['asal'];

    //edit data
    if ($pilihan == 'edit'){
        $query = "UPDATE pendaftaran SET nama = '$nama',alamat = '$alamat',kelamin = '$kelamin',agama = '$agama',asal = '$asal'";
        $ql    = mysqli_query($conn,$query);
        if ($ql){
            $sukses = 'Data berhasil di Update';
        }else{
            $error  = 'Data gagal di Update';
        }
    }

    //create data
    if ($nama && $alamat && $kelamin && $agama && $asal){
        $sql1 = "INSERT INTO pendaftaran(nama,alamat,kelamin,agama,asal_sekolah) VALUES ('$nama','$alamat','$kelamin','$agama','$asal')";
        $ql = mysqli_query($conn,$sql1);
        if ($ql){
            $sukses = 'Data berhasil di buat';
        }else{
            $error = 'Gagal memasukan data';
        }
    }else{
        $error = "Silahkan masukan semua data diri anda";
    }

}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran SMK 1 Muhammadiyah Sukoharjo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="css/home.css">
</head>

<body>
<div class="mx-auto">
    <!-- untuk memasukkan data -->
    <div class="card">
        <div class="card-header">
            Pendaftaran SMK 1 Muhammadiyah Sukoharjo
        </div>
        <div class="card-body">
            <?php
            if ($error){
                ?>
                    <div class="alert alert-danger" role="alert">
                        <?php
                       echo $error;
                        ?>
                        <?php
                        header("refresh:1;url=index.php");
                        ?>
                 </div>
                <?php
            }
            if ($sukses){
                ?>
                <div class="alert alert-primary" role="alert">
                  <?php
                  echo $sukses;
                  ?>
                  <?php
                  header("refresh:1;url=index.php");
                  ?>
            </div>
            <?php
            }
                ?>

            <form action="" method="POST">
                <div class="mb-3 row">
                    <label for="nim" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $nama ?>">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="nama" class="col-sm-2 col-form-label">Alamat</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="alamat" name="alamat" value="<?php echo $alamat ?>">
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="agama" class="col-sm-2 col-form-label">Agama</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="agama" name="agama" value="<?php echo $agama ?>">
                    </div>
                </div>

                    <div class="mb-3 row">
                        <label for="asal" class="col-sm-2 col-form-label">Asal-Sekolah</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="asal" name="asal" value="<?php echo $asal ?>">
                        </div>
                    </div>

                <div class="mb-3 row">
                    <label for="kelamin" class="col-sm-2 col-form-label">Jenis-Kelamin</label>
                    <div class="col-sm-10">
                        <select class="form-control" name="kelamin" id="kelamin">
                            <option value="">- Pilih Jenis-Kelamin -</option>
                            <option value="pria" <?php if ($kelamin == "pria") echo "selected" ?>>Pria</option>
                            <option value="wanita" <?php if ($kelamin == "wanita") echo "selected" ?>>Wanita</option>
                        </select>
                    </div>
                </div>
                <div class="col-12">
                    <input type="submit" name="simpan" value="Simpan Data" class="btn btn-primary" />
                </div>
            </form>
        </div>
    </div>

    <!-- untuk mengeluarkan data -->
    <div class="card">
        <div class="card-header text-white bg-secondary data">
            Data Siswa
        </div>
        <table class="card-body">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Alamat</th>
                    <th scope="col">Kelamin</th>
                    <th scope="col">Agama</th>
                    <th scope="col">Asal-Sekolah</th>
                    <th scope="col">Aksi</th>
                </tr>
                </thead>

            <tbody>
            <?php
            $dump = "SELECT * FROM pendaftaran ORDER BY id ASC";
            $qeury = mysqli_query($conn,$dump);
            $urut = 1;
            while ($siswa = mysqli_fetch_assoc($qeury)){
                $id         = $siswa['id'];
                $nama       = $siswa['nama'];
                $alamat     = $siswa['alamat'];
                $kelamin    = $siswa['kelamin'];
                $agama      = $siswa['agama'];
                $asal       = $siswa['asal_sekolah'];

            ?>
             <tr>
             <th scope="row"><?php echo $urut++ ?></th>
            <td scope="row"><?php echo $nama ?></td>
            <td scope="row"><?php echo $alamat ?></td>
            <td scope="row"><?php echo $kelamin ?></td>
            <td scope="row"><?php echo $agama ?></td>
            <td scope="row"><?php echo $asal ?></td>
            <td scope="row">
                <a href="index.php?pilihan=edit&id=<?php echo $id ?>"><button type="button" class="btn btn-warning">Edit</button></a>
                <a href="index.php?pilihan=delete&id=<?php echo $id?>" onclick="return confirm('Apakah anda yakin ingin menghapus data?')"><button type="button" class="btn btn-danger">Delete</button></a>
            </td>
            </tr>
            <?php
            }
            ?>
            </tbody>
        </table>
        </div>
    </div>


</body>
</html>