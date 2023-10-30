<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Models\User;

class FeedbackResource extends ResourceCollection
{

    public function toArray($request)
    {
        return $this->collection->transform(function($feedback) {
            $user = User::find($feedback->user_id);
            return [
                'id' => $feedback->id,
                'user_name' => $user->user_name,
                'user_avatar' => url('/').$user->avatar,
                'text' => $feedback->text,
                'rating' => $feedback->rating,
                'created_at' => $feedback->created_at,
            ];
        });

    }
}