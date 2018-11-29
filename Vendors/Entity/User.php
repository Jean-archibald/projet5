<?php
namespace Entity;

use \MyFram\Entity;
/**
   * Class represent a chapter
*/
class User extends Entity
{
    protected   $familyName,
                $firstName,
                $email,
                $password,
                $status,
                $dateCreated;

    /**
     * Relatives Constants to possible errors during method execution
     */
    const INVALID_FAMILYNAME = 1;
    const INVALID_FIRSTNAME = 2;
    const INVALID_EMAIL = 3;
    const INVALID_PASSWORD = 4;

    /**
     * Method useful to know if the user is valid
     * @return bool
     */
    public function isValid()
    {
        return !(empty($this->familyName) || empty($this->firstName) || empty($this->email) || empty($this->password));
    }

    
    // SETTERS //
    public function setFamilyName($familyName)
    {
        if (!is_string($familyName) || empty($familyName))
        {
            $this->errors[] = self::INVALID_FAMILYNAME;
        }
        else
        {
            $this->familyName = $familyName;
        }
    }

    public function setFirstName($firstName)
    {
        if (!is_string($firstName) || empty($firstName))
        {
            $this->errors[] = self::INVALID_FIRSTNAME;
        }
        else
        {
            $this->firstName = $firstName;
        }
    }

    public function setEmail($email)
    {
        if (!is_string($email) || empty($email))
        {
            $this->errors[] = self::INVALID_EMAIL;
        }
        else
        {
            $this->email = $email;
        }
    }

    public function setPassword($password)
    {
        if (!is_string($password) || empty($password))
        {
            $this->errors[] = self::INVALID_PASSWORD;
        }
        else
        {
            $this->password = $password;
        }
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function setDateCreated(\DateTime $dateCreated)
    {
        $this->dateCreated = $dateCreated;
    }

   

    // GETTERS //
    public function familyName()
    {
        return $this->familyName;
    }

    public function firstName()
    {
        return $this->firstName;
    }

    public function email()
    {
        return $this->email;
    }

    public function password()
    {
        return $this->password;
    }

    public function status()
    {
        return $this->status;
    }

    public function dateCreated()
    {
        return $this->dateCreated;
    }
}