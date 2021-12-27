<?php 
  $db = (new Database)->connect();
  $organization = new Organization($db);
  $classroom = new Classroom($db);
  $kelas = new Kelas($db);
  $teacher = new Teacher($db);
  $student = new Student($db);
  $course = new Course($db);

  $emoji = array("student"=>"👨‍🎓", "teacher"=>"👩‍🏫", "admin"=>"🧛‍♀️");
  $role = $_SESSION['user_type'];
  $user = isset($_SESSION['user']) ? $_SESSION['user'] : "";
  
  $dashboard = isset($_GET['dashboard']) ? $_GET['dashboard'] : ($role == 'admin' ? 'administrator' : 'home'); 
?>
<div class="d-flex">

  <!-- Sidebar -->
  <div class="min-vh-100 d-flex flex-column flex-shrink-0 p-3 text-white bg-dark" style="width: 280px;">
  <div class="border p-2 pb-0 bg-secondary mb-3 rounded">
    <p class="fs-4"><?php echo $emoji[$role]." ".ucfirst($role);?></p>
    <ul class="list-unstyled pb-1 small">
      <li><?php if($role != 'admin') echo $user['first_name']." ".$user['last_name']; ?></li>
      <li><?php if($role == 'student') echo "Undergraduate"; ?></li>
      <li>Binus University</li>
    </ul>
  </div>
    <ul class="nav nav-pills flex-column mb-auto">
    <?php if($role != 'admin') {?>
      <li class="nav-item">
        <a href="./?dashboard=home" class="nav-link <?php echo $dashboard == 'home' ? 'active' : 'text-white';?>" aria-current="page">
          <span>🏠</span>
          Home
        </a>
      </li>
      <li class="nav-item">
        <a href="./?dashboard=schedule" class="nav-link  <?php echo $dashboard == 'schedule' ? 'active' : 'text-white';?>">
          <span>📅</span>
          Schedule
        </a>
      </li>
      <li class="nav-item">
        <a href="./?dashboard=course" class="nav-link  <?php echo $dashboard == 'course' ? 'active' : 'text-white';?>">
        <span>📚</span>
          Courses
        </a>
      </li>
      <?php } else { ?>
        <li class="nav-item">
          <a href="./?dashboard=administrator" class="nav-link <?php echo $dashboard == 'administrator' ? 'active' : 'text-white';?>" aria-current="page">
            <span>🛠</span>
            Administrator
          </a>
        </li>
      <?php } ?>
    </ul>
  </div>
  
  <!-- Header -->
  <div class="w-100">
  <div class="d-flex align-items-center w-100 justify-content-between px-3 py-2 border-bottom">
    <h1 class="text-dark fs-4 mb-0">Welcome, <?php echo $role == 'admin' ? "Admin" : $user['first_name']; ?>!</h1>
    <div id="time-now" class="text-secondary fs-6 mb-0"></div>
    <div class="dropdown text-end">
      <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
        <img src="https://i.pravatar.cc/32?img=62" alt="avatar" class="rounded-circle">
      </a>
      <ul class="dropdown-menu text-small" aria-labelledby="dropdownUser1">
        <li><a class="dropdown-item" href="user/logout.php">Sign out</a></li>
      </ul>
    </div>
  </div>
  
  <!-- Content -->
  <div class="px-3 py-4">
    <?php include("dashboard/".($role == 'admin' ? "administrator" : $dashboard).".php"); ?>
  </div>
</div>

<script>
  const timeNow = document.querySelector('#time-now');
  setInterval(() => {
    const now = new Date();
    timeNow.textContent = new Intl.DateTimeFormat('en-ID', { dateStyle: 'full', timeStyle: 'long'}).format(now).replace(/GMT.*/g, '');
  }, 1000);
</script>	