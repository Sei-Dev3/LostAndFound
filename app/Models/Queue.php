<?php
namespace App\Models;

class Queue {
    private $items = [];

    public function enqueue($item) {
        $this->items[] = $item;
    }

    public function dequeue() {
        if (empty($this->items)) {
            return null;
        }

        return array_shift($this->items);
    }

    public function peek() {
        if (empty($this->items)) {
            return null;
        }

        return $this->items[0];
    }

    public function isEmpty() {
        return empty($this->items);
    }

    public function getAll() {
        return $this->items;
    }
}