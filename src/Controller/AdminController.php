<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\I18n\FrozenTime;
use Cake\Datasource\ConnectionManager;

class AdminController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('Flash');
        
        // Ensure user is an admin
        $user = $this->getRequest()->getSession()->read('Auth.User');
        $role = strtolower($user->Role ?? '');
        if ($role !== 'admin') {
            $this->Flash->error(__('You are not authorized to access that location.'));
            $this->redirect('/');
        }
    }

    public function index()
    {
        $this->viewBuilder()->setLayout('default');

        $usersTable = $this->fetchTable('Users');
        $membershipsTable = $this->fetchTable('Memberships');
        $classesTable = $this->fetchTable('Classes');

        $totalUsers = $usersTable->find()->where(['Role' => 'Member'])->count();
        $totalTrainers = $usersTable->find()->where(['Role' => 'Trainer'])->count();
        $activeMemberships = $membershipsTable->find()->where(['Status IN' => ['Active', 'active']])->count();
        
        $today = new FrozenTime('today');
        $classesToday = $classesTable->find()
            ->where(['StartTime >=' => $today, 'StartTime <' => $today->addDays(1)])
            ->count();

        // Revenue data (last 6 months)
        $conn = ConnectionManager::get('default');
        $revenueData = $conn->execute("
            SELECT DATE_FORMAT(m.StartDate, '%b') as month, SUM(p.Price) as revenue
            FROM memberships m
            JOIN packages p ON m.PackageID = p.PackageID
            WHERE m.StartDate >= DATE_SUB(NOW(), INTERVAL 6 MONTH)
            GROUP BY DATE_FORMAT(m.StartDate, '%b'), MONTH(m.StartDate)
            ORDER BY MONTH(m.StartDate) ASC
        ")->fetchAll('assoc');

        $months = [];
        $revenues = [];
        foreach ($revenueData as $row) {
            $months[] = $row['month'];
            $revenues[] = $row['revenue'];
        }

        // Top Classes
        $topClassesQuery = $conn->execute("
            SELECT c.ClassName, COUNT(b.BookingID) as bookings
            FROM classes c
            LEFT JOIN bookings b ON c.ClassID = b.ClassID
            GROUP BY c.ClassID
            ORDER BY bookings DESC
            LIMIT 5
        ")->fetchAll('assoc');
        
        $classNames = [];
        $classBookings = [];
        foreach ($topClassesQuery as $row) {
            $classNames[] = $row['ClassName'];
            $classBookings[] = $row['bookings'];
        }

        $this->set(compact('totalUsers', 'totalTrainers', 'activeMemberships', 'classesToday', 'months', 'revenues', 'classNames', 'classBookings'));
    }

    public function scanner()
    {
        $this->viewBuilder()->setLayout('default');
    }

    public function checkIn()
    {
        $this->request->allowMethod(['post']);
        $this->viewBuilder()->disableAutoLayout();
        
        $token = $this->request->getData('qr_token');
        
        if (strpos($token, 'gym-member-id:') === 0) {
            $userId = (int)str_replace('gym-member-id:', '', $token);
            
            $usersTable = $this->fetchTable('Users');
            $user = $usersTable->find()->where(['UserID' => $userId])->first();
            
            if ($user) {
                // Check membership
                $membershipsTable = $this->fetchTable('Memberships');
                $active = $membershipsTable->find()->where([
                    'UserID' => $userId,
                    'Status IN' => ['Active', 'active']
                ])->first();
                
                $status = $active ? 'Valid' : 'Expired Membership';
                
                // Log attendance
                $conn = ConnectionManager::get('default');
                $conn->insert('attendance', [
                    'user_id' => $userId,
                    'status' => $status,
                    'check_in_time' => (new FrozenTime())->format('Y-m-d H:i:s')
                ]);
                
                return $this->response->withType('application/json')->withStringBody(json_encode([
                    'success' => true,
                    'status' => $status,
                    'user' => $user->FullName
                ]));
            }
        }
        
        return $this->response->withType('application/json')->withStringBody(json_encode([
            'success' => false,
            'message' => 'Invalid QR Code'
        ]));
    }
}
