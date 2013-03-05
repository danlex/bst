<?php

namespace danlex\bst;

/*
* Balanced Binary Search Tree
*/
class AvlTree extends BinarySearchTree{

    /*
    * Insert a new node in the tree
    * We compare the vaue to inset with the value 
    * of the current node. We continue recursive in the left subree 
    * if the value of the current node > the value to insert.
    * After we insert the new node we rebalance the tree.
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

    /*
    * Calculate the balance, the diffrence between 
    * the height of the left subtree and the height
    * of the right subtree of the curret node
    * @param Ndde $node
    * @return int
    */
    public function balance (Node $node = NULL){
        if ($node === NULL){
            return 0;
        }
        return $this->height($node->getLeftNode()) - $this->height($node->getRightNode());
    }

    /*
    * Calculate the height of the tree
    * The height is the 1 + maxim of the height 
    * of the left and right subtree
    * @param Node $node
    * @return int
    */
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
