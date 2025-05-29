<?php
class User {
    public $id;
    public $username;
    public $points;

    public function __construct($pdo, $user_id) {
        $stmt = $pdo->prepare("SELECT id, username, points FROM users WHERE id = ?");
        $stmt->execute([$user_id]);
        $user = $stmt->fetch();
        if ($user) {
            $this->id = $user['id'];
            $this->username = $user['username'];
            $this->points = $user['points'];
        }
    }

    public function getOpenQuests($pdo) {
        $stmt = $pdo->prepare(
            "SELECT q.* FROM quests q WHERE q.id NOT IN (
                SELECT quest_id FROM completed_quests WHERE user_id = ?)"
        );
        $stmt->execute([$this->id]);
        return $stmt->fetchAll();
    }

    public function getCompletedQuests($pdo) {
        $stmt = $pdo->prepare(
            "SELECT q.* FROM quests q 
            JOIN completed_quests c ON q.id = c.quest_id 
            WHERE c.user_id = ?"
        );
        $stmt->execute([$this->id]);
        return $stmt->fetchAll();
    }
}
?>
