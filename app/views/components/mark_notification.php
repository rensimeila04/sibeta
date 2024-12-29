<?php
header('Content-Type: application/json');
header('Cache-Control: no-cache, must-revalidate');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && 
    isset($_POST['action']) && 
    $_POST['action'] === 'mark_as_read' && 
    isset($_POST['notification_id'])) {
    
    try {
        $notifikasiController->markNotificationAsRead($_POST['notification_id']);
        $newUnreadCount = $notifikasiController->getUnreadNotificationCount($nim);
        
        echo json_encode([
            'success' => true,
            'unreadCount' => $newUnreadCount
        ]);
    } catch (Exception $e) {
        http_response_code(400);
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    }
} else {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => 'Invalid request']);
}