<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Gallery | Event Studio</title>

<style>
@import url("https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap");

:root {
  --clr1: #f7f7f7;
  --clr2: rgb(194, 15, 110);
  --clr-accent: deeppink;
  --clr-dark: #1a1a1a;
  --clr-light-bg: #ffdfed;
}

* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: "Poppins", sans-serif;
  text-decoration: none;
  text-transform: uppercase;
  border: none;
}

html {
  font-size: 65%;
  scroll-behavior: smooth;
  scroll-padding-top: 7rem;
  overflow-x: hidden;
}

section {
  padding: 6rem 10%;
  background: var(--clr-light-bg);
}

.head {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  z-index: 10000;
  background: var(--clr2);
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 1.5rem 8%;
}

.head .logo {
  font-weight: bold;
  color: #fff;
  font-size: 2.3rem;
  display: flex;
  align-items: center;
}

.head .logo .logo-img {
  height: 3.8rem;
  width: 4rem;
  margin-right: 1rem;
  border-radius: 80%;
}

.head .navbar a {
  font-size: 1.7rem;
  color: #f6f2f2;
  margin-right: 2rem;
}

.head .navbar .signup-btn {
  background-color: var(--clr1);
  color: var(--clr-accent);
  padding: 1rem 1.5rem;
  border-radius: 0.5rem;
  font-weight: 500;
  transition: background-color 0.3s ease, color 0.3s ease;
  margin-left: 1rem; /* Add some space between 'Contact' and 'Sign Up' */
  font-size: 1.5rem;
  border: 1px solid #998a8a;
}

.head .navbar .signup-btn:hover {
  background-color: #ff57a9; /* Slightly lighter pink on hover */
  color: #fff;
}

.user-name {
  color: white;
  font-size: 1.6rem;
  margin-right: 1.5rem;
}

.logout-btn {
  font-size: 1.5rem;
  background: var(--clr-dark);
  padding: .8rem 1.3rem;
  border-radius: .5rem;
  color: #fff;
}

.page-title {
  text-align: center;
  padding: 120px 0 20px;
  font-size: 3rem;
  font-weight: 600;
}

.gallery {
  padding: 20px 50px 50px;
  column-count: 4;
  column-gap: 20px;
}

.gallery img {
  width: 100%;
  margin-bottom: 20px;
  border-radius: 10px;
  display: block;
  transition: .3s ease;
  cursor: pointer;
}

.gallery img:hover {
  transform: scale(1.03);
}

/* ===== Responsive ===== */
@media (max-width: 992px) {
  .gallery { column-count: 3; padding: 20px; }
}

@media (max-width: 768px) {
  .gallery { column-count: 2; }
}

@media (max-width: 480px) {
  .gallery { column-count: 1; padding: 10px; }
} 


  .head .navbar.active {
    clip-path: polygon(0 0, 100% 0, 100% 100%, 0 100%);
  }

  
/* ===== FOOTER ===== */
.footer {
  background-color: #222; /* Dark background, similar to Roy Events */
  color: #eee;
  padding: 60px 7%; /* Adjust padding as needed */
  font-size: 1.6rem;
}

.footer-grid {
  display: grid;
  grid-template-columns: repeat(
    auto-fit,
    minmax(250px, 1fr)
  ); /* Responsive grid for columns */
  gap: 30px; /* Space between columns */
  padding-bottom: 40px;
  border-bottom: 1px solid #444; /* Separator line */
}

/* --- Common Column Styles --- */
.footer-col h3 {
  font-size: 2rem;
  color: deeppink; /* Your theme accent color */
  margin-bottom: 25px;
  text-transform: uppercase;
  font-weight: 600;
}

/* --- Column 1: Brand Info --- */
.footer-brand-info .logo {
  display: flex;
  align-items: center;
  color: #fff;
  font-size: 2.8rem; /* Slightly larger for brand name */
  font-weight: 700;
  text-decoration: none;
  margin-bottom: 10px;
}

.footer-brand-info .logo-img {
  width: 49px; /* Larger logo image */
  height: 46px;
  margin-right: 12px;
  border-radius: 75%; /* If you want it circular */
  object-fit: cover;
}

.footer-brand-info .brand-tagline {
  font-size: 1.4rem;
  color: #bbb;
  margin-top: -5px; /* Adjust spacing */
  margin-bottom: 15px;
}

.footer-brand-info .brand-mission {
  font-size: 1.4rem;
  line-height: 1.8;
  color: #ccc;
}

