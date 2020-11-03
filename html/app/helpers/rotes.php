<?php
namespace app\helpers;

class rotes
{
    private $url;
    private $controller;
    private $method;
    private $parameters;
    private $msg;
    const PATH_CONTROLLER = '\\app\\controllers\\';


    public function __construct(array $url)
    {
        $this->url = $url;
        $len = sizeof($this->url);
        switch ($len) {
            case 1:
                $this->controller = self::PATH_CONTROLLER . $this->sanitize($this->url[0]);
                break;
            case 2:
                $this->controller = self::PATH_CONTROLLER . $this->sanitize($this->url[0]);
                $this->method = $this->sanitize($this->url[1]);
                break;
            case 3:
                $this->controller = self::PATH_CONTROLLER . $this->sanitize($this->url[0]);
                $this->method = $this->sanitize($this->url[1]);
                $this->parameters = $this->sanitize($this->url[2]);
                break;
            default:
                break;
        }
        $this->method = ($this->method === null ? 'index' : $this->method);
        $this->load();
    }

    private function sanitize(string $value)
    {
        $value = trim($value);
        $replace = [
            '&lt;' => '', '&gt;' => '', '&#039;' => '', '&amp;' => '', ' ' => '-',
            '&quot;' => '', 'À' => 'a', 'Á' => 'a', 'Â' => 'a', 'Ã' => 'a', 'Ä' => 'a',
            '&Auml;' => 'a', 'Å' => 'a', 'Ā' => 'a', 'Ą' => 'a', 'Ă' => 'a', 'Æ' => 'a',
            'Ç' => 'c', 'Ć' => 'c', 'Č' => 'c', 'Ĉ' => 'c', 'Ċ' => 'c', 'Ď' => 'd', 'Đ' => 'd',
            'Ð' => 'd', 'È' => 'e', 'É' => 'e', 'Ê' => 'e', 'Ë' => 'e', 'Ē' => 'e',
            'Ę' => 'e', 'Ě' => 'e', 'Ĕ' => 'e', 'Ė' => 'e', 'Ĝ' => 'g', 'Ğ' => 'g',
            'Ġ' => 'g', 'Ģ' => 'g', 'Ĥ' => 'h', 'Ħ' => 'h', 'Ì' => 'i', 'Í' => 'i',
            'Î' => 'i', 'Ï' => 'i', 'Ī' => 'i', 'Ĩ' => 'i', 'Ĭ' => 'i', 'Į' => 'i',
            'İ' => 'i', 'Ĳ' => 'i', 'Ĵ' => 'j', 'Ķ' => 'k', 'Ł' => 'k', 'Ľ' => 'l',
            'Ĺ' => 'l', 'Ļ' => 'l', 'Ŀ' => 'l', 'Ñ' => 'n', 'Ń' => 'n', 'Ň' => 'n',
            'Ņ' => 'n', 'Ŋ' => 'n', 'Ò' => 'o', 'Ó' => 'o', 'Ô' => 'o', 'Õ' => 'o',
            'Ö' => 'o', '&Ouml;' => 'o', 'Ø' => 'o', 'Ō' => 'o', 'Ő' => 'o', 'Ŏ' => 'o',
            'Œ' => 'o', 'Ŕ' => 'r', 'Ř' => 'r', 'Ŗ' => 'r', 'Ś' => 's', 'Š' => 's',
            'Ş' => 's', 'Ŝ' => 's', 'Ș' => 's', 'Ť' => 't', 'Ţ' => 't', 'Ŧ' => 't',
            'Ț' => 't', 'Ù' => 'u', 'Ú' => 'u', 'Û' => 'u', 'Ü' => 'u', 'Ū' => 'u',
            '&Uuml;' => 'u', 'Ů' => 'u', 'Ű' => 'u', 'Ŭ' => 'u', 'Ũ' => 'u', 'Ų' => 'u',
            'Ŵ' => 'w', 'Ý' => 'y', 'Ŷ' => 'y', 'Ÿ' => 'y', 'Ź' => 'z', 'Ž' => 'z',
            'Ż' => 'z', 'Þ' => 't', 'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a',
            'ä' => 'a', '&auml;' => 'a', 'å' => 'a', 'ā' => 'a', 'ą' => 'a', 'ă' => 'a',
            'æ' => 'a', 'ç' => 'c', 'ć' => 'c', 'č' => 'c', 'ĉ' => 'c', 'ċ' => 'c',
            'ď' => 'd', 'đ' => 'd', 'ð' => 'd', 'è' => 'e', 'é' => 'e', 'ê' => 'e',
            'ë' => 'e', 'ē' => 'e', 'ę' => 'e', 'ě' => 'e', 'ĕ' => 'e', 'ė' => 'e',
            'ƒ' => 'f', 'ĝ' => 'g', 'ğ' => 'g', 'ġ' => 'g', 'ģ' => 'g', 'ĥ' => 'h',
            'ħ' => 'h', 'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i', 'ī' => 'i',
            'ĩ' => 'i', 'ĭ' => 'i', 'į' => 'i', 'ı' => 'i', 'ĳ' => 'i', 'ĵ' => 'j',
            'ķ' => 'k', 'ĸ' => 'k', 'ł' => 'l', 'ľ' => 'l', 'ĺ' => 'l', 'ļ' => 'l',
            'ŀ' => 'l', 'ñ' => 'n', 'ń' => 'n', 'ň' => 'n', 'ņ' => 'n', 'ŉ' => 'n',
            'ŋ' => 'n', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o', 'ö' => 'o',
            '&ouml;' => 'o', 'ø' => 'o', 'ō' => 'o', 'ő' => 'o', 'ŏ' => 'o', 'œ' => 'o',
            'ŕ' => 'r', 'ř' => 'r', 'ŗ' => 'r', 'š' => 's', 'ù' => 'u', 'ú' => 'u',
            'û' => 'u', 'ü' => 'u', 'ū' => 'u', '&uuml;' => 'u', 'ů' => 'u', 'ű' => 'u',
            'ŭ' => 'u', 'ũ' => 'u', 'ų' => 'u', 'ŵ' => 'w', 'ý' => 'y', 'ÿ' => 'y',
            'ŷ' => 'y', 'ž' => 'z', 'ż' => 'z', 'ź' => 'z', 'þ' => 't', 'ß' => 's',
            'ſ' => 's', 'ый' => 'i', 'А' => 'a', 'Б' => 'b', 'В' => 'v', 'Г' => 'g',
            'Д' => 'd', 'Е' => 'e', 'Ё' => 'y', 'Ж' => 'z', 'З' => 'z', 'И' => 'i',
            'Й' => 'y', 'К' => 'k', 'Л' => 'l', 'М' => 'm', 'Н' => 'n', 'О' => 'o',
            'П' => 'p', 'Р' => 'r', 'С' => 's', 'Т' => 't', 'У' => 'u', 'Ф' => 'f',
            'Х' => 'h', 'Ц' => 'c', 'Ч' => 'c', 'Ш' => 's', 'Щ' => 's', 'Ъ' => '',
            'Ы' => 'y', 'Ь' => '', 'Э' => 'e', 'Ю' => 'y', 'Я' => 'y', 'а' => 'a',
            'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd', 'е' => 'e', 'ё' => 'y',
            'ж' => 'z', 'з' => 'z', 'и' => 'i', 'й' => 'y', 'к' => 'k', 'л' => 'l',
            'м' => 'm', 'н' => 'n', 'о' => 'o', 'п' => 'p', 'р' => 'r', 'с' => 's',
            'т' => 't', 'у' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'c', 'ч' => 'c',
            'ш' => 's', 'щ' => 's', 'ъ' => '', 'ы' => 'y', 'ь' => '', 'э' => 'e',
            'ю' => 'y', 'я' => 'y'
        ];
        $value = str_replace(array_keys($replace), $replace, $value);
        return $value;
    }

