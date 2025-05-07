<?php
require_once 'database.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    try {
        $sql = 'SELECT * FROM `articles`';
        $requete = $db->prepare($sql);
        $requete->execute();
        $articles = $requete->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($articles);
    } catch (PDOException $e) {
        echo json_encode(['error' => 'Erreur lors de la récupération des données']);
    }
    exit; // Arrête l'exécution pour éviter d'inclure le HTML
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>lean ajax</title>
</head>

<body>
    <button id='btn'>Générer les données</button>
    <script>
        document.getElementById('btn').addEventListener('click', function() {
            let xhr = new XMLHttpRequest();
            xhr.open('GET', 'index.php', true); // Configure la requête
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        let response = JSON.parse(xhr.responseText);
                        if (response && response.length > 0) {
                            let html = '<ul>';
                            response.forEach(function(data) {
                                html += '<li>Titre : ' + data.titre + '</li>';
                                html += '<li>Nom : ' + data.nom + '</li>';
                                html += '<li>ID : ' + data.id + '</li>';
                            });
                            html += '</ul>';
                            document.body.innerHTML += html;
                        } else {
                            console.log('Aucun article trouvé.');
                        }
                    } else {
                        console.error('Erreur lors de la requête AJAX.');
                    }
                }
            };
            xhr.send(); // Envoie la requête
        });
    </script>
</body>

</html