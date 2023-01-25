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
        // Initialisation de cURL
        $ch = curl_init();

        // Configuration de l'URL à envoyer la requête
        curl_setopt($ch, CURLOPT_URL, $url);
        // Configuration pour retourner la réponse plutôt que de l'afficher directement
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        // Configuration de la méthode de requête
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);

        // Si la méthode est POST, on envoie les données avec la requête
        if ($method == 'POST') {
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        }
        // Ajout d'entêtes pour indiquer que l'on s'attend à une réponse json
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

        // Envoi de la requête
        $output = curl_exec($ch);
        // Fermeture de cURL
        curl_close($ch);

        // Retourne la réponse décodée en tableau PHP
        return json_decode($output, true);
    }
}
