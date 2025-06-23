<?php
require '../src/ProjectsManager.php';
$projectsManager = new ProjectsManager();

if (isset($_GET["id"])) {
    $projectId = $_GET["id"];

    $project = $projectsManager->getProject($projectId);

    if (!$project) {
        header("Location: index.php");
        exit();
    }
} else {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html>

<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
            color: #333;
        }

        h1 {
            text-align: center;
            color: #444;
        }

        p {
            text-align: center;
        }

        form {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        label {
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="number"],
        input[type="color"],
        textarea,
        select {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="radio"],
        input[type="checkbox"] {
            margin-right: 5px;
        }

        input[type="radio"]+label,
        input[type="checkbox"]+label {
            display: inline-block;
            margin-right: 15px;
        }

        fieldset div {
            display: inline-block;
            margin-right: 10px;
        }

        fieldset {
            margin-top: 5px;
            margin-bottom: 15px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        legend {
            font-weight: bold;
        }

        button {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #5cb85c;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background-color: #4cae4c;
        }

        a {
            color: #5cb85c;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
    <title>Détails du projet</title>
</head>

<body>
    <h1>Détails du projet</h1>
    <p><a href="index.php">Retour à l'accueil</a></p>

    <?php if ($_SERVER["REQUEST_METHOD"] == "POST") { ?>
        <?php if (empty($errors)) { ?>
            <p style="color: green;">Le formulaire a été soumis avec succès !</p>
        <?php } else { ?>
            <p style="color: red;">Le formulaire contient des erreurs :</p>
            <ul>
                <?php foreach ($errors as $error) { ?>
                    <li><?php echo $error; ?></li>
                <?php } ?>
            </ul>
        <?php } ?>
    <?php } ?>

    <form>
        <label for="name">Nom :</label>
        <input type="text" id="name" name="name" value="<?= htmlspecialchars($project["name"]) ?>" required minlength="2">

        <br>
        <br>

        <label for="description">Description</label>
        <textarea id="description" name="description" rows="4" cols="30"><?= htmlspecialchars($project["description"]) ?></textarea>

        <br>
        <br>

        <label for="status">Statut :</label>
            <input type="text" id="status" value="<?= htmlspecialchars($project["status"]) ?>" disabled />

        <label for="priority">Priorité :</label>
            <input type="text" id="priority" value="<?= htmlspecialchars($project["priority"]) ?>" disabled />

        <br>
        <br>

        <label for="category">Catégories :</label>
            <input type="text" id="category" value="<?php
                                                        if (!empty($project['category'])) {
                                                            if (is_array($project['category'])) {
                                                                echo htmlspecialchars(implode(', ', $project['category']));
                                                            } else {
                                                                echo htmlspecialchars($project['category']);
                                                            }
                                                        }
                                                        ?>" disabled />

        <br>
        <br>

        <a href="delete.php?id=<?= $project["id"] ?>">
            <button type="button">Supprimer</button>
        </a>
        <br>
        <a href="edit.php?id=<?= $project["id"] ?>">
            <button type="button">Editer</button>
        </a>
    </form>
</body>

</html>