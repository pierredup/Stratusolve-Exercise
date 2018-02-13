<?php

$taskData = json_decode(file_get_contents('Task_Data.json'));

$html = '<a id="newTask" href="#" class="list-group-item" data-toggle="modal" data-target="#myModal">
                    <h4 class="list-group-item-heading">No Tasks Available</h4>
                    <p class="list-group-item-text">Click here to create one</p>
                </a>';

if (!$taskData) {
    die($html);
}

if (count($taskData) > 0) {
    $html = '';
    foreach ($taskData as $task) {
        $html .= '<a id="'.$task->TaskId.'" href="#" class="list-group-item" data-toggle="modal" data-target="#myModal">
                    <h4 class="list-group-item-heading">'.$task->TaskName.'</h4>
                    <p class="list-group-item-text">'.$task->TaskDescription.'</p>
                </a>';
    }
}
die($html);
