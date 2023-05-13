
<h1>Todo List</h1>
<a href="/tasks/create" class="btn btn-primary mb-3">Add task</a>
<ul class="list-group">
    <?php foreach ($tasks as $task): ?>
        <li class="list-group-item">
            <?= htmlspecialchars($task->description) ?>
            <a href="/tasks/<?= $task->id ?>/edit" class="btn btn-sm btn-secondary float-end">Edit</a>
        </li>
    <?php endforeach; ?>
</ul>