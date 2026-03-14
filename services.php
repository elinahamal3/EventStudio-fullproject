<?php
session_start();
require_once "connect.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Our Services | Event Studio</title>
  <link rel="stylesheet" href="style.css" />
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
  />
  <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"
  />
  <style>
/* HERO SECTION */
.hero {
  background: linear-gradient(
      rgba(142, 7, 74, 0.7),
      rgba(240, 122, 179, 0.7)
    ),
    url("projectimages/entrancegate3.jpg") center/cover no-repeat;
  color: white;
  text-align: center;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  min-height: 100vh; /* full screen */
  padding: 0 2rem; /* small side padding */
  box-sizing: border-box;
  position: relative;
}

.hero h1 {
  font-size: 3rem;
  margin: 0.5rem 0;
}

.hero p {
  font-size: 1.5rem;
  text-transform: capitalize;
  max-width: 700px;
}
.section-header h2{
  font-size: 4rem;
  margin-top :2.5rem;
}
/* Adjust for smaller screens */
@media (max-width: 768px) {
  .hero h1 {
    font-size: 2.2rem;
  }
  .hero p {
    font-size: 1.2rem;
  }
}
</style>

</head>
<body>
  <!-- HEADER -->
  <header class="head">
    <a href="index.php" class="logo">
      <img src="projectimages/logo.png" alt="EventStudioLogo" class="logo-img" />
      EVENT STUDIO
    </a>
    <nav class="navbar">
      <a href="index.php#home">Home</a>
      <a href="about-us.php">About</a>
      <a href="services.php">Services</a>
      <a href="packages.php">Price</a>
      <a href="gallery.php">Gallery</a>
      <a href="contact-us.php">Contact</a>
      <?php if (isset($_SESSION['user_id'])): ?>
        <span class="signup-btn">👤 <?= htmlspecialchars($_SESSION['user_name']); ?></span>
        <a href="backend/logout.php" class="signup-btn">LOGOUT</a>
      <?php else: ?>
        <a href="signup.php" class="signup-btn">SIGN UP</a>
      <?php endif; ?>
    </nav>
    <div id="menu"><i class="fa-solid fa-bars staggered"></i></div>
  </header>

  <!-- SERVICES SECTION -->
  <section id="services" class="services">
    <div class="container">
      <div class="section-header">
        <h2><span>OUR</span> SERVICES</h2>
        <p>We offer comprehensive event management solutions to make your special occasions memorable and stress-free.</p>
      </div>

      <div class="services-grid">
        <?php
        $services = mysqli_query($conn, "SELECT * FROM services ORDER BY id ASC");
        while($service = mysqli_fetch_assoc($services)):
        ?>
        <div class="service-card">
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

  <!-- FOOTER -->
  <footer class="footer">
    <div class="footer-grid">
      <div class="footer-col footer-brand-info">
        <a href="index.php" class="logo">
          <img src="projectimages/logo.png" alt="EventStudioLogo" class="logo-img" />EVENT STUDIO
        </a>
        <p class="brand-tagline">Wedding / Planner / Pokhara</p>
        <p class="brand-mission">Creating magical event moments in Pokhara since 2025. Your dream event is our mission.</p>
      </div>

      <div class="footer-col footer-services">
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

      <div class="footer-col footer-quick-links">
        <h3>Quick Links</h3>
        <ul>
          <li><a href="index.php#home">Home</a></li>
          <li><a href="about-us.php">About Us</a></li>
          <li><a href="services.php#services">Services</a></li>
          <li><a href="packages.php">Prices</a></li>
          <li><a href="gallery.php">Gallery</a></li>
          <li><a href="contact-us.php">Contact</a></li>
        </ul>
      </div>

      <div class="footer-col footer-contact-info">
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
