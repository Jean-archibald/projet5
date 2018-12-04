<?php
namespace Entity;

/**
   * Class represent a chapter
*/
class UpFile 
{
   protected   $up_id,
               $up_filename,
               $up_filesize,
               $up_title,
               $up_description,
               $up_finalname,
               $up_filedate,
               $up_mid,
               $errors;


   public function __construct(array $donnees = [])
   {
      if(!empty($donnees))
      {
         $this->hydrate($donnees);
      }
   }

   //SETTERS//

   public function setUp_id($up_id)
   {
      $this->up_id = (int) $up_id;
   }

   public function setUp_filename($up_filename)
   {
      $this->content = $content;
   }

   public function setUp_filesize($up_filesize)
   {
      $this->up_filesize = (int) $up_filesize;
   }

   public function setUp_title($up_title)
   {
      $this->up_title = $up_title;
   }
   
   public function setUp_description($up_description)
   {
      $this->up_description = $up_description;
   }

   public function setUp_finalname($up_finalname)
   {
      $this->up_finalname = $up_finalname;
   }

   public function setUp_filedate(\DateTime $up_filedate)
   {
      $this->up_filedate = $up_filedate;
   }

   public function setUp_mid($up_mid)
   {
      $this->up_mid = (int) $up_mid;
   }

   //GETTERS//

   public function up_id()
   {
      return $this->up_id;
   }

   public function up_filename()
   {
      return $this->up_filename;
   }

   public function up_filesize()
   {
      return $this->up_filesize;
   }

   public function up_title()
   {
      return $this->up_title;
   }

   public function up_description()
   {
      return $this->up_description;
   }

   public function up_finalname()
   {
      return $this->up_finalname;
   }

   public function up_filedate()
   {
      return $this->up_filedate;
   }

   public function up_mid()
   {
      return $this->up_mid;
   }

   public function errors()
   {
      return $this->errors;
   }

}