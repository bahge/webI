<?php
namespace app\helpers;


class views
{
    private $name;
    private $data;
    private $param;

    public function __construct($name, array $data = null, array $param = null)
    {
        $this->name = $name;
        $this->data = $data;
        $this->param = $param;
    }

    public function render()
    {
        $this->param['header'] = (isset($this->param['header'])) ? './app/views/include/' . $this->param['header'] . '.php': './app/views/include/stdHeader.php';
        $this->param['menu'] = (isset($this->param['menu'])) ? './app/views/include/' . $this->param['menu'] . '.php': './app/views/include/stdMenu.php';
        $this->param['footer'] = (isset($this->param['footer'])) ? './app/views/include/' . $this->param['footer'] . '.php': './app/views/include/stdFooter.php';

        if (file_exists($this->param['header'])){
            include $this->param['header'];
        }
        if (file_exists($this->param['menu'])){
            include $this->param['menu'];
        }
        if (file_exists( './app/views/' . $this->name . '.php')):
            include './app/views/' . $this->name . '.php';
        else:
            echo "Erro ao carregar a VIEW: <br>{$this->name}";
        endif;
        if (file_exists($this->param['footer'])){
            include $this->param['footer'];
        }
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

}