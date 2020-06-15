<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Ratings Model
 *
 * @property \App\Model\Table\BidinfosTable&\Cake\ORM\Association\BelongsTo $Bidinfos
 * @property \App\Model\Table\BuyersTable&\Cake\ORM\Association\BelongsTo $Buyers
 * @property \App\Model\Table\SellersTable&\Cake\ORM\Association\BelongsTo $Sellers
 *
 * @method \App\Model\Entity\Rating get($primaryKey, $options = [])
 * @method \App\Model\Entity\Rating newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Rating[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Rating|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Rating saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Rating patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Rating[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Rating findOrCreate($search, callable $callback = null, $options = [])
 */
class RatingsTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('ratings');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Bidinfos', [
            'foreignKey' => 'bidinfo_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Buyers', [
            'foreignKey' => 'buyer_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Sellers', [
            'foreignKey' => 'seller_id',
            'joinType' => 'INNER',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->integer('buyer_rating')
            ->requirePresence('buyer_rating', 'create')
            ->notEmptyString('buyer_rating');

        $validator
            ->scalar('comment_to_buyer')
            ->maxLength('comment_to_buyer', 255)
            ->requirePresence('comment_to_buyer', 'create')
            ->notEmptyString('comment_to_buyer');

        $validator
            ->dateTime('buyer_rating_created')
            ->requirePresence('buyer_rating_created', 'create')
            ->notEmptyDateTime('buyer_rating_created');

        $validator
            ->integer('seller_rating')
            ->requirePresence('seller_rating', 'create')
            ->notEmptyString('seller_rating');

        $validator
            ->scalar('comment_to_seller')
            ->maxLength('comment_to_seller', 255)
            ->requirePresence('comment_to_seller', 'create')
            ->notEmptyString('comment_to_seller');

        $validator
            ->dateTime('seller_rating_created')
            ->requirePresence('seller_rating_created', 'create')
            ->notEmptyDateTime('seller_rating_created');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['bidinfo_id'], 'Bidinfos'));
        $rules->add($rules->existsIn(['buyer_id'], 'Buyers'));
        $rules->add($rules->existsIn(['seller_id'], 'Sellers'));

        return $rules;
    }
}
