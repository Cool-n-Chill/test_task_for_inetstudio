<?php

class SomeObject {

    public function __construct(
        protected string $name
    ) {}

    public function getObjectName(): string {
        return $this->name;
    }
}

interface ObjectHandler {
    public function getHandlableObjectName(): string;
    public function handle(SomeObject $object): string;
}

class Object1Handler implements ObjectHandler {
    public function handle(SomeObject $object): string {
        return 'handle_object_1';
    }

    public function getHandlableObjectName(): string
    {
        return 'object_1';
    }
}

class Object2Handler implements ObjectHandler {
    public function handle(SomeObject $object): string {
        return 'handle_object_2';
    }

    public function getHandlableObjectName(): string
    {
        return 'object_2';
    }
}

class SomeObjectsHandler {

    public function __construct(
        protected array $handlers = []
    ) {}

    public function handleObjects(array $objects): array {
        $result = [];
        foreach ($objects as $object) {
            $handler = $this->getHandler($object);
            if ($handler) {
                $result[$object->getObjectName()] = $handler->handle($object);
            }
        }
        return $result;
    }

    protected function getHandler(SomeObject $object): ?ObjectHandler {
        foreach ($this->handlers as $handler) {
            if ($object->getObjectName() === $handler->getHandlableObjectName()) {
                return $handler;
            }
        }
        return null;
    }
}

$objects = [
    new SomeObject('object_1'),
    new SomeObject('object_2')
];

$handlers = [
    new Object1Handler(),
    new Object2Handler()
];

$soh = new SomeObjectsHandler($handlers);
$soh->handleObjects($objects);
