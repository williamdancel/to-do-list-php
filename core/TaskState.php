<?php
enum TaskState {

    /**
     * Priority levels for tasks.
     * 
     * '1' => 'High'   - High priority tasks.
     * '2' => 'Medium' - Medium priority tasks.
     * '3' => 'Low'    - Low priority tasks.
     */
    const PRIORITY = [
        '1' => 'High',
        '2' => 'Medium',
        '3' => 'Low',
    ];

    /**
     * Status options for tasks.
     * 
     * '0' => 'In Progress' - Indicates the task is ongoing.
     * '1' => 'Completed'   - Indicates the task is finished.
     */
    const STATUS = [
        '0' => 'In Progress',
        '1' => 'Completed'
    ];

}