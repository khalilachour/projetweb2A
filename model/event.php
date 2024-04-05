<?php
class Event {
    private $candidateName;
    private $description;
    private $date;
    private $place;
    private $eventName;
    private $eventType;

    public function __construct($candidateName, $description, $date, $place, $eventName, $eventType) {
        $this->candidateName = $candidateName;
        $this->description = $description;
        $this->date = $date;
        $this->place = $place;
        $this->eventName = $eventName;
        $this->eventType = $eventType;
    }
}
?>
