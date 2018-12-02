<?php

namespace App\Form;

use ElyAccount\Client\ClientId;
use ElyAccount\Client\ClientName;
use ElyAccount\Client\Command\RegisterAClientCommand;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\DataMapperInterface;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegisterClientType extends AbstractType implements DataMapperInterface
{
    const NAME = 'name';
    const ID = 'client_id';


    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(self::ID, HiddenType::class)
            ->add(self::NAME, ClientNameType::class)
            ->setDataMapper($this);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => RegisterAClientCommand::class,
            'empty_data' => null,
        ]);
    }

    /**
     * {@inheritDoc}
     *
     * @param RegisterAClientCommand $data
     */
    public function mapDataToForms($data, $forms)
    {
        $inputs = \iterator_to_array($forms);

        $this->clientIdType($inputs)->setData($data ? $data->clientId() : ClientId::generate());
        $this->clientNameType($inputs)->setData($data ? $data->clientName() : null);
    }

    /**
     * {@inheritDoc}
     */
    public function mapFormsToData($forms, &$data)
    {
        $inputs = \iterator_to_array($forms);

        $data = RegisterAClientCommand::prepare(
            ClientId::fromString($this->clientIdType($inputs)->getData()),
            $this->clientNameType($inputs)->getData()
        );
        dump($data);
    }

    /**
     * Retrieves the client identity field.
     *
     * @param FormInterface[] &$inputs
     *
     * @return HiddenType
     */
    private function clientIdType(array &$inputs): FormInterface
    {
        return $inputs[self::ID];
    }

    /**
     * Retrieves the client name field.
     *
     * @param FormInterface &$inputs
     *
     * @return ClientNameType
     */
    private function clientNameType(array &$inputs): FormInterface
    {
        return $inputs[self::NAME];
    }
}
