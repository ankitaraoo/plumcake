<h1>Edit Ticket</h1>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Tickets'), ['controller' => 'Tickets', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Ticket'), ['controller' => 'Tickets', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('Search Ticket'), ['controller' => 'Tickets', 'action' => 'tags']) ?></li>
    </ul>
</nav>
<div class="index large-9 medium-8 columns content">
<?php
    echo $this->Form->create($ticket);
    echo $this->Form->control('user_id', ['type' => 'hidden']);
    echo $this->Form->control('title');
    echo $this->Form->control('body', ['rows' => '3']);
        // belongsTo and hasOne
    //echo $this->Form->control('project');
    //echo $this->Form->select(
    'status',
    ['Unresolved', 'Resolved'],
    ['empty' => '(choose one)']
    );
    // belongsToMany
    echo $this->Form->control('tags');
    //hasMany
    //echo $this->Form->control('comments');
    echo $this->Form->button(__('Save Ticket'));
    echo $this->Form->button(__('Cancel'));
    echo $this->Form->end();
?>
</div>