<?php
/**
 * Class CurlHelper pour simplifier l'utilisation de la bibliothèque cURL.
 */
class CurlHelper {
    /**
     * Effectue une requête GET à l'URL spécifiée en utilisant les options cURL fournies.
     *
     * @param string $url L'URL à interroger. Par défaut, "https://jsonplaceholder.typicode.com/posts".
     * @param array $options Les options cURL à utiliser pour la requête. Par défaut, un tableau vide.
     * @return array Un tableau contenant deux éléments : un booléen indiquant si la requête a réussi et le contenu obtenu.
     */
    public static function get(string $url = "https://jsonplaceholder.typicode.com/posts", array $options = array()): array {
        return self::send($url, "GET", $options);
    }

    /**
     * Effectue une requête POST à l'URL spécifiée en utilisant les données fournies.
     *
     * @param string $url L'URL à interroger. Par défaut, "https://jsonplaceholder.typicode.com/posts".
     * @param array $options Les options cURL à utiliser pour la requête. Par défaut, un tableau vide.
     * @param mixed $data Les données à envoyer avec la requête. Peut être un tableau associatif ou une chaîne de requête.
     * @return array Un tableau contenant deux éléments : un booléen indiquant si la requête a réussi et le message retourné.
     */
    public static function post(string $url = "https://jsonplaceholder.typicode.com/posts", array $options = array(), mixed $data = ""): array {
        return self::send($url, "POST", $options, $data);
    }

    /**
     * Effectue une requête PUT à l'URL spécifiée en utilisant les données fournies.
     *
     * @param string $url L'URL à interroger. Par défaut, "https://jsonplaceholder.typicode.com/posts/1".
     * @param array $options Les options cURL à utiliser pour la requête. Par défaut, un tableau vide.
     * @param mixed $data Les données à envoyer avec la requête. Peut être un tableau associatif ou une chaîne de requête.
     * @return array Un tableau contenant deux éléments : un booléen indiquant si la requête a réussi et le message retourné.
     */
    public static function put(string $url = "https://jsonplaceholder.typicode.com/posts/1", array $options = array(), mixed $data = ""): array {
        return self::send($url, "PUT", $options, $data);
    }

    /**
     * Effectue une requête HTTP DELETE à l'URL spécifiée.
     *
     * @param string $url L'URL à laquelle envoyer la requête. Si null, l'URL par défaut est utilisée.
     * @param array $options Les options cURL à utiliser pour la requête. Par défaut, un tableau vide.
     * @return array Un tableau contenant le résultat de la requête. La première case contient un booléen indiquant si la requête a réussi ou non. La deuxième case contient le contenu de la réponse si la requête a réussi, ou un message d'erreur si elle a échoué.
     * @throws Exception Si la requête cURL échoue.
     */
    public static function delete(string $url = "https://jsonplaceholder.typicode.com/posts/1", array $options = array()): array {
        return self::send($url, "DELETE", $options);
    }

    private static function send(string $url, string $method = "GET", array $options = array(), mixed $data = ""): array {
        // Initialisation de cURL
        $ch = curl_init($url);
        // Configuration de la méthode de requête
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
        if ($method === "POST" || $method === "PUT") {
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        }
        // Configuration pour retourner la réponse plutôt que de l'afficher directement
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt_array($ch, $options);
        $result = curl_exec($ch);
        
        if (!$result) {
            $success = false;
            $result = 'Error: "' . curl_error($ch) . '" - Code: ' . curl_errno($ch);
        } else {
            $success = true;
        }
        curl_close($ch);

        return array($success, $result);
    }
}