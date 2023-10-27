<?
include_once("koneksi/db.php");


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard</title>
  <link rel="stylesheet" href="style/index.css" />
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

      <div class="pilihmana">
        <div class="penjualbox">
          <div class="infodb">
            <div class="topinfo">
              <div class="chartimg">
                <i style="color: white; font-size: 50px" class="fa-solid fa-chart-simple"></i>
              </div>
              <div class="infoIni">
                <p>Database : Kantin_db</p>
                <p>Table : Penjual</p>
                <p>Desc : Menjual Makanan / Minuman</p>
              </div>
            </div>

            <div class="bottominfo">
              <div class="bottom-info-content">
                <i class="fa-solid fa-users" style="color: #ffffff; font-size: 60px"></i>
                <p style="
                      text-align: center;
                      color: white;
                      font-weight: bold;
                      letter-spacing: 1px;
                    ">
                  Jumlah Penjual <br />
                  <?php

                  ?>
                </p>
              </div>
              <div class="bottom-info-content" onclick="window.location.href='penjual.php'">
                <i class="fa-solid fa-table" style="color: #ffffff; font-size: 60px"></i>
                <p style="
                      text-align: center;
                      color: white;
                      font-weight: bold;
                      letter-spacing: 1px;
                    ">
                  Lihat Lebih Lanjut
                </p>
              </div>
            </div>
          </div>
        </div>
        <div class="penjualbox">
          <div class="infodb">
            <div class="topinfo">
              <div class="chartimg">
                <i style="color: white; font-size: 50px" class="fa-solid fa-chart-simple"></i>
              </div>
              <div class="infoIni">
                <p>Database : Kantin_db</p>
                <p>Table : Menu</p>
                <p>Desc : Menu Makanan Yang Dijual Penjual</p>
              </div>
            </div>

            <div class="bottominfo">
              <div class="bottom-info-content">
                <i class="fa-solid fa-users" style="color: #ffffff; font-size: 60px"></i>
                <p style="
                      text-align: center;
                      color: white;
                      font-weight: bold;
                      letter-spacing: 1px;
                    ">
                  Jumlah Menu <br />
                  10
                </p>
              </div>
              <div class="bottom-info-content" onclick="window.location.href='menu.php'">
                <i class="fa-solid fa-table" style="color: #ffffff; font-size: 60px"></i>
                <p style="
                      text-align: center;
                      color: white;
                      font-weight: bold;
                      letter-spacing: 1px;
                    ">
                  Lihat Lebih Lanjut
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
<script src="index.js"></script>

</html>