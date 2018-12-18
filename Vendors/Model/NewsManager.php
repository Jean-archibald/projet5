<?php
namespace Model;

use \MyFram\Manager;
use \Entity\News;

abstract class NewsManager extends Manager
{
    /**
     * Method to add a chapter.
     * @param $chapter Chapter The chapter to add
     * @return void
     */
    abstract protected function add(News $news);

    /**
    * Method to tell the total number of chapter
    * @return int
    */
    abstract public function count();

    /**
    * Method to tell the number of chapter to publish
    * @return int
    */
    abstract public function countPublish();

    /**
    * Method to tell the number of chapter in the trash
    * @return int
    */
    abstract public function countTrash();

     /**
    * Method to tell the number of chapter in the search bar
    * @return int
    */
    abstract public function countTitleSearch($q);

    /**
    * Method to tell the number of chapter in the search bar
    * @return int
    */
    abstract public function countContentSearch($q);

    /**
     * Method to delete a chapter
     * @param $id int Identification of the chapter to delete
     * @return void
     */
    abstract public function delete($id);

    /**
     * Method return a list of asked chapters
     * @param $start int The first chapter to select
     * @param $limit int The number of chapter to select
     * @return array The list of the chapters, Each entrance is an instance of Chapter.
     */
    abstract public function getListPublishByCategory($start ,$limit ,$category );

     /**
     * Method return a list of asked chapters
     * @param $start int The first chapter to select
     * @param $limit int The number of chapter to select
     * @return array The list of the chapters, Each entrance is an instance of Chapter.
     */
    abstract public function getList($start = -1,$limit = -1);

    /**
     * Method return a list of asked News
     * @param $start int The first news to select
     * @param $limit int The number of news to select
     * @return array The list of the , Each entrance is an instance of Chapter.
     */
    abstract public function getListInTrash($start = -1,$limit = -1);


    /**
     * Metho return a specific news
     * @param $id int Identification of the news to get
     * @return News the news asked
     */
    abstract public function getUnique($id);

    /**
     * Method to save a News
     * @param $news news The news to save
     * @see self::add()
     * @see self::modify()
     * @return void
     */
    abstract protected function save(News $news);
    
    

    /**
     * Method to modify a news
     * @param $chapter chapter the chapter to modify
     * @return void
     */
    abstract protected function modify(News $news);


    /**
     * Method to search a news
     * @param $id int Identification of the news to get
     * @return News the news asked
     */
    abstract public function searchNewsByTitle($start = -1, $limit = -1,$q);

    /**
     * Method to search a news
     * @param $id int Identification of the news to get
     * @return News the news asked
     */
    abstract public function searchNewsByContent($start = -1, $limit = -1,$q);


    /**
     * Method to search a news
     * @param $id int Identification of the news to get
     * @return News the news asked
     */
    abstract public function searchNewsByConcat($start = -1, $limit = -1,$q);


}