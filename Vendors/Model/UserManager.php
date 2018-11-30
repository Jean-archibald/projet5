<?php
namespace Model;

use \MyFram\Manager;
use \Entity\User;

abstract class UserManager extends Manager
{
    /**
     * Method to add a user.
     * @param $user User The user to add
     * @return void
     */
    abstract protected function add(User $user);

    /**
    * Method to tell the total number of user
    * @return int
    */
    abstract public function count();

    /**
    * Method to tell the total number of user in Trash
    * @return int
    */
    abstract public function countTrash();

    /**
     * Method to delete a user
     * @param $id int Identification of the user to delete
     * @return void
     */
    abstract public function delete($id);

    /**
    * Method to get a user by his family Name
    * @return bool
    */
    abstract public function getUserByFamilyName($familyName);

    /**
    * Method to get a user by his id
    * @return bool
    */
    abstract public function getUserById($id);

   

    /**
    * Method to confirm password and name of user
    * @return bool
    */
    abstract public function confirmName($name);

    /**
    * Method to confirm password and name of user
    * @return bool
    */
    abstract public function confirmPassword($password);

    /**
     * Method to save a User
     * @param $user User The user to save
     * @see self::add()
     * @see self::modify()
     * @return void
     */
    abstract protected function save(User $user);

    /**
     * Method to modify a user
     * @param $user user the user to modify
     * @return void
     */
    abstract protected function modify(User $user);

    /**
     * Method return a list of all users
     * @param $start int the first member
     * @param $limit int The last member
     * @return array The list of the users, Each entrance is an instance of User.
     */
    abstract public function getList($start ,$limit );

     /**
     * Method return a list of all users
     * @param $start int the first member
     * @param $limit int The last member
     * @return array The list of the users, Each entrance is an instance of User.
     */
    abstract public function getTrashList($start = -1,$limit = -1);
    

}