<?php
namespace Model;

use \Entity\News;

class NewsManagerPDO extends NewsManager
{
    /**
     * @see NewsManager::add()
     */
    protected function add(News $news)
    {
        $request = $this->dao->prepare('INSERT INTO news(title, category, content, publish, trash, dateCreated, dateModified) 
        VALUES(:title, :category, :content, :publish,  :trash, NOW(), NOW())');

        $request->bindValue(':title', $news->title());
        $request->bindValue(':category', $news->category());
        $request->bindValue(':content', $news->content());
        $request->bindValue(':publish', 'non');
        $request->bindValue(':trash', 'non');
        

        $request->execute();
    }

    /**
     * @see NewsManager::count()
     */
    public function count()
    {
        return $this->dao->query('SELECT COUNT(*) FROM news WHERE trash=\'non\'')->fetchColumn();
    }

     /**
     * @see NewsManager::countPublish()
     */
    public function countPublish()
    {
        return $this->dao->query('SELECT COUNT(*) FROM news WHERE publish=\'oui\'')->fetchColumn();
    }
    

     /**
     * @see NewsManager::countTrash()
     */
    public function countTrash()
    {
        return $this->dao->query('SELECT COUNT(*) FROM news WHERE trash=\'oui\'')->fetchColumn();
    }

    /**
     * @see NewsManager::countCategory()
     */
    public function countNewsByCategoryAdmin($category)
    {
        return $this->dao->query('SELECT COUNT(*) FROM news WHERE category = "'.$category.'" AND trash=\'non\' ORDER BY id DESC')->fetchColumn();
    }

     /**
     * @see NewsManager::countCategory()
     */
    public function countNewsByCategoryPublic($category)
    {
        return $this->dao->query('SELECT COUNT(*) FROM news WHERE category = "'.$category.'" AND trash=\'non\' AND publish=\'oui\' ORDER BY id DESC')->fetchColumn();
    }

    
    
    /**
     * @see NewsManager::delete()
     */
    public function delete($id)
    {
        $this->dao->exec('DELETE FROM news WHERE id = '.(int) $id);
    }

    /**
     * @see NewsManager::getListPublish()
     */
    public function getListPublishByCategory($start = -1, $limit = -1,$category)
    {
        $sql = 'SELECT id, title, category, content, publish, dateCreated, dateModified 
        FROM news
        WHERE publish = \'oui\' AND category = ?
        ORDER BY id DESC';

        //Check if the given param are int
        if ($start != -1 || $limit != -1)
        {
            $sql .= ' LIMIT '.(int) $limit.' OFFSET '.(int) $start;
        }
        

        $request = $this->dao->prepare($sql);
        $request->execute(array($category));
        $request->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\News');
        
        $newsList = $request->fetchAll();
        

        // Use foreach to give instance of DateTime as created date and modified date.
        foreach ($newsList as $news)
        {
            
            $news->setDateCreated(new \DateTime($news->dateCreated()));
            $news->setDateModified(new \DateTime($news->dateModified()));
        }

        $request->closeCursor();

        return $newsList;
    } 

    /**
     * @see NewsManager::getListPublish()
     */
    public function getListByCategoryAdmin($start = -1, $limit = -1,$category)
    {
        $sql = 'SELECT id, title, category, content, publish, dateCreated, dateModified 
        FROM news
        WHERE trash = \'non\' AND category = ?
        ORDER BY id DESC';

        //Check if the given param are int
        if ($start != -1 || $limit != -1)
        {
            $sql .= ' LIMIT '.(int) $limit.' OFFSET '.(int) $start;
        }
        
        $request = $this->dao->prepare($sql);
        $request->execute(array($category));
        $request->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\News');
        
        $newsList = $request->fetchAll();
        

        // Use foreach to give instance of DateTime as created date and modified date.
        foreach ($newsList as $news)
        {
            
            $news->setDateCreated(new \DateTime($news->dateCreated()));
            $news->setDateModified(new \DateTime($news->dateModified()));
        }

        $request->closeCursor();

        return $newsList;
    } 


    /**
     * @see NewsManager::getList()
     */
    public function getList($start = -1, $limit = -1)
    {
        $sql = 'SELECT id, title, category, content, publish, trash, dateCreated, dateModified 
        FROM news
        WHERE trash = \'non\'
        ORDER BY dateCreated DESC';

        //Check if the given param are int
        if ($start != -1 || $limit != -1)
        {
            $sql .= ' LIMIT '.(int) $limit.' OFFSET '.(int) $start;
        }

        $request = $this->dao->query($sql);
        $request->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\News');
        
        $newsList = $request->fetchAll();
        

        // Use foreach to give instance of DateTime as created date and modified date.
        foreach ($newsList as $news)
        {
            
            $news->setDateCreated(new \DateTime($news->dateCreated()));
            $news->setDateModified(new \DateTime($news->dateModified()));
        }

        $request->closeCursor();

        return $newsList;
    } 

     /**
     * @see NewsManager::getLisTinTrash()
     */
    public function getListInTrash($start = -1, $limit = -1)
    {
        $sql = 'SELECT id, title, category, content, publish, trash, dateCreated, dateModified
        FROM news
        WHERE trash = \'oui\'
        ORDER BY id DESC';

        //Check if the given param are int
        if ($start != -1 || $limit != -1)
        {
            $sql .= ' LIMIT '.(int) $limit.' OFFSET '.(int) $start;
        }

        $request = $this->dao->query($sql);
        $request->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\News');
        
        $newsList = $request->fetchAll();
        

        // Use foreach to give instance of DateTime as created date and modified date.
        foreach ($newsList as $news)
        {
            
            $news->setDateCreated(new \DateTime($news->dateCreated()));
            $news->setDateModified(new \DateTime($news->dateModified()));
        }

        $request->closeCursor();

        return $newsList;
    } 


     /**
     * @see NewsManager::getLisTLastPublish()
     */
    public function getListLastPublish($start = -1, $limit = -1)
    {
        $sql = 'SELECT id, title, category, content, publish, trash, dateCreated, dateModified
        FROM news
        WHERE publish = \'oui\'
        ORDER BY id DESC';

        //Check if the given param are int
        if ($start != -1 || $limit != -1)
        {
            $sql .= ' LIMIT '.(int) $limit.' OFFSET '.(int) $start;
        }

        $request = $this->dao->query($sql);
        $request->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\News');
        
        $newsList = $request->fetchAll();
        

        // Use foreach to give instance of DateTime as created date and modified date.
        foreach ($newsList as $news)
        {
            
            $news->setDateCreated(new \DateTime($news->dateCreated()));
            $news->setDateModified(new \DateTime($news->dateModified()));
        }

        $request->closeCursor();

        return $newsList;
    } 

            

    /**
     * @see NewsManager::getUnique()
     */
    public function getUnique($id)
    {
        $request = $this->dao->prepare('SELECT id, title, category, content, publish, trash, dateCreated, dateModified 
        FROM news WHERE id = :id');
        $request->bindValue(':id', (int) $id, \PDO::PARAM_INT);
        $request->execute();

        $request->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\News');

        $news = $request->fetch();

        $news->setDateCreated(new \DateTime($news->dateCreated()));
        $news->setDateModified(new \DateTime($news->dateModified()));
   
        return $news;
    }

    /**
    * @see NewsManager::save()
    */
    public function save (News $news)
    {
        if ($news->isValid())
        {
            $news->isNew() ? $this->add($news) : $this->modify($news);
        }
        else
        {
            throw new RuntimeException('La News doit être valide pour être enregistrée');
        }
    }

    /**
    * @see NewsManager::modify()
    */
    protected function modify(News $news)
    {
    $request = $this->dao->prepare('UPDATE news 
    SET  title = :title, content = :content, publish = :publish, trash = :trash, dateModified = NOW()
    WHERE id = :id');
   
    $request->bindValue(':title', $news->title());
    $request->bindValue(':content', $news->content());
    $request->bindValue(':publish', $news->publish());
    $request->bindValue(':trash', $news->trash());
    $request->bindValue(':id', $news->id(), \PDO::PARAM_INT);

    $request->execute();
    }
 
    
}