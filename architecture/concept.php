<?php

interface TokenStorageInterface {
    public function getSecretKey():string;
}

class DbTokenStorage implements TokenStorageInterface {
    public function getSecretKey(): string
    {
        return 'token from DB';
    }
}


class FileTokenStorage implements TokenStorageInterface {
    public function getSecretKey(): string
    {
        return 'token from file storage';
    }
}


class RedisTokenStorage implements TokenStorageInterface {
    public function getSecretKey(): string
    {
        return 'token from redis storage';
    }
}

class Concept {
    public function __construct(
        private \GuzzleHttp\Client $client = new \GuzzleHttp\Client(),
        private string $storageType
    ) {}

    public function getUserData() {
        $params = [
            'auth' => ['user', 'pass'],
            'token' => $this->getSecretKey()
        ];

        $request = new \Request('GET', 'https://api.method', $params);
        $promise = $this->client->sendAsync($request)->then(function ($response) {
            $result = $response->getBody();
        });

        $promise->wait();
    }

    private function getSecretKey():string {
        return $this->chooseTokenStorage()->getSecretKey();
    }

    private function chooseTokenStorage(): TokenStorageInterface {
        return match ($this->storageType) {
            'file storage' => new FileTokenStorage(),
            'redis storage' => new RedisTokenStorage(),
            default => new DbTokenStorage(),
        };
    }
}