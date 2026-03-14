<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style.css" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
    />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css"
    />
    
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <title>Event Planning Website</title>
  </head>
  <body>
    <header class="head">
      <a href="#" class="logo">
        <img
          src="projectimages/logo.png"
          alt="EventStudioLogo"
          class="logo-img"
        />EVENT STUDIO</a
      >
      <nav class="navbar">
        <a href="#home">Home</a>
        <a href="about-us.php">about</a>
        <a href="services.php">services</a>
        <a href="packages.php">price</a>
        <a href="gallery.php">gallery</a>
        <a href="contact-us.php">contact</a>
<?php if (isset($_SESSION['user_id'])): ?>
  <span class="signup-btn">
    👤 <?= htmlspecialchars($_SESSION['user_name']); ?>
  </span>
  <a href="/EVENTSTUDIO/logout.php" class="signup-btn">LOGOUT</a>
<?php else: ?>
  <a href="/EVENTSTUDIO/signup.php" class="signup-btn">SIGN UP</a>
<?php endif; ?>



      </nav>

      <div id="menu"><i class="fa-solid fa-bars staggered"></i></div>
    </header>
<!-------------------------------------- Home -------------------------------------->
    <section class="home" id="home">
      <div class="content">
        <p>where EVENTS meet STYLE</p>
        <h3>LET'S ORGANIZE EVENTS WITH US<span class="heart">❤</span></h3>
        <a href="contact-us.php" class="btn">CONTACT US</a>
      </div>
    </section>
<!----------------------------------- About Section ------------------------------------->
    <section class="about-section" id="about">
      <h3 class="section-title">ABOUT US</h3>
      <div class="about-container">
        <div class="about-image" data-aos="fade-right">
          <img src="projectimages/back88.jpg" alt="A lovely wedding moment" />
        </div>

        <div class="about-content" data-aos="fade-left">
          <h4 class="know-us-heading">KNOW US</h4>

          <p>
            EVENT STUDIO IS A PREMIER EVENT PLANNING AND COORDINATION COMPANY IN
            NEPAL DEDICATED TO TURNING EVERY OCCASION INTO A REMARKABLE
            EXPERIENCE. WE SPECIALIZE IN CREATING UNFORGETTABLE CORPORATE AND
            SOCIAL EVENTS... FROM PRODUCT LAUNCHES, DEALER AND CUSTOMER MEETS,
            AND PRESS CONFERENCES TO HIGH-END SEMINARS AND PRIVATE CELEBRATIONS.
          </p>

          <a href="about-us.php" class="btn">Explore</a>
        </div>
      </div>
    </section> 

    <!---------------------------------- Services Section------------------------------>
    <!-- <section id="services" class="services">
      <div class="container">
        <div class="section-header" data-aos="fade-down">
          <h2><span>OUR</span> SERVICES</h2>
          <p>
            We offer comprehensive event management solutions to make your
            special occasions memorable and stress-free
          </p>
        </div>
        <div class="services-grid">
          <div class="service-card" data-aos="zoom-in">
            <div class="service-icon">
              <i class="fas fa-ring"></i>
            </div>
            <h3>Wedding Planning</h3>
            <p>
              Complete wedding planning services from venue selection to day-of
              coordination. We handle every detail to make your special day
              perfect.
            </p>
          </div>
          <div class="service-card" data-aos="zoom-in" data-aos-delay="100">
            <div class="service-icon">
              <i class="fas fa-briefcase"></i>
            </div>
            <h3>Corporate Events</h3>
            <p>
              Professional corporate event management including conferences,
              seminars, product launches, and team building activities.
            </p>
          </div>
          <div class="service-card" data-aos="zoom-in" data-aos-delay="200">
            <div class="service-icon">
              <i class="fas fa-birthday-cake"></i>
            </div>
            <h3>Private Parties</h3>
            <p>
              Birthday parties, anniversaries, and private celebrations planned
              to perfection with attention to every personal detail.
            </p>
          </div>
          <div class="service-card" data-aos="zoom-in" data-aos-delay="300">
            <div class="service-icon">
              <i class="fas fa-music"></i>
            </div>
            <h3>Entertainment Events</h3>
            <p>
              Concerts, festivals, and entertainment events with full production
              management and technical coordination.
            </p>
          </div>
          <div class="service-card" data-aos="zoom-in" data-aos-delay="400">
            <div class="service-icon">
              <i class="fas fa-utensils"></i>
            </div>
            <h3>Catering Services</h3>
            <p>
              Premium catering solutions with diverse menu options, dietary
              accommodations, and professional service staff.
            </p>
          </div>
          <div class="service-card" data-aos="zoom-in" data-aos-delay="500">
            <div class="service-icon">
              <i class="fas fa-camera"></i>
            </div>
            <h3>Event Photography</h3>
            <p>
              Professional photography and videography services to capture all
              the precious moments of your special event.
            </p>
          </div>
        </div>
      </div>
    </section> -->
    <section id="services" class="services">
  <div class="container">
    <div class="section-header" data-aos="fade-down">
      <h2><span>OUR</span> SERVICES</h2>
      <p>We offer comprehensive event management solutions to make your special occasions memorable and stress-free</p>
    </div>

    <div class="services-grid">
      <?php
      require_once "connect.php";
      $services = mysqli_query($conn, "SELECT * FROM services ORDER BY id ASC");
      $delay = 0;
      while($service = mysqli_fetch_assoc($services)):
          $delay += 100;
      ?>
      <div class="service-card" data-aos="zoom-in" data-aos-delay="<?= $delay ?>">
        <div class="service-icon">
          <i class="<?= htmlspecialchars($service['icon_class']) ?>"></i>
        </div>
        <h3><?= htmlspecialchars($service['title']) ?></h3>
        <p><?= htmlspecialchars($service['description']) ?></p>
      </div>
      <?php endwhile; ?>
    </div>
  </div>
