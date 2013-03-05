<?php

namespace danlex\bst;

/*
* Tree Node 
* @package danlex
* @subpackage bst
* @author Alexandru Dan <dan_lex@yahoo.com>
*/
class Node {

    /*
    * @access private
    * @var int 
    */
    private $data = NULL;
    
    /*
    * @access private
    * @var Node 
    */
    private $leftNode = NULL;
    
    /*
    * @access private
    * @var Node
    */
    private $rightNode = NULL;

    public function __construct(){
        
    }

    /*
    * @param int $data
    * return Node
    */
    public function setData($data){
       $this->data = $data;
       return $this;
    }

    /*
    * return int
    */
    public function getData(){
       return $this->data;
    }
    
    /*
    * @param Node $node
    * return Node
    */
    public function setLeftNode($node){
        $this->leftNode = $node;
        return $this;
    }
  
    /*
    * return Node
    */
    public function getLeftNode(){
        return $this->leftNode;
    }

    /*
    * @param Node $node
    * return Node
    */
    public function setRightNode($node){
        $this->rightNode = $node;
        return $this;
    }
    
    /*
    * return Node
    */
    public function getRightNode(){
        return $this->rightNode;
    }

    /*
    * Rotate left
    * @return Node
    */
    public function rotateLeft(){
        $pivot = $this->getRightNode();
        $this->setRightNode($pivot->getLeftNode());
        $pivot->setLeftNode($this);
        return $pivot;
    }

    /*
    * Rotate right
    * @return Node
    */
    public function rotateRight(){
        $pivot = $this->getLeftNode();
        $this->setLeftNode($pivot->getRightNode());
        $pivot->setRightNode($this);
        return $pivot;
    }
    
}
