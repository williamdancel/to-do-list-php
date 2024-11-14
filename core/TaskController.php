<?php
require_once 'Route.php';
require_once 'Database.php';
require_once 'TaskState.php';
require_once 'UriHandler.php';

class TaskController {
    private $db;
    private $params;
    private $baseUrl;
    private $responseMessage;

    /**
     * Constructor for TaskController
     * Initializes the database connection and URI handler, then routes to the specified function.
     *
     * @param string $uri The URI path for routing to specific functions.
    */
    public function __construct($uri)
    {
        $this->db = new Database;
        $this->uriHandler = new UriHandler;
        $this->goTo($uri);
    }

    /**
     * Displays all tasks.
     * Retrieves all tasks from the database and includes the todo list view.
     * Optionally applies sorting if a session variable 'sort' is set.
    */
    public function viewAll()
    {   
        $allTask = $this->db->get();
        if(isset($_SESSION['sort'])){
            $allTask = $this->db->sort($_SESSION['sort']);
        }

        $priority = TaskState::PRIORITY;
        $status = TaskState::STATUS;
        $completedTasks = array_filter($allTask, function($task) {
            return $task['status'] == 1;
        });
        $totalCompletedTasks = count($completedTasks);
        include_once 'views/todo-list.php';
        unset($_SESSION['responseMessage']);
        unset($_SESSION['errorMessage']);
    }

    /**
     * Displays a specific task for updating.
     * Retrieves a task by its ID and includes the update view.
     */
    public function update(){
        $task = $this->db->get(['id' => $this->params]);
        include_once 'views/update-todo.php';
    }

    /**
     * Displays the add task form.
     */
    public function add()
    {
        include_once 'views/add-todo.php';
    }

    /**
     * Saves a new task to the database.
     * Inserts task data from POST request, sets a success message, and redirects to the base URL.
     */
    public function save(){
        $this->db->insert($_POST);
        $_SESSION['responseMessage'] = 'Add Task Successfully';
        header("Location: {$this->uriHandler->getBaseUrl()}");
    }

    /**
     * Updates an existing task in the database.
     * Updates task data from POST request, sets a success message, and redirects to the base URL.
     */
    public function edit(){
        $this->db->update($_POST);
        $_SESSION['responseMessage'] = 'Update Task Successfully'; 
        header("Location: {$this->uriHandler->getBaseUrl()}");
    }

    /**
     * Deletes a task from the database.
     * Deletes the specified task by its ID, sets a success message, and redirects to the base URL.
     */
    public function delete(){
        $this->db->delete($this->params);
        $_SESSION['errorMessage'] = 'Delete Task Successfully'; 
        header("Location: {$this->uriHandler->getBaseUrl()}");
    }

    /**
     * Sets sorting preferences in the session.
     * Saves sort options from POST request to session and redirects to the base URL.
     */
    public function sort(){
        $_SESSION['sort'] = $_POST; 
        header("Location: {$this->uriHandler->getBaseUrl()}");
    }

    /**
     * Routes to the appropriate method based on URI.
     * Parses the URI to determine the function and any parameters, then calls the corresponding function.
     *
     * @param string $uri The URI path used for routing.
     */
    private function goTo($uri)
    {
        if(strlen($uri) > 1 && str_contains( $uri, '/')) {
            $uriSegments = explode('/', $uri);
            $uri = $uriSegments[0];
            $this->params = $uriSegments[1];
        }

        $function = Route::LIST[$uri];

        $this->$function();
    }
}
?>