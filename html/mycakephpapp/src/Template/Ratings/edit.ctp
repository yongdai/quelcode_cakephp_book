<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Rating $rating
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $rating->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $rating->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Ratings'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="ratings form large-9 medium-8 columns content">
    <?= $this->Form->create($rating) ?>
    <fieldset>
        <legend><?= __('Edit Rating') ?></legend>
        <?php
            echo $this->Form->control('bidinfo_id');
            echo $this->Form->control('buyer_id');
            echo $this->Form->control('buyer_rating');
            echo $this->Form->control('comment_to_buyer');
            echo $this->Form->control('buyer_rating_created');
            echo $this->Form->control('seller_id');
            echo $this->Form->control('seller_rating');
            echo $this->Form->control('comment_to_seller');
            echo $this->Form->control('seller_rating_created');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
