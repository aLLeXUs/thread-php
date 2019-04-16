<?php

declare(strict_types = 1);

namespace App\Http\Presenter\Tweet;

use App\Entity\Tweet;
use App\Http\Presenter\CollectionAsArrayPresenter;
use Illuminate\Support\Collection;
use App\Http\Presenter\User\UserArrayPresenter;
use App\Http\Presenter\Comment\CommentAsArrayPresenter;

final class TweetArrayPresenter implements CollectionAsArrayPresenter
{
    private $userPresenter;
    private $commentPresenter;

    public function __construct(
        UserArrayPresenter $userPresenter,
        CommentAsArrayPresenter $commentPresenter
    ) {
        $this->userPresenter = $userPresenter;
        $this->commentPresenter = $commentPresenter;
    }

    public function present(Tweet $tweet): array
    {
        return [
            'id' => $tweet->getId(),
            'text' => $tweet->getText(),
            'image_url' => $tweet->getImageUrl(),
            'created_at' => $tweet->getCreatedAt()->toDateTimeString(),
            'author' => $this->userPresenter->present($tweet->author),
            'comments' => $this->commentPresenter->presentCollection($tweet->comments)
        ];
    }

    public function presentCollection(Collection $collection): array
    {
        return $collection
            ->map(
                function (Tweet $tweet) {
                    return $this->present($tweet);
                }
            )
            ->all();
    }
}