    private function load()
    {
        if (class_exists($this->controller))
        {
            try {
                $this->loadMethod();
            }
            catch (Exception $e)
            {
                $this->setMethod(getenv('STD_MODEL'));
                $this->load();
            }
        }
        else
        {
            echo "A classe {$this->controller} não existe <br>";
            $this->setController(self::PATH_CONTROLLER . getenv('STD_CONTROLLER'));
            $this->load();
        }
    }

    private function loadMethod()
    {
        $classLoad = new $this->controller;
        if ( method_exists($classLoad, $this->method)):
            if ($this->parameters !== null)
            {
                $classLoad->{$this->method}($this->parameters);
            }
            else
            {
                $classLoad->{$this->method}();
            }
        else:
            echo "A classe <b>{$this->url[0]}</b>, existe, porém apresenta erro.<br> Erro ao carregar o método: <br> {$this->method}";
        endif;
    }

    /**
     * @param string $method
     */
    public function setMethod($method)
    {
        $this->method = $method;
    }

    /**
     * @return string
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @return string|string[]
     */
    public function getController()
    {
        return $this->controller;
    }

    /**
     * @param string|string[] $controller
     */
    public function setController($controller)
    {
        $this->controller = $controller;
    }

    /**
     * @param mixed $msg
     */
    public function setMsg($msg)
    {
        $this->msg = $msg;
    }

    /**
     * @return mixed
     */
    public function getMsg()
    {
        return $this->msg;
    }

}