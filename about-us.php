<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>About Us | Event Studio</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style.css" />


  </head>
  <body >
    <!-- HEADER -->
    <header class="head">
  <a href="index.php" class="logo">
    <img src="projectimages/logo.png" alt="EventStudioLogo" class="logo-img" />
    EVENT STUDIO
  </a>

  <nav class="navbar">
        <a href="index.php#home">Home</a>
        <a href="about-us.php">about</a>
        <a href="services.php">services</a>
        <a href="packages.php">price</a>
        <a href="gallery.php">gallery</a>
        <a href="contact-us.php">contact</a>
<?php if (isset($_SESSION['user_id'])): ?>
  <span class="signup-btn">
    👤 <?php echo htmlspecialchars($_SESSION['user_name']); ?>
  </span>
  <a href="backend/logout.php" class="signup-btn">LOGOUT</a>
<?php else: ?>
  <a href="signup.php" class="signup-btn">SIGN UP</a>
<?php endif; ?>

      </nav>
  <div id="menu" class="fas fa-bars"></div>
</header>

    <!-- HERO -->
    <section class="heroo">
      <h1>We Create Unforgettable Events</h1>
      <p>From dreamy weddings to elegant celebrations</p>
    </section>

    <!-- WHO WE ARE -->
    <section class="contentt">
      <div class="text">
        <h2>Who We Are</h2>
        <p>
          Event Studio is a professional event decoration and styling company
          creating elegant and memorable celebrations. We transform venues with
          creative designs, premium décor, and customized themes for weddings,
          receptions, Haldi–Mehendi, birthdays, corporate events, and private
          parties. From stunning entrance gates and stages to stylish photo
          booths and full venue makeovers, we handle every detail with
          creativity and care. At Event Studio, we make every event
          unique,stress-free, and unforgettable.
        </p>
      </div>
      <div class="image">
        <img src="projectimages/entrancegate2.jpg" alt="Wedding Decor" />
      </div>
    </section>

    <!-- OUR WORK -->
    <!-- <section class="gallery-section">
      <h2>Our Work</h2>
      <p>A glimpse of our creative setups</p>

      <div class="gallery">
        <div class="card">
          <img src="projectimages/entrancegate4.jpg" alt="Entrance Gate" />
          <span>Entrance Gate</span>
        </div>

        <div class="card">
          <img src="projectimages/photobooth1.jpg" alt="Photo Booth" />
          <span>Photo Booth</span>
        </div>

        <div class="card">
          <img src="projectimages/stagee.jpg" alt="Stage Decor" />
          <span>Stage Decor</span>
        </div>

        <div class="card">
          <img src="projectimages/haldi.jpg" alt="Haldi " />
          <span>Haldi</span>
        </div>

        <div class="card">
          <img src="projectimages/mehendi.jpg" alt="Mehendi" />
          <span>Mehendi</span>
        </div>

        <div class="card">
          <img src="projectimages/birthday.jpg" alt="birthdays" />
          <span>birthdays</span>
        </div>

        <div class="card">
          <img src="projectimages/bridetobe.jpg" alt="bridetobe" />
          <span>bridetobe</span>
        </div>

        <div class="card">
          <img src="projectimages/car.jpg" alt="car" />
          <span>car</span>
        </div>
        <div class="card">
          <img src="projectimages/cake2.jpg" alt="cake" />
          <span>cake</span>
        </div>
        <div class="card">
          <img src="projectimages/outsidedecor.jpg" alt="mandap" />
          <span>mandap</span>
        </div>
        <div class="card">
          <img src="projectimages/corporateevent.jpg" alt="corporateevent" />
          <span>corporateevent</span>
        </div>
        <div class="card">
          <img src="projectimages/dinningarea.jpg" alt="dinningarea" />
          <span>dinningarea</span>
        </div>
        <div class="card">
          <img src="projectimages/outsidedecor1.jpg" alt="outsidedecor" />
          <span>outsidedecor</span>
        </div>
        <div class="card">
          <img src="projectimages/babyshower.jpg" alt="babyshower" />
          <span>babyshower</span>
        </div>
        <div class="card">
          <img src="projectimages/barmala1.jpg" alt="varmala" />
          <span>varmala</span>
        </div>
        <div class="card">
          <img src="projectimages/aniversary.jpg" alt="aniversary" />
          <span>aniversary</span>
        </div>
        <div class="card">
          <img src="projectimages/marryme2.jpg" alt="proposaldecor" />
          <span>proposaldecor</span>
        </div>
        <div class="card">
          <img src="projectimages/bouquet.jpg" alt="bouquet" />
          <span>bouquet</span>
        </div>
        <div class="card">
          <img src="projectimages/homedecor.jpg" alt="homedecor" />
          <span>homedecor</span>
        </div>
        <div class="card">
          <img src="projectimages/photobooth.jpg" alt="welcomeboard" />
          <span>welcomeboard</span>
        </div>
        <div class="card">
          <img src="projectimages/weddingcard.jpg" alt="weddingcard" />
          <span>weddingcard</span>
        </div>
        <div class="card">
          <img src="projectimages/firework.jpg" alt="firework" />
          <span>firework</span>
        </div>
        <div class="card">
          <img src="projectimages/annaprashan.jpg" alt="annaprashan" />
          <span>Annaprashan</span>
        </div>
        <div class="card">
          <img src="projectimages/lateparty.jpg" alt="concert" />
          <span>concert</span>
        </div>
      </div>
    </section>
 -->
