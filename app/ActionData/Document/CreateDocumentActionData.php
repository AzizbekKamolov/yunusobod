<?php
declare(strict_types=1);
namespace App\ActionData\Document;


use Akbarali\ActionData\ActionDataBase;

class CreateDocumentActionData extends ActionDataBase
{
    public ?int $id;
    public ?array $title;
    public ?array $files;
    public ?int $file_category_id;

    protected array $rules = [
        'title' => 'required|array',
        'title.*' => 'required|string',
        'file_category_id' =>'required|exists:file_categories,id',
        'files' => 'required|array',
        'files.*.file' => 'required|mimes:jpeg,png,jpg,gif,svg,pdf,doc,docx|max:8192',
        'files.*.lang' => 'required|in:uz,ru',
    ];
}
