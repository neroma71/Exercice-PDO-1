<?php
    $dns = 'mysql:host=localhost;dbname=colyseum' ;
    $user = 'root';
    $password = '';

    try{
        $db = new PDO($dns, $user, $password);
    }
    catch(Exception $message){
        echo "impossible de se connectre" . "<pre>$message</pre>";
    }
    
    $req = $db->query('SELECT * FROM clients WHERE lastName like "M%" ');
    $clients = $req->fetchALL();

    $req = $db->query('SELECT * FROM shows ORDER by title ');
    $shows = $req->fetchALL();

    $req = $db->query('SELECT * FROM clients  GROUP BY cardNumber');
    $cards = $req->fetchALL();

   

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <section class="clients">
        <h2>clients</h2>
<?php
    foreach($clients as $client){
        echo "<p>".$client['firstName']."-".$client['lastName']."-".$client['birthDate']."</p>";
    }

    foreach($cards as $card){
        if(!empty($card['cardNumber'])){
            echo "<p>".$card['lastName']."-".$card['cardNumber']." avec numero de carte</p>";
        }
        else{
            echo "<p>".$card['lastName']." sans numero de carte</p>";
        }
        
    }
 ?>
 </section>
 <section class="shows">
    <h2>Spectacles</h2>
    <?php

        foreach($shows as $show){
            echo "<p>".$show['title']."-".$show['performer']."-".$show['date']."</p>";
        }
    ?>

    
 </section>
</body>
</html>