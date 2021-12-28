<?php
  global $kelas, $role;

  $classes = $role == 'student' ? $student->getClasses($user['id']) : $teacher->getClasses($user['id']);

  foreach($classes as $class) {
    $groupByMonth[(new DateTime($class['time']))->format('n')][] = $class;
  }
  $months = array_keys($groupByMonth); // [1,2,3,...,12] 
  sort($months);
  $current_month = isset($_GET['month']) ? $_GET['month'] : array_key_first($groupByMonth); 
  $newClass = array_map(function ($class) {
    global $kelas;
    $class = $kelas->getClass($class['id'], true);
    $classroom_code = sprintf("%s%02d", strtoupper(substr($class['classroom_type'], 0, 3)), $class['classroom_number']); //LEC001
    return [...$class, 'code' => $classroom_code];    
  }, $groupByMonth[$current_month]);
?>

<!-- Schedule -->
<h1 class="text-dark fs-2">🕘 Your Schedule</h1>
<hr>

<div class="mb-4">
  <div class="dropdown mb-3">
    <button class="btn btn-dark dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
      <?= date("F", strtotime($groupByMonth[$current_month][0]['time'])) ?>
    </button>
    <ul id="month-dropdown" class="dropdown-menu dropdown-menu-dark dropdown-menu-macos mx-0 border-0 shadow" style="width: 220px;">
      <?php 
        foreach($months as $month) {
          $month_str = date("F", strtotime($groupByMonth[$month][0]['time']));
          $month_int = date("n", strtotime($groupByMonth[$month][0]['time']));
      ?>
        <li><a class="dropdown-item" style="cursor: pointer;" href="./?dashboard=schedule&month=<?= $month_int ?>"><?= $month_str ?></a></li>
      <?php }?>
    </ul>
  </div>

  <div>
    <?php
      foreach($newClass as $myClass){
    ?>
      <div class="card bg-body my-3" style="">
        <div class="card-body">
          <div class="mb-3 d-flex justify-content-between align-items-center">
            <h5 class="card-title m-0"><?= $myClass['code']." - ".substr($myClass['code'], 0, 3) ?></h5>
            <span class="badge rounded-pill px-3 py-2 <?= $myClass['class_type'] == "Guided Self Learning Class" ? "bg-primary": "bg-danger"?>"><?= $myClass['class_type'] ?></span>
          </div>
          <h6 class="card-subtitle mb-2 text-muted"><?= $myClass['course_name'] ?></h6>
          <ul class="list-unstyled card-text d-grid gap-2 mt-3">
            <li>
              <span>👩🏻‍🏫</span>
              <?= $myClass['teacher_name']?>
            </li>
            <li>
              <span>⌚</span>
              <?= (new DateTime($myClass['time']))->format('g:i A \o\n l jS F Y')?>
            </li>
            <li>
              <span>⚡</span>
              <?= "Session ".$myClass['session']?>
            </li>
            <li>
              <span>📖</span>
              <?= $myClass['material_title']?>
            </li>
            <?php if($myClass['class_type'] != "Guided Self Learning Class") {?>
              <li>
                <span >🔗</span>
                <a href="<?= $myClass['url']?>" target="_blank">Zoom Link</a>
              </li>
            <?php }?>
          </ul>
        </div>
      </div>
    <?php } ?>