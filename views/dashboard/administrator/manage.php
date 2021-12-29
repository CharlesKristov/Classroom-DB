<?php
global $tableList;
?>
<!-- Administrator -->
<h1 class="text-dark fs-2">🔨 Manage</h1>
<hr>

<div class="accordion" id="accordionExample">
  <?php
  foreach ($tableList as $index => $table) {
    $tableName = key($table);
  ?>
    <div class="accordion-item">
      <h2 class="accordion-header" id="<?= 'heading' . $index ?>">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#<?= 'collapse' . $index ?>">
          <?= ucwords(join(" ", explode("_", $tableName))) ?>
        </button>
      </h2>
      <div id="<?= 'collapse' . $index ?>" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
        <div class="accordion-body">
          <div class="d-grid gap-2 d-md-block">
            <a class="btn btn-success" onclick="insertRow('<?= $tableName ?>')">Insert</a>
          </div>
          <div class="scroll-horizontal">
            <table id="table-<?= $tableName; ?>" class="table table-responsive">
              <thead>
                <tr>
                  <?php foreach ($table[$tableName][0] as $tableColumn => $value) { ?>
                    <th scope="col"><?= $tableColumn ?></th>
                  <?php } ?>
                  <th scope="col" style="width: 20%;"></th>
                  </th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($table[$tableName] as $tableColumn => $value) { ?>
                  <tr>
                    <?php foreach ($value as $key => $data) { ?>
                      <td><?= $data ?></td>
                    <?php } ?>
                    <td>
                      <button type="button" class="btn btn-warning m-1" onclick="editRow('<?= $tableName ?>', this.parentNode.parentNode)">Edit</button>
                      <button type="button" class="btn btn-danger m-1" onclick="deleteRow('<?= $tableName ?>', this.parentNode.parentNode)">Delete</button>
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
<script>
  /**
   *  
   * Function to get data from table
   * author: @Oiko78
   * @param {string} table
   * @param {HTMLElement} element
   */
  const getData = (table, element) => {
    const index = Array.from(element.parentNode.children).indexOf(element);
    const tableEle = document.querySelector(`#table-${table}`);
    const columnEle = tableEle.querySelector("thead > tr").children;
    const rowEle = tableEle.querySelector(`tbody tr:nth-child(${index + 1})`).children;
    const columns = [];
    const row = [];
    for (let i = 0; i < columnEle.length - 1; i++) {
      columns.push(columnEle.item(i).textContent);
    }
    for (let i = 0; i < rowEle.length - 1; i++) {
      row.push(rowEle.item(i).textContent);
    }
    return {
      table,
      columns,
      row
    };
  }


  /**
   *  
   * Function to delete row element from table
   * author: @Oiko78
   * @param {string} table
   * @param {HTMLElement} element
   */
  const deleteRowEle = (table, element) => {
    const index = Array.from(element.parentNode.children).indexOf(element);
    const tableEle = document.querySelector(`#table-${table}`);
    const rowEle = tableEle.querySelector(`tbody tr:nth-child(${index + 1})`);
    rowEle.remove();
  }

  /**
   *  
   * AJAX request to delete row
   * author: @Oiko78
   * @param {string} table
   * @param {HTMLElement} element
   */
  const deleteRow = (table, element) => {
    if (!confirm("Are you sure you want to delete this row?"))
      return;

    const datas = getData(table, element);
    const data = new FormData();
    data.append("table", datas['table']);
    data.append("columns", datas['columns']);
    data.append("row", datas['row']);
    const url = "script/php/deleteRow.php";
    const httpc = new XMLHttpRequest();
    httpc.addEventListener("load", function() {
      if (this.responseText !== "") {
        deleteRowEle(table, element);
      } else {
        alert("data is not exist! please reload the page.");
        window.location.reload(true);
      }
    });
    httpc.open("POST", url, true);
    httpc.send(data);
  }

  const editRow = (table, element) => {
    const datas = getData(table, element);
    const data = new FormData();
    data.append("table", datas['table']);
    data.append("columns", datas['columns']);
    data.append("row", datas['row']);
    data.append("method", "edit");
    // AJAX post request to form.php
    const url = "views/dashboard/administrator/form.php";
    const httpc = new XMLHttpRequest();
    httpc.open("POST", url, true);
    httpc.send(data);
    // Redirect user to form.php
    window.location.href = "./?dashboard=administrator&administrator=form";
  }

  const insertRow = (table) => {
    const data = new FormData();
    data.append("table", table);
    data.append("method", "insert");
    const url = "views/dashboard/administrator/form.php";
    const httpc = new XMLHttpRequest();
    httpc.open("POST", url, true);
    httpc.send(data);
    window.location.href = "./?dashboard=administrator&administrator=form";
  }
</script>