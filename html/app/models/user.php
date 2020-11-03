<?php
namespace app\models;

use app\helpers\crud;
use app\helpers\crudInterface;

class user implements crudInterface
{

    /**
     * @inheritDoc
     */
    public static function listAll()
    {
        // TODO: Implement listAll() method.
    }

    /**
     * @inheritDoc
     */
    public function listById($id)
    {
        // TODO: Implement listById() method.
    }

    /**
     * @inheritDoc
     */
    public function editById($id)
    {
        // TODO: Implement editById() method.
    }

    /**
     * @inheritDoc
     */
    public function deleteById($id)
    {
        // TODO: Implement deleteById() method.
    }

    public function __construct()
    {

    }
}