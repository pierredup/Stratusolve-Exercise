<?php

require('Task.class.php');

$task = new Task();

switch ($_POST['action'] ?? null) {
    case 'add':
        $task->Create($_POST['InputTaskName'] ?? '', $_POST['InputTaskDescription'] ?? '');
        $task->Save();

        echo $task->TaskId;
        break;

    case 'edit':
        break;

    case 'delete':
        break;
}