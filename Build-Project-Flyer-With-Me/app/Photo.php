<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Intervention\Image\Facades\Image;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class Photo extends Model
{
    protected $table = "flyer_photos";

    protected $guarded = [];

    protected $file;

    protected static function boot(){
        static::creating(function($photo){
            $photo->upload();
        });
    }
    /**
     * A flyer is composed of many photos
     * @return photos
     */
    public function flyer()
    {
        return $this->belongsTo('App\Flyer');
    }

    public function upload()
    {
        $this->file->move($this->baseDir(), $this->fileName());
        $this->makeThumbnail();

        return $this;
    }

    protected function makeThumbnail()
    {
        Image::make($this->filePath())
            ->fit(200)
            ->save($this->thumbnailPath());
    }

    public static function fromFile(UploadedFile $file)
    {
        $photo = new static;

        $photo->file = $file;

        return $photo->fill([
            'name'=> $photo->fileName(),
            'path'=> $photo->filePath(),
            'thumbnail_path'=>$photo->thumbnailPath()
        ]);
    }

    protected function fileName()
    {
        $name = sha1(
            time().$this->file->getClientOriginalName()
        );

        $extension = $this->file->getClientOriginalExtension();

        return "{$name}.{$extension}";
    }

    protected function filePath()
    {
        return $this->baseDir().'/'.$this->fileName();
    }

    protected function thumbnailPath()
    {
        return $this->baseDir().'/tn-'.$this->fileName();
    }

    protected function baseDir()
    {
        return 'images/photos';
    }
}
