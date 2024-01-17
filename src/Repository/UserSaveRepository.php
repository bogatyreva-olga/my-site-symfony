<?php
declare(strict_types=1);

namespace App\Repository;

use Symfony\Component\Filesystem\Filesystem;

class UserSaveRepository
{
    private const FILE_PATH = '/tmp/usersRegister.txt';
    private Filesystem $filesystem;

    public function __construct(Filesystem $filesystem)
    {
        $this->filesystem = $filesystem;
    }

    public function getUserData(): array
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
    public function persistUserData($messages)
    {
        $userDataJson = json_encode($messages);
        $this->filesystem->dumpFile(self::FILE_PATH, $userDataJson);

        return $userDataJson;
    }
}

