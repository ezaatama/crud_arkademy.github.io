<?php

    $server = "localhost";
    $user = "root";
    $password = "";
    $database = "arkademy";

    $koneksi = mysqli_connect($server, $user, $password, $database)or die(mysqli_error($koneksi));
    
    //tombol simpan
    if (isset($_POST['simpan']))
    {
        //setelah diedit tidak akan membuat data baru
        if($_GET['hal'] == "edit"){
            $ubah = mysqli_query($koneksi, "UPDATE produk set nama_produk = '$_POST[nm_produk]', keterangan = '$_POST[ket]',
            harga = '$_POST[hrg]', jumlah = '$_POST[jml]' WHERE id_produk = '$_GET[id]'");

                if ($ubah)
                {
                    echo "<script>
                            
                            document.location='index.php';
                        </script>";
                }else{
                    echo "<script>
                      
                        document.location='index.php';
                    </script>";
                }
        }else{
            $save = mysqli_query($koneksi, "INSERT into produk (nama_produk, keterangan, harga, jumlah) VALUES 
                ('$_POST[nm_produk]', '$_POST[ket]', '$_POST[hrg]', '$_POST[jml]')");

                if ($save)
                {
                    echo "<script>
                            document.location='index.php';
                        </script>";
                }else{
                    echo "<script>
                        document.location='index.php';
                    </script>";
                }
        }

        
        
    }

    //edit hapus
    if(isset($_GET['hal']))
    {
        if($_GET['hal'] == "edit")
        {
            $tampil = mysqli_query($koneksi, "SELECT * from produk WHERE id_produk = '$_GET[id]' ");
            $data = mysqli_fetch_array($tampil);
            if($data){
                $tnama_produk = $data['nama_produk'];
                $tketerangan = $data['keterangan'];
                $tharga = $data['harga'];
                $tjumlah = $data['jumlah'];
            }
        }else if($_GET['hal'] == "hapus"){
            $hapus = mysqli_query($koneksi, "DELETE from produk WHERE id_produk = '$_GET[id]'");
            if ($hapus){
                echo "<script>
                        alert('Hapus data berhasil');
                        document.location='index.php';
                    </script>";
            }
        }
    }

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Soal 10</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
</head>
    <body>
        <div class="container">
            <h1 class="title">Soal Nomor 10 Arkademy</h1>
            
            <div class="card">
                <div class="card-header">
                    Input Produk Baru
                </div>
                <div class="card-body">
                    <form method="post" action="">
                        <div class="form-group">
                            <label>Nama Produk</label>
                            <input type="text" name="nm_produk" value="<?=@$tnama_produk?>" class="form-control" placeholder="Masukkan nama produk baru" required>
                        </div>
                        <div class="form-group">
                            <label>Keterangan</label>
                            <input type="text" name="ket" value="<?=@$tketerangan?>" class="form-control" placeholder="Masukkan keterangan produk" required>
                        </div>
                        <div class="form-group">
                            <label>Harga</label>
                            <input type="text" name="hrg" value="<?=@$tharga?>" class="form-control" placeholder="Masukkan harga produk" required>
                        </div>
                        <div class="form-group">
                            <label>Jumlah</label>
                            <input type="text" name="jml" value="<?=@$tjumlah?>" class="form-control" placeholder="Masukkan jumlah produk" required>
                        </div>
                        <div class="tombol">
                            <button type="submit" class="btn btn-success" name="simpan">Simpan</button>
                            <button type="reset" class="btn btn-warning" name="batal">Batal</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card">
                <h1 class="subtitle">Data Produk</h1>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>No</th>
                            <th>Nama Produk</th>
                            <th>Keterangan</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Pilihan</th>
                        </tr>
                        <?php
                            $no = 1;
                            $tampil = mysqli_query($koneksi, "SELECT * from produk order by id_produk desc");
                            //convert jadi array
                            while ($data = mysqli_fetch_array($tampil)):

                        ?>
                        <tr>
                            <td><?=$no++;?></td>
                            <td><?=$data['nama_produk']?></td>
                            <td><?=$data['keterangan']?></td>
                            <td><?=$data['harga']?></td>
                            <td><?=$data['jumlah']?></td>
                            <td>
                                <a href="index.php?hal=edit&id=<?=$data['id_produk']?>" class="btn btn-warning">Edit</a>
                                <a href="index.php?hal=hapus&id=<?=$data['id_produk']?>" onClick="return confirm('Apakah Anda Yakin Ingin Hapus Data Ini?')" class="btn btn-danger">Hapus</a>
                            </td>
                        </tr>
                        <?php 
                            endwhile; 
                        ?>
                    </table>
                </div>
            </div>
        
        
        </div>


    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    
    </body>
</html>