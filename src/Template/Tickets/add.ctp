
<h1>Add Ticket</h1>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Tickets'), ['controller' => 'Tickets', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Ticket'), ['controller' => 'Tickets', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="index large-9 medium-8 columns content">
<?php
    echo $this->Form->create($ticket); //<form method="post" action="/articles/add">
    // Hard code the user for now.
    echo $this->Form->control('user_id', ['type' => 'hidden', 'value' => 1]);
    echo $this->Form->control('title');
    echo $this->Form->control('body', ['rows' => '3']);
    // belongsTo and hasOne
    //echo $this->Form->control('project_string', ['type' => 'text']);
    //echo $this->Form->control('projects._ids', ['options' => $projects]);

    //echo $this->Form->select(
    //'status', 
    //['Unresolved', 'Resolved'],
    //['empty' => '(choose one)']
    //);
    //echo $this->Form->control('status._ids', ['options' => $status]);
    // belongsToMany
    //echo $this->Form->control('tag_string', ['type' => 'text']);
    echo $this->Form->control('tags._ids', ['options' => $tags]);
    //echo $this->Form->control('tags');
    //hasMany
    //echo $this->Form->control('comments');
    echo $this->Form->button(__('Save Ticket'));
    //echo $this->Form->button(__('Cancel'));
    echo $this->Form->end();
?>
</div>