<?php
include('koneksi/db.php');

$nama = "";
$nohp = "";
$alamat = "";
$idpenjual = "";
$sukses = "";
$error = "";

//untuk mendapatkan GET
if (isset($_GET['to'])) {
  $to = $_GET['to'];
} else {
  $to = '';
}

//delete
if ($to == "delete") {
  $id = $_GET['id'];

  $qrydeletemenu = mysqli_query($conn, "DELETE FROM menu WHERE id_penjual = '$id'");
  $qrydelete = mysqli_query($conn, "DELETE FROM penjual WHERE id_penjual = '$id'");
  if ($qrydelete or $qrydeletemenu) {
    $sukses = "Data Berhasil Di Hapus";
    header("refresh:2;url=penjual.php");
  } else {
    $error = "Data Gagal Di Hapus, Terjadi Error !!!";
    header("refresh:2;url=penjual.php");
  }
}

//update
if ($to == "update") {
  $id = $_GET["id"];
  $qryu = mysqli_query($conn, "SELECT * FROM penjual WHERE id_penjual = '$id'");
  $fetchqryu = mysqli_fetch_array($qryu);

  $nama = $fetchqryu['nama_penjual'];
  $nohp = $fetchqryu['nohp'];
  $alamat = $fetchqryu['alamat'];
  $idpenjual = $fetchqryu['id_penjual'];
}

//UNTUK CREATE
if (isset($_POST["submit"])) {
  $nama = $_POST['nama'];
  $nohp = $_POST['nohp'];
  $alamat = $_POST['alamat'];
  $idpenjual = $_POST['idpenjual'];

  if ($nama or $nohp or $alamat or $idpenjual) {
    if ($to == "update") {
      $updateqry = mysqli_query($conn, "UPDATE penjual SET id_penjual = '$idpenjual', nama_penjual = '$nama', nohp = '$nohp', alamat = '$alamat' WHERE id_penjual = '$id'");
      if ($updateqry) {
        $sukses = "Data Berhasil Di Update";
        header("refresh:1;url=penjual.php");
      } else {
        $error = "Terjadi Kesalahan";
        header("refresh:2;url=penjual.php");
      }
    } else {
      $sukses = "SEMULA TERISI";
      $createqry = mysqli_query($conn, "INSERT INTO penjual (id_penjual, nama_penjual, nohp, alamat) VALUES ('$idpenjual' ,'$nama', '$nohp', '$alamat')");

      if ($createqry) {
        $sukses = "Data Berhasil Di Tambah";
      } else {
        $error = "Data Gagal Di Tambah, Terjadi Sebuah Error !!!";
      }
    }
  } else {
    $error = "Jangan Sampai Kosong";
  }
}

//UNTUK BATAL 
if (isset($_POST['batalbtn'])) {
  header("refresh:0;url=penjual.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard</title>
  <link rel="stylesheet" href="style/penjual.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css
    " />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
</head>

<body>
  <div class="hero">
    <div class="navbarV">
      <div class="userinfo">
        <p style="color: white; letter-spacing: 1px">CRUD LAYOUT</p>
        <div class="profile">
          <div class="pp">
            <i class="fa-solid fa-user" style="font-size: 20px"></i>
          </div>
          <p style="color: white">Habib Abdillah</p>
        </div>
      </div>

      <div class="navbarV-content">
        <div onclick="window.location.href='index.php'" class="dashboard-part">
          <h4>DASHBOARD</h4>
        </div>

        <div class="dashboard-part" onclick="window.location.href='penjual.php'">
          <h4>Penjual</h4>
        </div>

        <div class="dashboard-part" onclick="window.location.href='menu.php'">
          <h4>Menu Makanan</h4>
        </div>
      </div>
    </div>
    <div class="content">
      <div class="topbar">
        <div class="tbleft">
          <div class="threedot">
            <div></div>
            <div></div>
            <div></div>
          </div>
          <h2>Navigasi</h2>
        </div>
        <div class="tbright">
          <form action="">
            <input type="text" class="searchinput" />
            <button type="submit" class="searchsubmit">
              <i class="fa-solid fa-magnifying-glass"></i>
            </button>
          </form>

          <div class="user">
            <i class="fa-solid fa-user"></i>
          </div>
        </div>
      </div>

      <div class="container-crud">
        <div class="createOrUpdate">
          <div class="navbar-part">
            <h4 style="color: white">Create Or Update</h4>
          </div>
          <?php
          if ($sukses) :
            header("refresh:2;url=penjual.php");
          ?>
            <div class='alert alert-info' role='alert'>
              <?= $sukses ?>
            </div>
          <?php elseif ($error) :
          ?>
            <div class='alert alert-danger' role='alert'>
              <?= $error ?>
            </div>
          <?php
            header("refresh:2;url=penjual.php");
          endif; ?>


          <!--  -->
          <form class="createnupdate" method="post" action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            <div class="inputpart">
              <p>Id Penjual</p>
              <input type="text" name="idpenjual" value="<?php if ($idpenjual) echo $idpenjual; ?>" />
            </div>

            <div class="inputpart">
              <p>Nama</p>
              <input maxlength="26" type="text" name="nama" value="<?php if ($nama) echo $nama; ?>" />
            </div>

            <div class="inputpart">
              <p>nohp</p>
              <input type="text" name="nohp" value="<?php if ($nohp) echo $nohp; ?>" />
            </div>

            <div class="inputpart">
              <p>alamat</p>
              <input type="text" name="alamat" value="<?php if ($alamat) echo $alamat; ?>" />
            </div>

            <div class="btnpart">
              <button type="submit" class="btn btn-success" name="submit">Simpan</button>
              <button type="submit" class="btn btn-danger" name="batalbtn">Batal</button>
            </div>
          </form>
        </div>
      </div>

      <div class="readcrud">
        <div class="table-container">
          <table class="table table-hover">
            <thead>
              <tr>
                <th scope="col">Id</th>
                <th scope="col">Nama</th>
                <th scope="col">Nomor Handphone</th>
                <th scope="col">Alamat</th>
                <th scope="col">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $qry = "SELECT * FROM penjual ORDER BY id_penjual DESC";
              $result = mysqli_query($conn, $qry);

              while ($fetch = mysqli_fetch_assoc($result)) :
              ?>
                <tr>
                  <th scope="row"><?= $fetch['id_penjual'] ?></th>
                  <td><?= $fetch['nama_penjual'] ?></td>
                  <td><?= $fetch['nohp'] ?></td>
                  <td><?= $fetch['alamat'] ?></td>
                  <td>
                    <a href="penjual.php?to=update&id=<?= $fetch['id_penjual'] ?>">
                      <button type="button" class="btn btn-warning">Update</button>
                    </a>
                    <a href="penjual.php?to=delete&id=<?= $fetch['id_penjual'] ?>">
                      <button type="button" class="btn btn-danger">Delete</button>
                    </a>
                  </td>
                </tr>
              <?php endwhile; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</body>
<script src="index.js"></script>

</html>