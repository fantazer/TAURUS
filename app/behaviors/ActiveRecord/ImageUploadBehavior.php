<?php

namespace app\behaviors\ActiveRecord;

use yii\base\Behavior;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;
use yii\imagine\Image;
use Imagine\Image\Box;
use yii\base\ErrorException;

class ImageUploadBehavior extends Behavior
{
    /**
     * Название поля в модели, которое хранит название изображения
     *
     * @var $string
     */
    private $modelFileAttrName;

    /**
     * Путь до папки содержащей изображения
     *
     * @var string
     */
    private $fileDir;

    /**
     * @var string
     */
    private $imageWidth = null;

    /**
     * @var $imageHeight
     */
    private $imageHeight = null;

    /**
     * @param string $attrName
     */
    public function setModelFileAttrName($attrName)
    {
        $this->modelFileAttrName = $attrName;
    }

    /**
     * @param string $fileDir
     */
    public function setFileDir($fileDir)
    {
        $this->fileDir = $fileDir;
    }

    public function setImageWidth($imageWidth)
    {
        $this->imageWidth = $imageWidth;
    }

    public function setImageHeight($imageHeight)
    {
        $this->imageHeight = $imageHeight;
    }

    /**
     * Назначаем обработчики для событий
     *
     * @return array
     */
    public function events()
    {
        return [
            ActiveRecord::EVENT_BEFORE_INSERT => 'beforeInsert',
            ActiveRecord::EVENT_BEFORE_UPDATE => 'beforeUpdate',
            ActiveRecord::EVENT_BEFORE_DELETE=> 'beforeDelete',
        ];
    }

    /**
     * Выполняет действие перед созданием новой модели
     *
     * @return void
     */
    public function beforeInsert()
    {
        $this->uploadImage();
    }

    /**
     * Загрузка изображения
     */
    private function uploadImage()
    {
        $uploadFile = UploadedFile::getInstance($this->owner, $this->modelFileAttrName);
        if($uploadFile != null) {
            $fileName = time() . '_' . \Yii::$app->security->generateRandomString(5) . '.' . $uploadFile->extension;

            if(!$uploadFile->saveAs($this->fileDir . $fileName)) {
                throw new ErrorException('Ошибка загрузки файла. ' . $this->uploadFileErrorToString($uploadFile->error), 500);
            } else {
                $this->owner->{$this->modelFileAttrName} = $fileName;
                Image::getImagine()
                    ->open($this->fileDir . $fileName)
                    ->thumbnail(new Box($this->imageWidth, $this->imageHeight))
                    ->save($this->fileDir . $fileName);
                return true;
            }
        } else {
            if(!$this->owner->isNewRecord) {
                $this->owner->{$this->modelFileAttrName} = $this->owner->getOldAttribute($this->modelFileAttrName);
            }

            return false;
        }
    }

    /**
     * Выполняет действия при обновлении сущестующей модели
     *
     * @return void
     */
    public function beforeUpdate()
    {
        if($this->uploadImage()) {
            $this->deleteImage($this->fileDir . $this->owner->getOldAttribute($this->modelFileAttrName));
        }
    }

    /**
     * Удаление изображения
     *
     * @param string $file
     */
    private function deleteImage($file)
    {
        if(file_exists($file) && !is_dir($file)) {
            unlink($file);
        }
    }

    /**
     * Выполняет действия при удалении модели
     *
     * @return void
     */
    public function beforeDelete()
    {
        $this->deleteImage($this->fileDir . $this->owner->{$this->modelFileAttrName});
    }

    /**
     * @param $code
     * @return string
     */
    private function uploadFileErrorToString($code)
    {
        switch ($code) {
            case UPLOAD_ERR_OK:
                return 'Нет ошибки';
            case UPLOAD_ERR_INI_SIZE:
                return 'Размер принятого файла превысил максимально допустимый размер';
            case UPLOAD_ERR_FORM_SIZE:
                return 'Размер загружаемого файла превысил значение указанное в форме';
            case UPLOAD_ERR_PARTIAL:
                return 'Загружаемый файл был получен только частично.';
            case UPLOAD_ERR_NO_FILE:
                return 'Файл не был загружен.';
            case UPLOAD_ERR_NO_TMP_DIR:
                return 'Отсутствует временная папка.';
            case UPLOAD_ERR_CANT_WRITE:
                return 'Не удалось записать файл на диск.';
            case UPLOAD_ERR_EXTENSION:
                return 'PHP-расширение остановило загрузку файла.';
            default:
                return 'Неизвестная ошибка';
        }
    }
}