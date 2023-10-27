<?php
include("koneksi/db.php");

$error = '';
$sukses = '';

if (isset($_GET['to'])) {
  $to = $_GET['to'];
} else {
  $to = '';
}

if ($to == 'delete') {
  $iddel = $_GET['id'];

  $delqry = mysqli_query($conn, "DELETE FROM menu WHERE id = '$iddel'");
  if ($delqry) {
    $sukses = 'Data Berhasil Dihapus';
  } else {
    $error = 'Data Gagal Dihapus, Terjadi Sebuah Kesalahan';
  }
}

if ($to == 'update') {
  $idedit = $_GET['id'];
  $qryform = mysqli_query($conn, "SELECT * FROM menu JOIN penjual ON menu.id_penjual=penjual.id_penjual WHERE id = '$idedit'");
  $fetchf = mysqli_fetch_array($qryform);

  $fharga = $fetchf['harga'];
  $fjenis = $fetchf['jenis'];
  $fnama = $fetchf['nama'];
  $fidPenjual = $fetchf['id_penjual'];
  $fidNamaP = $fetchf['nama_penjual'];
  $fid = $fetchf['id'];
}

if (isset($_POST['btlbtn'])) {
  header("refresh:0;url=menu.php");
}

if (isset($_POST['submitbtn'])) {
  $harga = $_POST['harga'];
  $jenis = $_POST['jenis'];
  $nama = $_POST['nama'];
  $idPenjual = $_POST['idpenjual'];
  $id = $_POST['id'];


  if (empty($idPenjual) or empty($nama) or empty($harga) or empty($jenis)) {
    $error = 'Jangan Sampai Kosong, Silahkan Isi Ulang';
  } else {
    if ($to == "update") {
      $qryu = mysqli_query($conn, "UPDATE menu SET id = '$id', jenis = '$jenis', harga = '$harga', nama = '$nama', id_penjual = '$idPenjual' WHERE id = '$idedit'");
      if ($qryu) {
        $sukses = "Berhasil";
      } else {
        $error = "Gagal";
      }
    } else {
      $qryi = "INSERT INTO menu VALUES ('$id', '$jenis', '$harga', '$nama', '$idPenjual')";

      try {
        mysqli_query($conn, $qryi);
        $sukses = 'Data Berhasil Dibuat, Sukses.';
      } catch (mysqli_sql_exception) {
        $error = 'Gagal Membuat Data, Terjadi Kesalahan!!';
      }
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Menu Makanan</title>
  <link rel="stylesheet" href="style/menu.css" />
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
            header("refresh:2;url=menu.php");
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
            header("refresh:2;url=menu.php");
          endif; ?>

          <form class="createnupdate" method="post" action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" style="margin-top: 15px;">
            <div class="inputpart">
              <p>Id</p>
              <input type="text" value="<?php if (isset($fid)) echo $fid; ?>" name="id" />
            </div>

            <div class="inputpart">
              <p>Harga</p>
              <input value="<?php if (isset($fharga)) echo $fharga; ?>" type="text" name="harga" />
            </div>

            <div class="inputpart">
              <p>Jenis</p>
              <select name="jenis" id="">
                <option selected value="makanan berat" value="<?php
                                                              if (isset($fjenis)) {
                                                                if ($fjenis == 'makanan berat') {
                                                                  echo 'selected';
                                                                }
                                                              }

                                                              ?>">
                  Makanan Berat
                </option>
                <option <?php
                        if (isset($fjenis)) {
                          if ($fjenis == 'makanan ringan') {
                            echo 'selected';
                          }
                        }
                        ?> value="makanan ringan">Makanan Ringan</option>
              </select>
            </div>
            <div class="inputpart">
              <p>Nama Makanan</p>
              <input value="<?php if (isset($fnama)) echo "$fnama" ?>" type="text" name="nama" />
            </div>

            <div class="inputpart">
              <p>Id_Penjual</p>
              <select name="idpenjual" id="">
                <?php
                $rowsid = mysqli_query($conn, 'SELECT * FROM penjual');
                while ($row = mysqli_fetch_array($rowsid)) {
                  $idPenjual = $row['id_penjual'];
                  $namaPenjual = $row['nama_penjual'];
                  $selected = ($fidPenjual == $idPenjual) ? "selected" : "";
                  echo "<option value='$idPenjual $namaPenjual' $selected>$idPenjual $namaPenjual</option>";
                }
                ?>
              </select>
            </div>

            <div class="btnpart">
              <button type="submit" class="btn btn-success" name="submitbtn">Simpan</button>
              <button type="submit" class="btn btn-danger" name="btlbtn">Batal</button>
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
                <th scope="col">Harga</th>
                <th scope="col">Jenis Makanan</th>
                <th scope="col">Nama Makanan</th>
                <th scope="col">Id Penjual</th>
                <th scope="col">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $qryr = mysqli_query($conn, 'SELECT * FROM menu JOIN penjual ON menu.id_penjual=penjual.id_penjual');
              while ($fetch = mysqli_fetch_array($qryr)) :
              ?>
                <tr>
                  <th scope="row"><?= $fetch['id'] ?></th>
                  <td><?= $fetch['harga'] ?></td>
                  <td><?= $fetch['jenis'] ?></td>
                  <td><?= $fetch['nama'] ?></td>
                  <td><?= $fetch['id_penjual'] . " " . $fetch['nama_penjual'] ?></td>
                  <td>
                    <a href="menu.php?to=update&id=<?= $fetch['id'] ?>">
                      <button type="button" class="btn btn-warning">Update</button>
                    </a>
                    <a href="menu.php?to=delete&id=<?= $fetch['id'] ?>">
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