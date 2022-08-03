<?php declare(strict_types=1);

namespace Macademy\Blog\ViewModel;

//use Magento\Framework\DataObject;
use Macademy\Blog\Api\Data\PostInterface;
use Macademy\Blog\Api\PostRepositoryInterface;
use Macademy\Blog\Model\ResourceModel\Post\Collection;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\View\Element\Block\ArgumentInterface;

class Post implements ArgumentInterface
{
    public function __construct(
        private Collection $collection,
        private PostRepositoryInterface $postRepository,
        private RequestInterface $request,
    ) {
    }
    public function getList(): array
    {
        return $this->collection->getItems();
//        METHOD TO HARD CODE DATA
//        return [
//          new DataObject(['id' => 1, 'title' => 'Post 1']),
//          new DataObject(['id' => 2, 'title' => 'Post 2']),
//          new DataObject(['id' => 3, 'title' => 'Post 3']),
//        ];
    }

    public function getCount(): int
    {
//        return count($this->getList());
        return $this->collection->count();
    }

    public function getDetail(): PostInterface
    {
        $id = (int) $this->request->getParam('id');
        return $this->postRepository->getById($id);
    }
}
