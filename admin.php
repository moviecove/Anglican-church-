<?php
// ===== PHP HANDLER =====
// This file saves and reads JSON for admin uploads

$uploadsFile = 'uploads.json';
if(!file_exists($uploadsFile)) file_put_contents($uploadsFile, json_encode([
    'media'=>[], 'sermons'=>[], 'devotionals'=>[], 'announcements'=>[], 'events'=>[]
]));

// Handle POST
if($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['action'])){
    $data = json_decode(file_get_contents($uploadsFile), true);
    $action = $_POST['action'];

    $item = [];
    switch($action){
        case 'media':
            $item = [
                'title'=>$_POST['title'] ?? '',
                'url'=>$_POST['url'] ?? '',
                'type'=>$_POST['type'] ?? 'image',
                'thumbnail'=>$_POST['thumbnail'] ?? $_POST['url']
            ];
            $data['media'][] = $item;
        break;
        case 'sermon':
            $item = ['title'=>$_POST['title'] ?? '', 'url'=>$_POST['url'] ?? ''];
            $data['sermons'][] = $item;
        break;
        case 'devotional':
            $item = ['title'=>$_POST['title'] ?? '', 'content'=>$_POST['content'] ?? '', 'date'=>date('c')];
            $data['devotionals'][] = $item;
        break;
        case 'announcement':
            $item = ['title'=>$_POST['title'] ?? '', 'content'=>$_POST['content'] ?? '', 'date'=>date('c')];
            $data['announcements'][] = $item;
        break;
        case 'event':
            $item = ['title'=>$_POST['title'] ?? '', 'content'=>$_POST['content'] ?? '', 'date'=>$_POST['date'] ?? ''];
            $data['events'][] = $item;
        break;
    }

    file_put_contents($uploadsFile, json_encode($data, JSON_PRETTY_PRINT));
    echo json_encode(['success'=>true]);
    exit;
}

// Return JSON for GET
if($_SERVER['REQUEST_METHOD']==='GET'){
    header('Content-Type: application/json');
    echo file_get_contents($uploadsFile);
    exit;
}
?>