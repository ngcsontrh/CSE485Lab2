<?php
require './views/layout/header.php';
?>

<form method="POST">
  <input type="hidden" name="id" value=<?= $user->getId() ?> />
  <div class="mb-3">
    <label for="username" class="form-label">Username</label>
    <input type="text" required class="form-control" id="username" name="username" value=<?= $user->getUsername() ?>>
  </div>
  <div class="mb-3">
    <label for="password" class="form-label">Password</label>
    <input type="password" class="form-control" name="password" id="password">
  </div>
  <div class="mb-3">
    <label for="password" class="form-label">Role</label>
    <select class="form-select" aria-label="Default select example" name="role">
      <option value="0" <?= $user->getRole() == 0 ? 'selected' : '' ?>>User</option>
      <option value="1" <?= $user->getRole() == 1 ? 'selected' : '' ?>>Admin</option>
    </select>
  </div>
  <button type="submit" class="btn btn-primary">Update</button>
</form>

<?php
require './views/layout/footer.php';
?>