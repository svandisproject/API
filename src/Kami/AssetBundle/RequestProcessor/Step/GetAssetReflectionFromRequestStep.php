<?php

namespace Kami\AssetBundle\RequestProcessor\Step;

use Kami\AssetBundle\Entity\Asset;
use Kami\Component\RequestProcessor\Artifact;
use Kami\Component\RequestProcessor\ArtifactCollection;
use Kami\Component\RequestProcessor\Step\AbstractStep;
use Symfony\Component\HttpFoundation\Request;

class GetAssetReflectionFromRequestStep extends AbstractStep
{

    /**
     * @param Request $request
     * @return ArtifactCollection
     * @throws \ReflectionException
     */
    public function execute(Request $request) : ArtifactCollection
    {
        return new ArtifactCollection([
            new Artifact('reflection', new \ReflectionClass(Asset::class))
        ]);
    }

    public function getRequiredArtifacts(): array
    {
        return [];
    }
}