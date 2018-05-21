<?php
/**
 * Created by PhpStorm.
 * User: hinterreiter
 * Date: 21.05.2018
 * Time: 16:39
 */

namespace Slack;


class Posting extends Entity
{
    private $channelId;
    private $title;
    private $text;
    private $author;
    private $date;

    public function __construct($id, $channelId, $title, $text, $author, $date)
    {
        parent::__construct($id);
        $this->channelId = $channelId;
        $this->title = $title;
        $this->text = $text;
        $this->author = $author;
        $this->date = $date;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getChannelId()
    {
        return $this->channelId;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return mixed
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @return mixed
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

}