<?php
declare(strict_types=1);

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Core\Configure;
use Cake\Http\Exception\ForbiddenException;
use Cake\Http\Exception\NotFoundException;
use Cake\Http\Response;
use Cake\View\Exception\MissingTemplateException;

/**
 * Static content controller
 *
 * This controller will render views from templates/Pages/
 *
 * @link https://book.cakephp.org/4/en/controllers/pages-controller.html
 */
class PagesController extends AppController
{
    /**
     * Displays a view
     *
     * @param string ...$path Path segments.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Http\Exception\ForbiddenException When a directory traversal attempt.
     * @throws \Cake\View\Exception\MissingTemplateException When the view file could not
     *   be found and in debug mode.
     * @throws \Cake\Http\Exception\NotFoundException When the view file could not
     *   be found and not in debug mode.
     * @throws \Cake\View\Exception\MissingTemplateException In debug mode.
     */
    public function display(string ...$path): ?Response
    {
        if (!$path) {
            return $this->redirect('/');
        }
        if (in_array('..', $path, true) || in_array('.', $path, true)) {
            throw new ForbiddenException();
        }
        $page = $subpage = null;

        if (!empty($path[0])) {
            $page = $path[0];
        }
        if (!empty($path[1])) {
            $subpage = $path[1];
        }
        $this->set(compact('page', 'subpage'));

        // Inject live stats when displaying the admin dashboard
        if ($page === 'admin') {
            $totalUsers        = $this->fetchTable('Users')->find()->count();
            $activeMemberships = $this->fetchTable('Memberships')->find()
                ->where(['Status' => 'active'])
                ->count();
            $classesToday      = $this->fetchTable('Classes')->find()
                ->where([
                    'DATE(StartTime)' => date('Y-m-d'),
                ])
                ->count();
            $totalTrainers     = $this->fetchTable('Trainers')->find()->count();

            $this->set(compact('totalUsers', 'activeMemberships', 'classesToday', 'totalTrainers'));
        }

        // Inject logged-in user, active membership, booked classes, and pricing packages for the home page
        if ($page === 'home') {
            $user = $this->getRequest()->getSession()->read('Auth.User');
            $myBookings = [];
            $activeMembership = null;

            $packages = $this->fetchTable('Packages')->find()
                ->orderBy(['Price' => 'ASC'])
                ->all()
                ->toArray();

            if ($user) {
                $userId = is_object($user) ? $user->UserID : ($user['UserID'] ?? null);

                $myBookings = $this->fetchTable('Bookings')->find()
                    ->where(['Bookings.UserID' => $userId])
                    ->contain(['Classes' => ['Users']])
                    ->orderBy(['Classes.StartTime' => 'ASC'])
                    ->all()
                    ->toArray();

                if (strtolower(is_object($user) ? $user->Role : ($user['Role'] ?? '')) === 'trainer') {
                    $activeMembership = new \App\Model\Entity\Membership([
                        'Status' => 'Active',
                        'StartDate' => new \Cake\I18n\FrozenTime(),
                        'EndDate' => new \Cake\I18n\FrozenTime('+10 years'),
                        'package' => new \App\Model\Entity\Package([
                            'PackageName' => 'Staff Access',
                            'Price' => 0.00
                        ])
                    ]);
                } else {
                    $activeMembership = $this->fetchTable('Memberships')->find()
                        ->where([
                            'Memberships.UserID' => $userId,
                            'Memberships.Status IN' => ['Active', 'active']
                        ])
                        ->contain(['Packages'])
                        ->orderBy(['Memberships.StartDate' => 'DESC', 'Memberships.MembershipID' => 'DESC'])
                        ->first();

                    if (!$activeMembership) {
                        $activeMembership = $this->fetchTable('Memberships')->find()
                            ->where(['Memberships.UserID' => $userId])
                            ->contain(['Packages'])
                            ->orderBy(['Memberships.StartDate' => 'DESC', 'Memberships.MembershipID' => 'DESC'])
                            ->first();
                    }
                }
            }

            $this->set(compact('user', 'myBookings', 'activeMembership', 'packages'));
        }

        try {
            return $this->render(implode('/', $path));
        } catch (MissingTemplateException $exception) {
            if (Configure::read('debug')) {
                throw $exception;
            }
            throw new NotFoundException();
        }
    }
}
