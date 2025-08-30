<?php $this->load->view('data/typehtml') ?>
<html lang="<?php $this->load->view('data/lang') ?>">
<head>
  <meta charset="utf-8">
  <title><?= $idempresa->nombre ?></title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <link rel="shortcut icon" href="<?= base_url() ?>static/img/icono_1.png">
  <meta content="" name="keywords">
  <meta content="" name="description">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Montserrat:300,400,500,700" rel="stylesheet">

  <!-- Bootstrap CSS File -->
  <link href="<?= base_url() ?>static/cssinicio/lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Libraries CSS Files -->
  <link href="<?= base_url() ?>static/cssinicio/lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="<?= base_url() ?>static/cssinicio/lib/animate/animate.min.css" rel="stylesheet">
  <link href="<?= base_url() ?>static/cssinicio/lib/ionicons/css/ionicons.min.css" rel="stylesheet">
  <link href="<?= base_url() ?>static/cssinicio/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="<?= base_url() ?>static/cssinicio/lib/lightbox/css/lightbox.min.css" rel="stylesheet">

  <!-- Main Stylesheet File -->
  <link href="<?= base_url() ?>static/cssinicio/css/style.css" rel="stylesheet">

  <!-- =======================================================
    Theme Name: NewBiz
    Theme URL: https://bootstrapmade.com/newbiz-bootstrap-business-template/
    Author: BootstrapMade.com
    License: https://bootstrapmade.com/license/
  ======================================================= -->
  <style>
  #clients{
	  background-color:rgb(0, 74, 153);
  }
  #clients > div:nth-child(1) > div:nth-child(1) > p:nth-child(2),#clients > div:nth-child(1) > div:nth-child(1) > h3:nth-child(1){
	  color:white;
  }
  </style>
</head>

