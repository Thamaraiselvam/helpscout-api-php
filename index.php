<?php
require_once 'autoload.php';

use HelpScout\ApiClient;

define('HS_ADMIN_NUM', 12345);
define('HS_MAIL_BOX_PROXY', 12345);

class Convo {

	private $hs;
	private $admin_ref;
	private $customer_ref;
	private $mail_box;
	private $email;
	private $subject;
	private $body;

	public function __construct($email = 'admin@example.com') {
		$this->hs = ApiClient::getInstance();
		$this->hs->setKey('xxx');

		$this->admin_ref = $this->hs->getUserRefProxy(HS_ADMIN_NUM);
		$this->mail_box = $this->hs->getMailboxProxy(HS_MAIL_BOX_PROXY);
		$this->customer_ref = $this->hs->getCustomerRefProxy(null, $email);
		$this->email = $email;
		$this->subject = "Hey";
		$this->body = "Here you go";
		$this->create($this->subject, $this->body);
	}

	public function create($subject = '', $body = '') {

	$conversation = new \HelpScout\model\Conversation();
	$conversation->setSubject($subject);
	$conversation->setMailbox($this->mail_box);
	$conversation->setCustomer($this->customer_ref);

	$conversation->setType('email');

	$thread = new \HelpScout\model\thread\Message();

	$thread->setBody($body);

	$thread->setCreatedBy($this->admin_ref);

	$conversation->addLineItem($thread);

	$conversation->setCreatedBy($this->admin_ref);

	// $this->hs->createConversation($conversation);

	echo "Email :".$this->email."<br>";
	echo "subject :".$subject."<br>";
	echo "body :".$body."<br>";
	echo "<hr>";

	}
}


$convo = new Convo('email@gmail.com');

