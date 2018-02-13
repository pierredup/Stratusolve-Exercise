<?php

/**
 * This class handles the modification of a task object
 */
class Task
{
    public $TaskId;

    public $TaskName;

    public $TaskDescription;

    protected $TaskDataSource = [];

    public function __construct($Id = null)
    {
        $this->TaskDataSource = json_decode(file_get_contents('Task_Data.json'), true) ?: [];

        if (!$this->LoadFromId($Id)) {
            $this->Create();
        }
    }

    protected function Create()
    {
        // This function needs to generate a new unique ID for the task
        // Assignment: Generate unique id for the new task
        $this->TaskId = $this->getUniqueId();
        $this->TaskName = 'New Task';
        $this->TaskDescription = 'New Description';
    }

    protected function getUniqueId()
    {
        // Assignment: Code to get new unique ID
        return -1; // Placeholder return for now
    }

    protected function LoadFromId($Id = null)
    {
        if ($Id) {
            // Assignment: Code to load details here...
        } else {
            return null;
        }
    }

    public function Save()
    {
        //Assignment: Code to save task here
    }

    public function Delete()
    {
        //Assignment: Code to delete task here
    }
}