<?php

namespace App\Http\Service;

class ModuleService
{

    public function getDirectories(): array
    {
        $directories = [];
        $path = resource_path('views/admin/modules');

        // Verifica se o caminho é uma pasta válida
        if (is_dir($path)) {
            // Usa scandir para listar os itens da pasta
            $items = scandir($path);
    
            // Entender o código abaixo

            // Filtra as pastas
            $directories = array_filter($items, function($item) use ($path) {
                return is_dir($path . DIRECTORY_SEPARATOR . $item) && !in_array($item, ['.', '..']);
            });
        }

        return $directories;
    }

    public function listRenameDirectories(): array
    {
        return [
            'master_call' => 'Chamada Principal',
            'about' => 'Sobre nós',
            'opening_hours' => 'Horários de funcionamento',
            'footer' => 'Rodapé',
        ];
    }

    public function renameDirectories($directories)
    {
        $modules = [];

        foreach ($this->listRenameDirectories() as $path => $name ) {
            if (in_array($path, $directories)) {
                $modules[$path] = $name;
            }
        }

        return $modules;
    }
}