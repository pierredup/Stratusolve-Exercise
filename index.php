<!DOCTYPE html>
<html>
<head>
    <title>Basic Task Manager</title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
</head>
<body>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Modal title</h4>
            </div>
            <div class="modal-body">
                <form action="update_task.php" method="post" id="taskForm">
                    <div class="row">
                        <div class="col-md-12" style="margin-bottom: 5px;;">
                            <input id="InputTaskName" name="InputTaskName" type="text" placeholder="Task Name" class="form-control">
                        </div>
                        <div class="col-md-12">
                            <textarea id="InputTaskDescription" name="InputTaskDescription" placeholder="Description" class="form-control"></textarea>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button id="deleteTask" type="button" class="btn btn-danger">Delete Task</button>
                <button id="saveTask" type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>


<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">

        </div>
        <div class="col-md-6">
            <h2 class="page-header">Task List</h2>
            <!-- Button trigger modal -->
            <button id="newTask" type="button" class="btn btn-primary btn-lg" style="width:100%;margin-bottom: 5px;" data-toggle="modal" data-target="#myModal">
                Add Task
            </button>
            <div id="TaskList" class="list-group">
                <!-- Assignment: These are simply dummy tasks to show how it should look and work. You need to dynamically update this list with actual tasks -->
            </div>
        </div>
        <div class="col-md-3">

        </div>
    </div>
</div>
</body>
<script type="text/javascript" src="assets/js/jquery-1.12.3.min.js"></script>
<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
<script type="text/javascript">
    var currentTaskId = -1;
    var taskForm = $('#taskForm');

    var taskName = $('#InputTaskName');
    var taskDescription = $('#InputTaskDescription');

    $('#myModal').on('show.bs.modal', function (event) {
        var triggerElement = $(event.relatedTarget); // Element that triggered the modal
        var modal = $(this);
        if (triggerElement.attr("id") == 'newTask') {
            modal.find('.modal-title').text('New Task');
            $('#deleteTask').hide();
            currentTaskId = -1;
        } else {
            modal.find('.modal-title').text('Task details');
            $('#deleteTask').show();
            currentTaskId = triggerElement.attr("id");

            taskName.val(triggerElement.find('.list-group-item-heading').text());
            taskDescription.val(triggerElement.find('.list-group-item-text').text());

            console.log('Task ID: '+triggerElement.attr("id"));
        }
    }).on('hide.bs.modal', function () {
        taskName.val('');
        taskDescription.val('');
    });

    $('#saveTask').click(function() {
        $.ajax({
            url: taskForm.prop('action'),
            method: 'POST',
            data: taskForm.serialize() + '&TaskId=' + currentTaskId
        }).done(function (result) {
            alert('Save... Id:'+result);
            $('#myModal').modal('hide');
            updateTaskList();
        });
    });

    $('#deleteTask').click(function() {
        $.ajax({
            url: taskForm.prop('action'),
            method: 'POST',
            data: {
                'Action': 'DELETE',
                'TaskId': currentTaskId
            }
        }).done(function (result) {
            alert('Delete... Id:'+currentTaskId);
            $('#myModal').modal('hide');
            updateTaskList();
        });
    });

    function updateTaskList() {
        $.get("Task_Data.json", function( data ) {
            var html = '';

            if (data.length > 0) {
                $.each(data, function (index, task) {
                    console.log(task);
                    html += '<a id="' + task.TaskId + '" href="#" class="list-group-item" data-toggle="modal" data-target="#myModal">\
                                <h4 class="list-group-item-heading">' + task.TaskName + '</h4>\
                                <p class="list-group-item-text">' + task.TaskDescription + '</p>\
                            </a>';
                });
            } else {
                html = '<a id="newTask" href="#" class="list-group-item" data-toggle="modal" data-target="#myModal">\
                            <h4 class="list-group-item-heading">No Tasks Available</h4>\
                            <p class="list-group-item-text">Click here to create one</p>\
                        </a>';
            }

            $( "#TaskList" ).html(html);
        });
    }
    updateTaskList();
</script>
</html>