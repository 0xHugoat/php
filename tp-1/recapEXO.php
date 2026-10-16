
<?php
require_once('connexion.php');

$request = $db->query('SELECT * FROM shows');
$shows = $request->fetchAll();

$request = $db->query('SELECT * FROM showtypes');
$showtypes = $request->fetchAll();

foreach ($shows as $show) {
    foreach ($showtypes as $showtype) {

        if ($show['showTypesId'] == $showtype['id']) {

            echo "Spectacle : " . htmlspecialchars($show['title']) . "<br>";
            echo "Artiste : " . htmlspecialchars($show['performer']) . "<br>";
            echo "Date : " . htmlspecialchars($show['date']) . "<br>";
            echo "Type : " . htmlspecialchars($showtype['type']) . "<br><br>";

        }
    }
}
?>

-------------------------------------------------------------

<?php
   // dans un nouveau fichier que l'on peut nommer index.php
   // ne pas oublier d'importer le fichier connexion.php où l'on créer la connexion PDO
    require_once('connexion.php');

    // requete de mon user :

    // on commence par préparer la requète grace à query()
    $request =  $db->query('SELECT * FROM clients WHERE lastName LIKE "M%" ORDER BY lastName ASC');

    // on récupère la réponse à la requète grâce à fetch(), car je n'ai qu'un seul user en BDD
    $clients = $request->fetchAll();



// var_dump($clients);


   // après avoir récupéré la réponse de votre requète, ne pas hésiter à contrôler les données que l'on reçoit
   // par exemple pour voir le type de donnée que l'on reçoit
foreach ($clients as $client) {
    echo "Nom : " . htmlspecialchars($client['lastName']) .
         "<br> Prénom : " . htmlspecialchars($client['firstName']) .
         "<br><br>";
}

   ?>


-------------------------------------------------------------


<?php
   // dans un nouveau fichier que l'on peut nommer index.php
   // ne pas oublier d'importer le fichier connexion.php où l'on créer la connexion PDO
    require_once('connexion.php');

    // requete de mon user :

    // on commence par préparer la requète grace à query()
    $request =  $db->query('SELECT * FROM clients WHERE cardNumber != "NULL"');

    // on récupère la réponse à la requète grâce à fetch(), car je n'ai qu'un seul user en BDD
    $clients = $request->fetchAll();


    
// var_dump($clients);


   // après avoir récupéré la réponse de votre requète, ne pas hésiter à contrôler les données que l'on reçoit
   // par exemple pour voir le type de donnée que l'on reçoit
foreach ($clients as $client) {
    echo htmlspecialchars($client['lastName']) . " " .htmlspecialchars($client['firstName']) . "<br>";
}

   ?>

-------------------------------------------------------------



<?php
   // dans un nouveau fichier que l'on peut nommer index.php
   // ne pas oublier d'importer le fichier connexion.php où l'on créer la connexion PDO
    require_once('connexion.php');

    // requete de mon user :

    // on commence par préparer la requète grace à query()
    $request =  $db->query('SELECT * FROM clients LIMIT 20');

    // on récupère la réponse à la requète grâce à fetch(), car je n'ai qu'un seul user en BDD
    $clients = $request->fetchAll();


    
// var_dump($clients);


   // après avoir récupéré la réponse de votre requète, ne pas hésiter à contrôler les données que l'on reçoit
   // par exemple pour voir le type de donnée que l'on reçoit
foreach ($clients as $client) {
    echo htmlspecialchars($client['lastName']) . " " .htmlspecialchars($client['firstName']) . "<br>";
}

   ?>



-------------------------------------------------------------


<?php
   // dans un nouveau fichier que l'on peut nommer index.php
   // ne pas oublier d'importer le fichier connexion.php où l'on créer la connexion PDO
    require_once('connexion.php');

    // requete de mon user :

    // on commence par préparer la requète grace à query()
    $request =  $db->query('SELECT * FROM clients');

    // on récupère la réponse à la requète grâce à fetch(), car je n'ai qu'un seul user en BDD
    $clients = $request->fetchAll();


    
// var_dump($clients);


   // après avoir récupéré la réponse de votre requète, ne pas hésiter à contrôler les données que l'on reçoit
   // par exemple pour voir le type de donnée que l'on reçoit
foreach ($clients as $client) {

    echo "Nom : " . htmlspecialchars($client['lastName']) . "<br>";
    echo "Prénom : " . htmlspecialchars($client['firstName']) . "<br>";
    echo "Date de naissance : " . htmlspecialchars($client['birthDate']) . "<br>";

    if ($client['card'] == 1) {
        echo "Carte de fidélité : Oui<br>";
        echo "Numéro de carte : " . htmlspecialchars($client['cardNumber']) . "<br>";
    } else {
        echo "Carte de fidélité : Non<br>";
    }

    echo "<br><br>"; // Espace entre chaque client
}

   ?>