<?php

return [
    'name' => 'Isearch',

    'queries'=>[

        /* 'iblog' => function ($searchphrase){
            return \Modules\Iblog\Entities\Post::query()->where('title','LIKE',"%{$searchphrase}%")
            ->orWhere('description','LIKE',"%{$searchphrase}%")
            ->orderBy('created_at', 'DESC')->paginate(12);
        }*/
    ],
];
