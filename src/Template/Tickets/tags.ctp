<h1>
    Tickets tagged with
    <?= $this->Text->toList(h($tags), 'or')?>
</h1>
<span>Enter the tag name in the url ('tagged/tagName')</span>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Tickets'), ['controller' => 'Tickets', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Ticket'), ['controller' => 'Tickets', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('Search Ticket'), ['controller' => 'Tickets', 'action' => 'tags']) ?></li>
    </ul>
</nav>
<div class="index large-9 medium-8 columns content">
<section>
<?php foreach ($tickets as $ticket): ?>
    <article>
        <!-- Use the HtmlHelper to create a link -->
        <h4><?= $this->Html->link(
            $ticket->title,
            ['controller' => 'Tickets', 'action' => 'view', $ticket->slug]
        ) ?></h4>
        <span><?= h($ticket->created) ?></span>
        
    </article>
<?php endforeach; ?>
</section>
</div>