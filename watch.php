<?php

return [
    'text_watch' => [
        'file' => __DIR__ . '/watchables/text.txt',
        'onEdit' => function(\Watcher\MainBus $bus) {
            $bus->setDisableFlag(true);
        }
    ]
];