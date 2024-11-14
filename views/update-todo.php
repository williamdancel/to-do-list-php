<!DOCTYPE html>
<html>
    <head>
        <title>Update To Do List - William</title>
        <link rel="stylesheet" href="<?=$this->uriHandler->getBaseUrl(); ?>/css/style.css">
        <script></script>
    </head>
    <body>
        <div class="container">
            <a href="<?=$this->uriHandler->getBaseUrl(); ?>" class="backBtn">Back</a>
            <h1>Update Task Form</h1>
            <form action="<?=$this->uriHandler->getBaseUrl();?>/edit" method="POST">
                <label for="task_name">Task Name:</label>
                <input  class="textClass" type="text" id="task_name" name="name" value="<?=$task['name']?>" required><br><br>
                <label for="priority">Priority:</label>
                <select class="selectClass" id="priority" name="priority" required>
                    <option value="3" <?php if($task['priority']==3){echo "selected";}?>>Low</option>
                    <option value="2" <?php if($task['priority']==2){echo "selected";}?>>Medium</option>
                    <option value="1" <?php if($task['priority']==1){echo "selected";}?>>High</option>
                </select><br><br>
                <label for="status">Status:</label>
                <select class="selectClass" id="status" name="status" required>
                    <option value="0" <?php if($task['status']==0){echo "selected";}?>>In-Progress</option>
                    <option value="1" <?php if($task['status']==1){echo "selected";}?>>Completed</option>
                </select><br><br>
                <button class="btn btnUpdate" type="submit">Update Task</button>
                <input type="hidden" name="id" value="<?=$task['id'] ?>">
            </form>
        </div>
    </body>
</html>