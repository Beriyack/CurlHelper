<?php
$options = [CURLOPT_FOLLOWLOCATION => true];
$curlHelper = new CurlHelper();
$response = $curlHelper->send('https://example.com', 'GET', [], $options);
