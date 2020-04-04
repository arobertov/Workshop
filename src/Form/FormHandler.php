<?php


namespace App\Form;


use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;

class FormHandler
{
    private $formFactory;

    public function __construct(FormFactoryInterface $formFactory)
    {
        $this->formFactory = $formFactory;
    }

    public function handleWithSubmit(array $data, string $type, $entity, array $options = [])
    {
        try {
            $form = $this->formFactory->create($type, $entity, $options);
            $form->submit($data);
        } catch (\Exception $e){
            return $e->getMessage();
        }

        return $this->processSubmitted($form, $entity);
    }

    private function processSubmitted(FormInterface $form, $entity)
    {
        /* handle form error */
        if (!$form->isValid()) {
            $result =[];
            foreach ($form->getErrors(true,false) as $error){
                $fieldName = $error->current()->getOrigin()->getName();
                $result[$fieldName] = $error->current()->getMessage() ;
            }
            return $result;
        }

        if (!is_object($entity)) {
            $entity = $form->getData();
        }

        return $entity;
    }

}