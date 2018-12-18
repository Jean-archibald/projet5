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


     /**
     * Method return a list of asked files
     * @param $start int The first file to select
     * @param $limit int The number of files to select
     * @return array The list of the files, Each entrance is an instance of File.
     */
    abstract public function getList($start = -1,$limit = -1);

    /**
    * Method to get a file
     * @param $id int Identification of the file 
     * @return void
    */
    abstract public function getFileById($id);

}