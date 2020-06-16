<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Auth\DefaultPasswordHasher;
use Cake\Event\Event;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{

    public function initialize() {

        parent::initialize();

        $this->loadModel('Ratings');
        $this->loadModel('Users');
        $this->loadModel('Biditems');
        $this->loadModel('Bidinfo');
        //各種コンポーネントのロード
        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');
        $this->loadComponent('Auth', [
            'authorize' => ['Controller'],
            'authenticate' => [
                'Form' => [
                    'fields' => [
                        'username' => 'username',
                        'password' => 'password'
                    ]
                ]
            ],
            'loginRedirect' => [
                'controller' => 'Users',
                'action' => 'login'
            ],
            'logoutRedirect' => [
                'controller' => 'Users',
                'action' => 'logout'
            ],
            'authError' => 'ログインしてください',
        ]);
    }

    //ログイン処理
    function login() {
        // POST時の処理
        if ($this->request->isPost()) {
            $user = $this->Auth->identify();
            // Authのidentifyをユーザーに設定
            if (!empty($user)) {
                $this->Auth->setUser($user);
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error('ユーザー名かパスワードが間違っています。');
        }
    }

    // ログアウト処理
    public function logout() {
        //セッションを破棄
        $this->request->session()->destroy();
        return $this->redirect($this->Auth->logout());
    }

    // 認証を使わないページの設定
    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);
        // $this->Auth->allow(['login', 'index', 'add']); // 後で'add'を削除する
        $this->Auth->allow(['login']);
    }

    // 認証時のロールのチェック
    public function isAuthorized($user = null) {
        // 管理者はtrue
        if ($user['role'] === 'admin') {
            return true;
        }
        // 一般ユーザーはfalse
        if ($user['role'] === 'user') {
            return false;
        }
        // 他はすべてfalse
        return false;
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $users = $this->paginate($this->Users);

        $this->set(compact('users'));
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => ['Bidinfo', 'Biditems', 'Bidmessages', 'Bidrequests', 'Ratings'],
        ]);

        $rating = $this->Ratings->find('all', array(
            'conditions' => array(
                'OR' => array(
                    'Ratings.buyer_id' => $id,
                    'Ratings.seller_id' => $id,
                ),
            ),
        ))->all();

        $seller_rating_count = $this->Ratings->find('all')->where(['seller_id' => $id])->count();
        $seller_rating = $this->Ratings->find('all')->where(['seller_id' => $id])->toArray();

        $seller_rating_sum = 0;

        foreach($seller_rating as $value) {
            $seller_rating_sum += $value->seller_rating;
        }

        if ($seller_rating_count === 0) {
            $seller_rating_avg = $seller_rating_sum;
        } else {
            $seller_rating_avg = round($seller_rating_sum / $seller_rating_count);
        }

        $buyer_rating_count = $this->Ratings->find('all')->where(['buyer_id' => $id])->count();
        $buyer_rating = $this->Ratings->find('all')->where(['buyer_id' => $id])->toArray();

        $buyer_rating_sum = 0;

        foreach($buyer_rating as $value) {
            $buyer_rating_sum += $value->buyer_rating;
        }

        if ($buyer_rating_count === 0) {
            $buyer_rating_avg = $buyer_rating_sum;
        } else {
            $buyer_rating_avg = round($buyer_rating_sum / $buyer_rating_count);
        }

        $this->set(compact('user', 'rating', 'buyer_rating_avg', 'seller_rating_avg'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
