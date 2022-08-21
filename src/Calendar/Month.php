<?php
 namespace  Calendar;
 
class Month {
    public $days = ['Lundi', 'Mardi',  'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'];

    private $months = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet',
    'Août', 'Septembre', 'Octobre', 'Novembre', 'Decembre'];

    public $month;
    public $year;
    /**
     * constructeur de la class Month (mois)
     * @param int $month  le mois compris entre 1 et 12
     * @param int year l'année
     * @throws \Exception
     */
    public function __construct(?int $month = null, ?int $year = null){
        if ($month === null || $month <1 || $month >12 ){
         $month = intval(date(format: 'm'));
        }
        if ($year === null){
            $year = intval(date(format: 'y'));
        }

/*
        if ($month < 1 || $month > 12 ){
            throw new \Exception(message:"le mois $month n'est pas valide");
        }
        if ($year < 1970 ){
            throw new \Exception(message:"l'année est inferieure a 1970");
        }
        */
/*on reccupere le mois et l'annee du constructeur*/
        $this->month = $month;
        $this->year = $year;
    }

     /**
     * Renvoie le premier jours du mois
     * @param 
     * @param 
     */

    public function getStartingDay (): \DateTime {
        return new \DateTime(  "{$this->year}-{$this->month}-01");

    }

    /**
     * retourne le mois en toute lettre
    */
    public function toString(): string
    {
        return $this->months[$this->month - 1 ] . ' ' . $this->year; 
    }

    /**
     * renvoie le nombre de semaines dans le mois
     */
    public function getWeeks() : int{
        /*$start = new \DateTime(  "{$this->year}-{$this->month}-01");*/
        $start = $this->getStartingDay();
        $end = (clone $start)->modify( '+1 month -1 day');
        $weeks = intval($end->format(format: 'W')) - intval($start->format(format: 'W')) +1;
        if ($weeks < 0 ){
            $weeks= intval($end->format(format: 'W'));
            
        }
        return $weeks;
    }

    /**
     * savoir si le numero du jour est dans le mois en cours
     */
    public function withinMonth( \DateTime $date): bool{
        return $this->getStartingDay()->format('y-m') === $date->format('y-m');

    }

    /**
     * affiche le mois suivant
     */
    public function nextMonth(): Month{
        $month = $this->month+1;
        $year = $this->year;
        if ($month > 12 ){
            $month= 1;
            $year += 1;
        }
        return new Month($month, $year);
    }
     /**
     * affiche le mois précedent
     */
    public function previousMonth(): Month{
        $month = $this->month-1;
        $year = $this->year;
        if ($month < 1 ){
            $month= 12;
            $year -= 1;
        }
        return new Month($month, $year);
    }



}

?>