<?php 
require "connect.php"; 
$work = mysqli_query($conn, "SELECT * FROM our_work ORDER BY id DESC");
?>

<section class="gallery-sectionn">
  <h2>Our Work</h2>
  <p>A glimpse of our creative setups</p>

  <div class="galleryy">
    <?php while($row = mysqli_fetch_assoc($work)): ?>
      <div class="card">
        <img src="projectimages/<?= $row['image']; ?>" alt="">
        <span><?= htmlspecialchars($row['label']); ?></span>
      </div>
    <?php endwhile; ?>
  </div>
</section>

    <!---------------------------------- Footer Section ------------------------------>
    <footer class="footer">
      <div class="footer-grid">
        <div class="footer-col footer-brand-info" data-aos="fade-up">
          <a href="#" class="logo">
            <img
              src="projectimages/logo.png"
              alt="EventStudioLogo"
              class="logo-img"
            />EVENT STUDIO
          </a>
          <p class="brand-tagline">Wedding / Planner / Pokhara</p>
          <p class="brand-mission">
            Creating magical event moments in Pokhara since 2025. Your dream
            event is our mission.
          </p>
        </div>

        <div
          class="footer-col footer-services"
          data-aos="fade-up"
          data-aos-delay="100"
        >
          <h3>Services</h3>
          <ul>
            <li><a href="services.php#services">Wedding Decoration</a></li>
            <li><a href="services.php#services">Photography & Videography</a></li>
            <li><a href="services.php#services">Sound System</a></li>
            <li><a href="services.php#services">Event Planning</a></li>
            <li><a href="services.php#services">Destination Events</a></li>
            <li><a href="services.php#services">Entertainment</a></li>
          </ul>
        </div>

        <div
          class="footer-col footer-quick-links"
          data-aos="fade-up"
          data-aos-delay="200"
        >
          <h3>Quick Links</h3>
          <ul>
            <li><a href="#home">Home</a></li>
            <li><a href="about-us.php">About Us</a></li>
            <li><a href="services.php">services</a></li>
            <li><a href="packages.php">Prices</a></li>
            <li><a href="#gallery">Gallery</a></li>
            <li><a href="contact-us.php">Contact</a></li>
          </ul>
        </div>

        <div
          class="footer-col footer-contact-info"
          data-aos="fade-up"
          data-aos-delay="300"
        >
          <h3>Contact Info</h3>
          <p><i class="fas fa-map-marker-alt"></i>Pokhara, Nepal</p>
          <p><i class="fas fa-phone"></i> <a href="tel:+9779842222222">+977 9842222222</a></p>
          <p><i class="fas fa-envelope"></i> <a href="https://mail.google.com/mail/?view=cm&fs=1&to=info@eventstudio.com" target="_blank">
    info@eventstudio.com
  </a></p>
        </div>
      </div>

      <div class="footer-credit">
        <p>&copy; 2025 Event Studio. All rights reserved. Made in Nepal.</p>
      </div>
    </footer>
    <script>
    // Toggle Mobile Menu
    const menu = document.getElementById('menu');
    const navbar = document.querySelector('.head .navbar');

    menu.addEventListener('click', () => {
      navbar.classList.toggle('active');
    });
  </script>
  </body>
</html>
