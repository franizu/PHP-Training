<?php

namespace App\Post;
use ArrayAccess;
class PostModel implements ArrayAccess
{

  public $id;
  public $title;
  public $content;


    public function offsetSet($offset, $value) {

      if (isset(get_object_vars(this)[$offset])){
        $this ->$offset = $value;
      }
    }

    public function offsetExists($offset) {
      if (isset(get_object_vars(this)[$offset])){
        return isset($this->$offset);
      }

    public function offsetUnset($offset) {
      if (isset(get_object_vars(this)[$offset])){
        unset($this-> $offset);
      }
    }

    public function offsetGet($offset){
      if (isset(get_object_vars(this)[$offset])){
      return $this->$offset;
      }
    }


}
 ?>
