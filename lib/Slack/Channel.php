<?php
/**
 * Created by PhpStorm.
 * User: hinterreiter
 * Date: 21.05.2018
 * Time: 14:16
 */

namespace Slack;


class Channel extends Entity
{
    private $name;
    private $description;

    public function __construct($id, $name, $description)
    {
        parent::__construct($id);
        $this->name = $name;
        $this->description = $description;
    }

    public function getName()
    {
        return strtolower($this->name);
    }

    public function getDescription() {
        return strtolower($this->description);
    }

}