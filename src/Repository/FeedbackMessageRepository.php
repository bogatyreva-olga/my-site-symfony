<?php
declare(strict_types=1);

namespace App\Repository;

use Symfony\Component\Filesystem\Filesystem;

class FeedbackMessageRepository
{
    private const FILE_PATH = '/tmp/fbm.txt';
    private Filesystem $filesystem;

    public function __construct(Filesystem $filesystem)
    {
        $this->filesystem = $filesystem;
    }

    public function getMessages(): array
    {
        $messages = [];
        if ($this->filesystem->exists(self::FILE_PATH)) {
            $fileContent = file_get_contents(self::FILE_PATH);
            if ($fileContent !== false && $fileContent !== '') {
                $messages = json_decode($fileContent, true);
            }
        }

        return $messages;
    }

    public function persistMessages($messages)
    {
        $fbmsJson = json_encode($messages);
        $this->filesystem->dumpFile(self::FILE_PATH, $fbmsJson);

        return $fbmsJson;
    }

    public function getFeedbackMessagesByCategoryId(int $categoryId): array
    {
        $messages = $this->getMessages();
        if ($categoryId <= 0) {
            return $messages;
        }

        $messagesValue = array_filter($messages, function ($el) use ($categoryId) {
            return $el['categoryId'] === $categoryId;
        });

        return array_values($messagesValue);
    }
}
