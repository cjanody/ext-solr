<?php
declare(strict_types=1);

namespace ApacheSolrForTypo3\Solr\Search;

/*
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

use ApacheSolrForTypo3\Solr\Query\Modifier\Shard;

/**
 * Shard search component
 *
 * @author Christoph Lehmann
 */
class ShardComponent extends AbstractComponent
{

    /**
     * Initializes the search component.
     */
    public function initializeSearchComponent(): void
    {
        $GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['solr']['modifySearchQuery']['shard'] = Shard::class;
    }
}
