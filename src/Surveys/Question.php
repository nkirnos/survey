<?php

namespace Surveys;

class Question
{
    use HasId;
    use Taggable;

    protected $text;
    protected $variants = [];

    /**
     * @return mixed
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param mixed $text
     */
    public function setText($text)
    {
        $this->text = $text;
    }

    /**
     * @return array
     */
    public function getVariants()
    {
        return $this->variants;
    }

    /**
     * @param array $variants
     */
    public function setVariants($variants)
    {
        foreach ($variants as $variant_info) {
            if (is_a($variant_info, Variant::class)) {
                $this->addVariant($variant_info);
            } elseif (is_array($variant_info) && !empty($variant_info['text'])) {
                $variant = new Variant();
                $variant->setText($variant_info['text']);
                if (!empty($variant_info['tags']) && is_array($variant_info['tags'])) {
                    foreach ($variant_info['tags'] as $tag) {
                        $variant->addTag($tag);
                        $this->addTag($tag);
                    }
                }
                $this->addVariant($variant);
            }
        }
    }

    /**
     * @param $variant
     */
    protected function addVariant(Variant $variant)
    {
        $id = count($this->variants);
        $variant->setId($id);
        $this->variants[] = $variant;
    }

}