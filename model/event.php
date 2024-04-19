class Event {
    private $eventId;
    private $candidateName;
    private $description;
    private $date;
    private $place;
    private $eventName;
    private $eventType;

    public function __construct($candidateName, $description, $date, $place, $eventName, $eventType) {
        $this->setCandidateName($candidateName);
        $this->setDescription($description);
        $this->setDate($date);
        $this->setPlace($place);
        $this->setEventName($eventName);
        $this->setEventType($eventType);
    }

    // Getters and Setters
    public function getEventId() {
        return $this->eventId;
    }

    public function getCandidateName() {
        return $this->candidateName;
    }

    public function setCandidateName($candidateName) {
        // Validation logic for candidate name can be added here
        $this->candidateName = $candidateName;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setDescription($description) {
        // Validation logic for description can be added here
        $this->description = $description;
    }

    public function getDate() {
        return $this->date;
    }

    public function setDate($date) {
        // Validation logic for date can be added here
        $this->date = $date;
    }

    public function getPlace() {
        return $this->place;
    }

    public function setPlace($place) {
        // Validation logic for place can be added here
        $this->place = $place;
    }

    public function getEventName() {
        return $this->eventName;
    }

    public function setEventName($eventName) {
        // Validation logic for event name can be added here
        $this->eventName = $eventName;
    }

    public function getEventType() {
        return $this->eventType;
    }

    public function setEventType($eventType) {
        // Validation logic for event type can be added here
        $this->eventType = $eventType;
    }
}
