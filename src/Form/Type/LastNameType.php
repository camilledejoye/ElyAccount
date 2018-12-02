<?php

namespace App\Form\Type;

use ElyAccount\Common\Exception\EmptyLastName;
use ElyAccount\Common\LastName;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Exception\TransformationFailedException;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LastNameType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->addModelTransformer(new CallbackTransformer(
            function ($lastName) {
                if (!$lastName) {
                    return;
                }

                return (string) $lastName;
            },
            function ($stringLastName) {
                if (!$stringLastName) {
                    throw new TransformationFailedException('A last name can not be empty.');
                }

                if (!is_string($stringLastName)) {
                    throw new TransformationFailedException('Expected a string.');
                }

                try {
                    return LastName::fromString($stringLastName);
                } catch (EmptyLastName $exception) {
                    throw new TransformationFailedException(
                        $exception->getMessage(),
                        $exception->getCode(),
                        $exception
                    );
                }
            }
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'invalid_message' => 'A last name can not be empty',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'lastname';
    }

    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
        return TextType::class;
    }
}
