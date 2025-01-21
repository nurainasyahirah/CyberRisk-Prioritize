<?php
// activity_log.php
require_once 'db_connection.php';

// Function to log an activity for a specific user
function logActivity($user_id, $activity_description, $conn) {
    $stmt = $conn->prepare("INSERT INTO activity_log (user_id, activity_description) VALUES (?, ?)");
    $stmt->bind_param("is", $user_id, $activity_description);
    $stmt->execute();
    $stmt->close();
}

// Function to fetch recent activities for a specific user
function fetchRecentActivities($user_id, $conn, $limit = 10) {
    $recent_activities = [];
    $stmt = $conn->prepare("SELECT activity_description, activity_time FROM activity_log WHERE user_id = ? ORDER BY activity_time DESC LIMIT ?");
    $stmt->bind_param("ii", $user_id, $limit);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $recent_activities[] = $row;
    }

    $stmt->close();
    return $recent_activities;
}
