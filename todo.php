<?php
include_once './classes/task_control.php';


?>
<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>To Do List</title>
    <link rel="stylesheet" href="./style/todoStyle.css">
    <!-- jquery plugin -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="https://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <section class="vh-100">
        <div class="container py-5 h-100">
            <div class="row">
                <div class="col-md-12 col-xl-10">

                    <div class="card">
                        <div class="card-header p-3">
                            <h1> </h1>
                        </div>
                        <div class="card-body" data-mdb-perfect-scrollbar="true" style="position: relative; height: 400px">
                            <form method="post" id="form_data">
                                <table class="table mb-0">
                                    <thead>
                                        <tr>
                                            <td>
                                                <h4 style="color:#9ab973; text-decoration:underline;"> Task List</h4>
                                            </td>
                                            <td><input style="background-color: #ffeead;" class="form-control" type="text" placeholder="enter task name" name="taskname" id="taskname" style="color: orange;"><br>
                                                <span id="task_error"></span>
                                            </td>


                                            <td>

                                                <div class="btn-group">
                                                    <button id='btn' type="button" class="btn dropdown-toggle priority-btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">NoPriority</button>
                                                    <ul class="dropdown-menu">
                                                        <li><a name="priority" data-priority="high" class="dropdown-item">High</a></li>
                                                        <li><a name="priority" data-priority="medium" class="dropdown-item">Medium</a></li>
                                                        <li><a name="priority" data-priority="low" class="dropdown-item">Low</a></li>
                                                    </ul>
                                                </div><br>
                                                <span id="priorty_error"></span>
                                            </td>
                                            <td><button style="background-color:#96ceb4;" class="btn btn-success" id="add">Add Task</button></td>

                                        </tr>

                                        <tr style="background-color:#007777; font-size: 16px; color:white; font-family:sans-serif;">
                                            <td> ID</td>
                                            <td> Task Name</td>
                                            <td>Priority</td>
                                            <td>Edit</td>
                                            <td>Save</td>
                                            <td>Delete</td>
                                        </tr>
                                    </thead>
                                    <tbody id="taskslist">


                                    </tbody>
                                </table>
                            </form>

                        </div>



                    </div>

                </div>
            </div>
        </div>
    </section>


    <script src="./scripts/index.js"></script>


</body>

</html>