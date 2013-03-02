<?php

namespace danlex\bst;

/*
* Balanced Binary Search Tree
*/
class AvlTree extends BinarySearchTree{

    /*
    * @param int $data
    * @return AvlTree
    */
    public function insert($data){
        if ($root = $this->getRoot() === NULL){
            $this->setRoot($this->createNewNode($data));
        } else {
            $this->insertRec($this->getRoot(), $data);
            $this->rebalance();
        }

        return $this;
    }

    public function balance (Node $node = NULL){
        if ($node === NULL){
            return 0;
        }
        return $this->height($node->getLeftNode()) - $this->height($node->getRightNode());
    }

    public function height(Node $node = NULL){
        if ($node === NULL){
             return 0;
        }

        return 1 + max($this->height($node->getLeftNode()), $this->height($node->getRightNode()));
    }

    public function rebalanceRec(Node $rootNode = NULL){
        if ($rootNode === NULL){
           return $rootNode;
        }
        
        $rootNode->setLeftNode($this->rebalanceRec($rootNode->getLeftNode()));
        $rootNode->setRightNode($this->rebalanceRec($rootNode->getRightNode()));
        return $rootNode = $this->rebalanceSubtree($rootNode);
    }
 
    public Function rebalance(){
        $this->setRoot($this->rebalanceRec($this->getRoot()));
    }

    public function rebalanceSubtree(Node $rootNode = NULL){
       if ($rootNode === NULL){
           return $rootNode;
       }
       $balance = $this->balance($rootNode);
       if ($balance === 0){
           return $rootNode;
       }
       if ($balance == -2){ 
           $balanceSecond = $this->balance($rootNode->getRightNode());
           if ($balanceSecond >= 1){ 
                $pivot = $rootNode->getRightNode()->rotateRight();
                $rootNode->setRightNode($pivot);
                $rootNode = $rootNode->rotateLeft();
           }

           if ($balanceSecond <= -1){
                $rootNode = $rootNode->rotateLeft();
           }
       }
       
       if ($balance == 2){
           $balanceSecond = $this->balance($rootNode->getLeftNode());
           if ($balanceSecond >= 1){
                $rootNode = $rootNode->rotateRight();
           }

           if ($balanceSecond <= -1){
                $pivot  = $rootNode->getLeftNode()->rotateLeft();
                $rootNode->setLeftNode($pivot);
                $rootNode = $rootNode->rotateRight();
           }
       }

       return $rootNode;
    }
}
