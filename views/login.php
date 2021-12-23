<?php   
  $errorLogin = isset($_SESSION['error']['login']) ? $_SESSION['error']['login'] : '';
?>

<style>
  .bg-empty-classroom {
    position: relative;
  }
  .bg-empty-classroom::before {
    content: '';
    position: absolute;
    inset: 0;
    background-image: url('assets/empty_classroom.jpg');
    background-size: cover;
    filter: blur(3px);
  }
  .bg-empty-classroom > * {
    position: relative;
  }
</style>

<!-- Button trigger modal -->
<div class="min-vh-100 bg-empty-classroom">
  <div class="min-vh-100 d-flex flex-column align-items-center justify-content-center">
    <h1 class="mb-4 bg-light p-2 rounded">👨‍🎓 Classroom</h1>
    <form action="user/login.php" method="POST" class="shadow-sm p-3 bg-body rounded border w-25">
      <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="text" name="email" id="email" class="form-control <?php echo isset($errorLogin['email']) ? 'is-invalid' : '' ?>" required>
        <?php if(isset($errorLogin['email'])){ ?>
          <div class="invalid-feedback"><?php echo $errorLogin['email']; ?></div>
        <?php } ?>
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" name="password" id="password" class="form-control <?php echo isset($errorLogin['password']) ? 'is-invalid' : '' ?>" required>
        <?php if(isset($errorLogin['password'])){ ?>
          <div class="invalid-feedback"><?php echo $errorLogin['password']; ?></div>
        <?php } ?>
      </div>
      <div>
        <button type="submit" class="btn btn-primary">Login</button>
      </div>
    </form>
  </div>
</div>