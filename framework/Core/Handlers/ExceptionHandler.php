<?php

namespace Power\Core\Handlers;

use Throwable;

class ExceptionHandler
{
    public static function handle(Throwable $error)
    {
        if (env('APP_ENVIRONMENT') === 'web') {
            self::handleWebException($error);
        } else {
            self::handleApiException($error);
        }
    }

    public static function handleWebException(Throwable $error)
    {
        echo '<h1>FATAL ERROR!</h1>' . PHP_EOL;
        echo '<p>' . $error->getMessage() . '</p>' . PHP_EOL;
        echo '<h4>STACKTRACE</h4>' . PHP_EOL;
        foreach ($error->getTrace() as $key => $item) {
            echo "<p> #$key - ";
            echo "<ul>";
            foreach ($item as $key => $trace) {
                echo "<li>";
                echo "$key => ";
                echo $trace;
                echo "</li>";
            }
            echo "</ul>";
            echo '</p>';
        }
    }

    public static function handleApiException(Throwable $error)
    {
        echo json_encode([
            'error' => [
                'message' => $error->getMessage(),
                'stacktrace' => $error->getTrace()
            ]
        ]);
    }
}
