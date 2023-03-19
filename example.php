<?php
require_once __DIR__ . "/CurlHelper.php";

$options = array(
    CURLOPT_CAINFO => __DIR__ . "/Baltimore CyberTrust Root.crt"
);

$data = array(
    'userId' => 1,
    'title' => 'foo',
    'body' => 'bar'
);

// Exemple d'utilisation de la méthode GET
$result = CurlHelper::GET("https://jsonplaceholder.typicode.com/posts", $options);
if ($result[0]) {
  echo "Récupération réussie : " . $result[1];
} else {
  echo "Erreur : " . $result[1];
}

// Exemple d'utilisation de la méthode POST
$result = CurlHelper::POST("https://jsonplaceholder.typicode.com/posts", $options, $data);
if ($result[0]) {
  echo "Envoi réussi : " . $result[1];
} else {
  echo "Erreur : " . $result[1];
}

// Exemple d'utilisation de la méthode PUT
$result = CurlHelper::PUT("https://jsonplaceholder.typicode.com/posts/1", $options, $data);
if ($result[0]) {
  echo "Mise à jour réussie : " . $result[1];
} else {
  echo "Erreur : " . $result[1];
}

// Exemple d'utilisation de la méthode DELETE
$result = CurlHelper::DELETE("https://jsonplaceholder.typicode.com/posts/1", $options);
if ($result[0]) {
  echo "Suppression réussie : " . $result[1];
} else {
  echo "Erreur : " . $result[1];
}