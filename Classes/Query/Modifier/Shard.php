<?php
declare(strict_types=1);

namespace ApacheSolrForTypo3\Solr\Query\Modifier;

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

use ApacheSolrForTypo3\Solr\ConnectionManager;
use ApacheSolrForTypo3\Solr\Domain\Search\Query\Query;
use ApacheSolrForTypo3\Solr\Domain\Search\Query\QueryBuilder;
use ApacheSolrForTypo3\Solr\System\Configuration\TypoScriptConfiguration;
use ApacheSolrForTypo3\Solr\Util;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Modifies a query to add shard parameters
 *
 * http://localhost:8983/solr/core_de/select?shards=localhost:8983/solr/core_de,localhost:8983/solr/core_en
 */
class Shard implements Modifier
{
    /**
     * @var ConnectionManager
     */
    protected $connectionManager;
    /**
     * @var QueryBuilder
     */
    protected $queryBuilder;
    /**
     * @var TypoScriptConfiguration
     */
    protected $typoScriptConfiguration = null;

    public function __construct(QueryBuilder $builder = null)
    {
        $this->queryBuilder            = $builder ?? GeneralUtility::makeInstance(QueryBuilder::class);
        $this->typoScriptConfiguration = Util::getSolrConfiguration();
        $this->connectionManager       = GeneralUtility::makeInstance(ConnectionManager::class);
    }

    public function modifyQuery(Query $query): Query
    {
        $languages = GeneralUtility::trimExplode(',',
                                                 $this->typoScriptConfiguration->getValueByPath('plugin.tx_solr.search.query.shard.languages')
                                                 ??
                                                 '');

        if (count($languages) > 0) {
            $shards = [];
            foreach ($languages as $language) {
                $connection = $this->connectionManager->getConnectionByPageId($GLOBALS['TSFE']->id, (integer)$language);
                $node       = $connection->getNode('read');
                $shards[]   = rtrim($node->getCoreBasePath(), '/');
            }
            $query->addParam('shards', implode(',', $shards));
        }

        return $query;
    }
}
