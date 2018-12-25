<?php
namespace Model;

use \Entity\User;

class UserManagerPDO extends UserManager
{
    /**
     * @see UserManager::add()
     */
    protected function add(User $user)
    {
        $request = $this->dao->prepare('INSERT INTO users(familyName, firstName, email, password, status, trash, dateCreated) 
        VALUES(:familyName, :firstName, :email, :password, :status, :trash, NOW())');

        $request->bindValue(':familyName', $user->familyName());
        $request->bindValue(':firstName', $user->firstName());
        $request->bindValue(':email', $user->email());
        $request->bindValue(':password', $user->password());
        $request->bindValue(':status', 'utilisateur');
        $request->bindValue(':trash', 'non');
        

        $request->execute();
    }

     /**
     * @see UserManager::mailExist()
     */
    public function mailExist($email)
    {
        $request = $this->dao->prepare('SELECT * FROM users WHERE email = ?');
        $request->execute(array($email));
        $mailExist = $request->rowCount();

        return $mailExist;
    }

     /**
     * @see UserManager:userExist()
     */
    public function userExist($email,$password)
    {
        $request = $this->dao->prepare('SELECT * FROM users WHERE email = ? AND password = ?');
        $request->execute(array($email, $password));
        $userExist = $request->rowCount();

        return $userExist;
    }



    /**
     * @see UserManager::count()
     */
    public function count()
    {
        return $this->dao->query('SELECT COUNT(*) FROM users')->fetchColumn();
    }

   

     /**
     * @see UserManager::count()
     */
    public function countTrash()
    {
        return $this->dao->query('SELECT COUNT(*) FROM users WHERE trash = \'oui\' ')->fetchColumn();
    }

    /**
     * @see UserManager::delete()
     */
    public function delete($id)
    {
        $this->dao->exec('DELETE FROM users WHERE id = '.(int) $id);
    }

    /**
    * @see UserManager::confirm()
    */
    public function getUserByEmail($email)
    {
        $request = $this->dao->prepare('SELECT id, familyName, firstName, email, password, status
        FROM users WHERE email = :email');
        $request->bindValue(':email', $email);
        $request->execute();

        $request->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\User');

        $user = $request->fetch();

        return $user;
    }

    /**
    * @see UserManager::confirm()
    */
    public function getUserById($id)
    {
        $request = $this->dao->prepare('SELECT id, familyName, firstName, email, password, status
        FROM users WHERE id = :id');
        $request->bindValue(':id', (int) $id, \PDO::PARAM_INT);
        $request->execute();

        $request->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\User');

        $user = $request->fetch();

        return $user;
    }

 

     /**
    * @see UserManager::save()
    */
    public function save(User $user)
    {
        if ($user->isValid())
        {
            $user->isNew() ? $this->add($user) : $this->modify($user);
        }
        else
        {
            throw new RuntimeException('L\'utilisateur doit être valide pour être enregistré');
        }
    }

     /**
    * @see UserManager::modify()
    */
    protected function modify(User $user)
    {
    $request = $this->dao->prepare('UPDATE users 
    SET  familyName = :familyName, firstName = :firstName, email = :email, password = :password, status = :status, trash = :trash
    WHERE id = :id');
   
    $request->bindValue(':familyName', $user->familyName());
    $request->bindValue(':firstName', $user->firstName());
    $request->bindValue(':email', $user->email());
    $request->bindValue(':password', $user->password());
    $request->bindValue(':status', $user->status());
    $request->bindValue(':trash', $user->trash());
    $request->bindValue(':id', $user->id(), \PDO::PARAM_INT);

    $request->execute();
    }

    /**
     * @see UserManager::getList()
     */
    public function getList($start = -1, $limit = -1)
    {
        $sql = 'SELECT id, familyName, firstName, email, password, status, trash, dateCreated
        FROM users
        WHERE trash = \'non\'
        ORDER BY familyName ASC';

        //Check if the given param are int
        if ($start != -1 || $limit != -1)
        {
            $sql .= ' LIMIT '.(int) $limit.' OFFSET '.(int) $start;
        }

        $request = $this->dao->query($sql);
        $request->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\User');
        
        $usersList = $request->fetchAll();
        

        // Use foreach to give instance of DateTime as created date and modified date.
        foreach ($usersList as $user)
        { 
            $user->setDateCreated(new \DateTime($user->dateCreated()));
        }

        $request->closeCursor();

        return $usersList;
    } 


     /**
     * @see UserManager::getTrashList()
     */
    public function getTrashList($start = -1, $limit = -1)
    {

        $sql = 'SELECT id, familyName, firstName, email, password, status, trash, dateCreated
        FROM users
        WHERE trash = \'oui\'
        ORDER BY familyName ASC';
        //Check if the given param are int
        if ($start != -1 || $limit != -1)
        {
            $sql .= ' LIMIT '.(int) $limit.' OFFSET '.(int) $start;
        }

        $request = $this->dao->query($sql);
        $request->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\User');
        
        $usersList = $request->fetchAll();
        

        // Use foreach to give instance of DateTime as created date and modified date.
        foreach ($usersList as $user)
        {
            $user->setDateCreated(new \DateTime($user->dateCreated()));
        }

        $request->closeCursor();

        return $usersList;
    } 

}