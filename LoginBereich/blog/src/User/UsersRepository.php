<?php
namespace App\User;

use App\Core\AbstractRepository;

class UsersRepository extends AbstractRepository {

  public function getModelName(){
    return "App\\User\\UserModel";
  }

  public function getTableName(){
  return 'users';
  }
}


 ?>
