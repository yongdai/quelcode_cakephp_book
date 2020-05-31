<h2>ミニオークション</h2>
<h3>※出品されている商品</h3>
<table cellpadding="0" cellspacing="0">
<thead>
    <tr>
        <th class="main" scope="col"><?= $this->Paginator->sort('name') ?></th>
        <th scope="col"><?= __(' 残り時間　') ?></th>
        <th scope="col"><?= __('Image') ?></th>
        <th scope="col"><?= $this->Paginator->sort('finished') ?></th>
        <th scope="col"><?= $this->Paginator->sort('endtime') ?></th>
        <th scope="col" class="actions"><?= __('Actions') ?></th>
    </tr>
</thead>
<tbody>
    <?php foreach($auction as $biditem): ?>
    <tr>
        <td><?= h($biditem->name) ?></td>
        <td class="timer"><?= h($biditem->endtime->i18nFormat('YYYY/MM/dd HH:mm:ss')) ?></td>
        <td><?= $this->Html->image("http://localhost:10020/" . "upimage/" . $biditem->image_path, array('height' => 100, 'width' => 100)) ?></td>
        <td><?= h($biditem->finished ? 'Finished': '') ?></td>
        <td><?= h($biditem->endtime) ?></td>
        <td class="actions">
            <?= $this->Html->link(__('View'), ['action' => 'view', $biditem->id]) ?>
        </td>
    </tr>

    <?php endforeach; ?>
    <?= $this->Html->script('countdown') ?>
</tbody>
</table>
<div class="paginator">
    <ul class="pagination">
        <?= $this->Paginator->first('<< ' . __('first')) ?>
        <?= $this->Paginator->prev('< ' . __('previous')) ?>
        <?= $this->Paginator->numbers() ?>
        <?= $this->Paginator->next(__('next') . ' >') ?>
        <?= $this->Paginator->last(__('last') . ' >>') ?>
    </ul>
</div>