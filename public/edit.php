<?php
  include("../src/bootstrap.php");

  $pdo= get_pdo();
  $events = new Calendar\Events($pdo);
  $errors=[];

  /** */
  try{
    $event = $events->find($_GET['id'] ?? null);
  } catch(\Exception $e){
    e404();
  }
  catch(\Error $e){
    e404();
  }

  $data = [
      'name'        => $event->getName(),
      'description' => $event->getDescription(),
      'date'        => $event->getStart()->format('y-m-d'),
      'start'       => $event->getStart()->format('H:i'),
      'end'         => $event->getEnd()->format('H:i')
  ];

  if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $data= $_POST;

    $validator = new Calendar\EventValidator();
    $errors= $validator->validates($data);
    if(empty($errors)){
        $events->hydrate($event, $data);
        $events->update($event);
        header('Location: /index?success=1');
        exit();
      
    }
}

render('header', ['title' => $event->getName()]);

?>

<div class="container">
    <h1> Editer l'evennement 
    <small> <?= /* h($event['name']) ; */ h($event->getName()) ; ?> </small>
    </h1>

<ul>
  <li>Date: <?= $event->getStart()->format('y-d-m');?></li>
  <li>Heure de Démarage: <?= $event->getStart()->format('H-i');?></li>
  <li>Heure de Fin: <?= $event->getEnd()->format('H-i');?></li>
  <li>
    Description: <br>
    <?= h($event->getDescription()) ;  ?>
  </li>
</ul>


    <form action="" method="POST" class="form">
        <?php render('calendar/form', ['data' => $data, 'errors' => $errors]); ?>
        <div class="form-group">
            <button class="btn btn-primary">Modifier</button>
        </div>
    </form>
</div>

<?php render('footer');    ?>
