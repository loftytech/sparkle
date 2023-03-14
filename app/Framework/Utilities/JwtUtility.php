<?php
namespace App\Framework\Utilities;

class JwtUtility {
    private static $secret = "36bybdfs5238nf84498";

    private static function base64url_encode($str) {
        return rtrim(strtr(base64_encode($str), '+/', '-_'), '=');
    }

    private static function generate_jwt($headers, $payload) {
        $headers_encoded = self::base64url_encode(json_encode($headers));
        $payload_encoded = self::base64url_encode(json_encode($payload));
        
        $signature = hash_hmac('SHA256', "$headers_encoded.$payload_encoded", self::$secret, true);
        $signature_encoded = self::base64url_encode($signature);
        
        $jwt = "$headers_encoded.$payload_encoded.$signature_encoded";
        
        return $jwt;
    }

    public static function get_token($user_data) {
        $headers = array('alg'=>'HS256','typ'=>'JWT');
        $payload = $user_data;

        $jwt = self::generate_jwt($headers, $payload);

        return $jwt;
    }

    public static function validate_token($token) {
        // split the jwt
        $tokenParts = explode('.', $token);

        if (count($tokenParts) == 3) {
            $header = base64_decode($tokenParts[0]);
            $payload = base64_decode($tokenParts[1]);
            $signature_provided = $tokenParts[2];

            if (isset(json_decode($payload)->exp)) {
                // check the expiration time - note this will cause an error if there is no 'exp' claim in the jwt
                $expiration = json_decode($payload)->exp;
                $is_token_expired = ($expiration - time()) < 0;
            
                // build a signature based on the header and payload using the secret
                $base64_url_header = self::base64url_encode($header);
                $base64_url_payload = self::base64url_encode($payload);
                $signature = hash_hmac('SHA256', $base64_url_header . "." . $base64_url_payload, self::$secret, true);
                $base64_url_signature = self::base64url_encode($signature);
            
                // verify it matches the signature provided in the jwt
                $is_signature_valid = ($base64_url_signature === $signature_provided);
                
                if ($is_token_expired || !$is_signature_valid) {
                    return false;
                } else {
                    return true;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public static function getUserDetails($token) {
        // split the jwt
        $tokenParts = explode('.', $token);

        if (count($tokenParts) == 3) {
            $payload = base64_decode($tokenParts[1]);
            $user_details = json_decode($payload);
            return $user_details;
        }

        return false;
    }
}
