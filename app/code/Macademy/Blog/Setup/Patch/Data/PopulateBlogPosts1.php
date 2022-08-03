<?php declare(strict_types=1);

namespace Macademy\Blog\Setup\Patch\Data;

use Macademy\Blog\Api\PostRepositoryInterface;
use Macademy\Blog\Model\PostFactory;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\Patch\PatchInterface;

class PopulateBlogPosts1 implements DataPatchInterface
{
    public function __construct(
        private ModuleDataSetupInterface $moduleDataSetup,
        private PostFactory $postFactory,
        private PostRepositoryInterface $postRepository,
    ) {
    }

    public static function getDependencies(): array
    {
        return [];
    }

    public function getAliases(): array
    {
        return [];
    }

    /**
     * @throws CouldNotSaveException
     */
    public function apply()
    {
        $this->moduleDataSetup->startSetup();

        $posts = [
            [
                'title' => 'A second post',
                'content' => 'This is a second post!' ,
            ],
            [
                'title' => 'A third post',
                'content' => 'This is a third post!' ,
            ],
        ];

        foreach ($posts as $postData) {
            $post = $this->postFactory->create();
            $post->setData($postData);

            try {
                $this->postRepository->save($post);
            } catch (\Exception $exception) {
                throw new CouldNotSaveException(__($exception->getMessage()));
            }
        }

        $this->moduleDataSetup->endSetup();
    }
}
