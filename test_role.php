<?php
require 'vendor/autoload.php';
require 'config/bootstrap.php';
use Cake\ORM\TableRegistry;
$users = TableRegistry::getTableLocator()->get('Users');
$u = $users->find()->where(['Username' => 'trainer799'])->first();
var_dump($u->Role);
