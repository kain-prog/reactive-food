<?php

return [
    Symfony\Bundle\FrameworkBundle\FrameworkBundle::class => ['all' => true],
    Symfony\UX\StimulusBundle\StimulusBundle::class => ['all' => true],
    Symfony\UX\Turbo\TurboBundle::class => ['all' => true],
    Symfony\Bundle\TwigBundle\TwigBundle::class => ['all' => true],
    Twig\Extra\TwigExtraBundle\TwigExtraBundle::class => ['all' => true],
    Symfony\Bundle\MakerBundle\MakerBundle::class => ['dev' => true],
    App\Bundles\CategoryBundle\CategoryBundle::class => ['all' => true],
    App\Bundles\ProductBundle\ProductBundle::class => ['all' => true],
    App\Bundles\OrderBundle\OrderBundle::class => ['all' => true],
    App\Bundles\CardBundle\CardBundle::class => ['all' => true],
    App\Bundles\AddressBundle\AddressBundle::class => ['all' => true],
    App\Bundles\CustomerBundle\CustomerBundle::class => ['all' => true],
    Doctrine\Bundle\DoctrineBundle\DoctrineBundle::class => ['all' => true],
    Doctrine\Bundle\MigrationsBundle\DoctrineMigrationsBundle::class => ['all' => true],
];
