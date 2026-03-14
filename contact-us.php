<?php
session_start();
include 'connect.php';

if (isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phonenumber = mysqli_real_escape_string($conn, $_POST['phonenumber']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);

    $sql = "INSERT INTO contact_messages (name, email, phonenumber, message)
            VALUES ('$name', '$email', '$phonenumber', '$message')";

    if ($conn->query($sql)) {
        echo "<script>alert('Message sent successfully!');</script>";
    } else {
        echo "<script>alert('Error: " . $conn->error . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Contact Us | Event Studio</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <link rel="stylesheet" href="style.css" />
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
  />
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css"
  />
</head>

<body>

  <!-- HEADER -->
  <header class="head">
      <a href="#" class="logo">
        <img
          src="projectimages/logo.png"
          alt="EventStudioLogo"
          class="logo-img"
        />EVENT STUDIO</a
      >
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

      <div id="menu"><i class="fa-solid fa-bars staggered"></i></div>
    </header>

  <!-- CONTACT HERO -->
  <section class="contact-hero">
    <h1 data-aos="fade-down">Contact Us</h1>
    <p data-aos="fade-up">Let’s plan something beautiful together</p>
    <style>
.contact-hero {
  padding-top: 12rem; /* fixed header space */
  padding-bottom: 6rem;
  text-align: center;
  background:
    linear-gradient(rgba(142, 7, 74, 0.7), rgba(224, 106, 163, 0.7)),
    url("projectimages/stagee.jpg");
  color: white;
  background-size: cover;
  background-position: center;
}
</style>
  </section>

  <!-- CONTACT CONTENT -->
  <section class="contact-page">
    <div class="contact-container">

      <!-- LEFT INFO -->
      <div class="contact-info" data-aos="fade-right">
        <h2>Get In Touch</h2>
        <p>
            We’d love to hear from you! Whether you’re planning a wedding,
            corporate event, or special celebration, we’re here to make it
            unforgettable.
        </p>

        <div class="info-box">
          <i class="fas fa-map-marker-alt"></i>
          <span>Pokhara, Nepal</span>
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
          <span>Mon – Fri : 9:00 AM – 6:00 PM</span>
        </div>
      </div>

      <!-- RIGHT FORM -->
      <form class="contact-form" method="post" action="" data-aos="fade-left">

        <h2>Send Message</h2>
        <input type="text" name="name" placeholder="Your Name" required />
  <input type="email" name="email" placeholder="Your Email" required />
  <input type="text" name="phonenumber" placeholder=" Your Phone Number" required />
  <textarea name="message" placeholder="Your Message" rows="5" required></textarea>
  <button type="submit" name="submit" class="btn">Send</button>
      </form>

    </div>
  </section>
  <!---------------------------------- Footer Section ------------------------------>
    <footer class="footer">
      <div class="footer-grid">
        <div class="footer-col footer-brand-info">
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
        >
          <h3>Quick Links</h3>
          <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="about-us.php">About Us</a></li>
            <li><a href="services.php">services</a></li>
            <li><a href="packages.php">Prices</a></li>
            <li><a href="gallery.php">Gallery</a></li>
            <li><a href="contact-us.php">Contact</a></li>
          </ul>
        </div>

        <div
          class="footer-col footer-contact-info"
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

  <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
  <script>AOS.init();</script>
</body>
</html>
