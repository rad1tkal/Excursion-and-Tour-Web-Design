<!DOCTYPE html>
<?php 
  include "includes/config.php";
  $query = mysqli_query($connection, "SELECT * FROM area");

  $destinasi = mysqli_query($connection, "SELECT * FROM destinasi,kategori,area,fotodestinasi WHERE kategori.kategoriID = destinasi.kategoriID AND destinasi.destinasiID = fotodestinasi.destinasiID AND destinasi.areaID = area.areaID");
  $hotel= mysqli_query($connection, "SELECT * FROM hotel, fotohotel,area WHERE hotel.hotelID = fotohotel.hotelID AND area.areaID = hotel.areaID");

  $sql1 = mysqli_query($connection, "SELECT * FROM destinasi ");
  $jumlah1 = mysqli_num_rows($sql1);
  $foto = mysqli_query($connection, "SELECT * FROM fotodestinasi");
  $foto1 = mysqli_query($connection, "SELECT * FROM fotohotel");
  $foto2 = mysqli_query($connection, "SELECT * FROM fotorestoran");
  $sql2 = mysqli_query($connection, "SELECT * FROM hotel");
  $sql3 = mysqli_query($connection, "SELECT * FROM restoran");
  $sql4 = mysqli_query($connection, "SELECT * FROM sewakendaraan ");
  $jumlah2 = mysqli_num_rows($sql2);
  $jumlah3 = mysqli_num_rows($sql3);
  $jumlah4 = mysqli_num_rows($sql4);
 ?>

<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Hotel</title>
  <meta content="" name="descriptison">
  <meta content="" name="keywords">

  <!-- Favicons -->
  

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="assets/vendor/ionicons/css/ionicons.min.css" rel="stylesheet">
  <link href="assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="assets/vendor/venobox/venobox.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="assets/css/style.css" type="text/css" rel="stylesheet">


</head>

<body id="page-top">

  <!-- ======= Header/ Navbar ======= -->
  <nav class="navbar navbar-b navbar-trans navbar-expand-md fixed-top" id="mainNav" style="background-color:black;">
    <div class="container">
      <a class="navbar-brand js-scroll" href="#page-top" style="color:maroon;">Wisata</a>
      <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarDefault" aria-controls="navbarDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span></span>
        <span></span>
        <span></span>
      </button>
      <div class="navbar-collapse collapse justify-content-end" id="navbarDefault">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link js-scroll active" href="index.php" style="color:maroon;">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll" href="#tampilan" style="color:maroon;">Hotel</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll" href="#service" style="color:maroon;">Services</a>
          </li>
          <li class="nav-item" >
            <a class="nav-link js-scroll" href="#work" style="color:maroon;">Gallery</a>
          </li>
         
        </ul>
      </div>
    </div>
  </nav>

  <!-- ======= Intro Section ======= -->
  <div id="home" class="intro route bg-image" style="background-image: url(assets/img/fotocandiborobudur.jpg); height:800px; width:100%;">
    <div class="overlay-itro"></div>
    <div class="intro-content display-table">
      <div class="table-cell">
        <div class="container">
          <!--<p class="display-6 color-d">Hello, world!</p>-->
          <h1 class="intro-title mb-4" style="color:maroon;">Hotel</h1>
          <p class="intro-subtitle" style="color:maroon;"><span class="text-slider-items" >Destinasi,Area,Hotel,Sewa Kendaraan,Restoran</span><strong class="text-slider"></strong></p>
          <!-- <p class="pt-3"><a class="btn btn-primary btn js-scroll px-4" href="#about" role="button">Learn More</a></p> -->
        </div>
      </div>
    </div>
  </div><!-- End Intro Section -->

  <main id="main">

    <!-- ======= tampilan Section ======= -->
    <section id="tampilan" class="about-mf sect-pt4 route" >
     <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <div class="title-box text-center">
              <h3 class="title-a">
                Hotel
              </h3>
              <p class="subtitle-a">
                Berbagai macam pilihan hotel
              </p>
              <div class="line-mf"></div>
            </div>
          </div>
        </div>
  <div class="row">
    <div class="col-sm-1"></div>

    <div class="col-sm-10" style="border: 1px solid maroon; border-radius: 5px; background-color: black; padding: 20px;" >
    
  <?php if(mysqli_num_rows($hotel) > 0){
    while($row2= mysqli_fetch_array($hotel)){ ?>
      <div class="media" style=" padding: 10px;">
        <div class="media-body">
          <h4 class="mt-0 mb-1" style="color: maroon; " ><?php echo $row2['hotelnama'] ?></h4>
          <h5><?php echo $row2['hotelalamat'] ?></h5>
          <p><?php echo "Harga: ".$row2['kategoriharga'] ?></p>
          <p><?php echo "Kamar: ".$row2['kamartersedia'].", ".$row2['hoteltelp']; ?></p>
          <p><?php echo "Area: ".$row2['areanama'] ?></p>
        </div>
        <img class="ml-3" style="width:300px; height:180px;" src="images/<?php echo $row2["fotofile"] ?>" alt="Gambar Tidak Ada">
      </div>
    <?php }} ?>
    </div>
    
