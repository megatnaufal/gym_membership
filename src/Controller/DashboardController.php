<?php
declare(strict_types=1);

namespace App\Controller;

class DashboardController extends AppController
{
    public function index()
    {
        $this->viewBuilder()->disableAutoLayout();

        $user = $this->getRequest()->getSession()->read('Auth.User');
        if (!$user) {
            $this->Flash->error(__('Please log in to view your dashboard.'));
            return $this->redirect('/?login=1');
        }

        // Redirect admins and trainers to their own portals
        $role = strtolower($user->Role ?? '');
        if ($role === 'admin') {
            return $this->redirect('/admin');
        }
        if ($role === 'trainer') {
            return $this->redirect('/trainer');
        }

        $userId = $user->UserID ?? $user['UserID'];

        // ── Membership ──────────────────────────────────────────────
        $activeMembership = $this->fetchTable('Memberships')->find()
            ->where([
                'Memberships.UserID' => $userId,
                'Memberships.Status IN' => ['Active', 'active'],
            ])
            ->contain(['Packages'])
            ->orderBy(['Memberships.StartDate' => 'DESC'])
            ->first();

        // ── Upcoming Group Class Bookings ────────────────────────────
        $upcomingBookings = $this->fetchTable('Bookings')->find()
            ->where(['Bookings.UserID' => $userId])
            ->contain(['Classes' => ['Users']])
            ->orderBy(['Classes.StartTime' => 'ASC'])
            ->all()
            ->toArray();

        // Filter to only future classes
        $now = new \DateTime();
        $upcomingBookings = array_filter($upcomingBookings, function ($b) use ($now) {
            $class = $b->gym_class ?? null;
            if (!$class) return false;
            $st = $class->StartTime;
            $dt = is_object($st) && method_exists($st, 'toNative') ? $st->toNative() : (is_object($st) ? $st : new \DateTime((string)$st));
            return $dt > $now;
        });

        // ── Next 1-on-1 Lesson ───────────────────────────────────────
        $nextLesson = $this->fetchTable('PrivateLessons')->find()
            ->where([
                'MemberUserID' => $userId,
                'Status' => 'Confirmed',
                'LessonDateTime >=' => $now,
            ])
            ->orderBy(['LessonDateTime' => 'ASC'])
            ->first();

        // Trainer name for next lesson
        $nextLessonTrainerName = null;
        if ($nextLesson) {
            $trainer = $this->fetchTable('Users')->find()
                ->where(['UserID' => $nextLesson->TrainerUserID])
                ->select(['FullName'])
                ->first();
            $nextLessonTrainerName = $trainer->FullName ?? 'Your Trainer';
        }

        // ── Stats ────────────────────────────────────────────────────
        $totalBooked    = $this->fetchTable('Bookings')->find()->where(['UserID' => $userId])->count();
        $totalLessons   = $this->fetchTable('PrivateLessons')->find()->where(['MemberUserID' => $userId])->count();

        $this->set(compact(
            'user',
            'activeMembership',
            'upcomingBookings',
            'nextLesson',
            'nextLessonTrainerName',
            'totalBooked',
            'totalLessons'
        ));
    }
}
