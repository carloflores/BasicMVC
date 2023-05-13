<h1>Edit Task</h1>
<form method="POST" action="/tasks/<?= $task->id ?>">
    <div class="form-group">
        <label for="description">Task Description</label>
        <input type="text" class="form-control" id="description" name="description"
            value="<?= htmlspecialchars($task->description) ?>" required>
    </div>
    <button type="submit" class="btn btn-primary">Save Task</button>
</form>