<?php
require 'vendor/autoload.php';
require 'config/bootstrap.php';
use Cake\ORM\TableRegistry;
$users = TableRegistry::getTableLocator()->get('Users');
$user = $users->find()->first();
var_dump($user->Role, $user->role, $user->ROLE);
