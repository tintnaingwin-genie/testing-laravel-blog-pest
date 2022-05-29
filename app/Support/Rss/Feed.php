<?php

namespace App\Support\Rss;

use Feed as BaseFeed;
use FeedException;
use SimpleXMLElement;

class Feed extends BaseFeed
{
    public static function fromAtom(SimpleXMLElement $xml)
    {
        if (!in_array('http://www.w3.org/2005/Atom', $xml->getDocNamespaces(), true)
            && !in_array('http://purl.org/atom/ns#', $xml->getDocNamespaces(), true)
        ) {
            throw new FeedException('Invalid feed.');
        }

        // generate 'timestamp' tag
        foreach ($xml->entry as $entry) {
            $entry->timestamp = strtotime($entry->updated);
        }
        $feed = new self;
        $feed->xml = $xml;
        return $feed;
    }
}
