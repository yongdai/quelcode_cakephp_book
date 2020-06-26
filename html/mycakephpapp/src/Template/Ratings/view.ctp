<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Rating $rating
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Rating'), ['action' => 'edit', $rating->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Rating'), ['action' => 'delete', $rating->id], ['confirm' => __('Are you sure you want to delete # {0}?', $rating->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Ratings'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Rating'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="ratings view large-9 medium-8 columns content">
    <h3><?= h($rating->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Comment To Buyer') ?></th>
            <td><?= h($rating->comment_to_buyer) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Comment To Seller') ?></th>
            <td><?= h($rating->comment_to_seller) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($rating->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Bidinfo Id') ?></th>
            <td><?= $this->Number->format($rating->bidinfo_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Buyer Id') ?></th>
            <td><?= $this->Number->format($rating->buyer_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Buyer Rating') ?></th>
            <td><?= $this->Number->format($rating->buyer_rating) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Seller Id') ?></th>
            <td><?= $this->Number->format($rating->seller_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Seller Rating') ?></th>
            <td><?= $this->Number->format($rating->seller_rating) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Buyer Rating Created') ?></th>
            <td><?= h($rating->buyer_rating_created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Seller Rating Created') ?></th>
            <td><?= h($rating->seller_rating_created) ?></td>
        </tr>
    </table>
</div>
