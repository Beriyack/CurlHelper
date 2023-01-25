<?php
class CurlHelper {
    /**
     * Envoie une requête cURL à une URL spécifiée
     *
     * @param string $url L'URL à laquelle envoyer la requête
     * @param string $method La méthode de requête (GET ou POST)
     * @param array $data Les données à envoyer avec la requête (pour les requêtes POST)
     *
     * @return array|null La réponse décodée en JSON du serveur, ou null si la réponse n'est pas au format JSON
     */
    public function send($url, $method = 'GET', $data = []) : ?array {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);

        if ($method == 'POST') {
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        }
        // Ajout d'entêtes pour indiquer que l'on s'attend à une réponse json
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

        $output = curl_exec($ch);
        curl_close($ch);

        return json_decode($output, true);
    }
}