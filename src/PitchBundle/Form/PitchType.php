<?php

namespace PitchBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PitchType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('description', TextareaType::class)
            ->add('url')
            ->add('category', EntityType::class, array(
                'class' => 'PitchBundle:Category',
                'choice_label' => 'title',
            ))
        ;
        $builder->get('description')
            ->addModelTransformer(new CallbackTransformer(
            // transform <br/> to \n so the textarea reads easier
                function ($originalDescription) {
                    return preg_replace('#<br\s*/?>#i', "\n", $originalDescription);
                },
                function ($submittedDescription) {
                    // remove most HTML tags (but not br,p)
                    $cleaned = strip_tags($submittedDescription, '<br><br/><p>');

                    // transform any \n to real <br/>
                    return str_replace("\n", '<br/>', $cleaned);
                }
            ));
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'PitchBundle\Entity\Pitch'
        ));
    }
}
