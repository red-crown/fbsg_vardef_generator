<?php
namespace FBSG\Generator;

class Generator
{
    private $jsonFile;
    private $parsedJson = array();

    public function __construct($jsonFile = null)
    {
        if (is_string($jsonFile)) {
            $this->jsonFile = $jsonFile;
        }
    }

    public function generate()
    {
        $json = (array)$this->parsedJson;
        $module = $json['module_name'];

        $output = "<?php\n\n";
        if (!empty($json['properties'])) {
            foreach ($json['properties']['fields'] as $key => $val) {
                $output .= '$dictionary[\''.trim(ucwords($module), 's').'\']';
                $output .= "['fields']['";
                $output .= $key;
                $output .= "'] => array(\n";
                foreach ($val as $k => $v) {
                    $output .= "\t'".$k."' => '".$v."'\n";
                }
                $output .= ");\n\n";
            }
            file_put_contents(BASEPATH.DS.'output.php', $output);
        }
    }

    public function getJsonFile()
    {
        return $this->jsonFile; 
    }

    public function setJsonFile($jsonFile)
    {
        $this->jsonFile   = $jsonFile;
        $this->parsedJson = json_decode(file_get_contents($this->jsonFile), true);
    }

    public function readJson()
    {
        return $this->parsedJson;
    }
}

