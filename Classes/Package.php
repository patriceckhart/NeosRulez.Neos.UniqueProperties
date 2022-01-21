<?php
namespace NeosRulez\Neos\UniqueProperties;

use Neos\Flow\Annotations as Flow;
use Neos\Flow\Package\Package as BasePackage;
use Neos\Flow\Core\Bootstrap;
use Neos\ContentRepository\Domain\Model\Node;
use NeosRulez\Neos\UniqueProperties\Service\UniquePropertyService;

class Package extends BasePackage {

    /**
     * @param Bootstrap $bootstrap The current bootstrap
     * @return void
     */
    public function boot(Bootstrap $bootstrap) {
        $dispatcher = $bootstrap->getSignalSlotDispatcher();
        $dispatcher->connect(Node::class, 'nodePropertyChanged', UniquePropertyService::class, 'onNodePropertyChanged');
    }

}
