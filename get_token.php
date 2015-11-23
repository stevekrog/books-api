<?php
/*
* Acknowledgements to David Jones for much of this code
*/

  $url = "https://accounts.google.com/o/oauth2/auth";

  $params = array(
    "response_type" => "code",
    "client_id" => getenv('GOOGLE_BOOKS_AUTH_CLIENT_ID'),
    "redirect_uri" => "http://localhost:8080/books-api/oauth2callback.php",
    "scope" => "https://www.googleapis.com/auth/books"
  );

  $request_url = $url . "?". http_build_query($params);
  print "request_url: " . $request_url;
  header("Location: ".$request_url);

 ?>
