<?php
require '../src/ProjectsManager.php';
$projectsManager = new ProjectsManager();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $description = $_POST["description"];
    $status = $_POST["status"];
    $priority = $_POST["priority"];
    $category = isset($_POST["personalities"]) ? $_POST["personalities"] : [];

    $project = new Project(
        $name,
        $description,
        $status,
        $priority,
        $category
    );

    $errors = $project->validate();

    if (empty($errors)) {

        $projectId = $projectsManager->addProject($project);
        var_dump($_POST);
    }
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
    <title>Crée un nouvel animal de compagnie | Gestionnaire d'animaux de compagnie</title>
</head>

<body>
    <h1>Crée un nouvel animal de compagnie</h1>
    <p><a href="index.php">Retour à l'accueil</a></p>
    <p>Utilise cette page pour créer un nouvel animal de compagnie.</p>

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

    <form action="create.php" method="POST">
        <label for="name">Nom :</label>
        <input type="text" id="name" name="name" value="<?php if (isset($name)) {
                                                            echo $name;
                                                        } ?>" required minlength="2">

        <br>
        <br>

        <label for="description">Description</label>
        <textarea id="description" name="description" rows="4" cols="30"><?php if (isset($description)) echo $description; ?></textarea>

        <br>
        <br>

        <label for="status">Statut du projet :</label>
        <select id="status" name="status" required>
            <option value="progress" <?php if (isset($status) && $status == "progress") echo "selected"; ?>>En cours</option>
            <option value="done" <?php if (isset($status) && $status == "done") echo "selected"; ?>>Terminé</option>
            <option value="cancelled" <?php if (isset($status) && $status == "cancelled") echo "selected"; ?>>Annulé</option>
        </select>

        <br>
        <br>

        <fieldset>
            <legend>Priorité :</legend>

            <input type="radio" id="low" name="priority" value="low" <?php echo (isset($priority) && $priority == 'low') ? 'checked' : ''; ?> required />
            <label for="low">Basse</label><br>

            <input type="radio" id="medium" name="priority" value="medium" <?php echo (isset($priority) && $priority == 'medium') ? 'checked' : ''; ?> required />
            <label for="medium">Moyenne</label>

            <input type="radio" id="high" name="priority" value="high" <?php echo (isset($priority) && $priority == 'high') ? 'checked' : ''; ?> required />
            <label for="high">Haute</label>
        </fieldset>

        <br>
        <br>

        <fieldset>
            <legend>Catégorie :</legend>

            <div>
                <input type="checkbox" id="development" name="category" value="development" <?php echo (isset($category) && in_array("development", $category)) ? "checked" : ""; ?> />
                <label for="development">Développement</label>
            </div>

            <div>
                <input type="checkbox" id="finance" name="category" value="finance" <?php echo (isset($category) && in_array("finance", $category)) ? "checked" : ""; ?> />
                <label for="finance">Finances</label>
            </div>

            <div>
                <input type="checkbox" id="admin" name="category" value="admin" <?php echo (isset($category) && in_array("admin", $category)) ? "checked" : ""; ?> />
                <label for="admin">Administration</label>
            </div>

            <div>
                <input type="checkbox" id="marketing" name="category" value="marketing" <?php echo (isset($category) && in_array("marketing", $category)) ? "checked" : ""; ?> />
                <label for="marketing">Marketing</label>
            </div>
        </fieldset>

        <br>
        <br>

        <button type="submit">Créer</button><br>
        <button type="reset">Réinitialiser</button>
    </form>
</body>

</html>