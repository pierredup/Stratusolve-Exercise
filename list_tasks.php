<?php
/**
 * Created by PhpStorm.
 * User: johangriesel
 * Date: 15122016
 * Time: 15:14
 * @package    ${NAMESPACE}
 * @subpackage ${NAME}
 * @author     johangriesel <info@stratusolve.com>
 * Task_Data.json contains the Task data in JSON format, e.g: [{"TaskId":1,"TaskName":"Test","TaskDescription":"Test"},{"TaskId":2,"TaskName":"Test2","TaskDescription":"Test2"}]
 */
$taskData = json_decode(file_get_contents('Task_Data.json'));

$html = '<a id="newTask" href="#" class="list-group-item" data-toggle="modal" data-target="#myModal">
                    <h4 class="list-group-item-heading">No Tasks Available</h4>
                    <p class="list-group-item-text">Click here to create one</p>
                </a>';

if (!$taskData) {
    die($html);
}
if (sizeof($taskData) > 0) {
    $html = '';
    foreach ($taskData as $task) {
        $html .= '<a id="'.$task->TaskId.'" href="#" class="list-group-item" data-toggle="modal" data-target="#myModal">
                    <h4 class="list-group-item-heading">'.$task->TaskName.'</h4>
                    <p class="list-group-item-text">'.$task->TaskDescription.'</p>
                </a>';
    }
}
die($html);
?>