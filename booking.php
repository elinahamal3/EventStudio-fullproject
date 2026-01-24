<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    // Redirect to signup with a redirect back to booking.php
    header("Location: signup.php?redirect=booking.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Event Booking | Event Studio</title>
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
    <header class="head">
      <a href="index.php" class="logo">
        <img src="projectimages/logo.png" class="logo-img" />EVENT STUDIO
      </a>
    </header>


    <section class="booking-section"> 
  <div class="booking-header" style="position: relative; margin-bottom: 30px;">
    
    <!-- Back button -->
    <a href="index.php" class="back-btn" style="
      position: absolute;
      left: 0;
      top: 0;
      display:inline-flex;
      align-items:center;
      gap:6px;
      padding:8px 12px;
      border-radius:6px;
      background:#df0d92;
      color:#fff;
      text-decoration:none;
      font-size:14px;
      font-weight:600; 
      margin-top: 20px;
      z-index: 1000;
    ">
      <i class="fas fa-arrow-left"></i> Back
    </a>

    <!-- Centered heading -->
    <h1 class="heading" data-aos="fade-down" style="
      margin: 0 auto;
      font-size:5rem;
      text-align:center;
      max-width: 100%;
    ">
      <span>Book</span> Your Event
    </h1>

  </div>

    
      <div class="booking-container">
        <form id="bookingForm" class="booking-form" data-aos="fade-right">
          <h2>Booking Details</h2>

          <label>Select Package</label>
          <select name="package" required>
            <option value="" disabled selected>Choose Package</option>
            <option value="Basic Package – $4000">Basic Package – $4000</option>
<option value="Standard Package – $6000">Standard Package – $6000</option>
<option value="Premium Package – $8000">Premium Package – $8000</option>
<option value="Deluxe Package – $10000">Deluxe Package – $10000</option>

          </select>

          <label>Your Name</label>
          <input
            type="text"
            name="name"
            placeholder="Enter your name"
            required
          />

          <label>Your Email</label>
          <input
            type="email"
            name="email"
            placeholder="Enter your email"
            required
          />

          <label>Phone Number</label>
          <input
            type="text"
            name="phone"
            placeholder="Enter phone number"
            required
          />

          <label>Event Date</label>
          <input type="date" name="event_date" required />

          <label>Event Location</label>
          <input
            type="text"
            name="location"
            placeholder="Enter event location"
            required
          />

<label>Your Message</label>
<textarea
  name="message"
  placeholder="Describe your event"
  rows="5"
></textarea>

<!-- Add cash-only notice -->
<div style="
  background:#ffebf4;
  border:1px solid #ffc2de;
  padding:12px 14px;
  border-radius:6px;
  font-size:1.3rem;
  color:#b20763;
  margin-top:15px;
">
  <strong>Note:</strong> Payments are accepted in cash only.
</div>


<button type="submit" class="btn" style="background-color: #df0d92; color: #fff; border: none;">
  Submit Booking
</button>
        </form>

        <div class="booking-image" data-aos="fade-left">
          <img src="projectimages/back88.jpg" alt="booking" />
        </div>
      </div>
    </section>

    <footer class="footer">
      <div class="footer-credit">
        <p>&copy; 2025 Event Studio. All rights reserved.</p>
      </div>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script>
      AOS.init();

      // ===== AJAX Booking Form Submission =====
      document
        .getElementById("bookingForm")
        .addEventListener("submit", async function (e) {
          e.preventDefault(); // Prevent page refresh

          const form = e.target;

          const data = {
            package: form.package.value,
            name: form.name.value,
            email: form.email.value,
            phone: form.phone.value,
            event_date: form.event_date.value,
            location: form.location.value,
            message: form.message.value,
          };

          try {
            const response = await fetch("backend/save_booking.php", {
              method: "POST",
              headers: { "Content-Type": "application/json" },
              body: JSON.stringify(data),
            });

            const result = await response.json();
            alert(result.message);

            if (result.success) form.reset(); // Clear form on success
          } catch (err) {
            console.error(err);
            alert("Server error. Please try again.");
          }
        });
    </script>
  </body>
</html>
