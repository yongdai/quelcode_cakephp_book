<h2>「<?=$biditem->name ?>」の情報</h2>
<table class="vertical-table">
<tr>
    <th class="small" scope="row">出品者</th>
    <td><?= $biditem->has('user') ? $biditem->user->username : '' ?></td>
</tr>
<tr>
    <th scope="row">商品名</th>
    <td><?= h($biditem->name) ?></td>
</tr>
<tr>
    <th scope="row">商品ID</th>
    <td><?= $this->Number->format($biditem->id) ?></td>
</tr>
<tr>
    <th scope="row">終了時間</th>
    <td class="endtime"><?= h($biditem->endtime->i18nFormat('YYYY/MM/dd HH:mm:ss')) ?></td>
</tr>
</table>
<?= $this->Html->script('countdown') ?>
<div class="related">
    <h4><?= __('落札情報') ?></h4>
    <?php if (!empty($biditem->bidinfo)): ?>
    <table cellpadding="0" cellspacing="0">
    <tr>
        <th scope="col">落札者</th>
        <th scope="col">落札金額</th>
        <th scope="col">落札日時</th>
    </tr>
    <tr>
        <td><?= h($biditem->bidinfo->user->username) ?></td>
        <td><?= h($biditem->bidinfo->price) ?>円</td>
        <td><?= h($biditem->endtime->i18nFormat('YYYY/MM/dd HH:mm:ss')) ?></td>
    </tr>
    </table>
    <?php else: ?>
    <p><?= '※落札情報は、ありません。' ?></p>
    <?php endif; ?>
</div>
<div class="related">
    <h4><?= __('発送状況スタータス') ?></h4>
    <?php if (!empty($biditem->bidinfo)): ?>
    <table cellpadding="0" cellspacing="0">
    <tr>
        <th scope="col">発送済み</th>
        <th scope="col">受取済み</th>
    </tr>
    <tr>
        <td></td>
        <td></td>
    </tr>
    </table>
    <?php else: ?>
    <p><?= '※落札情報は、ありません。' ?></p>
    <?php endif; ?>
</div>
<div class="related">
    <?php if (!isset($bidinfo->ship_name) || !isset($bidinfo->ship_address) || !isset($bidinfo->ship_tel)): ?>
    <h4><?= __('発送先入力フォーム') ?></h4>
    <?= $this->Form->create($bidinfo) ?>
    <?= $this->Form->hidden('bidinfo_id', ['value' => $bidinfo->id]) ?>
    <?= $this->Form->hidden('user_id', ['value' => $bidinfo->user_id]) ?>
    <h6>発送元氏名</h6>
    <?= $this->Form->textarea('ship_name', ['rows' => 1]); ?>
    <h6>発送元住所</h6>
    <?= $this->Form->textarea('ship_address', ['rows' => 1]); ?>
    <h6>発送元電話番号</h6>
    <?= $this->Form->textarea('ship_tel', ['rows' => 1]); ?>
    <?= $this->Form->button('配送元情報を確定') ?>
    <?= $this->Form->end() ?>
    <?php else: ?>
    <?= h($bidinfo->ship_name) ?>
    <?= h($bidinfo->ship_address) ?>
    <?= h($bidinfo->ship_tel) ?>
    <?php endif; ?>
    <?php if (!empty($biditem->bidinfo)): ?>
    <table cellpadding="0" cellspacing="0">
    <tr>
        <th scope="col">発送済み</th>
        <th scope="col">受取済み</th>
    </tr>
    <tr>
        <td><?= h($biditem->bidinfo->user->username) ?></td>
        <td><?= h($biditem->bidinfo->price) ?>円</td>
    </tr>
    </table>
    <?php else: ?>
    <p><?= '※落札情報は、ありません。' ?></p>
    <?php endif; ?>
</div>
<div class="related">
    <h4><?= __('取引相手の評価') ?></h4>
    <?php if (!empty($biditem->bidinfo)): ?>
    <table cellpadding="0" cellspacing="0">
    <tr>
        <th scope="col">発送済み</th>
        <th scope="col">受取済み</th>
    </tr>
    <tr>
        <td><?= h($biditem->bidinfo->user->username) ?></td>
        <td><?= h($biditem->bidinfo->price) ?>円</td>
    </tr>
    </table>
    <?php else: ?>
    <p><?= '※落札情報は、ありません。' ?></p>
    <?php endif; ?>
</div>
<div class="related">
    <h4><?= __('メッセージ一覧') ?></h4>
    <?php if (!empty($biditem->bidinfo)): ?>
    <table cellpadding="0" cellspacing="0">
    <tr>
        <th scope="col">発送済み</th>
        <th scope="col">受取済み</th>
    </tr>
    <tr>
        <td><?= h($biditem->bidinfo->user->username) ?></td>
        <td><?= h($biditem->bidinfo->price) ?>円</td>
    </tr>
    </table>
    <?php else: ?>
    <p><?= '※落札情報は、ありません。' ?></p>
    <?php endif; ?>
</div>