<?php
  require('Pusher.php');

  $options = array(
    'encrypted' => true
  );
  $pusher = new Pusher(
    '58aefe829914bc20edc6',
    '4919aff5850cf0890664',
    '240567',
    $options
  );

  $data['message'] = 'hello world';
  echo "Antes";
  $pusher->trigger('test_channel', 'my_event', $data);
    echo "depos";
?>