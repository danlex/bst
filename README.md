Binary Search Tree library
===
Binary Search Tree is a node-based binary tree data structure which has the following properties:
* The left subtree of a node contains only nodes with keys less than the node's key.
* The right subtree of a node contains only nodes with keys greater than the node's key.
* Both the left and right subtrees must also be binary search trees.
* There must be no duplicate nodes

Insertion
===
Insertion begins as asearch would begin; if the key is not equal to that of the root, we search the left or right subtrees as before. Eventually, we will reach an external node and add the new key-value pair (here encoded as a record 'newNode') as its right or left child, depending on the node's key. In other words, we examine the root and recursively insert the new node to the left subtree if its key is less than that of the root, or the right subtree if its key is greater than or equal to the root.

You can insert nodes using insert method or create from array


    $bst = new danlex\bst\BinarySearchTree();
    $bst->insert(1);
    $bst->insert(2);
    $bst->insert(3);
    echo($bst->printTree());

or

    $bst = new danlex\bst\BinarySearchTree();
    $bst->createFromArray(array(1,2,3);
    echo($bst->printTree());

Avl Tree
===
AVL Tree is a self-balancing binary search tree. In an AVL tree, the heights of the two child subtrees of any node differ by at most one; if at any time they differ by more than one, rebalancing is done to restore this property.
Lookup, insertion, and deletion all take O(log n) time in both the average and worst cases.

    $avl = new danlex\bst\AvlTree();
    $avl->createFromArray(array(1,2,3));
    echo($avl->printTree());
    
   
