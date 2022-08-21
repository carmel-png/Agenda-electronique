<?php
namespace Calendar;

use Exception;
use LDAP\Result;

class Events{
    private $pdo;
    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * reccupere les evennements entre deux dates
     */
    public function getEventsBetween(\DateTime $start, \DateTime $end): array {
        $sql = "SELECT * FROM events WHERE start BETWEEN '{$start->format('y-m-d 00:00:00')}' AND 
        '{$end->format('y-m-d 23:59:59')}'  ORDER BY start ASC" ;

        $statement = $this->pdo->query($sql);
        $results = $statement->fetchAll();

        return $results; 
    }

     /**
     * reccupere les evennements entre deux dates indexé par jour
     */
    public function getEventsBetweenByDay(\DateTime $start, \DateTime $end): array {
        $events = $this->getEventsBetween($start, $end);
        $days = [];
        foreach($events as $event ){
            $date = explode(' ', $event['start'])[0];
            if(!isset($days[$date])){
                $days[$date]= [$event];
                }else{
                    $days[$date][]=$event;
                }
        }  
        return $days;
      }

      /**
       * reccupere un evennement
       */
      public function find(int $id): Event{

        include("Event.php");
       $statement = $this->pdo->query("SELECT * FROM events WHERE id = $id LIMIT 1");
       $statement->setFetchMode( \PDO::FETCH_CLASS, Event::class);
       $result= $statement->fetch();

       if ($result === false){
           throw new  \Exception('aucun resultat trouve');
       }
       return $result;
      }

      public function hydrate(Event $event, array $data){
          
        $event->setName($data['name']);
        $event->setDescription($data['description']);
        $event->setStart(\DateTime::createFromFormat('y-m-d H:i', $data['date'] . ' ' . $data['start'] )->format('y-m-d H:i'));
        $event->setEnd(\DateTime::createFromFormat('y-m-d H:i', $data['date'] . ' ' . $data['end'] )->format('y-m-d H:i'));

        return $event;
    }

      /**
       * creer un evennemnt dans la base de donnees
       */
      public function create(Event $event): bool{
        $statement= $this->pdo->prepare('INSERT INTO events (name, description, start, end) VALUES (?, ?, ?, ?)');
       return $statement->execute([
            $event->getName(),
            $event->getDescription(),
            $event->getStart()->format('y-m-d H:i:s'),
            $event->getEnd()->format('y-m-d H:i:s')
       ]);
    }

    /**
     * met a jour un evennemnet dans la base de donnees
     */
    public function update(Event $event): bool{
        $statement= $this->pdo->prepare('UPDATE events SET name = ?, description = ?, start = ?, end = ? WHERE id= ?  ');
       return $statement->execute([
            $event->getName(),
            $event->getDescription(),
            $event->getStart()->format('y-m-d H:i:s'),
            $event->getEnd()->format('y-m-d H:i:s'),
            $event->getId()
       ]);
    }

}
?>