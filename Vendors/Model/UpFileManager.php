<?php
namespace Model;

use \MyFram\Manager;
use \Entity\UpFile;

abstract class UpFileManager extends Manager
{
    
/**
     * Method to add a file.
     * @param $Upfile Upfile The file to add
     * @return void
     */
    abstract public function add(UpFile $UpFile);

     /**
    * Method to tell the total number of files
    * @return int
    */
    abstract public function count();

     /**
     * Method to delete a file
     * @param $id int Identification of the file to delete
     * @return void
     */
    abstract public function delete($id);

    /**
     * Method to delete a file
     * @param $id int Identification of the file to delete
     * @return int
     */
    abstract public function UpFileExist($up_filename);


 

}