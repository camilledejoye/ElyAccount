<?php

namespace App\Form;

use ElyAccount\Client\ClientName;
use ElyAccount\Common\Exception\EmptyFirstName;
use ElyAccount\Common\Exception\EmptyLastName;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\DataMapperInterface;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormError;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Form\Type\FirstNameType;
use App\Form\Type\LastNameType;

class ClientNameType extends AbstractType implements DataMapperInterface
{
    const FIRST_NAME = 'first_name';
    const LAST_NAME = 'last_name';


    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(self::FIRST_NAME, FirstNameType::class)
            ->add(self::LAST_NAME, LastNameType::class)
            ->setDataMapper($this);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ClientName::class,
            'empty_data' => null,
        ]);
    }

    /**
     * {@inheritDoc}
     *
     * @param ClientName $data
     * @param FormInterfaces[] $forms
     */
    public function mapDataToForms($data, $forms)
    {
        $inputs = \iterator_to_array($forms);

        $this->firstNameType($inputs)->setData($data ? $data->firstName() : '');
        $this->lastNameType($inputs)->setData($data ? $data->lastName() : '');
    }

    /**
     * {@inheritDoc}
     *
     * @param FormInterfaces[] $forms
     * @param ClientName &$data
     */
    public function mapFormsToData($forms, &$data)
    {
        $inputs = \iterator_to_array($forms);

        $firstName = $this->firstNameType($inputs);
        $LastName = $this->lastNameType($inputs);

        $data = ClientName::fromNames(
            $firstName->getData(),
            $LastName->getData()
        );
    }

    /**
     * Retrieves the first name field.
     *
     * @param FormInterface[] &$inputs
     *
     * @return FirstNameType
     */
    private function firstNameType(array &$inputs): FormInterface
    {
        return $inputs[self::FIRST_NAME];
    }

    /**
     * Retrieves the last name field.
     *
     * @param FormInterface[] &$inputs
     *
     * @return LastNameType
     */
    private function lastNameType(array &$inputs): FormInterface
    {
        return $inputs[self::LAST_NAME];
    }
}
