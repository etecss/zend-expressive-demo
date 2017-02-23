<?php
namespace App\Form;
use App\Validation\NewsValidator;
use Zend\Form\Form as ZendForm;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Hydrator\ClassMethods as ClassMethodsHydrator;

class NewsForm extends ZendForm implements InputFilterProviderInterface
{
    /**
     * @param null|string $name
     */
    public function __construct($name = null)
    {
        $name = isset($name) ? $name : 'news-form';
        parent::__construct($name);
        $this->setAttribute('method', 'post')
            ->setHydrator(new ClassMethodsHydrator());
        $this->add([
            'name' => 'id',
            'type'  => 'hidden',
        ]);
        $this->add([
            'name' => 'title',
            'type'  => 'text',
            'options' => [
                'label' => 'Title',
            ],
            'attributes' => [
                'placeholder' => 'Title',
            ],
        ]);
        $this->add([
            'type' => 'text',
            'name' => 'content',
            'options' => [
                'label' => 'Content',
            ],
            'attributes' => [
                'placeholder' => 'Content',
            ],
        ]);
        $this->add([
            'name' => 'submit',
            'type'  => 'Submit',
            'attributes' => [
                'value' => 'Save',
            ],
        ]);
    }
    /**
     * @return array
     */
    public function getInputFilterSpecification()
    {
        $newsValidator = new NewsValidator();
        return [
            'title' => [
                'required' => true,
                'filters'  => [
                    ['name' => 'Zend\Filter\StringTrim'],
                ],
                'validators' => [
                    $newsValidator->getValidator('title')
                ]
            ],
            'content' => [
                'required' => true,
                'filters'  => [
                    ['name' => 'Zend\Filter\StringTrim'],
                ],
                'validators' => [
                    $newsValidator->getValidator('content')
                ],
            ],
        ];
    }
}
