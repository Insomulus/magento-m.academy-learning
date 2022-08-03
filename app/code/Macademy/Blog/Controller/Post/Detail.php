<?php declare(strict_types=1);

// namespace Macademy\Blog\Controller\Post;

// use Magento\Customer\Model\Session;
// use Magento\Framework\App\Action\HttpGetActionInterface;
// use Magento\Framework\App\RequestInterface;

// REMEMBER THAT THIS IS THE CODE FOR PHP 7.4, MY SYSTEM IS RUNNING 8.1.8 BUT MY NGINX
// IS RUNNING 7.3.*. MAKE SURE TO FIX NGINX VERSION LATE AND USE NEWER METHOD OF DOING THIS
// -- DEPENDENCY INJECTION, OBJECT WITH DEPENDENCY INJECTION USING SINGLETON --
//class Detail implements HttpGetActionInterface
//{
//    private $session;
//    private $request;
//    public function __construct(
//        Session $session,
//        RequestInterface $request
//    )
//     {
//        $this->session = $session;
//        $this->request = $request;
//    }
//
//
//    public function execute()
//    {
//        echo '<pre>';
//        // USUALLY ONLY DUMP TO SCREEN WHEN DEBUGGING
//        var_dump($this->session->getData());
//       var_dump($this->request->getParams());
//        die();
//    }
//}

/*namespace Macademy\Blog\Controller\Post;

use Magento\Customer\Model\Session;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\RequestInterface;


// THIS IS THE ABOVE BUT WORKING WITH PHP 8.1.8 (FIXED FPM VERSION ON NGIX)
class Detail implements HttpGetActionInterface
{
    public function __construct(
        private Session $session,
        private RequestInterface $request
    ) {}

    public function execute()
    {
        echo '<pre>';
        var_dump($this->session->getData());
        var_dump($this->request->getParams());
        die();
    }
}*/


namespace Macademy\Blog\Controller\Post;

use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Event\ManagerInterface as EventManager;
use Magento\Framework\View\Result\Page;
use Magento\Framework\View\Result\PageFactory;

class Detail implements HttpGetActionInterface
{
    public function __construct(
        private PageFactory $pageFactory,
        private EventManager $eventManager,
        private RequestInterface $request,
    )
    {
    }

    public function execute(): Page
    {
        $this->eventManager->dispatch('macademy_blog_post_detail_view', [
            'request' => $this->request,
        ]);

        return $this->pageFactory->create();
    }
}
