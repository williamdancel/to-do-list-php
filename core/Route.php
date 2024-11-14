<?php

enum Route {
    /**
     * Route list constant.
     * 
     * Maps URL paths to controller methods.
     * '/'       => 'viewAll' - Displays all tasks.
     * 'add'     => 'add'     - Shows the form to add a new task.
     * 'update'  => 'update'  - Displays the update form for a specific task.
     * 'save'    => 'save'    - Handles the saving of a new task.
     * 'edit'    => 'edit'    - Handles updating an existing task.
     * 'delete'  => 'delete'  - Handles deleting a specific task.
     * 'sort'    => 'sort'    - Sorts tasks based on selected criteria.
     */
    const LIST = [
        '/' => 'viewAll',
        'add' => 'add',
        'update' => 'update',
        'save'  => 'save',
        'edit'  => 'edit',
        'delete'  => 'delete',
        'sort'  => 'sort'
    ];
}