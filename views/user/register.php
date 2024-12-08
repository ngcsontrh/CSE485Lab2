<?php
require_once './views/layout/header.php';
?>

<form method="POST">
  <div class="mb-3">
    <label for="username" class="form-label">Username</label>
    <input type="text" required class="form-control" id="username" name="username">
  </div>
  <div class="mb-3">
    <label for="password" class="form-label">Password</label>
    <input type="password" required class="form-control" name="password" id="password">
  </div>
  <button type="submit" class="btn btn-primary">Register</button>
</form>

<?php
require_once './views/layout/footer.php';
?>