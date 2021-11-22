<?php


namespace Lys\Until\Img;

/**
 * 图片大小质量转化类
 * @author linyushan
 * Class ImgQuality
 * @package Lys\Until\Img
 */
class ImgQuality
{
    private $picture_create;
    private $picture_type;
    private $picture_ext;
    private $picture_width;
    private $picture_height;
    private $picture_mime;
    private $tmp_path;
    private $error_msg;
    private $picture_size;

    /**
     * ImgQuality constructor.
     * @param $path  //原始图片文件路径
     * @param $tmp_path //压缩转化图片文件路径
     */
    public function __construct($path, $tmp_path)
    {
        $this->tmp_path = $tmp_path;
        $this->getInfo($path);
    }

    public function getInfo($picture_url)
    {
        /**
         * 处理原图片的信息,先检测图片是否存在,不存在则给出相应的信息
         */
        $size = @getimagesize($picture_url);
        if (empty($size)) {
            $this->error_msg = '要处理的图片加载失败';
            return false;
        }
        // 得到原图片的信息类型、宽度、高度
        $this->picture_mime = $size['mime'];
        $this->picture_width = $size[0];
        $this->picture_height = $size[1];
        $this->picture_size = filesize($picture_url);
        // 创建图片
        switch ($size[2]) {
            case 1:
                $this->picture_create = imagecreatefromgif($picture_url);
                $this->picture_type = "imagejpeg";
                $this->picture_ext = "jpg";
                break;
            case 2:
                $this->picture_create = imagecreatefromjpeg($picture_url);
                $this->picture_type = "imagegif";
                $this->picture_ext = "gif";
                break;
            case 3:
                $this->picture_create = imagecreatefrompng($picture_url);
                $this->picture_type = "imagepng";
                $this->picture_ext = "png";
                break;
            default:
                $this->error_msg = '要处理的图片加载失败，或者图片类型不对';
        }

    }

    /**
     * @param $picture_type //图片类型 如 jpg、png、gif
     * @param $maxsize //最大文件大小
     * @return bool
     */
    public function validate($picture_type, $maxsize)
    {
        if ($picture_type != $this->picture_type) {
            return false;
        }
        if ($maxsize < $this->picture_size) {
            return false;
        }
        return true;
    }

    /**
     * @return mixed
     */
    public function getPictureCreate()
    {
        return $this->picture_create;
    }

    /**
     * @return mixed
     */
    public function getPictureType()
    {
        return $this->picture_type;
    }

    /**
     * @return mixed
     */
    public function getPictureExt()
    {
        return $this->picture_ext;
    }

    /**
     * @return mixed
     */
    public function getPictureWidth()
    {
        return $this->picture_width;
    }

    /**
     * @return mixed
     */
    public function getPictureHeight()
    {
        return $this->picture_height;
    }

    /**
     * @return mixed
     */
    public function getPictureMime()
    {
        return $this->picture_mime;
    }

    /**
     * @return mixed
     */
    public function getTmpPath()
    {
        return $this->tmp_path;
    }

    /**
     * @return mixed
     */
    public function getErrorMsg()
    {
        return $this->error_msg;
    }

    /**
     * 将图片转化为jpg
     * @param string $maxsize
     * @param int $quality
     * @return string $path
     */
    public function toJpg($quality = 90, $maxsize = 'auto')
    {
        if (empty($this->picture_create)) {
            return false;
        }
        if ($maxsize != 'auto') {
            $res = imagejpeg($this->picture_create, $this->tmp_path, $quality);
            if (empty($res)) {
                $this->error_msg = '图片转化失败';
                return false;
            }
            $filesize = filesize($this->tmp_path);
            if ($filesize < $maxsize) {
                return $this->tmp_path;
            }
            @unlink($this->tmp_path);
            return $this->toJpg($quality - 5, $maxsize);
        } else {
            $res = imagejpeg($this->picture_create, $this->tmp_path, $quality);
        }
        if ($res) {
            return $this->tmp_path;
        }
        $this->error_msg = '图片转化失败';
        return false;
    }
}