<?php
class Event {
    private $eventName;
    private $eventType;
    private $date;
    private $location;
    private $description;

    public function __construct($eventName, $eventType, $date, $location, $description) {
        $this->eventName = $eventName;
        $this->eventType = $eventType;
        $this->date = $date;
        $this->location = $location;
        $this->description = $description;
    }
}
?>
