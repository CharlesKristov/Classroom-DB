<?php
global $student, $teacher, $role, $course, $kelas;
$courses = $role == 'student' ? $student->getCourses($user['id']) : $teacher->getCourses($user['id']);
if ($courses) {
  foreach ($courses as $current_course) {
    $class = $kelas->getClass($current_course['class_id'], true);
    extract($course->getCourse($current_course['id']));

    $credit = $credit;
    $course_name = $name;
    $classroom_code = sprintf("%s%02d", strtoupper(substr($class['classroom_type'], 0, 3)), $class['classroom_number']); //LEC001
    $classroom_type = substr($classroom_code, 0, 3);
    $course_code = implode("", array_map(function ($word) {
      return strtoupper($word[0]);
    }, explode(" ", $course_name))) . ' - ' . $classroom_type;

    $groupByType[$classroom_type][] = ['credit' => $credit, 'course_name' => $course_name, 'classroom_code' => $classroom_code, 'classroom_type' => $classroom_type, 'course_code' => $course_code];
  }
  $course_type = isset($_GET['course_type']) ? (in_array($_GET['course_type'], array_keys($groupByType)) ? $_GET['course_type'] : array_key_first($groupByType)) : array_key_first($groupByType);
}

?>
<!-- Courses -->
<h1 class="text-dark fs-2">📚 Your Courses</h1>
<hr>


<div class="tab-navigation d-flex gap-3 mb-4 border-bottom">
  <a href="./?dashboard=course&course_type=LAB" class="p-3 link-dark text-decoration-none border-bottom border-5 <?= $course_type == 'LAB' ? 'border-warning' : 'border-body' ?>">LAB</a>
  <a href="./?dashboard=course&course_type=LEC" class="p-3 link-dark text-decoration-none border-bottom border-5 <?= $course_type == 'LEC' ? 'border-warning' : 'border-body' ?>">LEC</a>
</div>
<?php ?>
<div class="row row-cols-3 g-4">
  <?php foreach ($groupByType[$course_type] as $current_course) { ?>
    <div class="col">
      <div class="card h-100">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-center gap-2">
            <h5 class="card-title text-break"><?= $current_course['course_name']; ?></h5>
            <button class="btn btn-outline-primary my-2"><?= $current_course['classroom_code']; ?></button>
          </div>
          <div class="card-text mb-2">👨🏿‍🤝‍👨🏿 <?= $current_course['course_code']; ?></div>
          <div class="card-text mb-2">📖 Credits: <?= $current_course['credit']; ?></div>
          <a href="#" class="text-decoration-none stretched-link">View Details</a>
        </div>
      </div>
    </div>
  <?php } ?>
</div>

<?php
if (!$courses) { ?>
  <div>
    <div class="card text-white bg-danger mt-4">
      <div class="card-body">
        <h5 class="card-title m-0"><span style="color: transparent; text-shadow: 0 0 0 white;">❌</span> You have no course </h5>
      </div>
    </div>
  </div>
<?php } ?>