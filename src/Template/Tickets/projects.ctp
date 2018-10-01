<h1>
    Tickets of Project : 
    <?= $this->Text->toList(h($projects), 'or') ?>
</h1>

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