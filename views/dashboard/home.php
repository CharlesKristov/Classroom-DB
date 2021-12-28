<?php 
  global $organization, $classroom, $kelas, $teacher, $student, $course;
  
  $classrooms = $role == 'student' ? $student->getClassrooms($user['id']) : ($role == 'teacher' ? $teacher->getClassrooms($user['id']) : []);
  $organizations = $role == 'student' ? $organization->getOrganizations($user['id']) : [];

  $ongoing_class = $kelas->getClass(($role == 'student' ? $student->getOngoingClass($user['id']) : $teacher->getOngoingClass($user['id']))['id']);
  $ongoing_class_type = $kelas->getClassType($ongoing_class['type_id'])['name'];
  $ongoing_classroom = $classroom->getClassroom($ongoing_class['classroom_id']);
  $ongoing_classroom_code = sprintf("%s%02d", strtoupper(substr($classroom->getClassroomType($ongoing_classroom['type_id'])['name'], 0, 3)), $ongoing_classroom['id']);
  $ongoing_teacher = $teacher->getTeacherById($ongoing_class['teacher_id']);
  $ongoing_class_time = new DateTime($ongoing_class['time']);
  $ongoing_class_start_time = date_format(($ongoing_class_time), "H:i");
  $ongoing_class_end_time = date_format(($ongoing_class_time)->modify("+2 hour"), "H:i");
  $ongoing_course = $course->getCourse($course->getCourseDetail($ongoing_class['course_detail_id'])['course_id'])['name'];  
?>

<!-- Home -->
<h1 class="text-dark fs-2">📜 Your Dashboard</h1>
<hr>

<div class="mb-4">

  <!-- Ongoing Class -->
  <h2 class="fs-4">Ongoing Class</h2>
  <div>
    <div class="card bg-light " style="">
      <div class="card-body">
        <div class="mb-3 d-flex justify-content-between align-items-center">
          <span class="badge rounded-pill px-3 py-2 <?= $ongoing_class['type_id'] == 1 ? "bg-primary": "bg-danger"?>"><?= $ongoing_class_type?></span>
          <span class="fs-5">⏳ <span class="fw-bold text-secondary">2 Hours</span></span>
        </div>
        <h5 class="card-title"><?= $ongoing_classroom_code?> - <?= substr($ongoing_classroom_code,0,3)?></h5>
        <h6 class="card-subtitle mb-2 text-muted"><?= $ongoing_course?></h6>
        <ul class="list-unstyled card-text d-grid gap-2 mt-3">
          <li>
            <span>👩🏻‍🏫</span>
            <?= $ongoing_teacher['first_name']." ".$ongoing_teacher['last_name'];?>
          </li>
          <li>
            <span>⌚</span>
            <?= $ongoing_class_start_time." - ".$ongoing_class_end_time;?>
          </li>
        </ul>
        <a href="#" class="badge rounded-pill bg-primary px-3 py-2 card-link link-light text-decoration-none">View Session</a>
        <a href="#" class="badge rounded-pill bg-primary px-3 py-2 card-link link-light text-decoration-none">View Course</a>
      </div>
    </div>
  </div>
</div>

<div class="d-flex gap-3">
  
  <!-- Organization List -->
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
          <p class="fw-bold fs-4 mb-0"><?= $title; ?></p>
          <p class="text-secondary"><?= $sub_title; ?></p>
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
          <td scope="row"><?= $index + 1;?></td>
          <td><?= $clsroom_code;?></td>
          <td><?= $clsroom['capacity'];?></td>
          <td><?= substr($clsroom_code,0,3)?></td>
        </tr>
      <?php }?>
      </tbody>
    </table>
    </div>
  </div>
</div>