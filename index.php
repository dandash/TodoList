<?php
session_start();
require_once('miniRouter.php');
include_once './dbstalker/core/stalker_configuration.core.php';
include_once './dbstalker/core/stalker_registerar.core.php';
include_once './dbstalker/core/stalker_schema.core.php';
include_once './dbstalker/core/stalker_validator.core.php';
include_once './dbstalker/core/stalker_database.core.php';
include_once './dbstalker/core/stalker_information_schema.core.php';
include_once './dbstalker/core/stalker_query.core.php';
include_once './dbstalker/core/stalker_migrator.core.php';
include_once './dbstalker/core/stalker_backup.core.php';
include_once './dbstalker/core/stalker_table.core.php';
include_once './dbstalker/core/stalker_seed.core.php';
include_once './dbstalker/core/stalker_seeder.core.php';
include_once './dbstalker/core/stalker_view.core.php';
include_once './classes/task_control.php';


foreach (glob("./dbstalker/tables/*.table.php") as $file) {
    require_once $file;
}
foreach (glob("../dbstalker/views/*.view.php") as $file) {
    require_once $file;
}

foreach (glob("../dbstalker/seeds/*.seed.php") as $file) {
    require_once $file;
}

Stalker_Registerar::auto_register();
if (Stalker_Migrator::need_migration()) {
    Stalker_Migrator::migrate();
}

$router = new miniRouter();

$router->group("starkid/TodoList", function ($router) {

    $router->get('/', function () {
        include 'todo.php';
    });
    // $router->get('/home', function () {
    //     include './classes/home.php';
    // });
    // $router->post(
    //     '/login',
    //     [new Server_Control(), 'login'],
    //     //"isLoggedIn"
    // );

    $router->post('/add', [new Task_Control(), 'add_Task']);
    $router->get('/tasks', [new Task_Control(), 'displayTasks']);
    //$router->get('/addtasks', [new Task_Control(), 'add']);
    $router->put('/update', [new Task_Control(), 'update_task']);
    $router->delete('/delete', [new Task_Control(), 'delete_task']);
});
$router->fallback(function () {
    echo "Page Not Found";
});


$router->start_routing();
