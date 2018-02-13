<?php

/**
 * This class handles the modification of a task object
 */
class Task
{
    public $TaskId;

    public $TaskName;

    public $TaskDescription;

    private $TaskDataSource = [];

    public function __construct($Id = null)
    {
        $this->TaskDataSource = json_decode(file_get_contents('Task_Data.json'), true) ?: [];

        /*if (!$this->LoadFromId($Id)) {

        }*/
    }

    public function Create(string $name, string $description)
    {
        $this->TaskId = $this->getUniqueId();
        $this->TaskName = $name;
        $this->TaskDescription = $description;

        $this->TaskDataSource[] = [
            'TaskId' => $this->TaskId,
            'TaskName' => $this->TaskName,
            'TaskDescription' => $this->TaskDescription,
        ];
    }

    protected function getUniqueId()
    {
        return max(array_column($this->TaskDataSource, 'TaskId')) + 1;
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
        file_put_contents('Task_Data.json', json_encode($this->TaskDataSource, JSON_PRETTY_PRINT));
    }

    public function Delete()
    {
        //Assignment: Code to delete task here
    }
}