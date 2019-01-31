<?php
namespace Entity;


use \MyFram\Entity;
/**
   * Class represent a chapter
*/
class UpFile extends Entity
{
   protected   $up_filename,
               $up_file_url,
               $dateCreated;


   //SETTERS//

   public function setUp_filename($up_filename)
   {
      $this->up_filename = $up_filename;
   }

   public function setUp_file_url($up_file_url)
   {
      $this->up_file_url = $up_file_url;
   }

   public function setDateCreated(\DateTime $dateCreated)
   {
      $this->dateCreated = $dateCreated;
   }


   //GETTERS//

   public function up_filename()
   {
      return $this->up_filename;
   }

   public function up_file_url()
   {
      return $this->up_file_url;
   }

   public function dateCreated()
   {
      return $this->dateCreated;
   }

}