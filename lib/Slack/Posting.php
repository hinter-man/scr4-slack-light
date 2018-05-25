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
    private $read;
    private $important;

    public function __construct($id, $channelId, $title, $text, $author, $date, $read, $important)
    {
        parent::__construct($id);
        $this->channelId = $channelId;
        $this->title = $title;
        $this->text = $text;
        $this->author = $author;
        $this->date = $date;
        $this->read = $read;
        $this->important = $important;
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

    /**
     * @return mixed
     */
    public function getRead()
    {
        return $this->read;
    }

    /**
     * @return mixed
     */
    public function getImportant()
    {
        return $this->important;
    }

}