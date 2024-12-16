<?php
require 'views/components/header.php';
require 'views/components/navbar.php';
?>
<div class="form-container">
    <h2 class="text-center mb-4">Delete Account</h2>
    <form action="/deleteAccount" method="post">
        <div class="mb-3">
            <label for="registerPassword" class="form-label">Name</label>
            <input type="text" value="<?= $_SESSION['user']['full_name'] ?>" class="form-control" id="registerPassword" placeholder="Enter your password" name="password" required>
        </div>
        <div class="mb-3">
            <label for="registerEmail" class="form-label">Email</label>
            <input type="email" value="<?= $_SESSION['user']['email'] ?>" class="form-control" id="registerEmail" placeholder="Enter your email" name="email" required>
        </div>
        <div class="d-grid">
            <button type="submit" class="btn btn-danger">Delete Account</button>
        </div>
    </form>
    <p class="text-center mt-3">
        Already have an account? <a href="/">Home</a>
    </p>
</div>
<?php
require 'views/components/footer.php';
?>