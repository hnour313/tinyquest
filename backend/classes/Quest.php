<?php
class Quest {
    public $id;
    public $title;
    public $description;
    public $points;

    public function __construct($data) {
        $this->id = $data['id'];
        $this->title = $data['title'];
        $this->description = $data['description'];
        $this->points = $data['points'];
    }
}
?>
