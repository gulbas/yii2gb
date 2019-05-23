<?php
	$this->title = 'Tasks';
	$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?= $this->title ?></h1>

<div class="row">
    <div class="col-sm-12">
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">Description</th>
                <th scope="col">Owner</th>
                <th scope="col">Assigned</th>
                <th scope="col">Deadline</th>
                <th scope="col">Status</th>
            </tr>
            </thead>
            <tbody>
            <tr onclick="document.location = '/task/card?id=<?= $task->id ?>';">
                <th scope="row"><?= $task->id ?></th>
                <td><?= $task->title ?></td>
                <td><?= $task->description ?></td>
                <td><?= $task->owner ?></td>
                <td><?= $task->assigned ?></td>
                <td><?= $task->dedline ?></td>
                <td><?= $task->status ?></td>
            </tr>
            </tbody>
        </table>
    </div>
</div>