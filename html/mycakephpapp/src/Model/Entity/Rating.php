<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Rating Entity
 *
 * @property int $id
 * @property int $bidinfo_id
 * @property int $buyer_id
 * @property int $buyer_rating
 * @property string $comment_to_buyer
 * @property \Cake\I18n\FrozenTime $buyer_rating_created
 * @property int $seller_id
 * @property int $seller_rating
 * @property string $comment_to_seller
 * @property \Cake\I18n\FrozenTime $seller_rating_created
 *
 * @property \App\Model\Entity\Bidinfo $bidinfo
 * @property \App\Model\Entity\Buyer $buyer
 * @property \App\Model\Entity\Seller $seller
 */
class Rating extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'bidinfo_id' => true,
        'buyer_id' => true,
        'buyer_rating' => true,
        'comment_to_buyer' => true,
        'buyer_rating_created' => true,
        'seller_id' => true,
        'seller_rating' => true,
        'comment_to_seller' => true,
        'seller_rating_created' => true,
    ];
}