<body>

  <!--==========================
  Header
  ============================-->
  <header id="header" class="fixed-top">
    <div class="container">

      <div class="logo float-left">
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <h1 class="text-light"><a href="#header"><span>NewBiz</span></a></h1> -->
        <a style="color:black" href="#intro" class="scrollto">
		<img src="<?= base_url() ?>static/img/icono_1.png" alt="" class="img-fluid">
		</a>
      </div>

      <nav class="main-nav float-right d-none d-lg-block">
        <ul>
          <li class="active"><a href="#intro">Inicio</a></li>
          <li><a href="#about">Acerca de</a></li>
          <li><a href="#contact">Contáctanos</a></li>
		  <li><a href="<?= base_url() ?>login">Ingresar al Sistema</a></li>
        </ul>
      </nav><!-- .main-nav -->
      
    </div>
  </header><!-- #header -->

  <!--==========================
    Intro Section
  ============================-->
  <section id="intro" class="clearfix">
    <div class="container">

      <div class="intro-img">
        <img src="<?= base_url() ?>static/cssinicio/img8.png" alt="" class="img-fluid">
      </div>

      <div class="intro-info">
        <h2>"Don Lucho"<br><span>Establecimiento</span></h2>
        <div>
          <a href="<?= base_url() ?>login" class="btn-get-started scrollto">Ingresar al sistema</a>
          <a href="#contact" class="btn-services scrollto">Contáctanos</a>
        </div>
      </div>

    </div>
  </section><!-- #intro -->

  <main id="main">

    <!--==========================
      About Us Section
    ============================-->
    <section id="about">
      <div class="container">

        <header class="section-header">
          <h3>About Us</h3>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
        </header>

        <div class="row about-container">

          <div class="col-lg-6 content order-lg-1 order-2">
            <p>
              Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
            </p>

            <div class="icon-box wow fadeInUp">
              <div class="icon"><i class="fa fa-shopping-bag"></i></div>
              <h4 class="title"><a href="">Eiusmod Tempor</a></h4>
              <p class="description">Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi</p>
            </div>

            <div class="icon-box wow fadeInUp" data-wow-delay="0.2s">
              <div class="icon"><i class="fa fa-photo"></i></div>
              <h4 class="title"><a href="">Magni Dolores</a></h4>
              <p class="description">Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>
            </div>

            <div class="icon-box wow fadeInUp" data-wow-delay="0.4s">
              <div class="icon"><i class="fa fa-bar-chart"></i></div>
              <h4 class="title"><a href="">Dolor Sitema</a></h4>
              <p class="description">Minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat tarad limino ata</p>
            </div>

          </div>

          <div class="col-lg-6 background order-lg-2 order-1 wow fadeInUp">
            <img src="<?= base_url() ?>static/cssinicio/img20.png" class="img-fluid" alt="">
          </div>
        </div>

        <div class="row about-extra">
          <div class="col-lg-6 wow fadeInUp">
            <img src="<?= base_url() ?>static/cssinicio/img9.png" class="img-fluid" alt="">
          </div>
          <div class="col-lg-6 wow fadeInUp pt-5 pt-lg-0">
            <h4>Voluptatem dignissimos provident quasi corporis voluptates sit assumenda.</h4>
            <p>
              Ipsum in aspernatur ut possimus sint. Quia omnis est occaecati possimus ea. Quas molestiae perspiciatis occaecati qui rerum. Deleniti quod porro sed quisquam saepe. Numquam mollitia recusandae non ad at et a.
            </p>
            <p>
              Ad vitae recusandae odit possimus. Quaerat cum ipsum corrupti. Odit qui asperiores ea corporis deserunt veritatis quidem expedita perferendis. Qui rerum eligendi ex doloribus quia sit. Porro rerum eum eum.
            </p>
          </div>
        </div>

        <div class="row about-extra">
          <div class="col-lg-6 wow fadeInUp order-1 order-lg-2">
            <img src="<?= base_url() ?>static/cssinicio/img10.png" class="img-fluid" alt="">
          </div>

          <div class="col-lg-6 wow fadeInUp pt-4 pt-lg-0 order-2 order-lg-1">
            <h4>Neque saepe temporibus repellat ea ipsum et. Id vel et quia tempora facere reprehenderit.</h4>
            <p>
             Delectus alias ut incidunt delectus nam placeat in consequatur. Sed cupiditate quia ea quis. Voluptas nemo qui aut distinctio. Cumque fugit earum est quam officiis numquam. Ducimus corporis autem at blanditiis beatae incidunt sunt. 
            </p>
            <p>
              Voluptas saepe natus quidem blanditiis. Non sunt impedit voluptas mollitia beatae. Qui esse molestias. Laudantium libero nisi vitae debitis. Dolorem cupiditate est perferendis iusto.
            </p>
            <p>
              Eum quia in. Magni quas ipsum a. Quis ex voluptatem inventore sint quia modi. Numquam est aut fuga mollitia exercitationem nam accusantium provident quia.
            </p>
          </div>
          
        </div>

      </div>
    </section><!-- #about -->

    <!--==========================
      Services Section
    ============================-->
    

    <!--==========================
      Why Us Section
    ============================-->
    

    <!--==========================
      Portfolio Section
    ============================-->
    

    <!--==========================
      Clients Section
    ============================-->
    

    <!--==========================
      Team Section
    ============================-->
    

    <!--==========================
      Clients Section
    ============================-->
    <section id="clients" class="section-bg">

      <div class="container">

        <div class="section-header">
          <h3>Our CLients</h3>
          <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque dere santome nida.</p>
        </div>

        <div class="row no-gutters clients-wrap clearfix wow fadeInUp">

          <div class="col-lg-3 col-md-4 col-xs-6">
            <div class="client-logo">
              <img src="<?= base_url() ?>static/cssinicio/img/clients/client-1.png" class="img-fluid" alt="">
            </div>
          </div>
          
          <div class="col-lg-3 col-md-4 col-xs-6">
            <div class="client-logo">
              <img src="<?= base_url() ?>static/cssinicio/img/clients/client-2.png" class="img-fluid" alt="">
            </div>
          </div>
        
          <div class="col-lg-3 col-md-4 col-xs-6">
            <div class="client-logo">
              <img src="<?= base_url() ?>static/cssinicio/img/clients/client-3.png" class="img-fluid" alt="">
            </div>
          </div>
          
          <div class="col-lg-3 col-md-4 col-xs-6">
            <div class="client-logo">
              <img src="<?= base_url() ?>static/cssinicio/img/clients/client-4.png" class="img-fluid" alt="">
            </div>
          </div>
          
          <div class="col-lg-3 col-md-4 col-xs-6">
            <div class="client-logo">
              <img src="<?= base_url() ?>static/cssinicio/img/clients/client-5.png" class="img-fluid" alt="">
            </div>
          </div>
        
          <div class="col-lg-3 col-md-4 col-xs-6">
            <div class="client-logo">
              <img src="<?= base_url() ?>static/cssinicio/img/clients/client-6.png" class="img-fluid" alt="">
            </div>
          </div>
          
          <div class="col-lg-3 col-md-4 col-xs-6">
            <div class="client-logo">
              <img src="<?= base_url() ?>static/cssinicio/img/clients/client-7.png" class="img-fluid" alt="">
            </div>
          </div>
          
          <div class="col-lg-3 col-md-4 col-xs-6">
            <div class="client-logo">
              <img src="<?= base_url() ?>static/cssinicio/img/clients/client-8.png" class="img-fluid" alt="">
            </div>
          </div>

        </div>

      </div>

    </section>

    <!--==========================
      Contact Section
    ============================-->
    <section id="contact">
      <div class="container-fluid">

        <div class="section-header">
          <h3>Contact Us</h3>
        </div>

        <div class="row wow fadeInUp">

          <div class="col-lg-8">
            <div class="map mb-8 mb-lg-0">
			<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d9482.131922034003!2d-79.64596332799542!3d-2.2488818629029224!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xa9a2fabcd5c97a63!2sIglesia%20Virgen%20de%20fatima!5e0!3m2!1ses-419!2sec!4v1575230375222!5m2!1ses-419!2sec" width="800" height="450" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
            </div>
          </div>

          <div class="col-lg-4">
            <div class="row">
              <div class="col-md-12 info">
                <i class="ion-ios-location-outline"></i>
                <p>A108 Adam Street, NY 535022</p>
              </div>
              <div class="col-md-12 info">
                <i class="ion-ios-email-outline"></i>
                <p>info@example.com</p>
              </div>
              <div class="col-md-12 info">
                <i class="ion-ios-telephone-outline"></i>
                <p>+1 5589 55488 55</p>
              </div>
            </div>

            <!--
			<div class="form">
              <div id="sendmessage">Your message has been sent. Thank you!</div>
              <div id="errormessage"></div>
              <form action="" method="post" role="form" class="contactForm">
                <div class="form-row">
                  <div class="form-group col-lg-6">
                    <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
                    <div class="validation"></div>
                  </div>
                  <div class="form-group col-lg-6">
                    <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" data-rule="email" data-msg="Please enter a valid email" />
                    <div class="validation"></div>
                  </div>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject" />
                  <div class="validation"></div>
                </div>
                <div class="form-group">
                  <textarea class="form-control" name="message" rows="5" data-rule="required" data-msg="Please write something for us" placeholder="Message"></textarea>
                  <div class="validation"></div>
                </div>
                <div class="text-center"><button type="submit" title="Send Message">Send Message</button></div>
              </form>
            </div>
			-->
          </div>

        </div>

      </div>
    </section><!-- #contact -->

  </main>

  <!--==========================
    Footer
  ============================-->
  <footer id="footer">
    <div class="footer-top">
      <div class="container">
        <div class="row">
          <div class="col-lg-2 col-md-6 footer-links">
            <h4>Useful Links</h4>
            <ul>
              <li><a href="#">Home</a></li>
              <li><a href="#">About us</a></li>
              <li><a href="#">Terms of service</a></li>
              <li><a href="#">Privacy policy</a></li>
            </ul>
          </div>

          <div class="col-lg-5 col-md-6 footer-contact">
            <h4>Contact Us</h4>
            <p>
              A108 Adam Street <br>
              New York, NY 535022<br>
              United States <br>
              <strong>Phone:</strong> +1 5589 55488 55<br>
              <strong>Email:</strong> info@example.com<br>
            </p>

            

          </div>

          <div class="col-lg-5 col-md-6 footer-newsletter">
            <h4>Our Newsletter</h4>
            <p>Tamen quem nulla quae legam multos aute sint culpa legam noster magna veniam enim veniam illum dolore legam minim quorum culpa amet magna export quem marada parida nodela caramase seza.</p>
            <div class="social-links">
              <a href="#" class="twitter"><i class="fa fa-twitter"></i></a>
              <a href="#" class="facebook"><i class="fa fa-facebook"></i></a>
              <a href="#" class="instagram"><i class="fa fa-instagram"></i></a>
              <a href="#" class="google-plus"><i class="fa fa-google-plus"></i></a>
              <a href="#" class="linkedin"><i class="fa fa-linkedin"></i></a>
            </div>
          </div>

        </div>
      </div>
    </div>

    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong>2019</strong>. All Rights Reserved
      </div>
      <div class="credits">
        <!--
          All the links in the footer should remain intact.
          You can delete the links only if you purchased the pro version.
          Licensing information: https://bootstrapmade.com/license/
          Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/buy/?theme=NewBiz
        -->
        Diseñado por <a href="#"><?= $idempresa->nombre ?></a>
      </div>
    </div>
  </footer><!-- #footer -->

  <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
  <!-- Uncomment below i you want to use a preloader -->
  <!-- <div id="preloader"></div> -->

  <!-- JavaScript Libraries -->
  <script src="<?= base_url() ?>static/cssinicio/lib/jquery/jquery.min.js"></script>
  <script src="<?= base_url() ?>static/cssinicio/lib/jquery/jquery-migrate.min.js"></script>
  <script src="<?= base_url() ?>static/cssinicio/lib/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?= base_url() ?>static/cssinicio/lib/easing/easing.min.js"></script>
  <script src="<?= base_url() ?>static/cssinicio/lib/mobile-nav/mobile-nav.js"></script>
  <script src="<?= base_url() ?>static/cssinicio/lib/wow/wow.min.js"></script>
  <script src="<?= base_url() ?>static/cssinicio/lib/waypoints/waypoints.min.js"></script>
  <script src="<?= base_url() ?>static/cssinicio/lib/counterup/counterup.min.js"></script>
  <script src="<?= base_url() ?>static/cssinicio/lib/owlcarousel/owl.carousel.min.js"></script>
  <script src="<?= base_url() ?>static/cssinicio/lib/isotope/isotope.pkgd.min.js"></script>
  <script src="<?= base_url() ?>static/cssinicio/lib/lightbox/js/lightbox.min.js"></script>
  <!-- Contact Form JavaScript File -->
  <script src="<?= base_url() ?>static/cssinicio/contactform/contactform.js"></script>

  <!-- Template Main Javascript File -->
  <script src="<?= base_url() ?>static/cssinicio/js/main.js"></script>

</body>
</html>
