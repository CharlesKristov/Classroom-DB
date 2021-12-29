<?php
$db = (new Database)->connect();
$organization = new Organization($db);
$classroom = new Classroom($db);
$kelas = new Kelas($db);
$teacher = new Teacher($db);
$student = new Student($db);
$course = new Course($db);

$emoji = array("student" => "👨‍🎓", "teacher" => "👩‍🏫", "admin" => "🧛‍♀️");
$role = $_SESSION['user_type'];
$user = isset($_SESSION['user']) ? $_SESSION['user'] : "";

$dashboard = isset($_GET['dashboard']) ? $_GET['dashboard'] : ($role == 'admin' ? 'administrator' : 'home');
?>
<div class="d-flex">

  <!-- Sidebar -->
  <div class="min-vh-100 d-flex flex-column flex-shrink-0 p-3 text-white bg-dark" style="<?php echo $role != 'admin' ? 'width: 250px;' : '' ?>">
    <div class=" border p-2 pb-0 bg-secondary mb-3 rounded">
      <div class="d-flex justify-content-center align-items-center mb-2 <?= $role == 'admin' ? '' : '' ?>">
        <?php if ($role == 'admin') { ?>
          <div>
            <img src="https://stbm7resourcesprod.blob.core.windows.net/profilepicture/e37f6235-26f0-4f80-9f8f-956ffdf8eb66.jpg" alt=" avatar" class="text-center rounded" />
            <h5 class="text-center">Charles</h5>
          </div>
          <div>
            <img src="https://stbm7resourcesprod.blob.core.windows.net/profilepicture/8098b4a3-3bc7-4a51-a6e9-ad9c0455af8b.jpg" alt="avatar" class="text-center rounded" />
            <h5 class="text-center">Chico</h5>
          </div>
          <div>
            <img src="https://stbm7resourcesprod.blob.core.windows.net/profilepicture/77998c8f-7dfc-4f41-a5f9-38f1027b3ade.jpg" alt="avatar" class="text-center rounded" />
            <h5 class="text-center">Made</h5>
          </div>
        <?php } else { ?>
          <img src="<?= $role == 'admin' ? 'https://stbm7resourcesprod.blob.core.windows.net/profilepicture/e37f6235-26f0-4f80-9f8f-956ffdf8eb66.jpg' : $user['avatar'] ?>" alt="avatar" class="text-center rounded" />
        <?php } ?>

      </div>
      <p class="fs-4"><?= $emoji[$role] . " " . ucfirst($role); ?></p>
      <ul class="list-unstyled pb-1 small">
        <li><?php if ($role != 'admin') echo $user['first_name'] . " " . $user['last_name']; ?></li>
        <li><?php if ($role == 'student') echo "Undergraduate"; ?></li>
        <li>Binus University</li>
      </ul>
    </div>
    <ul class="nav nav-pills flex-column mb-auto">
      <?php if ($role != 'admin') { ?>
        <li class="nav-item">
          <a href="./?dashboard=home" class="nav-link <?= $dashboard == 'home' ? 'active' : 'text-white'; ?>" aria-current="page">
            <span>🏠</span>
            Home
          </a>
        </li>
        <li class="nav-item">
          <a href="./?dashboard=schedule" class="nav-link  <?= $dashboard == 'schedule' ? 'active' : 'text-white'; ?>">
            <span>📅</span>
            Schedule
          </a>
        </li>
        <li class="nav-item">
          <a href="./?dashboard=course" class="nav-link  <?= $dashboard == 'course' ? 'active' : 'text-white'; ?>">
            <span>📚</span>
            Courses
          </a>
        </li>
      <?php } else { ?>
        <li class="nav-item">
          <a href="./?dashboard=administrator&administrator=manage" class="nav-link <?= $dashboard == 'administrator' ? 'active' : 'text-white'; ?>" aria-current="page">
            <span>🛠</span>
            Administrator
          </a>
        </li>
      <?php } ?>
    </ul>
  </div>


  <div class="w-100">
    <!-- Header -->
    <div class="d-flex align-items-center w-100 justify-content-between px-3 py-3 border-bottom">
      <h1 class="text-dark fs-4 mb-0">Welcome, <?= $role == 'admin' ? "Admin" : $user['first_name']; ?>!</h1>
      <div id="time-now" class="text-secondary fs-6 mb-0"></div>
      <div class="dropdown text-end">
        <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
          Menu
        </a>
        <ul class="dropdown-menu text-small" aria-labelledby="dropdownUser1">
          <li><a class="dropdown-item" href="user/logout.php">Sign out</a></li>
        </ul>
      </div>
    </div>

    <!-- Content -->
    <div class="px-3 py-4">
      <?php include("dashboard/" . ($role == 'admin' ? "administrator" : $dashboard) . ".php"); ?>
    </div>
  </div>
</div>

<script>
  const timeNow = document.querySelector('#time-now');
  setInterval(() => {
    const now = new Date();
    timeNow.textContent = new Intl.DateTimeFormat('en-ID', {
      dateStyle: 'full',
      timeStyle: 'long'
    }).format(now).replace(/GMT.*/g, '');
  }, 1000);
</script>