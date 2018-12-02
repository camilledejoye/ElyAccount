<?php

namespace App\Form\Type;

use ElyAccount\Common\Exception\EmptyFirstName;
use ElyAccount\Common\FirstName;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Exception\TransformationFailedException;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FirstNameType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->addModelTransformer(new CallbackTransformer(
            function ($firstName) {
                if (!$firstName) {
                    return;
                }

                return (string) $firstName;
            },
            function ($stringFirstName) {
                if (!$stringFirstName) {
                    throw new TransformationFailedException('A first name can not be empty.');
                }

                if (!is_string($stringFirstName)) {
                    throw new TransformationFailedException('Expected a string.');
                }

                try {
                    return FirstName::fromString($stringFirstName);
                } catch (EmptyFirstName $exception) {
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
            'invalid_message' => 'A first name can not be empty',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'firstname';
    }

    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
        return TextType::class;
    }
}
