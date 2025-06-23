<?php

class Project {
    private $name;
    private $description;
    private $status;
    private $priority;
    private $category;

    public function __construct($name, $description, $status, $priority, $category) {
        $this->name = $name;
        $this->description = $description;
        $this->status = $status;
        $this->priority = $priority;
        $this->category = $category;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setSpecies($description) {
        $this->description = $description;
    }

     public function getStatus() {
        return $this->status;
    }

    public function setStatus($status) {
        $this->status = $status;
    }

     public function getPriority() {
        return $this->priority;
    }

    public function setPriority($priority) {
        $this->priority = $priority;
    }

     public function getCategory() {
        return $this->category;
    }

    public function setCategory($category) {
        $this->category = $category;
    }

    public function validate() {
    $errors = [];

    if (empty($this->name)) {
        array_push($errors, "Le nom est obligatoire.");
    }

    if (strlen($this->name) < 2) {
        array_push($errors, "Le nom doit contenir au moins 2 caractères.");
    }

    if (strlen($this->name) > 100) {
        array_push($errors, "Le nom doit contenir maximum 100 caractères.");
    }

    if (strlen($this->description) < 10) {
        array_push($errors, "La description doit contenir au moins 10 caractères.");
    }

    if (strlen($this->name) > 500) {
        array_push($errors, "La description doit contenir maximum 500 caractères.");
    }

    return $errors;
    }


}
