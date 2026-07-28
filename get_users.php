<?php
require 'vendor/autoload.php';
require 'config/bootstrap.php';
use Cake\ORM\TableRegistry;

$users = TableRegistry::getTableLocator()->get('Users');

$member = $users->find()->where(['Email' => 'megat@gmail.com'])->first();
$trainer = $users->find()->where(['Email' => 'ain@anytimefitness.com'])->first();

print_r($member->toArray());
print_r($trainer->toArray());
