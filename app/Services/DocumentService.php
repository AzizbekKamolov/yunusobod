<?php

namespace App\Services;

use Akbarali\DataObject\DataObjectCollection;
use App\ActionData\Document\CreateDocumentActionData;
use App\ActionData\Document\UpdateDocumentActionData;
use App\DataObjects\Document\DocumentData;
use App\Models\Document;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

class DocumentService
{
    public function paginate(int $page = 1, int $limit = 15, ?iterable $filters = null): DataObjectCollection
    {
        $query = Document::applyEloquentFilters($filters)->with('files', 'category');
        $total = $query->count();
        $skip = ($page - 1) * $limit;
        $documents = $query->skip($skip)->take($limit)->get();
        $documents->transform(fn(Document $document) => DocumentData::fromModel($document));
        return new DataObjectCollection($documents, $total, $limit, $page);
    }

    public function createDocument(CreateDocumentActionData $actionData): void
    {
        $data = $actionData->all();
        DB::beginTransaction();
        try {
            $document = Document::query()->create([
                'title' => $data['title'],
                'file_category_id' => $data['file_category_id']
            ]);
            if (isset($data['files'])) {
                foreach ($data['files'] as $file) {
                    FileService::uploadFile(file: $file['file'], model: $document, lang: $file['lang'], diskName: 'document', uploaded_at: $file['uploaded_at']);
                }
            }
            DB::commit();
        } catch (Throwable $th) {
            DB::rollBack();
            Log::error($th);
        }
    }

    public function updateDocument(UpdateDocumentActionData $actionData, int $id): void
    {
        $document = $this->getOne($id);
        $data = $actionData->all();
        $document->update($data);
        if (isset($data['files'])) {
            foreach ($data['files'] as $file) {
                FileService::uploadFile(file: $file['file'], model: $document, lang: $file['lang'], diskName: 'document', uploaded_at: $file['uploaded_at']);

            }
        }
    }


    public function getOne(int $id): Document
    {
        return Document::query()->with('files')->findOrFail($id);
    }


    public function deleteDocument(int $id): void
    {
        $document = $this->getOne($id);
        foreach ($document->files as $file) {
            FileService::fileDelete(diskName: 'document',id:  $file->id);
        }
        $document->delete();
    }

}
