<?php
declare(strict_types=1);

namespace App\Command;

use Cake\Command\Command;
use Cake\Console\Arguments;
use Cake\Console\ConsoleIo;
use Cake\ORM\TableRegistry;

class TestCheckoutCommand extends Command
{
    public function execute(Arguments $args, ConsoleIo $io)
    {
        $users = TableRegistry::getTableLocator()->get('Users');
        $user = $users->get(8);
        $user->FullName = 'Updated Name';
        
        $savedUser = $users->save($user);
        
        if (!$savedUser) {
            $io->error("Failed to save user: " . print_r($user->getErrors(), true));
            return static::CODE_ERROR;
        }
        
        $io->success("User saved! ID: " . $savedUser->UserID);

        $memberships = TableRegistry::getTableLocator()->get('Memberships');
        $membership = $memberships->newEmptyEntity();
        
        $membershipData = [
            'UserID' => $savedUser->UserID,
            'PackageID' => 1,
            'StartDate' => date('Y-m-d'),
            'EndDate' => date('Y-m-d', strtotime('+1 month')),
            'Status' => 'Active'
        ];
        
        $membership = $memberships->patchEntity($membership, $membershipData);
        $savedMembership = $memberships->save($membership);
        
        if (!$savedMembership) {
            $io->error("Failed to save membership: " . print_r($membership->getErrors(), true));
            return static::CODE_ERROR;
        }
        
        $io->success("Membership saved! ID: " . $savedMembership->MembershipID);
        return static::CODE_SUCCESS;
    }
}
