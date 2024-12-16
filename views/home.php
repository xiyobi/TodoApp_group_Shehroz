<?php
require 'views/components/header.php';
require 'views/components/navbar.php';
?>

<div class="hero container-home container">
    <div class="hero-text">
        <h1>Organize your work and life, finally.</h1>
        <p>
            Simplify life for both you and your team with the world's #1 task manager and to-do list app.
        </p>
        <a href="/register" class="btn btn-primary btn-primary-home btn-lg">Register</a>
    </div>
    <div class="hero-image">
        <img src="https://www.w3schools.com/html/pic_trulli.jpg" alt="App Screenshot">
    </div>
</div>


<!-- Testimonials Section -->
<div class="testimonials">
    <div class="row justify-content-center">
        <div class="col-md-3">
            <p class="quote">"Simple, straightforward, and super powerful"</p>
            <p class="source">- The Verge</p>
        </div>
        <div class="col-md-3">
            <p class="quote">"The best to-do list app on the market"</p>
            <p class="source">- PC Mag</p>
        </div>
        <div class="col-md-3">
            <p class="quote">"Nothing short of stellar"</p>
            <p class="source">- TechRadar</p>
        </div>
    </div>
</div>

<?php
require 'views/components/footer.php';
?>

