<?php
namespace Chetu\Anshika\Controller\Index;

use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Filesystem\DirectoryList;

class Index extends \Magento\Framework\App\Action\Action
{
	protected $_pageFactory;

	public function __construct(
		\Magento\Framework\App\Action\Context $context,
		\Magento\Framework\View\Result\PageFactory $pagefactory,
		\Magento\Framework\App\ResourceConnection $resource,

		\Magento\Framework\Filesystem $filesystem,
		\Magento\Framework\Model\CustomerFactory $customerfactory)



		
	{
		$this->_pageFactory = $pageFactory;
		$this->_resource = $resource;
		$this->customerFactory = $customerFactory;
		$this->directory = $filesystem->getDirectoryWrite(DirectoryList::VAR_DIR);
			return parent::__construct($context);
	}

	public function execute()
	{
		 $connection = $this->_resource;
		 $conn=$connection->getConnection();
		
		if (!$conn){
            echo "Connection to the database failed."; 
        }
        echo "Successfully connected to the database";
		die;
		
		$name = $this->getRequest()->getParam('name');
		$age = $this->getRequest()->getParam('age');
		$email = $this->getRequest()->getParam('email');
		$phone = $this->getRequest()->getParam('phone');
		$edu = $this->getRequest()->getParam('edu');
		$cert = $this->getRequest()->getParam('cert');
		//$lang = $this->getRequest()->getParam('lang');





		$filepath = 'export/surveyForm.csv';
        $this->directory->create('export');
        $stream = $this->directory->openFile($filepath, 'w+');
        $stream->lock();

		$header = ['Name', 'age', 'email','phone','edu','cert'];
        $stream->writeCsv($header);

		$collection = $this->customerFactory->create()->getCollection();
        foreach ($collection as $customer) {
            $data = [];
            $data[] = $name;
            $data[] = $age;
            $data[] = $email;
            $data[] = $phone;
			$data[] = $edu;
			$data[] = $cert;
            $stream->writeCsv($data);
        }
		die;
    




		

		$sql = "INSERT INTO `anshika_survey_form`(`name`, `phone`, `email`, `age`, `education`, `certification`) VALUES ('$name','$phone','$email','$age','$edu','$cert')";
		
		$conn->query($sql);
			
		
		// echo "$name <br> $age <br> $email <br> $phone <br> $edu <br> $cert <br> $lang";
		// die;
	
        
		
	}
}
