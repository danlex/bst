<?php

namespace danlex\bst;

/*
* Balanced Binary Search Tree
* @package danlex\bst
* @author dan_lex@yahoo.com
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

    /*
    * Rebalance recursive starting with curent node
    * Rebalance left subtree, right subtree and current tree 
    * @param Node $rootNode
    * return Node $node
    */
    public function rebalanceRec(Node $rootNode = NULL){
        if ($rootNode === NULL){
           return $rootNode;
        }
        
        $rootNode->setLeftNode($this->rebalanceRec($rootNode->getLeftNode()));
        $rootNode->setRightNode($this->rebalanceRec($rootNode->getRightNode()));
        return $rootNode = $this->rebalanceSubtree($rootNode);
    }
 
    /*
    * Rebalance the tree
    * @return AvlTree
    */
    public Function rebalance(){
        //rebalance recursive starting with the root of the tree
        $this->setRoot($this->rebalanceRec($this->getRoot()));
        return $this;
    }

    /*
    * Rebalance subtree with root given node
    * @param Node $rootNode
    * @return Node $node
    */
    public function rebalanceSubtree(Node $rootNode = NULL){
       if ($rootNode === NULL){
           return $rootNode;
       }
       //calculate the balance of the btree with root $rootNode
       $balance = $this->balance($rootNode);
    
       //the subtree is balanced, we return the root of the tree
       if ($balance === 0){
           return $rootNode;
       }
      
       //the subtree is right heavy
       if ($balance == -2){
           //calculate the balance of the right subtree
           $balanceSecond = $this->balance($rootNode->getRightNode());

           //the tree is right left heavy, we perform right rotation on subtree, 
           //left rotation of the tree
           if ($balanceSecond >= 1){
                //rotate right the pivot the right node of the root 
                $pivot = $rootNode->getRightNode()->rotateRight();
                $rootNode->setRightNode($pivot);
                //rotate left with the pivot root
                $rootNode = $rootNode->rotateLeft();
           }

           //the tree is right right right heavy, we perform simple left rotation
           if ($balanceSecond <= -1){
                rotate left with the pivot root
                $rootNode = $rootNode->rotateLeft();
           }
       }
       
       //the subtree is left heavy
       if ($balance == 2){
           //calculate the balance of the left subtree
           $balanceSecond = $this->balance($rootNode->getLeftNode());

           //the tree is left left heavy, we perform simple right rotation
           if ($balanceSecond >= 1){
                //rotate right with the pivot root
                $rootNode = $rootNode->rotateRight();
           }

           //the tree is left right heavy, we perform left rotation on subtree, 
	   //right rotation of the tree
           if ($balanceSecond <= -1){
                //rotate subtree right with pivot the left node of the root 
                $pivot  = $rootNode->getLeftNode()->rotateLeft();
                $rootNode->setLeftNode($pivot);
                //rotate right with the pivot the root
                $rootNode = $rootNode->rotateRight();
           }
       }

       return $rootNode;
    }
}
