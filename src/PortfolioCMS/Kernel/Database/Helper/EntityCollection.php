<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 22-12-2016 17:35
 * Licence: GNU General Public licence version 3 <https://www.gnu.org/licenses/quick-guide-gplv3.html>
 */
declare( strict_types = 1 );

namespace StendenINF1B\PortfolioCMS\Kernel\Database\Helper;


use StendenINF1B\PortfolioCMS\Kernel\Helper\ParameterContainer;

class EntityCollection extends ParameterContainer
{
    /**
     * Gets an new EntityCollection filtered by the entities which field has an certain value.
     *
     * @param string $fieldName
     * @param        $hasValue
     * @return EntityCollection
     */
    public function getEntitiesWith( string $fieldName, $hasValue )
    {
        $filteredEntityCollection = new EntityCollection();

        foreach ( $this->parameters as $entityId => $entity )
        {
            if( isset( $entity->{$fieldName} ))
            {
                if( $entity->{$fieldName} == $hasValue )
                {
                    $filteredEntityCollection->set( $entityId, $entity );
                }
            }
            else
            {
                // The field name was not found so return an empty entity collection.
                return $filteredEntityCollection;
            }
        }
        return $filteredEntityCollection;
    }
}