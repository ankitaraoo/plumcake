
<h1>Tickets</h1>


<?php /*
    echo $this->Form->create(null, [
    'url' => ['controller' => 'Tickets', ['action' => 'tags', $tags]]
]);
    echo $this->Form->control('tags');
echo $this->Form->button(__('Submit'));
echo $this->Form->end();*/?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Tickets'), ['controller' => 'Tickets', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Ticket'), ['controller' => 'Tickets', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('Search Ticket'), ['controller' => 'Tickets', 'action' => 'tags']) ?></li>
    </ul>
</nav>
<div class="index large-9 medium-8 columns content">
<table>
    <tr>
        <th>Title</th>
        <th>Created</th>
        <th>Action</th>
        
    </tr>

    <!-- Here is where we iterate through our $articles query object, printing out article info -->

    <?php foreach ($tickets as $ticket): ?>
    <tr>
        <td>
            <?= $this->Html->link($ticket->title, ['action' => 'view', $ticket->slug]) ?>
        </td>
        <td>
            <?= $ticket->created->format(DATE_RFC850) ?>
        </td>
        <!--td> 
          <?php /*foreach($ticket->tags as $tag): ?> 
                <?= //h($this->Tags->title) 
                    $this->Html->link(
            $tag->title,
            ['controller' => 'Tickets', 'action' => 'getTags', $ticket->slug]
        ) ?>
            <?php endforeach; */?>
        </td-->
        <td>
            <?= $this->Html->link('Edit', ['action' => 'edit', $ticket->slug]) ?>
            <?= $this->Form->postLink('Delete', ['action' => 'delete', $ticket->slug], ['confirm' => 'Are you sure?']) ?>
        
        </td>
    </tr>
    <?php endforeach; ?>
</table>
</div>