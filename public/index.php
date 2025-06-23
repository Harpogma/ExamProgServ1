<?php
require "../src/ProjectsManager.php";

$projectsManager = new ProjectsManager();
$projects = $projectsManager->getProjects();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exam Prog Serv 1</title>

    <style>
        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
            padding: 8px;
        }
    </style>
</head>

<body>
    <h1>Accueil</h1>

    <p><a href="create.php"><button>Créer un nouveau projet</button></a></p>


    <table>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Description</th>
                <th>Status</th>
                <th>Priorité</th>
                <th>Catégorie</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($projects as $project) { ?>
                <tr>
                    <td><?= htmlspecialchars($project['name']) ?></td>
                    <td><?= htmlspecialchars($project['description']) ?></td>
                    <td><?= htmlspecialchars($project['status']) ?></td>
                    <td><?= htmlspecialchars($project['priority']) ?></td>
                    <td><?php
                        if (!empty($project['category'])) {
                            if (is_array($project['category'])) {
                                echo htmlspecialchars(implode(', ', $project['category']));
                            } else {
                                echo htmlspecialchars($project['category']);
                            }
                        }
                        ?>
                    </td>
                    <td>
                        <a href="delete.php?id=<?= htmlspecialchars($project['id']) ?>"><button>Supprimer</button></a>
                        <a href="view.php?id=<?= htmlspecialchars($project['id']) ?>"><button>Visualiser</button></a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>

</html>