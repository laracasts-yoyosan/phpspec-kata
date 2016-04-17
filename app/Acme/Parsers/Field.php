<?php

namespace Acme\Parsers;

use Acme\Parsers\Exceptions\UnrecognizedType;

class Field
{
    /**
     * parse
     * @param  string $fields
     * @return array
     */
    public function parse($fields)
    {
        $chunks = $this->splitFieldsIntoChunks($fields);
        $parsed = [];

        foreach ($chunks as $chunk) {
            $parsed = $this->parseChunk($chunk, $parsed);
        }

        return $parsed;
    }

    /**
     * @param  string $fields
     * @return array
     */
    protected function splitFieldsIntoChunks($fields)
    {
        return preg_split('/, ?/', $fields);
    }

    protected function parseChunk($declaration, $parsed)
    {
        list($property, $type) = explode(':', $declaration);

        if (!$this->typeIsRecognized($type)) {
            throw new UnrecognizedType();
        }

        $parsed[$property] = $type;

        return $parsed;
    }

    protected function typeIsRecognized($type)
    {
        return in_array($type, ['string', 'text']);
    }
}
