<h2>「<?=$biditem->name ?>」の取引について</h2>
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
    <?php if ($authuser['id'] == $biditem->user_id && $bidinfo->is_shipped === false): ?>
    <?= $this->Form->create($bidinfo, [
        'type' => 'post',
        'url' => ['controller' => 'Auction',
                'action' => 'end', $biditem->id]]) ?>
    <?= $this->Form->hidden('Bidinfo.id', ['value' => $bidinfo->id]) ?>
    <h6>発送はすみましたか？</h6>
    <?= $this->Form->hidden('Bidinfo.is_shipped', ['value' => true]) ?>
    <?= $this->Form->button('発送済み') ?>
    <?= $this->Form->end() ?>
    <?php elseif ($authuser['id'] == $biditem->bidinfo->user->id && $bidinfo->is_received === false): ?>
    <?= $this->Form->create($bidinfo, [
        'type' => 'post',
        'url' => ['controller' => 'Auction',
                'action' => 'end', $biditem->id]]) ?>
    <?= $this->Form->hidden('Bidinfo.id', ['value' => $bidinfo->id]) ?>
    <h6>受取はすみましたか？</h6>
    <?= $this->Form->hidden('Bidinfo.is_received', ['value' => true]) ?>
    <?= $this->Form->button('受領済み') ?>
    <?= $this->Form->end() ?>
    <?php endif; ?>
    <h4><?= __('発送状況スタータス') ?></h4>
    <table cellpadding="0" cellspacing="0">
    <tr>
        <th scope="col">発送済み</th>
        <th scope="col">受取済み</th>
    </tr>
    <tr>
        <td><?php if($bidinfo->is_shipped): ?>発送済み<?php else: ?>未発送<?php endif; ?></td>
        <td><?php if($bidinfo->is_received): ?>受領済み<?php else: ?>未受領<?php endif; ?></td>
    </tr>
    </table>
</div>
<div class="related">
    <?php if ($authuser['id'] == $biditem->bidinfo->user->id): ?>
    <?php if (!isset($bidinfo->ship_name) || !isset($bidinfo->ship_address) || !isset($bidinfo->ship_tel)): ?>
    <h4><?= __('発送先入力フォーム') ?></h4>
    <?= $this->Form->create($bidinfo, [
        'type' => 'post',
        'url' => ['controller' => 'Auction',
                'action' => 'end', $biditem->id]]) ?>
    <?= $this->Form->hidden('Bidinfo.id', ['value' => $bidinfo->id]) ?>
    <?= $this->Form->hidden('Bidinfo.user_id', ['value' => $bidinfo->user_id]) ?>
    <h6>発送元氏名</h6>
    <?= $this->Form->textarea('Bidinfo.ship_name', ['rows' => 1]); ?>
    <h6>発送元住所</h6>
    <?= $this->Form->textarea('Bidinfo.ship_address', ['rows' => 1]); ?>
    <h6>発送元電話番号</h6>
    <?= $this->Form->textarea('Bidinfo.ship_tel', ['rows' => 1]); ?>
    <?= $this->Form->button('配送元情報を確定') ?>
    <?= $this->Form->end() ?>
    <?php else: ?>
    <?php endif; ?>
    <?php else: ?>
        <h4><?= __('発送先情報') ?></h4>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th scope="col">発送先名前</th>
            <th scope="col">発送先住所</th>
            <th scope="col">発送先電話番号</th>
        </tr>
        <tr>
            <td><?php if (isset($bidinfo->ship_name)): ?><?= h($bidinfo->ship_name) ?><?php else: ?>未設定<?php endif; ?></td>
            <td><?php if (isset($bidinfo->ship_address)): ?><?= h($bidinfo->ship_address) ?><?php else: ?>未設定<?php endif; ?></td>
            <td><?php if (isset($bidinfo->ship_tel)): ?><?= h($bidinfo->ship_tel) ?><?php else: ?>未設定<?php endif; ?></td>
        </tr>
    </table>
    <?php endif; ?>
</div>
<div class="related">
    <h4><?= __('取引相手の評価') ?></h4>
    <?php if ($authuser['id'] == $biditem->user_id && (!isset($rating->buyer_rating))): ?>
    <?= $this->Form->create($bidinfo, [
        'type' => 'post',
        'url' => ['controller' => 'Auction',
                'action' => 'end', $biditem->id]]) ?>
    <?= $this->Form->hidden('Ratings.bidinfo_id', ['value' => $bidinfo->id]) ?>
    <?= $this->Form->hidden('Ratings.buyer_id', ['value' => $biditem->bidinfo->user->id]) ?>
    <?= $this->Form->input('Ratings.buyer_rating', array(
        'label' => '相手の評価',
        'options' => array(5 => 5, 4 => 4, 3 => 3, 2 => 2, 1 => 1),
        'empty' => '評価を選択してください。　5=良い〜1=悪い')); ?>
    <h6>評価コメント</h6>
    <?= $this->Form->textarea('Ratings.comment_to_buyer', ['rows' => 1]); ?>
    <?= $this->Form->hidden('Ratings.buyer_rating_created', ['value' => date('Y-m-d H:i:s')]); ?>
    <?= $this->Form->button('評価を確定') ?>
    <?= $this->Form->end() ?>
    <?php elseif ($authuser['id'] == $biditem->bidinfo->user->id && (!isset($rating->seller_rating))): ?>
        <?= $this->Form->create($rating, [
        'type' => 'post',
        'url' => ['controller' => 'Auction',
                'action' => 'end', $biditem->id]]) ?>
    <?= $this->Form->hidden('Ratings.bidinfo_id', ['value' => $bidinfo->id]) ?>
    <?= $this->Form->hidden('Ratings.seller_id', ['value' => $biditem->user_id]) ?>
    <?= $this->Form->input('Ratings.seller_rating', array(
        'label' => '相手の評価',
        'options' => array(5 => 5, 4 => 4, 3 => 3, 2 => 2, 1 => 1),
        'empty' => '評価を選択してください。　5=良い〜1=悪い')); ?>
    <h6>評価コメント</h6>
    <?= $this->Form->textarea('Ratings.comment_to_seller', ['rows' => 1]); ?>
    <?= $this->Form->hidden('Ratings.seller_rating_created', ['value' => date('Y-m-d H:i:s')]); ?>
    <?= $this->Form->button('評価を確定') ?>
    <?= $this->Form->end() ?>
    <?php endif; ?>
    <h6>評価結果</h6>
    <table cellpadding="0" cellspacing="0">
    <tr>
        <th scope="col">Seller評価</th>
        <th scope="col">Buyer評価</th>
    </tr>
    <tr>
        <td><?= h($rating->buyer_rating) ?></td>
        <td><?= h($rating->seller_rating) ?></td>
    </tr>
    </table>
</div>
<div class="related">
    <h4><?= __('メッセージ一覧') ?></h4>
    <table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th class="main" scope="col"><?= $this->Paginator->sort('メッセージ') ?></th>
            <th scope="col"><?= $this->Paginator->sort('送信者') ?></th>
            <th scope="col"><?= $this->Paginator->sort('created') ?></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($messages as $message): ?>
            <tr>
                <td><?= $this->Html->link(__(h($message->message)), ['action' => 'msg', $message->bidinfo_id]) ?></td>
                <td><?= h($message->user->username) ?></td>
                <td><?= h($message->created) ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
    </table>
</div>