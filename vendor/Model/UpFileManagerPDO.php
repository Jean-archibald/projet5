<?php
namespace Model;

use \Entity\UpFile;

class UpFileManagerPDO extends UpFileManager
{
    /**
     * @see UpFileManager::add()
     */
    public function add(UpFile $upfile)
    {
        $request = $this->dao->prepare('INSERT INTO up_file(up_filename, up_file_url, dateCreated) 
        VALUES(:up_filename, :up_file_url, NOW())');

        $request->bindValue(':up_filename', $upfile->up_filename());
        $request->bindValue(':up_file_url', $upfile->up_file_url());
    
        $request->execute();
    }

    /**
     * @see UpFileManager::count()
     */
    public function count()
    {
        return $this->dao->query('SELECT COUNT(*) FROM up_file')->fetchColumn();
    }

    /**
     * @see UpFileManager::delete()
     */
    public function delete($id)
    {
        $this->dao->exec('DELETE FROM up_file WHERE id = '.(int) $id);
    }

     /**
     * @see UpFileManager:UpFileExist()
     */
    public function upFileExist($up_filename)
    {
        $request = $this->dao->prepare('SELECT * FROM up_file WHERE up_filename = ? ');
        $request->execute(array($up_filename));
        $upFileExist = $request->rowCount();

        return $upFileExist;
    }

    /**
     * @see UpFileManager::getList()
     */
    public function getList($start = -1, $limit = -1)
    {
        $sql = 'SELECT id, up_filename, up_file_url, dateCreated
        FROM up_file
        ORDER BY id DESC';

        //Check if the given param are int
        if ($start != -1 || $limit != -1)
        {
            $sql .= ' LIMIT '.(int) $limit.' OFFSET '.(int) $start;
        }

        $request = $this->dao->query($sql);
        $request->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\UpFile');
        
        $filesList = $request->fetchAll();
        

        // Use foreach to give instance of DateTime as created date and modified date.
        foreach ($filesList as $UpFile)
        {
            
            $UpFile->setDateCreated(new \DateTime($UpFile->dateCreated()));
        
        }

        $request->closeCursor();

        return $filesList;
    } 


    /**
    * @see UpFileManager::getFilebyId()
    */
    public function getFileById($id)
    {
        $request = $this->dao->prepare('SELECT id, up_filename, up_file_url, dateCreated
        FROM up_file WHERE id = :id');
        $request->bindValue(':id', (int) $id, \PDO::PARAM_INT);
        $request->execute();

        $request->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\UpFile');

        $UpFile = $request->fetch();

        return $UpFile;
    }


}