<!DOCTYPE html>
<html>
    <head>
        <title>To Do List - William</title>
        <link rel="stylesheet" href="css/style.css">
        <script></script>
    </head>
    <body>
        <div class="container">
            <h1 class="text-center">TO DO LIST</h1>
            <?php if(isset($_SESSION['responseMessage'])):?>
                <p class="success-alert-box"><?=$_SESSION['responseMessage']?></p>
            <?php endif; ?>
            <?php if(isset($_SESSION['errorMessage'])):?>
                <p class="error-alert-box"><?=$_SESSION['errorMessage']?></p>
            <?php endif; ?>
            <form action="<?=$this->uriHandler->getBaseUrl();?>/sort" method="POST" class="sort-form">
                <label>Sort By:</label>
                <select name="sort" id="sort">
                    <option value="ASC">Ascending</option>
                    <option value="DESC">Descending</option>
                </select>
                <label>Field:</label>
                <select name="field" id="field">
                    <option value="name,priority">Both</option>
                    <option value="name">Task Name</option>
                    <option value="priority">Priority</option>
                </select>
                <button class="btn btn-sort" type="submit">Filter</button>
            </form>
            <a href="<?=$this->uriHandler->getBaseUrl();?>/add" class="btn btn-add">Add Task</a>
            <table class="styled-table">
                <thead>
                    <tr>
                        <th>Task Name</th>
                        <th>Priority</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php if(empty($allTask)):?>
                    <tr>
                        <td colspan="4" class="centered-cell">No Task Found</td>
                    </tr>
                <?php endif; ?>
                    <?php foreach($allTask as $task): ?>
                    <tr>
                        <td><?=$task['name']?></td>
                        <td><?=$priority[$task['priority']]?></td>
                        <td><?=$status[$task['status']]?></td>
                        <td>
                            <a href="<?=$this->uriHandler->getBaseUrl();?>/update/<?=$task['id']?>" class="btn btn-update">Update</a>
                            <a href="<?=$this->uriHandler->getBaseUrl();?>/delete/<?=$task['id']?>" class="btn btn-delete">Delete</a>
                        </td>
                    </tr>
                   
                    <?php endforeach; ?>
                </tbody>
            </table>
            <p>Total Completed Task: <?=$totalCompletedTasks?> out of <?=count($allTask) ?></p>
        </div>
    </body>
</html>