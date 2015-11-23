<?php
if(isset($_GET['code'])){
  print "code is: " . $_GET['code'];

  $code = $_GET['code'];

  $params = array(
      "code" => $code,
      "client_id" => getenv('GOOGLE_BOOKS_AUTH_CLIENT_ID'),
      "client_secret" => getenv('GOOGLE_BOOKS_AUTH_CLIENT_SECRET'),
      "redirect_uri" => "http://localhost:8080/books-api/oauth2callback.php",
      "grant_type" => "authorization_code"
  );

  // Get cURL resource
  $curl = curl_init();
  // Set some options - we are passing in a useragent too here
  curl_setopt_array($curl, array(
      CURLOPT_RETURNTRANSFER => 1,
      CURLOPT_URL => 'https://accounts.google.com/o/oauth2/token',
      CURLOPT_POST => 1,
      CURLOPT_SSL_VERIFYPEER => 1,
      CURLOPT_POSTFIELDS => $params
  ));
  // Send the request & save response to $resp
  $resp = curl_exec($curl);
    if ($resp == FALSE)
    {
        print "curl response was false <br />";
        print "<pre>".print_r(curl_error($curl))."</pre>";
    }

  print "<pre>".print_r(json_decode($resp), true)."</pre>";
  // Close request to clear up some resources
  curl_close($curl);
  $r = json_decode($resp);
  $token = $r->access_token;
  //   https://www.googleapis.com/auth/calendar
  //   /users/me/calendarList

  //$url ='https://www.googleapis.com/calendar/v3/users/me/calendarList?access_token='.$token;

  // get a list of bookshelves for user
  // $url ='https://www.googleapis.com/books/v1/users/112515085508713743757/bookshelves?access_token='.$token;

  // get a specific volume
  $key = getenv('GOOGLE_BOOKS_AUTH_API_KEY');
  $url = 'https://www.googleapis.com/books/v1/volumes/PGR2AwAAQBAJ?key='.$key;

  $ch = curl_init();

  curl_setopt($ch,CURLOPT_URL,$url);
  curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
//  curl_setopt($ch,CURLOPT_HEADER, false);

  $output=curl_exec($ch);
  // print htmlspecialchars($output);
  curl_close($ch);


  print "<br/><br/>";
  $obj = json_decode($output);


  print "<pre>".print_r($obj,true)."</pre>";

}
