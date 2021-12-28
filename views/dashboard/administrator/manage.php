<?php 
  global $tableList;
?>
<!-- Administrator -->
<h1 class="text-dark fs-2">🔨 Manage</h1>
<hr>

<div class="accordion" id="accordionExample">
  <?php 
    foreach($tableList as $index => $table) { 
    $tableName = key($table);
  ?>
    <div class="accordion-item">
      <h2 class="accordion-header" id="<?= 'heading'.$index ?>">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#<?= 'collapse'.$index ?>">
          <?= $tableName ?>
        </button>
      </h2>
      <div id="<?= 'collapse'.$index ?>" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
        <div class="accordion-body">
          <div class="d-grid gap-2 d-md-block">
            <a href="" class="btn btn-success">Insert</a>
          </div>
          <div class="scroll-horizontal">
            <table class="table table-responsive">
              <thead>
                <tr>
                  <?php foreach($table[$tableName][0] as $tableColumn => $value) { ?>
                    <th scope="col"><?= $tableColumn ?></th>
                  <?php } ?>
                  <th scope="col" style="width: 14%;"></th></th>
                </tr>
              </thead>
              <tbody>
                  <?php foreach($table[$tableName] as $tableColumn => $value) { ?>
                    <tr>
                      <?php foreach($value as $key => $data) {?>
                        <td><?= $data ?></td>
                      <?php } ?>
                      <td>
                        <a class="btn btn-warning" type="button">Edit</a>
                        <a class="btn btn-danger" type="button">Delete</a>
                      </td>
                    </tr>
                  <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  <?php } ?>
</div>
