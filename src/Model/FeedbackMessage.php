<?php
declare(strict_types=1);

namespace App\Model;

use DateTimeImmutable;

class FeedbackMessage
{
    public string $userName;
    public string $message;
    public int $categoryId;
    public int $createdAt;
    
    public function __construct(string $userName, string $message, int $categoryId)
    {
        $this->userName = $userName;
        $this->message = $message;
        $this->categoryId = $categoryId;
        $this->createdAt = (new DateTimeImmutable())->getTimestamp();
    }
}
