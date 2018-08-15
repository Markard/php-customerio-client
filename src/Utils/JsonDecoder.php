<?php

namespace CustomerIo\Utils;

final class JsonDecoder
{
    /**
     * @param string $string
     *
     * @return mixed
     *
     * @throws \RuntimeException
     */
    public static function decodeToAssocArray(string $string)
    {
        $decoded = json_decode($string, true);
        switch (json_last_error()) {
            case JSON_ERROR_NONE:
                return $decoded;
            case JSON_ERROR_DEPTH:
                throw new \RuntimeException('Could not decode JSON response, maximum stack depth exceeded.');
            case JSON_ERROR_STATE_MISMATCH:
                throw new \RuntimeException('Could not decode JSON response, underflow or the nodes mismatch.');
            case JSON_ERROR_CTRL_CHAR:
                throw new \RuntimeException('Could not decode JSON response, unexpected control character found.');
            case JSON_ERROR_SYNTAX:
                throw new \RuntimeException('Could not decode JSON response, syntax error - malformed JSON.');
            case JSON_ERROR_UTF8:
                throw new \RuntimeException('Could not decode JSON response, malformed UTF-8 characters (incorrectly encoded?)');
            default:
                throw new \RuntimeException('Could not decode JSON response.');
        }
    }
}
