<?php
require '../src/DatabaseTest.php';
require '../src/Project.php';

class ProjectsManager {
    private $database;

    public function __construct() {
        $this->database = new DatabaseTest();
    }

    public function getProjects() {
        $sql = "SELECT * FROM projects";

        $stmt = $this->database->getPdo()->prepare($sql);

        $stmt->execute();

        $projects = $stmt->fetchAll();

        return $projects;
    }

    public function getProject($id) {
        $sql = "SELECT * FROM projects WHERE id = :id";

        $stmt = $this->database->getPdo()->prepare($sql);

        $stmt->bindParam(':id', $id);

        $stmt->execute();

        $project = $stmt->fetch();

        if ($project && !empty($project['category'])) {
            $project['category'] = explode(',', $project['category']);
        }

        return $project;
    }

    public function addProject($project) {
        
        $project->validate();

        $sql = "INSERT INTO projects (
            name,
            description,
            status, 
            priority, 
            category
        ) VALUES (
            :name,
            :description,
            :status,
            :priority,
            :category
        )";

        $stmt = $this->database->getPdo()->prepare($sql);

        $stmt->bindValue(':name', $project->getName());
        $stmt->bindValue(':description', $project->getDescription());
        $stmt->bindValue(':status', $project->getStatus());
        $stmt->bindValue(':priority', $project->getPriority());
        $stmt->bindValue(':category', implode(',', $project->getCategory()));

        $stmt->execute();

        $projectId = $this->database->getPdo()->lastInsertId();

        return $projectId;
    }


    public function updateProject($id, $project) {
        $sql = "UPDATE projects SET
            name = :name,
            description = :description,
            status = :status,
            priority = :priority,
            category = :category,
        WHERE id = :id";

        $stmt = $this->database->getPdo()->prepare($sql);

        $stmt->bindValue(':id', $id);
        $stmt->bindValue(':name', $project->getName());
        $stmt->bindValue(':description', $project->getDescription());
        $stmt->bindValue(':status', $project->getStatus());
        $stmt->bindValue(':priority', $project->getPriority());
        $stmt->bindValue(':category', implode(',', $project->getCategory()));

        return $stmt->execute();
    }
}