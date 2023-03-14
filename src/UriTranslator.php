<?php

namespace CodeZero\UriTranslator;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Str;

class UriTranslator
{
    /**
     * Translate a URI.
     *
     * @param string $uri
     * @param string|null $locale
     * @param string|null $namespace
     *
     * @return string
     */
    public function translate($uri, $locale = null, $namespace = null)
    {
        $fullUriKey = $this->buildTranslationKey($uri, $namespace);

        // Attempt to translate the full URI.
        if (Lang::has($fullUriKey, $locale)) {
            return Lang::get($fullUriKey, [], $locale);
        }

        $segments = $this->splitUriIntoSegments($uri);

        // Attempt to translate each segment individually. If there is no translation
        // for a specific segment, then its original value will be used.
        $translations = $segments->map(function ($segment) use ($locale, $namespace) {
            $segmentKey = $this->buildTranslationKey($segment, $namespace);

            // If the segment is not a placeholder and the segment
            // has a translation, then update the segment.
            if ( ! Str::startsWith($segment, '{') && Lang::has($segmentKey, $locale)) {
                $segment = Lang::get($segmentKey, [], $locale);
            }

            return $segment;
        });

        // Rebuild the URI from the translated segments.
        return $translations->implode('/');
    }

    /**
     * Split the URI into a Collection of segments.
     *
     * @param string $uri
     *
     * @return \Illuminate\Support\Collection
     */
    protected function splitUriIntoSegments($uri)
    {
        $uri = trim($uri, '/');
        $segments = explode('/', $uri);

        return Collection::make($segments);
    }

    /**
     * Build a translation key, including the namespace and file name.
     *
     * @param string $key
     * @param string|null $namespace
     *
     * @return string
     */
    protected function buildTranslationKey($key, $namespace)
    {
        $namespace = $namespace ? "{$namespace}::" : '';
        $file = $this->getTranslationFileName();

        return "{$namespace}{$file}.{$key}";
    }

    /**
     * Get the file name that holds the URI translations.
     *
     * @return string
     */
    protected function getTranslationFileName()
    {
        return 'routes';
    }
}
