<?php
namespace NeosRulez\Neos\UniqueProperties\Service;

use Neos\Flow\Annotations as Flow;

/**
 * @Flow\Scope("singleton")
 */
class UniquePropertyService
{

    /**
     * @Flow\Inject
     * @var \Doctrine\ORM\EntityManagerInterface
     */
    protected $entityManager;

    /**
     * @var array
     */
    protected $settings;

    /**
     * @param array $settings
     * @return void
     */
    public function injectSettings(array $settings) {
        $this->settings = $settings;
    }


    public function onNodePropertyChanged($node, $propertyName, $oldValue, $newValue)
    {
        $properties = $this->settings;
        if(!empty($properties)) {
            $connection = $this->entityManager->getConnection();
            $rows = [];
            foreach ($properties as $property) {
                if(!empty($property['nodeTypes'])) {
                    foreach ($property['nodeTypes'] as $nodeType) {
                        $nodes = $connection->executeQuery('SELECT * FROM neos_contentrepository_domain_model_nodedata WHERE nodetype = "' . $nodeType . '"')->fetchAll();
                        if(!empty($nodes)) {
                            foreach ($nodes as $item) {
                                $rows[] = $item;
                            }
                        }
                    }
                }
                if(!empty($rows)) {
                    foreach ($rows as $row) {
                        $props = json_decode($row['properties'], true);
                        if(array_key_exists($propertyName, $props)) {
                            if($props[$propertyName] == $newValue) {
                                throw new \Exception(sprintf('The value entered in "%s" already exists.', $propertyName));
                            }
                        }
                    }
                }
            }
        }
    }

}
