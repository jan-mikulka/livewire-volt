<?php

namespace App\Enums;

enum ResourceType: string
{
    case Idea = 'idea';
    case Meet = 'meet';
    case Book = 'book';
    case Article = 'article';
    case Video = 'video';
    case Audio = 'audio';
}
