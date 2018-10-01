<h1><?= h($ticket->title) ?></h1>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Tickets'), ['controller' => 'Tickets', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Ticket'), ['controller' => 'Tickets', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('Search Ticket'), ['controller' => 'Tickets', 'action' => 'tags']) ?></li>
    </ul>
</nav>
<div class="index large-9 medium-8 columns content">
<h5><?= h($ticket->body) ?></h5>
    
<p>Created: <?= $ticket->created->format(DATE_RFC850) ?></p>
    
<p><?= $this->Html->link('Edit', ['action' => 'edit', $ticket->slug]) ?></p>
</div>