<?php

namespace App\ActionData\Document;

use Akbarali\ActionData\ActionDataBase;

class UpdateDocumentActionData extends ActionDataBase
{
    public ?int $id;
    public ?array $title;
    public ?array $files;
    public ?int $file_category_id;

    protected array $rules = [
        'title' => 'nullable|array',
        'title.*' => 'nullable|string',
        'file_category_id' =>'nullable|exists:file_categories,id',
        'files' => 'nullable|array',
        'files.*.file' => 'nullable|mimes:jpeg,png,jpg,gif,svg,pdf,doc,docx|max:8192',
        'files.*.lang' => 'nullable|in:uz,ru',
    ];
}
