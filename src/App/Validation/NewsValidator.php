<?php
namespace App\Validation;
use Zend\Validator;
class NewsValidator extends AbstractValidator
{
    public function __construct()
    {
        // Id
        $idValidator = new Validator\ValidatorChain();
        $idValidator
            ->attach(new Validator\Digits())
            ->attach(new Validator\GreaterThan(['min' => 1]));
        $this->addValidator('id', $idValidator);
        // Title
        $titleValidator = new Validator\ValidatorChain();
        $titleValidator
            ->attach(new Validator\NotEmpty([
                'message' => 'Title is required',
            ]))
            ->attach(new Validator\StringLength([
                'min' => 1,
                'max' => 32,
                'messages' => [
                    Validator\StringLength::TOO_SHORT => 'Title must have at least 4 characters',
                    Validator\StringLength::TOO_LONG  => 'Title can\'t have more than 16 characters',
                ],
            ]))
        ;
        $this->addValidator('title', $titleValidator);
        // Content
        $contentValidator = new Validator\ValidatorChain();
        $contentValidator
            ->attach(new Validator\NotEmpty([
                'message' => 'Content is required',
            ]))
            /*->attach(new Validator\ContentAddress([
                'message' => 'Invalid content format',
            ]))*/
        ;
        $this->addValidator('content', $contentValidator);
    }
    /**
     * @param string $key
     * @return \Zend\Validator\ValidatorInterface|null
     */
    public function getValidator($key)
    {
        return isset($this->validators[$key]) ? $this->validators[$key] : null;
    }
    /**
     * @param int $id
     */
    public function assertId($id)
    {
        $this->assert('id', $id);
    }
    /**
     * @param string $title
     */
    public function assertTitle($title)
    {
        $this->assert('title', $title);
    }
    /**
     * @param string $content
     */
    public function assertContent($content)
    {
        $this->assert('content', $content);
    }
}