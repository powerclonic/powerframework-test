<?php

namespace Power\Core;

class PowerParser
{
    private string $fileName;
    private array $vars;

    public function __construct(string $fileName, array $vars = [])
    {
        $this->fileName = $fileName;
        $this->vars = $vars;

        $this->parse();
    }

    private function parse()
    {
        $file = $this->convertPwrToPhp();
        require $this->saveConvertedFile($file);
    }

    private function convertPwrToPhp() {
        $file = $this->getPwrFile();

        $file = $this->replace('/(?<!\w)@(?!\w)/', '<?php ', ' ?>', $file);
        $file = $this->replace('/(?<!\w)@(echo|endecho)(?!\w)/', '<?php echo "', '"; ?>', $file);

        return $file;
    }

    private function getPwrFile(): string
    {
        $fileDir = $this->isFrameworkView() ? srcdir() . "Views/{$this->fileName}.pwr" : appdir() . "Views/{$this->fileName}.pwr";

        return file_get_contents($fileDir);
    }

    private function saveConvertedFile(string $file) {
        file_put_contents(srcdir() . "Cache/Views/{$this->fileName}.php", $file);
        
        return srcdir() . "Cache/Views/{$this->fileName}.php";
    }

    private function isFrameworkView(): bool
    {
        return substr($this->fileName, 0, 16) === '$powerframework.';
    }

    private function replace(string $pattern, string $firstReplace, string $secondReplace, string $string) {
        return preg_replace_callback($pattern, function() use ($firstReplace, $secondReplace) {
            static $count = 0;
            $count++;

            if ($count % 2 === 1) {
                echo $firstReplace;
                return $firstReplace;
            } else {
                echo $secondReplace;
                return $secondReplace;
            }
        }, $string);
    }
}