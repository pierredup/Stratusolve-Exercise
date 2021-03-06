<?php

require('Task.class.php');

if (isset($_POST['TaskId'])) {
    if ('DELETE' === ($_POST['Action'] ?? '')) {
        $task = new Task($_POST['TaskId']);
        $task->Delete();
    } else if (-1 === (int) $_POST['TaskId']) {
        $task = new Task();
        $task->Create($_POST['InputTaskName'] ?? '', $_POST['InputTaskDescription'] ?? '');
    } else {
        $task = new Task($_POST['TaskId']);
        $task->TaskName = $_POST['InputTaskName'] ?? '';
        $task->TaskDescription = $_POST['InputTaskDescription'] ?? '';
    }

    $task->Save();
    echo $task->TaskId;
}