</section>

<!--------------------------------------- Pricing Section -------------------------->
    <!-- <section class="price" id="price">
      <div class="packagess" data-aos="fade-down">
        <h1 class="heading"><span>Choose</span>&nbsp;Plan</h1>
        <p>
          We offer four flexible event packages designed to fit a range of needs
          and budgets. From essential coverage to all-inclusive premium
          services, select the plan that brings your dream event to life without
          compromise.
        </p>
      </div>
      <div class="price-container">
        <div class="price-box" data-aos="zoom-in-up" data-aos-delay="100">
          <h3 class="package">Package 01</h3>
          <h3 class="amount">Rs 5000</h3>
          <p><i class="fa-solid fa-square-check"></i>4 hrs coverage</p>
          <p><i class="fa-solid fa-square-check"></i>basic decoration</p>
          <p>
            <i class="fa-solid fa-square-check"></i>Professional photography
          </p>
          <p><i class="fa-solid fa-square-check"></i>Edited Digital Image</p>
          <p><i class="fa-solid fa-square-check"></i>Light snacks & drinks</p>
          <a href="booking.php" class="btn">Choose Plan</a>
        </div>
        <div class="price-box" data-aos="zoom-in-up" data-aos-delay="200">
          <h3 class="package">Package 02</h3>
          <h3 class="amount">Rs 7500</h3>
          <p><i class="fa-solid fa-square-check"></i>6 Hrs Coverage</p>
          <p><i class="fa-solid fa-square-check"></i>standard decoration</p>
          <p>
            <i class="fa-solid fa-square-check"></i>Photography + short video
          </p>
          <p><i class="fa-solid fa-square-check"></i>Edited Digital Image</p>
          <p>
            <i class="fa-solid fa-square-check"></i>Complimentary event
            consultation
          </p>
          <p>
            <i class="fa-solid fa-square-check"></i>Buffet service(basic menu)
          </p>

          <a href="booking.php" class="btn">Choose Plan</a>
        </div>
        <div class="price-box" data-aos="zoom-in-up" data-aos-delay="300">
          <h3 class="package">Package 03</h3>
          <h3 class="amount">Rs 10000</h3>
          <p><i class="fa-solid fa-square-check"></i>8 Hrs Coverage</p>
          <p>
            <i class="fa-solid fa-square-check"></i>Royal theme decoration with
            lighting setup
          </p>
          <p>
            <i class="fa-solid fa-square-check"></i>Photography & fullHD video
          </p>
          <p>
            <i class="fa-solid fa-square-check"></i>Custom luxury 8 X 8 Album
          </p>
          <p><i class="fa-solid fa-square-check"></i>Edited Digital Image</p>
          <p>
            <i class="fa-solid fa-square-check"></i>Free drone shot(if outdoor)
          </p>
          <p>
            <i class="fa-solid fa-square-check"></i>Buffet service(premium menu)
          </p>

          <a href="booking.php" class="btn">Choose Plan</a>
        </div>
        <div class="price-box" data-aos="zoom-in-up" data-aos-delay="400">
          <h3 class="package">Package 04</h3>
          <h3 class="amount">Rs 12500</h3>
          <p><i class="fa-solid fa-square-check"></i>10 Hrs Coverage</p>
          <p>
            <i class="fa-solid fa-square-check"></i>Luxury decoration with
            flowers, stage, & lighting
          </p>
          <p>
            <i class="fa-solid fa-square-check"></i>Photography & cinematic
            video shoot
          </p>
          <p><i class="fa-solid fa-square-check"></i>Canvas Print</p>
          <p><i class="fa-solid fa-square-check"></i>Custom 8 X 8 Album</p>
          <p>
            <i class="fa-solid fa-square-check"></i>Highlight film for
            socialmedia
          </p>
          <p><i class="fa solid fa-square-check"></i>2 parent albums</p>
          <p><i class="fa-solid fa-square-check"></i>VIP team service</p>
          <p>
            <i class="fa-solid fa-square-check"></i>Full-course buffet(custom
            menu)
          </p>
          <a href="booking.php" class="btn">Choose Plan</a>
        </div>
      </div>
    </section> -->
    <section class="price" id="price">
  <div class="packagess" data-aos="fade-down">
    <h1 class="heading"><span>Choose</span>&nbsp;Plan</h1>
    <p>
      We offer flexible event packages designed to fit a range of needs and budgets.
    </p>
  </div>

  <div class="price-container">
    <?php
    require_once "connect.php";
    $packages = mysqli_query($conn, "SELECT * FROM packages ORDER BY id ASC");
    $delay = 0;
    while($package = mysqli_fetch_assoc($packages)):
        $delay += 100;
        $features = explode("\n", $package['features']);
    ?>
    <div class="price-box" data-aos="zoom-in-up" data-aos-delay="<?= $delay ?>">
      <h3 class="package"><?= htmlspecialchars($package['name']) ?></h3>
      <h3 class="amount"><?= htmlspecialchars($package['price']) ?></h3>
      <?php foreach($features as $feature): ?>
        <p><i class="fa-solid fa-square-check"></i> <?= htmlspecialchars($feature) ?></p>
      <?php endforeach; ?>
      <a href="booking.php" class="btn">Choose Plan</a>
    </div>
    <?php endwhile; ?>
  </div>
