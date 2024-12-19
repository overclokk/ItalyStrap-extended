<?php

namespace ItalyStrap\Migrations;

class ImageUrlToIdProcessor implements ProcessorInterface
{

    public function process($value)
    {
        if (!\is_string($value)) {
            return $value;
        }

        if (!\preg_match('#png|jpg|gif#is', $value)) {
            return $value;
        }

        return $this->getImageIdFromUrl((string)$value);
    }

    private function getImageIdFromUrl(string $image_url): int
    {
        $attachment_id = \attachment_url_to_postid($image_url);
//
//        if (0 === $attachment_id) {
//            $attachment_id = $this->uploadImageFromUrl($image_url);
//        }
//
//        return $attachment_id;

        return \ItalyStrap\Core\get_image_id_from_url($image_url);
    }
}
