<?php

namespace App\Models\Contracts;

use Illuminate\Http\UploadedFile;

interface UploadedFilesInterface
{
    /**
     * for default filename on database.
     *
     * @return string
     */
    public function fileColumn(): string;

    /**
     * check if there any uploaded file before.
     *
     * @return boolean
     */
    public function hasPreviousFile(): bool;

    /**
     * delete previous uploaded file.
     *
     * @return void
     */
    public function deletePreviousFile(): void;

    /**
     * to save uploaded file to directory folder.
     *
     * @param \Illuminate\Http\UploadedFile $file
     * @return void
     */
    public function saveFile(UploadedFile $file): void;
}
