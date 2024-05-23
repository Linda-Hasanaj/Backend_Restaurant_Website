<?php
if (!function_exists('error_handler')) {
    // Funksioni për trajtimin e gabimeve
    function error_handler($errno, $errstr, $errfile, $errline, $errcontext) {
        $error_message = "Gabim [$errno]: $errstr në linjë $errline në skedarin $errfile.";

        // trajtoni gabimet: regjistrimi në logs
        error_log($error_message, 3, "errors.log");

        // Mesazh për përdoruesin (mund të personalizohet më tej)
        echo "Ndodhi një gabim! Ju lutemi kontaktoni mbështetjen teknike.";
        echo "Stafi i LaTulipe do te perkujdeset per kete error!";
    }
    // Vendosni funksionin e trajtimit të gabimeve si trajtuesin e parazgjedhur
    set_error_handler("error_handler");

    // Opsional: Funksioni për trajtimin e përjashtimeve (exceptions)
    function exception_handler($exception) {
        error_handler(E_ERROR, $exception->getMessage(), $exception->getFile(), $exception->getLine(), []);
    }
    // Vendosni funksionin e trajtimit të përjashtimeve si trajtuesin e parazgjedhur
    set_exception_handler("exception_handler");
}
?>
