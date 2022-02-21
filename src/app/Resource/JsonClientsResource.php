<?php

namespace App\Resource;

use Hyperf\Resource\Json\ResourceCollection;

class JsonClientsResource extends ResourceCollection
{
    /**
     * 指示是否應保留資源的集合鍵。
     *
     * @var bool
     */
    public $preserveKeys = true;

    /**
     * Transform the resource collection into an array.
     *
     * @return array
     */
    public function toArray(): array
    {
        // return parent::toArray();
        return [
            'data' => $this->collection,
            // 'links' => [
            //     'self' => 'link-value',
            // ],
        ];
    }
}
