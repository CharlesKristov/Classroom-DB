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
  $classrooms = $role == 'student' ? $student->getClassrooms($user['id']) : ($role == 'teacher' ? $teacher->getClassrooms($user['id']) : []);
  $organizations = $role == 'student' ? $organization->getOrganizations($user['id']) : [];
  $classes = $role == 'admin' ? [] : $classroom->getClasses($user['id']);

  $ongoing_class = '';
  $ongoing_class_type = '';
  $ongoing_classroom = '';
  $ongoing_classroom_code = '';
  $ongoing_teacher = '';
  $ongoing_class_time = '';
  $ongoing_class_start_time = '';
  $ongoing_class_end_time = '';
  $ongoing_course = '';

  if($role != 'admin') {
    $ongoing_class = $kelas->getClass($kelas->getOngoingClass($user['id'])['id']);
    $ongoing_class_type = $kelas->getClassType($ongoing_class['type_id'])['name'];
    $ongoing_classroom = $classroom->getClassroom($ongoing_class['classroom_id']);
    $ongoing_classroom_code = sprintf("%s%02d", strtoupper(substr($classroom->getClassroomType($ongoing_classroom['type_id'])['name'], 0, 3)), $ongoing_classroom['id']);
    $ongoing_teacher = $teacher->getTeacherById($ongoing_class['teacher_id']);
    $ongoing_class_time = new DateTime($ongoing_class['time']);
    $ongoing_class_start_time = date_format(($ongoing_class_time), "H:i");
    $ongoing_class_end_time = date_format(($ongoing_class_time)->modify("+2 hour"), "H:i");
    $ongoing_course = $course->getCourse($course->getCourseDetail($ongoing_class['course_detail_id'])['course_id'])['name'];
  }
  
?>

<div class="d-flex">
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
        <a href="#" class="nav-link active" aria-current="page">
          <span>🏠</span>
          Home
        </a>
      </li>
      <li>
        <a href="#" class="nav-link text-white">
          <span>📅</span>
          Schedule
        </a>
      </li>
      <li>
        <a href="#" class="nav-link text-white">
        <span>📚</span>
          Courses
        </a>
      </li>
      <?php } else { ?>
        <li class="nav-item">
          <a href="#" class="nav-link active" aria-current="page">
            <span>🛠</span>
            Administrator
          </a>
        </li>
      <?php } ?>
    </ul>
  </div>

  
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

  <div class="px-3 py-4">
    <?php if($role != 'admin') {?>
    <h1 class="text-dark fs-2">📜 Your Dashboard</h1>
    <hr>
    <div class="mb-4">
      <!-- Ongoing Class -->
        <h2 class="fs-4">Ongoing Class</h2>
        <div>
          <div class="card bg-light " style="">
            <div class="card-body">
              <div class="mb-3 d-flex justify-content-between align-items-center">
                <span class="badge rounded-pill px-3 py-2 <?php echo $ongoing_class['type_id'] == 1 ? "bg-primary": "bg-danger"?>"><?php echo $ongoing_class_type?></span>
                <span class="fs-5">⏳ <span class="fw-bold text-secondary">2 Hours</span></span>
              </div>
              <h5 class="card-title"><?php echo $ongoing_classroom_code?> - <?php echo substr($ongoing_classroom_code,0,3)?></h5>
              <h6 class="card-subtitle mb-2 text-muted"><?php echo $ongoing_course?></h6>
              <ul class="list-unstyled card-text d-grid gap-2 mt-3">
                <li>
                  <span>👩🏻‍🏫</span>
                  <?php echo $ongoing_teacher['first_name']." ".$ongoing_teacher['last_name'];?>
                </li>
                <li>
                  <span>⌚</span>
                  <?php echo $ongoing_class_start_time." - ".$ongoing_class_end_time;?>
                </li>
              </ul>
              <a href="#" class="card-link">View Session</a>
              <a href="#" class="card-link">View Course</a>
            </div>
          </div>
        </div>
      </div>
    
     <!-- Organization -->
     <div class="d-flex gap-3">
      <div class="border p-4 flex-fill rounded">
        <h2 class="fs-4">Organizations</h2>
        <hr>
        <ul class="list-unstyled">
          <?php foreach($organizations as $org) { ?>
            <?php 
              $current_organization = $organization->getOrganization($org['organization_id']); 
              $sub_title = $current_organization['name'];
              $title = $current_organization['short_name'];
            ?>
            <li>
              <p class="fw-bold fs-4 mb-0"><?php echo $title; ?></p>
              <p class="text-secondary"><?php echo $sub_title; ?></p>
            </li>
          <?php } ?>
        </ul>
      </div>

       <!-- Classroom List -->
      <div class="border p-4 flex-fill rounded py-4">
        <h2 class="fs-4 px-3">Classroom List</h2>
        <hr>
        <div class="px-3">
        <table class="table table-hover table-striped table-bordered">
          <thead>
            <tr class="bg-secondary text-light">
              <th scope="col">#</th>
              <th scope="col">Name</th>
              <th scope="col">Capacity</th>
              <th scope="col">Class Type</th>
            </tr>
          </thead>
          <tbody>
          <?php foreach($classrooms as $index=>$cls) {?>
            <?php 
              $clsroom = $classroom->getClassroom($cls['classroom_id']);
              $clsroom_code = sprintf("%s%02d", strtoupper(substr($classroom->getClassroomType($clsroom['type_id'])['name'], 0, 3)), $clsroom['id']);
            ?>
            <tr>
              <td scope="row"><?php echo $index + 1;?></td>
              <td><?php echo $clsroom_code;?></td>
              <td><?php echo $clsroom['capacity'];?></td>
              <td><?php echo substr($clsroom_code,0,3)?></td>
            </tr>
          <?php }?>
          </tbody>
        </table>
        </div>
      </div>
    </div>
    <?php } else { ?>
    <h1 class="text-dark fs-2">🔨 Manage</h1>
    <hr>
    <?php } ?>

  </div>
</div>

<script>
  const timeNow = document.querySelector('#time-now');
  setInterval(() => {
    const now = new Date();
    timeNow.textContent = new Intl.DateTimeFormat('en-ID', { dateStyle: 'full', timeStyle: 'long'}).format(now).replace(/GMT.*/g, '');
  }, 1000);
</script>	