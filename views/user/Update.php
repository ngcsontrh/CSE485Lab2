<?php
require './views/layout/header.php';
?>

<form method="POST">
  <div class="mb-3">
    <label for="username" class="form-label">Username</label>
    <input type="text" required class="form-control" id="username" name="username">
  </div>
  <div class="mb-3">
    <label for="password" class="form-label">Password</label>
    <input type="password" required class="form-control" id="password">
  </div>
  <button type="submit" class="btn btn-primary">Create</button>
</form>

<?php
require './views/layout/footer.php';
?>