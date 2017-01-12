<?php

/**
 * imageResizer short summary.
 *
 * imageResizer description.
 *
 * @version 1.0
 * @author Jérôme
 */
class ImageResizer
{
    
    function generate_image_thumbnail($source_image_path, $thumbnail_image_path, $maxwidth = 300, $maxHeight = 300)
    {
        //define('THUMBNAIL_IMAGE_MAX_WIDTH', 300);
        //define('THUMBNAIL_IMAGE_MAX_HEIGHT', 300);
        list($source_image_width, $source_image_height, $source_image_type) = getimagesize($source_image_path);
        switch ($source_image_type) {
            case IMAGETYPE_GIF:
                $source_gd_image = imagecreatefromgif($source_image_path);
                break;
            case IMAGETYPE_JPEG:
                $source_gd_image = imagecreatefromjpeg($source_image_path);
                break;
            case IMAGETYPE_PNG:
                $source_gd_image = imagecreatefrompng($source_image_path);
                break;
        }
        if ($source_gd_image === false) {
            return false;
        }
        $source_aspect_ratio = $source_image_width / $source_image_height;
        $thumbnail_aspect_ratio = $maxwidth / $maxHeight;
        if ($source_image_width <= $maxwidth && $source_image_height <= $maxHeight) {
            $thumbnail_image_width = $source_image_width;
            $thumbnail_image_height = $source_image_height;
        } elseif ($thumbnail_aspect_ratio > $source_aspect_ratio) {
            $thumbnail_image_width = (int) ($maxHeight * $source_aspect_ratio);
            $thumbnail_image_height = $maxHeight;
        } else {
            $thumbnail_image_width = $maxwidth;
            $thumbnail_image_height = (int) ($maxwidth / $source_aspect_ratio);
        }
        $thumbnail_gd_image = imagecreatetruecolor($thumbnail_image_width, $thumbnail_image_height);
        imagecopyresampled($thumbnail_gd_image, $source_gd_image, 0, 0, 0, 0, $thumbnail_image_width, $thumbnail_image_height, $source_image_width, $source_image_height);
        imagejpeg($thumbnail_gd_image, $thumbnail_image_path, 90);
        imagedestroy($source_gd_image);
        imagedestroy($thumbnail_gd_image);
        return true;
    }
    
    /*
     * Redimensionne les images présentes dans /assets/img/sponsor
     * @param longueur et hauteur a redimensionner.
     * @return les images de sponsors redimensionnées.
     */
    function getSponsors($longueurAResize = 300, $hauteurAResize = 300) 
    {
        $data['imagesTEMP1'] = glob("assets/img/sponsors/*.j*");
        $data['imagesTEMP2'] = glob("assets/img/sponsors/*.p*");
        if (!empty($data['imagesTEMP1']) && !empty($data['imagesTEMP2'])) { 
            $data['imagesTEMP'] = array_merge($data['imagesTEMP1'], $data['imagesTEMP2']);              
        }
        else if (!empty($data['imagesTEMP1']) && empty($data['imagesTEMP2']))
        {
            $data['imagesTEMP'] = $data['imagesTEMP1'];
        }
        else if (empty($data['imagesTEMP1']) && !empty($data['imagesTEMP2']))
        {
            $data['imagesTEMP'] = $data['imagesTEMP2'];
        }
        
        
        // Resize des images
        foreach ($data['imagesTEMP'] as $imageTmp)
        {
            $temp = strstr($imageTmp, "-RESIZE");
            if ($temp == false)
            {
                $resizeNameTemp = explode('.', $imageTmp);
                $resizeName = $resizeNameTemp[0].'-RESIZE.'.$resizeNameTemp[1];
                $resizer = new imageResizer();
                $resizer->generate_image_thumbnail($imageTmp, $resizeName, $longueurAResize, $hauteurAResize);
            }
        }
        
        return glob('assets/img/sponsors/*-RESIZE.'.'*');
    }
}
