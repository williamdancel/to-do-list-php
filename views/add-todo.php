<!DOCTYPE html>
<html>
    <head>
        <title>Add To Do List - William</title>
        <link rel="stylesheet" href="<?=$this->uriHandler->getBaseUrl(); ?>/css/style.css">
        <script></script>
    </head>
    <body>
        <div class="container">
            <a href="<?=$this->uriHandler->getBaseUrl(); ?>" class="backBtn">Back</a>
            <h1>Add Task Form</h1>
            <form action="<?=$this->uriHandler->getBaseUrl();?>/save" method="POST" >
                <label for="task_name">Task Name:</label>
                <input class="textClass" type="text" id="task_name" name="name" required><br><br>
                <label for="priority">Priority:</label>
                <select class="selectClass" id="priority" name="priority" required>
                    <option value="3">Low</option>
                    <option value="2">Medium</option>
                    <option value="1">High</option>
                </select><br><br>
                <button class="btn btnAdd" type="submit">Submit Task</button>
            </form>
        </div>
    </body>
</html>