</section>

    <!---------------------------- Gallery Section ----------------------------->
    <section class="gallery" id="gallery">
      <h1 class="heading" data-aos="fade-down"><span>our</span> gallery</h1>

      <div class="swiper gallery-slider">
        <div class="swiper-wrapper">
          <div class="swiper-slide" data-aos="zoom-in">
            <img src="projectimages/service.jpg" alt="" />
          </div>
          <div class="swiper-slide" data-aos="zoom-in" data-aos-delay="400">
            <img src="projectimages/ring.jpg" alt="" />
          </div>
          <div class="swiper-slide" data-aos="zoom-in" data-aos-delay="150">
            <img src="projectimages/service33.jpg" alt="" />
          </div>
          <div class="swiper-slide" data-aos="zoom-in" data-aos-delay="650">
            <img src="projectimages/service111.jpg" alt="" />
          </div>
          <div class="swiper-slide" data-aos="zoom-in" data-aos-delay="500">
            <img src="projectimages/service8.jpg" alt="" />
          </div>
          <div class="swiper-slide" data-aos="zoom-in" data-aos-delay="600">
            <img src="projectimages/up.jpg" alt="" />
          </div>
          <div class="swiper-slide" data-aos="zoom-in" data-aos-delay="650">
            <img src="projectimages/service10.jpg" alt="" />
          </div>
          <div class="swiper-slide" data-aos="zoom-in" data-aos-delay="400">
            <img src="projectimages/entrancegate1.jpg" alt="" />
          </div>
          <div class="swiper-slide" data-aos="zoom-in" data-aos-delay="100">
            <img src="projectimages/service2.jpg" alt="" />
          </div>
          <div class="swiper-slide" data-aos="zoom-in" data-aos-delay="200">
            <img src="projectimages/service44.jpg" alt="" />
          </div>
          <div class="swiper-slide" data-aos="zoom-in" data-aos-delay="250">
            <img src="projectimages/service5.jpg" alt="" />
          </div>
          <div class="swiper-slide" data-aos="zoom-in" data-aos-delay="400">
            <img src="projectimages/service7.jpg" alt="" />
          </div>
          <div class="swiper-slide" data-aos="zoom-in" data-aos-delay="400">
            <img src="projectimages/hand2.jpg" alt="" />
          </div>
          <div class="swiper-slide" data-aos="zoom-in" data-aos-delay="50">
            <img src="projectimages/service11.jpg" alt="" />
          </div>
          <div class="swiper-slide" data-aos="zoom-in" data-aos-delay="400">
            <img
              src="projectimages/fe3b130be110a0ff28a3d799c38e02f2.jpg"
              alt=""
            />
          </div>
          <div class="swiper-slide" data-aos="zoom-in" data-aos-delay="400">
            <img src="projectimages/gmehendi.jpg" alt="" />
          </div>
          <div class="swiper-slide" data-aos="zoom-in" data-aos-delay="650">
            <img src="projectimages/service333.jpg" alt="" />
          </div>
        </div>
      </div>
    </section>


    <!---------------------------------- Contact Section ------------------------------>
    <section class="contact" id="contact">
      <h1 class="heading" data-aos="fade-down"><span>Contact</span> Us</h1>

      <div class="contact-container">
        <div class="contact-info" data-aos="fade-right">
          <h2>Get In Touch</h2>
          <p>
            We’d love to hear from you! Whether you’re planning a wedding,
            corporate event, or special celebration, we’re here to make it
            unforgettable.
          </p>

          <div class="info-box">
            <i class="fas fa-map-marker-alt"></i>
            <span>pokhara, Nepal</span>
          </div>

          <div class="info-box">
            <i class="fas fa-phone"></i>
            <a href="tel:+9779842222222">+977 9842222222</a>
          </div>

          <div class="info-box">
            <i class="fas fa-envelope"></i>
            <a href="https://mail.google.com/mail/?view=cm&fs=1&to=info@eventstudio.com" target="_blank">
    info@eventstudio.com
  </a>
          </div>

          <div class="info-box">
            <i class="fas fa-clock"></i>
            <span>Mon - Fri : 9:00 AM - 6:00 PM</span>
          </div>
        </div>

        <form class="contact-form" method="post" action="contact-us.php" data-aos="fade-left">
  <h2>Send Message</h2>
  <input type="text" name="name" placeholder="Your Name" required />
  <input type="email" name="email" placeholder="Your Email" required />
  <input type="text" name="phonenumber" placeholder="Your Phone Number" required />
  <textarea name="message" placeholder="Your Message" rows="5" required></textarea>
  <button type="submit" name="submit" class="btn">Send</button>
</form>
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
            <li><a href="index.php#home">Home</a></li>
            <li><a href="about-us.php">About Us</a></li>
            <li><a href="services.php">services</a></li>
            <li><a href="packages.php">Prices</a></li>
            <li><a href="gallery.php">Gallery</a></li>
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
  </body>
</html>

<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script src="script.js"></script>
