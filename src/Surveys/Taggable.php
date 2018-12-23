<?php

namespace Surveys;

trait Taggable
{
    protected $tags = [];

    /**
     * @return array
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * @param array $tags
     */
    public function setTags(array $tags)
    {
        $this->tags = array_unique($tags);
    }

    /**
     * @param $tag
     */
    public function addTag($tag)
    {
        if(!in_array($tag, $this->tags)) {
            $this->tags[] = $tag;
            return true;
        }
        return false;
    }
}