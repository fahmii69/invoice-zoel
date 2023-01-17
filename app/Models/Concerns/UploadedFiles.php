<?php

namespace App\Models\Concerns;

use App\Jobs\DeleteFileJob;
use App\Models\Contracts\UploadedFilesInterface;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Filesystem\FilesystemAdapter;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;


trait UploadedFiles
{

    /**
     * for automatically saving & deleting an file 
     * whenever an method event occurs on the model.
     *
     * @return void
     */
    public static function booted()
    {
        /**
         * @param \Illuminate\Database\Eloquent\Model<\App\Models\Contracts\UploadedFilesInterface>
         */
        static::saving(function ($model) {

            if ($model->isDirty($model->fileColumn())) {
                if ($model->hasPreviousFile()) {
                    $model->deletePreviousFile();
                }

                $file = $model->getAttribute($model->fileColumn());

                if ($file instanceof UploadedFile) {
                    $model->saveFile($file);
                }
            }
        });

        /**
         * @param \Illuminate\Database\Eloquent\Model<\App\Models\Contracts\UploadedFilesInterface>
         */
        static::deleting(function ($model) {

            $model->update([
                $model->fileColumn() => null
            ]);
        });
    }

    /**
     * for default filename on database.
     *
     * @return string
     */
    public function fileColumn(): string
    {
        return 'file';
    }

    /**
     * default file folder.
     *
     * @return string
     */
    public function getFilePath(): string
    {
        return 'files';
    }

    /**
     * default file storage name.
     *
     * @return string
     */
    public function getStorageName(): string
    {
        return config('filesystems.default');
    }

    /**
     * to make uploaded filename hashed to database.
     *
     * @param UploadedFile $file
     * @return string
     */
    public function getUploadedFilename(UploadedFile $file): string
    {
        return $file->hashName();
    }

    /**
     * show message if upload failed.
     *
     * @return string
     */
    public function getFailedMessage(): string
    {
        return 'Failed to Upload File';
    }

    /**
     * to save uploaded file to directory folder.
     *
     * @param UploadedFile $file
     * @return void
     */
    public function saveFile(UploadedFile $file): void
    {
        $fileName = $this->getUploadedFilename(file: $file);

        $uploaded = $file->storeAs(
            path: $this->getFilePath(),
            name: $fileName,
            options: $this->getStorageName(),
        );

        if (!$uploaded) {
            throw new \Exception($this->getFailedMessage(), 1);
        }
        $this->setAttribute(
            key: $this->fileColumn(),
            value: $fileName
        );
    }

    /**
     * create filesystem folder.
     *
     * @return Filesystem | FilesystemAdapter
     */
    public function getFileStorage(): Filesystem | FilesystemAdapter
    {
        return Storage::disk($this->getStorageName());
    }

    /**
     * get full uploaded file path.
     *
     * @return string
     */
    public function getFullFilePath(): string
    {
        return $this->getFilePath() . '/' . $this->getAttribute($this->fileColumn());
    }

    /**
     * get previous uploaded file path.
     *
     * @return string
     */
    public function getPreviousFilePath(): string
    {
        return $this->getFilePath() . '/' . $this->getRawOriginal($this->fileColumn());
    }

    /**
     * check the file if there was an uploaded file on database.
     *
     * @return boolean
     */
    public function hasFile(): bool
    {
        return !blank($this->getAttribute($this->fileColumn()));
    }

    /**
     * show the uploaded file if there was an uploadfile on database.
     *
     * @return string|null
     */
    public function imageAsset(): ?string
    {
        if (!$this->hasFile()) {
            return null;
        };

        return $this->getFileStorage()->url($this->getFullFilePath());
    }

    /**
     * check if there any uploaded file before.
     *
     * @return boolean
     */
    public function hasPreviousFile(): bool
    {
        return !blank($this->getRawOriginal($this->fileColumn()));
    }

    /**
     * delete previous uploaded file.
     *
     * @return void
     */
    public function deletePreviousFile(): void
    {
        if (!$this->hasPreviousFile()) {
            return;
        }

        DeleteFileJob::dispatch(
            $this->getPreviousFilePath(),
            $this->getStorageName()
        )->afterCommit();
    }
}
