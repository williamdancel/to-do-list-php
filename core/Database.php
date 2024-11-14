<?php

class Database{
    private $db;

    /**
     * Constructor for Database class.
     * Initializes the SQLite database connection.
    */
    public function __construct()
    {
        $this->initializeDB();
    }

    /**
     * Retrieves tasks from the database.
     * Optionally filters tasks based on provided parameters.
     *
     * @param array|null $params Optional parameters for filtering tasks.
     * @return array Single task if $params is set, otherwise all tasks.
    */
    public function get($params = null) {
        $where = '';
        if(!empty($params)){
            $where = "where ".http_build_query($params); 
        }
        $query = $this->db->query("SELECT * FROM task {$where} ORDER BY name ASC");
        if(isset($params)){
            return $query->fetch(PDO::FETCH_ASSOC);
        }
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Inserts a new task into the database.
     *
     * @param array $data Data for the new task (e.g., name, priority).
    */
    public function insert($data){
        $data['status'] = 0;
        $columns = implode(", ", array_keys($data)); 
        $placeholders = ":" . implode(", :", array_keys($data)); 
        $insertStatement  = $this->db->prepare("INSERT INTO task ($columns) VALUES ($placeholders)");
        foreach ($data as $key => $value) {
            $insertStatement ->bindValue(':' . $key, $value);
        }
        $insertStatement->execute();
    }

     /**
     * Updates an existing task in the database.
     *
     * @param array $data Data to update (id, name, priority, status).
    */
    public function update($data){
        $sql = "UPDATE task SET name= :name, status = :status, priority = :priority WHERE id = :id";
        $updateStatement = $this->db->prepare($sql);
        $updateStatement->bindValue(':id', $data['id'], PDO::PARAM_INT);         
        $updateStatement->bindValue(':name', $data['name'], PDO::PARAM_STR);  
        $updateStatement->bindValue(':priority', $data['priority'], PDO::PARAM_INT); 
        $updateStatement->bindValue(':status', $data['status'], PDO::PARAM_INT); 
        $updateStatement->execute();
    }

    /**
     * Deletes a task from the database.
     *
     * @param int $id ID of the task to delete.
    */
    public function delete($id){

        $sql = "DELETE FROM task WHERE id = :id";
        $deleteStatement = $this->db->prepare($sql);
        $deleteStatement->bindValue(':id', $id, PDO::PARAM_INT);
        $deleteStatement->execute();
    }

    /**
     * Sorts tasks based on specified field(s) and order.
     *
     * @param array $data Sort parameters ('field' and 'sort' order).
     * @return array Sorted list of tasks.
    */
    public function sort($data){
        $orderBy = "{$data['field']} {$data['sort']}";

        if (strpos($data['field'], ',') !== false) {
            $fields = explode(',',$data['field']);
            $orderBy = "{$fields[0]} {$data['sort']}, {$fields[1]} {$data['sort']}" ;
        }
        $sql = "SELECT * FROM task ORDER BY {$orderBy}";
        $sortStatement = $this->db->prepare($sql);
        $sortStatement->execute();
    
        return $sortStatement->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Initializes the SQLite database connection and creates the task table.
     * Also populates the table with dummy data if it does not already exist.
    */
    public function initializeDB(){
        try {
            $this->db = new PDO("sqlite:database.db");
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            $this->db->exec("CREATE TABLE IF NOT EXISTS task (
                id INTEGER PRIMARY KEY, 
                name VARCHAR(255), 
                priority INTEGER, 
                status INTEGER
            )");

            
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }

    }
}

?>