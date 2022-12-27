<?php

class Node
{
    public string $name = '';
    public ?Node $parent = null;
    public bool $isDirectory = true;
    public int $size = 0;
    public array $children = [];

    public function __construct(string $name)
    {
        $this->name = $name;
    }
}

function processCommand(Node $rootNode, Node $currentNode, string $line) {
    $command = explode(' ', $line);
        
    if ($command[1] === 'cd') {
        if ($command[2] === '..') {
            return $currentNode->parent;
        } else if ($command[2] === '/') {
            return $rootNode;
        } else {
            $newNode = new Node($command[2]);
            $newNode->parent = $currentNode;

            $currentNode->children[$command[2]] = $newNode;

            return $newNode;
        }
    } else if ($command[1] === 'ls') {
    }

    return $currentNode;
}

function processFile(Node $currentNode, string $line) {
    $command = explode(' ', $line);

    if (isset($currentNode->children[$command[1]])) {
        $newNode = $currentNode->children[$command[1]];
    } else {
        $newNode = new Node($command[1]);
        $newNode->parent = $currentNode;

        $currentNode->children[$command[1]] = $newNode;
    }

    if ($command[0] !== 'dir') {
        $newNode->isDirectory = false;
        $newNode->size        = abs($command[0]);
    }
}

function updateDirectorySize(Node $node) {
    if (!$node->isDirectory) {
        return $node->size;
    }

    $subSize = 0;
    foreach ($node->children as $childNode) {
        $subSize += updateDirectorySize($childNode);
    }
    
    $node->size = $subSize;
    
    return $subSize;
}

function sumOfDirectorySizeLessThanThreshold(Node $node, int $threshold, int $totalSize) {
    if (!$node->isDirectory) {
        return $totalSize;
    }

    foreach ($node->children as $childNode) {
        $totalSize = sumOfDirectorySizeLessThanThreshold($childNode, $threshold, $totalSize);
    }

    if ($node->size <= $threshold) {
        return $node->size + $totalSize;
    }

    return $totalSize;
}

function findSmallestDirectoryGreaterThanSize(Node $node, ?Node $candidateNode, int $targetSize) {
    if (!$node->isDirectory) {
        return $candidateNode;
    }

    foreach ($node->children as $childNode) {
        $candidateNode = findSmallestDirectoryGreaterThanSize($childNode, $candidateNode, $targetSize);
    }

    if ($node->size < $targetSize) {
        return $candidateNode;
    }

    if (!$candidateNode || $node->size <= $candidateNode->size) {
        return $node;
    }

    return $candidateNode;
}

$lines       = file('input.txt');
$breadcrumbs = [];
$structure   = [];
$currentNode = $rootNode = new Node('/');

foreach ($lines as $line) {
    $line = trim($line);

    if (str_starts_with($line, '$')) {
        $currentNode = processCommand($rootNode, $currentNode, $line);
    } else {
        processFile($currentNode, $line);
    }
}

$totalSpace         = 70000000;
$freeSpaceNeeded    = 30000000;
$totalSize          = updateDirectorySize($rootNode);
$currentlyFreeSpace = $totalSpace - $totalSize;
$moreSpaceNeeded    = $freeSpaceNeeded - $currentlyFreeSpace;

echo findSmallestDirectoryGreaterThanSize($rootNode, null, $moreSpaceNeeded)->size;