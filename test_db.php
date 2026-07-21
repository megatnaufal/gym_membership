<?php
require 'config/bootstrap.php';
$table = \Cake\ORM\TableRegistry::getTableLocator()->get('Memberships');
$entity = $table->newEntity([
    'UserID' => 1,
    'PackageID' => 1,
    'StartDate' => date('Y-m-d'),
    'EndDate' => date('Y-m-d', strtotime('+1 month')),
    'Status' => 'Active'
]);
print_r($entity->getErrors());
