<?php
class Task_Control
{

    //=====================================(Add Task)==================================
    function add_Task()
    {

        if (isset($_POST['saveSubmit'])) {
            echo "hello add function";
            if (empty($_POST['taskName'])) {
                echo "please enter your task name";
                $error = true;
                die();
            } else {
                $taskName = $_POST['taskName'];
                $error = false;
            }
            if (($_POST['priority']) === "NoPriority") {

                echo "please enter your task priorty ";
                $error = true;
                die();
            } else {
                $priority = $_POST['priority'];
                $error = false;
            }
            if ($error === false) {

                $atask = new Tasks();
                $atask->taskname = $taskName;
                $atask->priority = $priority;
                $atask->save();
                $atask->id;
                echo json_encode(array('status' => 'success'));
            } else {
                echo json_encode(array('status' => 'error'));
            }
        }
    }


    //=========================================(Display Tasks)============================================

    function displayTasks()
    {
        if (isset($_GET['display'])) {
            $tasks = Tasks::fetch();
            echo json_encode($tasks);
            return (array)$tasks;
        }
        exit();
    }


    //=========================================(Update Task)=============================================
    public function update_task()
    {

        echo "i love update";

        if (isset($_REQUEST['update'])) {
            $taskName = $_REQUEST['taskName'];
            $priority = $_REQUEST['priority'];
            $id = $_REQUEST['id'];

            if (empty($_REQUEST['taskName'])) {
                echo 'Please Enter Your Task Name!';
                $error = true;
            } else {
                $error = false;
            }
        }
        if (empty($_REQUEST['priority'])) {
            echo 'Please Enter task priority!';
            $error = true;
        } else {
            $error = false;
        }
        if ($error === false) {
            $task = Tasks::get($id);
            $task->taskname = $taskName;
            $task->priority = $priority;
            $task->save();
            echo json_encode(array('status' => 'success'));
        } else {
            echo "there is something wrong";

            exit();
        }
    }


    //============================================(Delete Task)=========================================
    public function delete_task()
    {
        if (isset($_REQUEST['delete'])) {
            $id = $_REQUEST['id'];
            $task = Tasks::get($id);
            if ($task->delete()) {
                echo json_encode(array('status' => 'success'));
            } else {
                echo json_encode(array('status' => 'error'));
            }
        }
        exit();
    }
}
