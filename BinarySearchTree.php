<?php

namespace danlex\bst;

/*
* Binary Search Tree
* @package danlex
* @subpackage bst
* @author Alexandru Dan <dan_lex@yahoo.com>
*/
class BinarySearchTree{
    
    /*
    * @access private
    * @var Node
    */
    private $root = NULL;
    
    public function __construct(){
    
    }

    /*
    * @return BinarySearchTree
    */
    public function getRoot(){
        return $this->root;
    }
    
    /*
    * @param Node $node
    * @return BinarySearchTree
    */
    public function setRoot(Node $node){
        $this->root = $node;
        return $this;
    }
    
    /*
    * @param int $data
    * @return BinarySearchTree
    */
    public function insert($data){
        if ($root = $this->getRoot() === NULL){
            $this->setRoot($this->createNewNode($data));
        } else {
            $this->insertRec($this->getRoot(), $data);
        }
        
        return $this;
    }
    
    /*
    * @param Node $node
    * @param int $data
    * @return BinarySearchTree
    */
    public function insertRec(Node $node, $data){
        if($data < $node->getData()){
            $leftNode = $node->getLeftNode();
            if($leftNode !== NULL){
                $this->insertRec($leftNode, $data);
            } else {
                $node->setLeftNode($this->createNewNode($data));
            }
        } else {
            $rightNode = $node->getRightNode();
            if($rightNode !== NULL){
		$this->insertRec($rightNode, $data);
            } else {
                $node->setRightNode($this->createNewNode($data));
            }
        }
    }
    
    /*
    * @access protected
    * @param int $data
    * @return BinarySearchTree
    */
    protected function createNewNode($data){
        $newNode = new Node();
        $newNode->setData($data);
        return $newNode;
    }
    
    /*
    * Print tree
    */
    public function printTree(){
        echo $this->printTreeRec($this->getRoot());
    }

    /*
    * @access private
    * @param Node $node NULL
    * @return string
    */
    private function printTreeRec(Node $node = NULL){
        if($node === NULL){
            return '';
        } else {
            return 
                $this->printTreeRec($node->getLeftNode())
                . ' '.$node->getData()
                . $this->printTreeRec($node->getRightNode());
        }
    }

    /*
    * @param Array $array 
    */
    public function createFromArray(Array $array){
        foreach($array as $item){
            $this->insert($item);
        }
        return $this;
    }

    /*
    * @return Array 
    */
    public function toArray(){
        $root = $this->getRoot();
        if ($root === NULL){
            return array();
        }
        return $this->toArrayRec($root);
    }

    /*
    * @access private
    * @param Node $node NULL
    * @return array
    */
    private function toArrayRec(Node $node){
        $leftNode = $node->getLeftNode();
        $rightNode = $node->getRightNode();
        if ($leftNode === NULL && $rightNode === NULL){
            return $node->getData();
        }
        if ($leftNode !== NULL) {
            $return[$node->getData()]['left'] = $this->toArrayRec($leftNode);
        }
        if ($rightNode !== NULL){
            $return[$node->getData()]['right'] = $this->toArrayRec($rightNode);
        }

        return $return;
    }

    /*
    * @param int $data
    * @return boolean
    */
    public function lookup($data){
        return $this->lookupRec($this->getRoot(), $data);
    }

    /*
    * @access private
    * @param Node $node NULL
    * @param int $data
    * @return boolean
    */
    private function lookupRec(Node $node = NULL, $data){
        if ($node === NULL) {
            return false;
        } elseif($data === $node->getData()){
            return true;
        } elseif($node->getData() < $data){
            return $this->lookupRec($node->getRightNode(), $data);
        } else {
            return $this->lookupRec($node->getLeftNode(), $data);
        }
    }

    /*
    * 
    * @param int $nodesCount
    * @return int
    */
    public function countTrees($nodesCount){
        if($nodesCount === 0){
             return 1;
        } elseif($nodesCount === 1){
             return 1;
        } else {
             $countTrees = 0;
             for($i = 1; $i <= $nodesCount; $i++){
                 $countTrees += $this->countTrees($i - 1) * $this->countTrees($nodesCount - $i);
             }
             return $countTrees;
        }
    }


    /*
    * calculate the number of nodes in the tree
    * @return int
    */
    public function size(){
         return $this->sizeRec($this->getRoot()); 
    }

    /*
    * calculate the number of nodes of the subtree
    * @access private
    * @return int
    */
    private function sizeRec(Node $node = NULL){
        if($node === NULL) {
            return 0;
        } else {
            return $this->sizeRec($node->getLeftNode()) + 1 + $this->sizeRec($node->getRightNode());
        }
    }

    /*
    * @return boolean
    */
    public function isBST(){
       return $this->isBSTRec($this->getRoot(), -PHP_INT_MAX, PHP_INT_MAX);
    }

    /*
    * @access private 
    * @param Node $node
    * @param int min
    * @param int max
    * @return booleaan
    */
    private function isBSTRec(Node $node = NULL, $min, $max){
        if ($node === NULL){
            return true;
        } elseif($node->getData() < $min || $node->getData() > $max) {
            return false; 
        } else {
            return 
                $this->isBSTRec($node->getLeftNode(), $min, $node->getData()) && 
                $this->isBSTRec($node->getRightNode(), $node->getData(), $max);
        }       
    }
    

    /*
    */
    public function printPaths(){
       $path = array();
       $htis->printPathsRec($this->getRoot(), $path, 0);
    }

    /*
    * @access private
    * @param Node $node
    */
    private function printPathsRec(Node $node = NULL, $path = array(), $pathLen = 0) {
     if ($node === NULL){
            return;
        } else {
            $this->pathLen ++;
            $this->path[$this->pathLen] = $node->getData();
        }
    }
}
