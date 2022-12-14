<?php
  include("../src/bootstrap.php");


  include("../src/Calendar/Events.php");
     
    $pdo= get_pdo();
  $events = new Calendar\Events($pdo);
  if(!isset($_GET['id'])){
      header('location: 404.php');
  }
  try{
    $event = $events->find($_GET['id']);
  } catch(\Exception $e){
    e404();
  }
  /*$event = $events->find($_GET['id']);
  var_dump($event);*/

render('header', ['title' => $event->getName()]);
/*  include("../views/header.php");*/
?>

<h1>  <?= /* h($event['name']) ; */
   h($event->getName()) ; ?> </h1>

<ul>
  <li>Date: <?= $event->getStart()->format('d/m/y') ; ?></li>
  <li>Heure de démarrage: <?= $event->getStart()->format('H:i') ; ?></li>
  <li>Heure de fin: <?= $event->getEnd()->format('H:i') ; ?></li>
  <li>
    Description: <br>
    <?= h($event->getDescription()); ?>
  </li>
</ul>

<?php include("../views/footer.php");    ?>
