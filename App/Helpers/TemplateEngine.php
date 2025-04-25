<?php
namespace App\Helpers;

class TemplateEngine
{
    public static function render(string $file, array $data = []): string
    {
        if (!file_exists($file)) {
            error_log("Template não encontrado: $file");
            Flash::set('error', 'Erro interno: template ausente');
            return '';
        }

        $content = file_get_contents($file);

        $keys = array_keys($data);
        $keys = array_map(function($item) { return '{{'.$item.'}}'; }, $keys );
        return str_replace($keys, array_values($data), $content);
    }
}
?>