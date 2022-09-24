<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Get EnableX Api</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
</head>

<body>
    <?php

        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.enablex.io/video/v2/rooms',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            'accept: application/json',
            'Authorization: Basic NjMyZjMxNjgwYjZkMzA0YjI4NjgwMGIzOmFKZVB5dmE2ZXllenVUZTV5RWFQZVhlVXlqZVp1NHVyeWRlNA=='
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $resArr = json_decode($response);
        echo '<div class="container p-4"><div class="row">';
        foreach ($resArr->rooms as $rooms) {
            $curl = curl_init();

            curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.enablex.io/video/v2/rooms/'.$rooms->room_id.'/users',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'accept: application/json',
                'Authorization: Basic NjMyZjMxNjgwYjZkMzA0YjI4NjgwMGIzOmFKZVB5dmE2ZXllenVUZTV5RWFQZVhlVXlqZVp1NHVyeWRlNA=='
            ),
            ));

            $user_response = curl_exec($curl);

            curl_close($curl);
            $user_resArr = json_decode($user_response);
            if ($user_resArr->total > 0) { ?>
            <div class="col-md-2"><div class="d-grid gap-2"><button type="button" data-count="<?php echo $user_resArr->total;?>" class="btn btn-success">Room</button></div></div>
            <?php } else { ?>
            <div class="col-md-2"><div class="d-grid gap-2"><button type="button" data-count="<?php echo $user_resArr->total;?>" class="btn btn-danger disabled">Room</button></div></div>
            <?php }
            

        }
        echo "</div></div>";

    ?>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <script>
    jQuery(document).ready(function() {
        setTimeout(function() {}, 3000);
    });
    </script>
</body>
</html>