 <?php
    $d = new Task_Control();
    $data = $d->displayTasks();
    foreach ((array)$data as $row) {
        echo "<tr ' id='edit_table'>";
        echo "<td class='task_id' value='$row->id'>" . $row->id . "</td>";
        echo "<td class='etaskname'  value='$row->taskname'>" . $row->taskname . "</td> <br> <span class='etask_error'></span>";
        echo "<td class='epriority'  value='$row->priority'>" . $row->priority . "</td>";
        echo "<td><button class='btn' id='edit' class='edit'> <i class='fa fa-edit'></i></button></td>";
        echo "<td><button class='btn' name='save' id='save' ><i class='fa fa-save'></i></button></td>";
        echo '<td><button type="button" class="btn" name="delete" class="delete" id="delete"><i class="fa fa-trash"></i></button></td>';
        // echo "<td>" . $row['why'] . "</td>";

        // echo "<td> <input type=\"button\" value=\"Start Session\"onClick=\accept.php?id=" . $row->id . " &start=true></td>";
    }

    echo "</tr>";
    ?>