/* --- Column 2 & 3: Links (Services & Quick Links) --- */
.footer-services ul,
.footer-quick-links ul {
  list-style: none;
  padding: 0;
}

.footer-services ul li,
.footer-quick-links ul li {
  margin-bottom: 10px;
}

.footer-services a,
.footer-quick-links a {
  color: #ccc;
  text-decoration: none;
  font-size: 1.5rem;
  transition: color 0.3s ease;
}

.footer-services a:hover,
.footer-quick-links a:hover {
  color: deeppink; /* Hover effect */
}

/* --- Column 4: Contact Info --- */
.footer-contact-info p {
  color: #ccc;
  font-size: 1.5rem;
  margin-bottom: 10px;
  display: flex;
  align-items: flex-start; /* Align icon and text at the top */
}

.footer-contact-info p i {
  color: deeppink; /* Icon color */
  margin-right: 10px;
  margin-top: 3px; /* Adjust icon vertical alignment */
  font-size: 1.6rem;
}

/* --- Footer Credit Section --- */
.footer-credit {
  text-align: center;
  padding-top: 30px;
  font-size: 1.4rem;
  color: #999;
}

/* --- Responsive Adjustments --- */
@media (max-width: 991px) {
  .footer-grid {
    grid-template-columns: repeat(
      auto-fit,
      minmax(200px, 1fr)
    ); /* More compact on tablets */
    gap: 20px;
  }
}

@media (max-width: 768px) {
  .footer-grid {
    grid-template-columns: 1fr 1fr; /* Two columns on smaller tablets */
  }
  .footer-col {
    margin-bottom: 25px;
  }
  .footer-brand-info .logo {
    justify-content: center; /* Center logo on smaller screens */
  }
  .brand-tagline,
  .brand-mission {
    text-align: center;
  }
  .footer-services,
  .footer-quick-links,
  .footer-contact-info {
    text-align: center;
  }
  .footer-contact-info p {
    justify-content: center;
  }
  .date-converter-btn {
    margin-left: auto;
    margin-right: auto;
    display: flex; /* Ensure button stays centered */
  }
}

@media (max-width: 480px) {
  .footer-grid {
    grid-template-columns: 1fr; /* Single column on mobile */
  }
  .footer-col {
    text-align: center;
  }
  .footer-contact-info p {
    justify-content: center;
  }
}
.page-title {
  text-align: center;
  padding: 120px 0 20px;
  font-size: 5rem;
  font-weight: 620;
}
</style>
</head>

<body>
<header class="head">
  <a href="index.php" class="logo">
    <img src="projectimages/logo.png" class="logo-img"> EVENT STUDIO
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
</header>

<h1 class="page-title">Our Gallery</h1>

<!-- <div class="gallery">
  <img src="projectimages/gmehendi1.jpg">
  <img src="projectimages/gmehendi2.jpg">
  <img src="projectimages/gmehendi3.jpg">
  <img src="projectimages/gmehendi4.jpg">
<img src="projectimages/gmehendi333.jpg">
<img src="projectimages/gmehendi3333.jpg">
<img src="projectimages/gmehendi33333.jpg">
  <img src="projectimages/gmehendi5.jpg">
  <img src="projectimages/gmehendi6.jpg">
  <img src="projectimages/gmehendi7.jpg">
  <img src="projectimages/gmehendi8.jpg">
  <img src="projectimages/gmehendi9.jpg">
  <img src="projectimages/gmehendi11.jpg">
  <img src="projectimages/gmehendi12.jpg">
   <img src="projectimages/gmehendi22.jpg">
  <img src="projectimages/gmehendi111.jpg">
  <img src="projectimages/gmehendi122.jpg">
  <img src="projectimages/gmehendi222.jpg">
  <img src="projectimages/gmehendi1222.jpg">
  <img src="projectimages/gmehendi12222.jpg">
  <img src="projectimages/gmehendi122222.jpg">
  <img src="projectimages/gmehendi1222222.jpg">
  <img src="projectimages/gunyo.jpg">
  <img src="projectimages/engagement.jpg">
  <img src="projectimages/catering.jpg">
</div> -->
<div class="gallery">
<?php
require_once "connect.php";
$res = $conn->query("SELECT * FROM gallery_images ORDER BY uploaded_at DESC");
while ($row = $res->fetch_assoc()) {
    echo '<img src="projectimages/'.$row['image_name'].'">';
}
?>
</div>



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
