<?php

namespace BookmarkBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BookmarkType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', null, array('label' => 'Titre : '))
            ->add('url', null, array('label' => 'URL : '))
            ->add('mark', null, array('label' => 'Note : '))
            //->add('tags')
            //->add('icon')
            //->add('pageCapture')
            ->add('note', 'textarea', array('label' => 'Commentaires : '))
            ->add('submit', 'submit', array('label' => 'Sauver'))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BookmarkBundle\Entity\Bookmark'
        ));
    }
}
