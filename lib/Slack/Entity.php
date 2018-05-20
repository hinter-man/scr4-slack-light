<?php
/**
 * Created by PhpStorm.
 * User: hinterreiter
 * Date: 19.05.2018
 * Time: 23:34
 */

namespace Slack;

interface IData
{
    public function getId();
}

class Entity extends BaseObject implements IData
{

    private $id;

    public function getId()
    {
        return $this->id;
    }

    public function __construct($id)
    {
        $this->id = $id;
    }
}