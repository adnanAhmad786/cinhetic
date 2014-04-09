<?php

namespace Cinhetic\PublicBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CommentsMovieType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('note','choice', array(
                'choices'   => array('1' => 'Naz', '2' => 'Moyen', '3' => 'Agréable', "4" => "Bon film", '5' => "Excellent film"),
                'required'  => false,
            ))
            ->add('content', null, array('label' => "Commentaire",'attr' => array('cols' => 150, 'rows' => 5)))
            ->add('movie', "hidden")
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Cinhetic\PublicBundle\Entity\Comments'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return '';
    }
}