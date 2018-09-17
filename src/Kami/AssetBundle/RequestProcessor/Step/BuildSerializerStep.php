<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 17.09.18
 * Time: 17:50
 */

namespace Kami\AssetBundle\RequestProcessor\Step;

use Kami\ApiCoreBundle\RequestProcessor\Step\Common\BuildSerializerStep as Base;
use Kami\Component\RequestProcessor\ArtifactCollection;
use Kami\Component\RequestProcessor\Artifact;
use Symfony\Component\HttpFoundation\Request;

class BuildSerializerStep extends Base
{
    public function execute(Request $request) : ArtifactCollection
    {
        return new ArtifactCollection([
            new Artifact('serializer', $this->serializer)
        ]);
    }
}