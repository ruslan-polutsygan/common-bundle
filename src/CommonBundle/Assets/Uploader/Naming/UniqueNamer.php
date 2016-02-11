<?php

namespace RP\CommonBundle\Assets\Uploader\Naming;

use Vich\UploaderBundle\Mapping\PropertyMapping;
use Vich\UploaderBundle\Naming\Polyfill\FileExtensionTrait;
use Vich\UploaderBundle\Naming\UniqidNamer;

class UniqueNamer extends UniqidNamer
{
    use FileExtensionTrait;

    /**
     * @param object          $entity
     * @param PropertyMapping $mapping
     *
     * @return string
     */
    public function name($entity, PropertyMapping $mapping)
    {
        $extension = $this->getExtension($mapping->getFile($entity));

        if ($mapping->getUriPrefix()) {
            $namePieces[] = $mapping->getUriPrefix();
        }

        $namePieces[] = sprintf('%s.%s',
            str_replace('.', '', uniqid('', true)), $extension
        );

        $name = implode('/', $namePieces);

        return $name;
    }
}
