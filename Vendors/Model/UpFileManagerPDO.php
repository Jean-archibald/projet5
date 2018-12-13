<?php
namespace Model;

use \Entity\UpFile;

class UpFileManagerPDO extends UpFileManager
{
    /**
     * @see NewsManager::add()
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


}