<?php

namespace App\Transformers;

use League\Fractal;
use League\Fractal\TransformerAbstract;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;


class UserOtherTransformer extends TransformerAbstract
{
    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = ['post'];

    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected $defaultIncludes = [];

    /**
     * Transform object into a generic array
     *
     * @var $resource
     * @return array
     */
    public function transform(User $user)
    {
        $data = [
            'id' => $user->id,
            'username' => $user->username,
            'nickname' => $user->nickname,
            'head_img' => $user->head_img,
//            'user_group' => $user->user_group,
        ];
        if($user->email_access){
            $data['email'] = $user->email;
        }
        if($user->phone_access) {
            $data['phone'] = $user->phone;
        }
        if($user->qq_access){
            $data['qq'] = $user->qq;
        }
        return $data;
    }

    /**
     * @param User $user
     * @return Collection
     */
    public function includePosts(User $user)
    {
        return $this->collection($user->posts(),new PostTransformer());
    }
}