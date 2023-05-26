<?php

namespace Power\Core;

class PowerHtmlParser
{
    private array $vars;
    private string $file;

    public function __construct(array $vars, string $file)
    {
        // $this->vars = $this->convertCodeVarNames($vars);
        $this->vars = $vars;
        $this->file = $file;
    }   

    public function parse()
    {
        $rawPowerFile = $this->getViewFile($this->file);

        $rawPowerFile = $this->convertFileVarNames($rawPowerFile, $this->file);

        return $this->saveViewConvertedFile($rawPowerFile, $this->file);
    }

    private function convertFileVarNames(string $rawFile, string $fileName)
    {
        // $rawFile = preg_replace('/(^@)(.*)(@$)/s', '<?php $2', strval($rawFile));

        $rawFile = preg_replace_callback('/@/', function($matches) {
            static $count = 0;
            $count++;
            
            if ($count % 2 === 1) {
                return '<?php';
            } else {
                return '?>';
            }
        }, $rawFile);
        
        echo $rawFile;

        return $rawFile;
    }

    private function convertCodeVarNames(array $rawFile)
    {
    }

    private function saveViewConvertedFile(string $fileContent, string $fileName)
    {
        $fileDir = __DIR__ . "/../Cache/Views/{$fileName}.php";

        if (file_exists($fileDir)) unlink($fileDir); 

        file_put_contents($fileDir, $fileContent);

        return $fileDir;
    }

    private function getViewFile(string $fileName): string
    {
        $rootDir = __DIR__ . '/../../src/Views/';
        return file_get_contents($rootDir . $fileName . '.pwr');
    }
}
