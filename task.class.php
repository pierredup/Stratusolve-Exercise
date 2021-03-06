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

    public function __construct(?int $Id = null)
    {
        $this->TaskDataSource = json_decode(file_get_contents('Task_Data.json'), true) ?: [];

        $this->LoadFromId((int) $Id);
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

    protected function getUniqueId(): int
    {
        return (int) max(array_column($this->TaskDataSource, 'TaskId') ?: [0]) + 1;
    }

    protected function LoadFromId(int $Id)
    {
        if ($Id > 0) {
            $task = &$this->TaskDataSource[array_search($Id, array_column($this->TaskDataSource, 'TaskId'), true)];

            $this->TaskId = &$task['TaskId'];
            $this->TaskName = &$task['TaskName'];
            $this->TaskDescription = &$task['TaskDescription'];
        }
    }

    public function Save(): void
    {
        file_put_contents('Task_Data.json', json_encode($this->TaskDataSource, JSON_PRETTY_PRINT));
    }

    public function Delete(): void
    {
        unset($this->TaskDataSource[array_search($this->TaskId, array_column($this->TaskDataSource, 'TaskId'), true)]);
    }
}