</div>
<div class="col-sm-1"></div>
    </section><!-- End tampilan Section -->

    <!-- ======= Services Section ======= -->
    <section id="service" class="services-mf pt-5 route">
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <div class="title-box text-center">
              <h3 class="title-a">
                Services
              </h3>
              <p class="subtitle-a">
                Hotel, Restoran, dan Tempat Sewa Kendaraan
              </p>
              <div class="line-mf"></div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4"><a href="hotel.php">
            <div class="service-box">
              <div class="service-ico">
                <span class="ico-circle"><ion-icon name="bed"></ion-icon></span>
              </div>
              <div class="service-content">
                <h2 class="s-title">Hotel</h2>
                <p class="s-description text-center">
                  Pilihan hotel dekat area destinasi anda
                </p>
              </div>
            </div>
          </a>
          </div>
          <div class="col-md-4"><a href="restoran.php">
            <div class="service-box">
              <div class="service-ico">
                <span class="ico-circle"><ion-icon name="restaurant"></ion-icon></span>
              </div>
              <div class="service-content">
                <h2 class="s-title">Restoran</h2>
                <p class="s-description text-center">
                  Pilihan restoran dekat area destinasi anda
                </p>
              </div>
            </div>
            </a>
          </div>
          <div class="col-md-4"><a href="sewa.php">
            <div class="service-box">
              <div class="service-ico" >
                <span class="ico-circle"><ion-icon name="car"></ion-icon></span>
              </div>
              <div class="service-content">
                <h2 class="s-title">Sewa Kendaraan</h2>
                <p class="s-description text-center">
                  Pilihan tempat sewa kendaraan dekat area destinasi anda
                </p>
              </div>
            </div>
          </div>
          </a>
        </div>
      </div>
    </section><!-- End Services Section -->

    <!-- ======= Counter Section ======= -->
    <div class="section-counter paralax-mf bg-image" style="background-image: url(images/candiborobudur.jpg);">
      <div class="overlay-mf" style="background-color: black;"></div>
      <div class="container">
        <div class="row">
          <div class="col-sm-3 col-lg-3">
            <div class="counter-box counter-box pt-4 pt-md-0">
              <div class="counter-ico">
                <span class="ico-circle"><ion-icon name="location"></ion-icon></span>
              </div>
              <div class="counter-num">
                <p class="counter"><?php echo $jumlah1 ?></p>
                <span class="counter-text">DESTINASI WISATA</span>
              </div>
            </div>
          </div>
          <div class="col-sm-3 col-lg-3">
            <div class="counter-box pt-4 pt-md-0">
              <div class="counter-ico">
                <span class="ico-circle"><ion-icon name="bed"></ion-icon></span>
              </div>
              <div class="counter-num">
                <p class="counter"><?php echo $jumlah2?></p>
                <span class="counter-text">HOTEL</span>
              </div>
            </div>
          </div>
          <div class="col-sm-3 col-lg-3">
            <div class="counter-box pt-4 pt-md-0">
              <div class="counter-ico">
                <span class="ico-circle"><ion-icon name="restaurant"></ion-icon></span>
              </div>
              <div class="counter-num">
                <p class="counter"><?php echo $jumlah3 ?></p>
                <span class="counter-text">RESTORAN</span>
              </div>
            </div>
          </div>
          <div class="col-sm-3 col-lg-3">
            <div class="counter-box pt-4 pt-md-0">
              <div class="counter-ico">
                <span class="ico-circle"><ion-icon name="car"></ion-icon></span>
              </div>
              <div class="counter-num">
                <p class="counter"><?php echo $jumlah4 ?></p>
                <span class="counter-text">TEMPAT SEWA KENDARAAN</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div><!-- End Counter Section -->

    <!-- ======= gallery Section ======= -->
    <section id="work" class="portfolio-mf sect-pt4 route">
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <div class="title-box text-center">
              <h3 class="title-a">
                Gallery
              </h3>
              <p class="subtitle-a">
                Foto-foto destinasi, hotel, dan restoran
              </p>
              <div class="line-mf"></div>
            </div>
          </div>
        </div>  
        <div class="row">
        <?php while($row3=mysqli_fetch_array($foto)){?>
          <div class="col-sm-4">
            <figure class="figure">
              <img src="images/<?php echo $row3["fotofile"] ?>" class="figure-img img-fluid rounded" alt="Foto Tidak Ada" style="height: 250px; width: 400px;" >
              <figcaption class="figure-caption text-right"><?php echo $row3['fotonama']?></figcaption>
            </figure>
          </div>
          
        <?php  } ?>
        <?php while($row4=mysqli_fetch_array($foto1)){?>
          <div class="col-sm-4">
            <figure class="figure">
              <img src="images/<?php echo $row4["fotofile"] ?>" class="figure-img img-fluid rounded" alt="Foto Tidak Ada" style="height: 250px; width: 400px;" >
              <figcaption class="figure-caption text-right"><?php echo $row4['fotonama']?></figcaption>
            </figure>
          </div>
          
        <?php  } ?>
        <?php while($row5=mysqli_fetch_array($foto2)){?>
          <div class="col-sm-4">
            <figure class="figure">
              <img src="images/<?php echo $row5["fotofile"] ?>" class="figure-img img-fluid rounded" alt="Foto Tidak Ada" style="height: 250px; width: 400px;" >
              <figcaption class="figure-caption text-right"><?php echo $row5['fotonama']?></figcaption>
            </figure>
          </div>
          
        <?php  } ?>

        </div>
        </div>
          

        </div>
      </div>
    </section><!-- End gallery Section -->

    

    

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer style="background-color: black; color: maroon;">
    <div class="container" >
      <div class="row">
        <div class="col-sm-12">
          <div class="copyright-box">
            <p class="copyright">&copy; Copyright <strong></strong>. All Rights Reserved</p>
            <div class="credits">
              <!--
              All the links in the footer should remain intact.
              You can delete the links only if you purchased the pro version.
              Licensing information: https://bootstrapmade.com/license/
              Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/buy/?theme=DevFolio
            -->
              reDesigned by <a href="https://pesonajawa.com/" style="color:maroon;">Muhammad Raditya Vivaldy</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </footer><!-- End  Footer -->

  <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/jquery/jquery.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/jquery.easing/jquery.easing.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/waypoints/jquery.waypoints.min.js"></script>
  <script src="assets/vendor/counterup/jquery.counterup.min.js"></script>
  <script src="assets/vendor/owl.carousel/owl.carousel.min.js"></script>
  <script src="assets/vendor/typed.js/typed.min.js"></script>
  <script src="assets/vendor/venobox/venobox.min.js"></script>
  <script src="https://unpkg.com/ionicons@5.2.3/dist/ionicons.js"></script>

  <script src="assets/js/main.js"></script>

</body>

</html>