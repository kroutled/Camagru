<?php

function setComments()
{
    include 'config/database.php';
  
    if (isset($_POST['commentSubmit']))
    {
        $uid = $_POST['uid'];
        $dates = $_POST['dates'];
        $message = strip_tags($_POST['message']);

        if ($message != NULL)
        {
            $stmt = $pdo->prepare('INSERT INTO comments (cid, uid, dates, message)
            VALUES (NULL, :uid, :dates, :message)');
            $stmt->execute(['uid' => $uid, 'dates' => $dates, 'message' => $message]);
        }
    }
}
?>