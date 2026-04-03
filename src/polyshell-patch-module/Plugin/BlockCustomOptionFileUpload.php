<?php
/**
 * Created by Qoliber
 *
 * @author qoliber <info@qoliber.com>
 */

declare(strict_types = 1);

namespace Qoliber\PolyshellPatch\Plugin;

use Magento\Catalog\Model\Webapi\Product\Option\Type\File\Processor;
use Magento\Framework\Api\Data\ImageContentInterface;
use Magento\Framework\Exception\InputException;
use Magento\Framework\Phrase;

class BlockCustomOptionFileUpload
{
    /**
     * Prevent custom option file uploads via the Web API item option flow.
     *
     * @param Processor $subject
     * @param ImageContentInterface $imageContent
     * @throws InputException
     *
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function beforeProcessFileContent(
        Processor $subject,
        ImageContentInterface $imageContent
    ): void {
        throw new InputException(
            new Phrase('Uploading file-type custom options is disabled.')
        );
    }
}
