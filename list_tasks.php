<?php

$taskData = json_decode(file_get_contents('Task_Data.json'), true);

$html = '';

if ($taskData) {
    foreach ($taskData as $task) {
        $html .= '<a id="'.$task['TaskId'].'" href="#" class="list-group-item" data-toggle="modal" data-target="#myModal">
                    <h4 class="list-group-item-heading">'.$task['TaskName'].'</h4>
                    <p class="list-group-item-text">'.$task['TaskDescription'].'</p>
                </a>';
    }
} else {
    $html = '<a id="newTask" href="#" class="list-group-item" data-toggle="modal" data-target="#myModal">
                    <h4 class="list-group-item-heading">No Tasks Available</h4>
                    <p class="list-group-item-text">Click here to create one</p>
                </a>';
}

echo $html;

